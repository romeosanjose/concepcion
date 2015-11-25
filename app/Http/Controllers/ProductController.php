<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Category;
use App\Model\Files;
use App\Model\Module;
use App\Model\Material;
use App\Model\ProductMaterial;
use Config;
use DB;
use Redirect;

class ProductController extends Controller
{
    
    
    /* Display a listing of the resource in front end.
     *
     * @return \Illuminate\Http\Response
     */
    public function lists(Request $request)
    {
         if ($request->has('search')){
            $products = DB::select('select product.*,(select disk_name from files where attachment_id=product.id and module_id= 1) as disk_name ' .
                                                        'from product ' .
                                                        'where product.is_active=1 ' .
                                                        'where product.id LIKE %:search% OR product.product_name LIKE %:search% ' .
                                                        'group by product.id ',
                                                    [':search'=>$request->input('search')]
                                                    );
        }else if ($request->has('sortby')){
             $products = DB::select('select product.*,(select disk_name from files where attachment_id=product.id and module_id= 1) as disk_name ' .
                                                        'from product ' .
                                                        'where product.is_active=1 ' .
                                                        'group by product.id ' .
                                                        'order by :sortby',
                                                    [':sortby'=>$request->input('sortby')]
                                                    );
        }else{
           $products = DB::select('select product.*,(select disk_name from files where attachment_id=product.id and module_id= 1) as disk_name ' .
                                                        'from product ' .
                                                        'where product.is_active=1 ' .
                                                        'group by product.id '
                                                    );

        }
        $categories = Category::all();
        return view('pages.product.list', ['products'=>$products,'categories'=>$categories]);
    }
    
     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

         $product = DB::select('select product.*,(select disk_name from files where attachment_id=product.id and module_id= 1) as disk_name ' .
                                                        'from product ' .
                                                        'where product.is_active=1 ' .
                                                        'and product.id=:id ' .
                                                        'group by product.id ',
                                                    [':id'=>$id]  
                                                    );
        return view('pages.product.show', ['product'=>$product]);   
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('search')){
            $products = Product::where('is_active',1)
                ->where('id','LIKE',"%".$request->input('search')."%")
                ->orWhere('product_name','LIKE',"%".$request->input('search')."%")
                ->paginate(5);
        }else{
            if ($request->has('sortby')){
                $products = Product::orderBy($request->input('sortby'))
                    ->paginate(5);
            }else{
                $products = Product::paginate(5);
            }
        }

        $products->setPath(url().'/back/product');
        return view('pages.admin.product.list', ['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productCategories = Category::all();
        return view('pages.admin.product.create',['productCategories'=>$productCategories]);
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
                'product_name' => 'required|unique:product|max:255|min:3',
                'product_desc' => 'required|min:1|max:500',
                'price' => 'required|numeric',
                'size' => 'required|numeric'
            ]);
            $productobj = new Product;
            $productobj->product_name = $request->input('product_name');
            $productobj->product_desc = $request->input('product_desc');
            $productobj->category_id = $request->input('product_category');
            $productobj->product_code = $request->input('productcateg_code');
            $productobj->size = $request->input('size');
            $productobj->price = $request->input('price');
            $productobj->is_active = true;
            $productobj->save();
            
            return Redirect::to('/back/product/edit/'.$productobj->id);

        }catch(Exception $e){
            return Redirect::to('/back/product/create')->withwith('message','Oops! Something went wrong. Please try again later' );
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
        $productobj = new Product;
        $product = $productobj->find($id);
        $productCategories = Category::all();
        $productCategId = Category::find($product->category_id);
        //get the image assiociates
        $prodFiles = Files::where('attachment_id',$product->id)
            ->where('is_active',True)
            ->get();


        //get all materials associated
        $curMaterials = array();
        $curMatIds = array();
        $prodMaterials = Product::find($id)
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
//        echo '<pre>';
//        print_r($curMatIds);die();
       //get all the materials not in current product
        $allMaterials = Material::whereNotIn('id',$curMatIds)
                                ->orderBy('material_name','asc')
                                ->get();

        return view('pages.admin.product.edit', ['product'=>$product, 'productCategories'=>$productCategories, 'productCategId'=>$productCategId,
                                                 'prodFiles'=>$prodFiles,'allMaterials'=>$allMaterials, 'curMaterials'=> $curMaterials]);
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
                 'product_name' => 'required|max:255|min:3',
                 'product_desc' => 'required|min:1|max:500',
                 'price' => 'required|numeric',
                 'size' => 'required|numeric'
             ]);
            
            $is_active = ($request->input('is_active'))? true : false;
            $productobj = new Product;
            $productobj->where('id',$request->input('id'))
                    ->update([
                            'product_name' => $request->input('product_name'),
                            'product_desc' => $request->input('product_desc'),
                            'category_id' => $request->input('product_category'),
                            'product_code' => $request->input('productcateg_code'),
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
             return Redirect::to("/back/product/edit/$id")->with('message', $request->input('product_name') . ' was successfully updated');
         }catch(Exception $e){
             return Redirect::to("/back/product/edit/$id")->with('message','Oops! Something went wrong. Please try again later' );
         }
    }


    /**
     * API for adding materials being called from js
     */
    public function addMaterial(Request $request){
        $prodId = $request->input('product_id');
        $matId = $request->input('material_id');
        //add material product
        $prodMat = new ProductMaterial();
        $prodMat->product_id = $prodId;
        $prodMat->material_id = $matId;
        $prodMat->is_active = true;
        $prodMat->save();

        //get the product-materials
        $curMaterials = array();
        $curMatIds = array();
        $prodMaterials = Product::find($prodId)
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
        $prodId = $request->input('product_id');
        $matId = $request->input('material_id');
        //delete material product
        ProductMaterial::where('product_id',$prodId)
                                  ->where('material_id',$matId)
                                  ->delete();

//        $prodMat->where('product_id',$prodId)
//            ->where('material_id',$matId)
//            ->update([
//                'is_active' => false
//            ]);

        //get the product-materials
        $curMaterials = array();
        $curMatIds = array();
        $prodMaterials = Product::find($prodId)
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
