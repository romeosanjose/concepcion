<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\SubProduct;
use App\Model\Files;
use App\Model\Material;
use App\Model\SubProductMaterial;
use Config;
use DB;
use Redirect;

class SubProductController extends Controller
{
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('search')){
            $products = SubProduct::where('is_active',1)
                ->where('id','LIKE',"%".$request->input('search')."%")
                ->orWhere('product_name','LIKE',"%".$request->input('search')."%")
                ->paginate(5);
        }else{
            if ($request->has('sortby')){
                $products = SubProduct::orderBy($request->input('sortby'))
                    ->paginate(5);
            }else{
                $products = SubProduct::paginate(5);
            }
        }

        $products->setPath(url().'/back/subproduct');
        return view('pages.admin.subproduct.list', ['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.subproduct.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $this->validate($request, [
                'sub_product_name' => 'required|unique:sub_product|max:255|min:3',
                'sub_product_desc' => 'required|min:1|max:500',
                'price' => 'required|numeric',
                'size' => 'required|numeric'
            ]);
            $productobj = new SubProduct;
            $productobj->sub_product_name = $request->input('sub_product_name');
            $productobj->sub_product_desc = $request->input('sub_product_desc');
            $productobj->size = $request->input('size');
            $productobj->price = $request->input('price');
            $productobj->is_active = true;
            $productobj->save();
            
            return Redirect::to('/back/subproduct/edit/'.$productobj->id);

        }catch(Exception $e){
            return Redirect::to('/back/subproduct/create')->withwith('message','Oops! Something went wrong. Please try again later' );
        }
    }

   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productobj = new SubProduct;
        $product = $productobj->find($id);
        $moduleId = 6; //project
        //get the image assiociates
        $prodFiles = Files::where('attachment_id',$product->id)
            ->where('is_active',True)
            ->where('module_id',$moduleId)
            ->get();


        //get all materials associated
        $curMaterials = array();
        $curMatIds = array();
        $prodMaterials = SubProduct::find($id)
            ->materials()
            ->get();


        foreach ($prodMaterials as $pm){
            //gets the current set materials
            $matExtObject = Material::where('is_active',true)
                                    ->where('id',$pm->material_id)
                                    ->first();

            array_push($curMaterials,$matExtObject);
            array_push($curMatIds,$pm->material_id);
            $matExtObject = null;

        }

        $allMaterials = Material::whereNotIn('id',$curMatIds)
                                ->orderBy('material_name','asc')
                                ->get();

        return view('pages.admin.subproduct.edit', ['product'=>$product,'prodFiles'=>$prodFiles,'allMaterials'=>$allMaterials, 'curMaterials'=> $curMaterials,'moduleId'=>$moduleId]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
         try{
             $this->validate($request, [
                 'sub_product_name' => 'required|max:255|min:3',
                 'sub_product_desc' => 'required|min:1|max:500',
                 'price' => 'required|numeric',
                 'size' => 'required|numeric'
             ]);
            
            $is_active = ($request->input('is_active'))? true : false;
            $productobj = new SubProduct;
            $productobj->where('id',$request->input('id'))
                    ->update([
                            'sub_product_name' => $request->input('sub_product_name'),
                            'sub_product_desc' => $request->input('sub_product_desc'),
                            'size' => $request->input('size'),
                            'price' => $request->input('price'),
                            'is_active' => $is_active
                    ]);

             //update attachment images
             if ($request->has('img')) {
                 foreach ($request->input('img') as $img){
                     //unserialize image value
                     $imgVal = unserialize($img);
                     if ($imgVal[1]) {
                         $fileObj = new Files;
                         $fileObj->where('id',$imgVal[0])
                             ->update([
                                 'attachment_id' => $id
                             ]);
                     } else {
                         $fileObj = new Files;
                         $fileObj->where('id',$imgVal[0])
                             ->update([
                                 'is_active' => false
                             ]);
                     }
                 }
             }
             return Redirect::to("/back/subproduct/edit/$id")->with('message', $request->input('sub_product_name') . ' was successfully updated');
         }catch(Exception $e){
             return Redirect::to("/back/subproduct/edit/$id")->with('message','Oops! Something went wrong. Please try again later' );
         }
    }


    /**
     * API for adding materials being called from js
     */
    public function addMaterial(Request $request){
        $prodId = $request->input('sub_product_id');
        $matId = $request->input('material_id');
        $matPrice = $request->input('price');
        //add material product
        $prodMat = new SubProductMaterial();
        $prodMat->sub_product_id = $prodId;
        $prodMat->material_id = $matId;
        $prodMat->mat_sub_price = $matPrice;

        $prodMat->is_active = true;
        $prodMat->save();

        //get the product-materials
        $curMaterials = array();
        $curMatIds = array();
        $prodMaterials = SubProduct::find($prodId)
            ->materials()
            ->get();
        foreach ($prodMaterials as $pm){
            //gets the current set materials
            $matExtObject = Material::where('is_active',true)
                ->where('id',$pm->material_id)
                ->first();
            array_push($curMaterials,$matExtObject);
            array_push($curMatIds,$pm->material_id);

        }

        //get the all current materials
        $allMaterials = Material::whereNotIn('id',$curMatIds)
            ->where('is_active',True)
            ->orderBy('material_name','asc')
            ->get();

        //return current and all materials
        return json_encode(array('curMaterials'=>$curMaterials,'allMaterials'=>$allMaterials));
    }

    /**
     * API or adding materials being called from js
     */
    public function removeMaterial(Request $request){
        $prodId = $request->input('sub_product_id');
        $matId = $request->input('material_id');
        //delete material product
        SubProductMaterial::where('sub_product_id',$prodId)
                                  ->where('material_id',$matId)
                                  ->delete();
        //get the product-materials
        $curMaterials = array();
        $curMatIds = array();
        $prodMaterials = SubProduct::find($prodId)
            ->materials()
            ->get();
        foreach ($prodMaterials as $pm){
            //gets the current set materials
            $matExtObject = Material::where('is_active',true)
                ->where('id',$pm->material_id)
                ->first();
            array_push($curMaterials,$matExtObject);
            array_push($curMatIds,$pm->material_id);

        }

        //get the all current materials
        $allMaterials = Material::whereNotIn('id',$curMatIds)
            ->where('is_active',True)
            ->orderBy('material_name','asc')
            ->get();

        //return current and all materials
        return json_encode(array('curMaterials'=>$curMaterials,'allMaterials'=>$allMaterials));
    }

}
