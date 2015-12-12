<?php

namespace App\Http\Controllers;

use App\Model\MainSubProduct;
use App\Model\SubProductMaterial;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Category;
use App\Model\Files;
use App\Model\MaterialCategory;
use App\Model\Material;
use App\Model\ProductMaterial;
use App\Model\SubProduct;
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
            $products = DB::select("select product.*,(select disk_name from files where attachment_id=product.id and module_id= 2 and is_active=1 order by id desc limit 1) as disk_name " .
                                        "from product " .
                                        "where product.is_active=1 " .
                                        "and product.id LIKE '%".$request->input('search')."%' OR product.product_name LIKE '%".$request->input('search'). "%' " .
                                        "group by product.id "

                                                    );
        }else if ($request->has('sortby')){
             $products = DB::select('select product.*,(select disk_name from files where attachment_id=product.id and module_id= 2 and is_active=1 order by id desc limit 1) as disk_name ' .
                                         'from product ' .
                                         'where product.is_active=1 ' .
                                         'group by product.id ' .
                                         'order by :sortby ',
                                         [':sortby'=>$request->input('sortby')]
                                                    );
        }else{
           $products = DB::select('select product.*,(select disk_name from files where attachment_id=product.id and module_id= 2 and is_active=1 order by id desc limit 1) as disk_name ' .
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
        $product = Product::find($id);
        $moduleId = 2; //product
        //get the image assiociates
        $prodFiles = Files::where('attachment_id',$product->id)
            ->where('is_active',True)
            ->where('module_id',$moduleId)
            ->get();

        //get product materials
        $prodMaterials = Product::find($id)
            ->materials()
            ->get();
        $curMaterials = array();
        $matcategids = array();
        foreach ($prodMaterials as $pm){
            //gets the current set materials
            $matExtObject = Material::where('is_active',true)
                ->where('id',$pm->material_id)
                ->first();

            array_push($curMaterials,$matExtObject);
            array_push($matcategids,$matExtObject->material_categ_id);
            $matExtObject = null;

        }
        //get materialcategory from materials
        $materialCategs = MaterialCategory::whereIn('id',$matcategids)->get();
        //all materials
        $allMaterials = Material::all();


        //1. get subproducts from product
        $curSubProducts = array();
        $curSubProductsNames = array();
        $matPriceArray= '';
        $subProducts = Product::find($id)
            ->sub_products()
            ->get();

        foreach ($subProducts as $pm){
            $subprodExtObject = SubProduct::where('is_active',true)
                ->where('id',$pm->sub_product_id)
                ->first();
            array_push($curSubProducts,$subprodExtObject);
            array_push($curSubProductsNames,$subprodExtObject->sub_product_name);
            $subprodExtObject = null;
        }

        $currMaterialsDet = array();
        foreach($curSubProducts as $curSubProduct){
            $prodMaterials = SubProduct::find($curSubProduct->id)
                ->materials()
                ->get();

            foreach ($prodMaterials as $pm){
                //gets the current set materials
                $matExtObject = Material::where('is_active',true)
                    ->where('id',$pm->material_id)
                    ->first();

                array_push($currMaterialsDet,array('subprod_name'=>$curSubProduct->sub_product_name,'mat_sub_id'=>$matExtObject->id,'mat_sub_name'=>$matExtObject->material_name,'mat_sub_price'=>$pm->mat_sub_price));
                $matPriceArray[$matExtObject->material_name] = array();
                $matExtObject = null;

            }

        }

//        echo '<pre>';
        $count= 0;
        foreach ($curSubProducts as $cuuProd) {

            foreach ($currMaterialsDet as $matItem) {
                $matCount = SubProductMaterial::where('sub_product_id',$cuuProd->id)
                                ->where('material_id',$matItem['mat_sub_id'])
                                ->first();
                if ($matCount){


                    //check if key value pairs exist first
                    if (!empty($matPriceArray[$matItem['mat_sub_name']])){
                        $isExist = False;

                        if (array_key_exists($count,$matPriceArray[$matItem['mat_sub_name']])) {

                            if (array_key_exists($cuuProd->sub_product_name, $matPriceArray[$matItem['mat_sub_name']][$count])) {
                                if ($count < count($matPriceArray)) {
//                                    print 'key: ' . key($matPriceArray[$matItem['mat_sub_name']][$count]) . ' productname: ' . $cuuProd->sub_product_name . '<br>';
                                    if (key($matPriceArray[$matItem['mat_sub_name']][$count]) == $cuuProd->sub_product_name) {
//                                        print 'exist<br>';
//                                        print 'price: ' . $matPriceArray[$matItem['mat_sub_name']][$count][$cuuProd->sub_product_name] . ' price actual: ' . $matCount->mat_sub_price . '<br>';
                                        if ($matPriceArray[$matItem['mat_sub_name']][$count][$cuuProd->sub_product_name] == $matCount->mat_sub_price) {

                                            $isExist = True;
                                            continue;
                                        }
                                    }
                                }else{
                                    break;
                                }
                            }
                        }

                        if (!$isExist){
                            array_push($matPriceArray[$matItem['mat_sub_name']], array($cuuProd->sub_product_name=>$matCount->mat_sub_price) );
                        }

                    }else{
                        array_push($matPriceArray[$matItem['mat_sub_name']], array($cuuProd->sub_product_name=>$matCount->mat_sub_price) );
                    }

                } else {


                    //check if key value pairs exist first
                    if (!empty($matPriceArray[$matItem['mat_sub_name']])){
                        $isExist = False;
                        if (array_key_exists($count,$matPriceArray[$matItem['mat_sub_name']])) {
                            if (array_key_exists($cuuProd->sub_product_name, $matPriceArray[$matItem['mat_sub_name']][$count])) {
                                if ($count < count($matPriceArray)) {
                                    if (key($matPriceArray[$matItem['mat_sub_name']][$count]) == $cuuProd->sub_product_name) {
                                        if ($matPriceArray[$matItem['mat_sub_name']][$count][$cuuProd->sub_product_name] == '&nbsp;') {

                                            $isExist = True;
                                            continue;
                                        }
                                    }
                                }else{
                                    break;
                                }
                            }
                        }
                       if (!$isExist){
                            array_push($matPriceArray[$matItem['mat_sub_name']], array($cuuProd->sub_product_name=>'&nbsp;') );
                        }

                    }else{
                        array_push($matPriceArray[$matItem['mat_sub_name']], array($cuuProd->sub_product_name=>'&nbsp;') );
                    }



                }


            }
            $count++;
        }


        return view('pages.product.show', ['product'=>$product,'curSubProducts'=>$curSubProducts,'matPriceArray'=>$matPriceArray,'prodFiles'=>$prodFiles,'curMaterials'=>$curMaterials,'materialCategs'=>$materialCategs,'allMaterials'=>$allMaterials]);
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
        $moduleId = 2; //product
        //get the image assiociates
        $prodFiles = Files::where('attachment_id',$product->id)
            ->where('is_active',True)
            ->where('module_id',$moduleId)
            ->get();

        //materials sesction
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

       //get all the materials not in current product
        $allMaterials = Material::whereNotIn('id',$curMatIds)
                                ->orderBy('material_name','asc')
                                ->get();


        //subproducts section
        //get all subproducts associated
        $curSubProducts = array();
        $curSubProductIds = array();
        $subProducts = Product::find($id)
            ->sub_products()
            ->get();


        foreach ($subProducts as $pm){
            //gets the current set materials
            $subprodExtObject = SubProduct::where('is_active',true)
                ->where('id',$pm->sub_product_id)
                ->first();

            array_push($curSubProducts,$subprodExtObject);
            array_push($curSubProductIds,$pm->sub_product_id);
            $subprodExtObject = null;

        }

        //get all the subproducts not in current main product
        $allSubProducts = SubProduct::whereNotIn('id',$curSubProductIds)
            ->orderBy('sub_product_name','asc')
            ->get();


        return view('pages.admin.product.edit', ['product'=>$product, 'productCategories'=>$productCategories, 'productCategId'=>$productCategId,
                                                 'prodFiles'=>$prodFiles,'allMaterials'=>$allMaterials, 'curMaterials'=> $curMaterials,
                                                 'allSubProducts'=>$allSubProducts, 'curSubProducts'=> $curSubProducts,'moduleId'=>$moduleId
                                                ]);
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
     * API or removing materials being called from js
     */
    public function removeMaterial(Request $request){
        $prodId = $request->input('product_id');
        $matId = $request->input('material_id');
        //delete material product
        ProductMaterial::where('product_id',$prodId)
                                  ->where('material_id',$matId)
                                  ->delete();

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
     * API for adding subproducts being called from js
     */
    public function addSubProduct(Request $request){
        $prodId = $request->input('product_id');
        $subProdId = $request->input('sub_product_id');
        //add sub product
        $subProd = new MainSubProduct();
        $subProd->product_id = $prodId;
        $subProd->sub_product_id = $subProdId;
        $subProd->save();

        //get all subproducts associated
        $curSubProducts = array();
        $curSubProductIds = array();
        $subProducts = Product::find($prodId)
            ->sub_products()
            ->get();


        foreach ($subProducts as $pm){
            //gets the current set materials
            $subprodExtObject = SubProduct::where('is_active',true)
                ->where('id',$pm->sub_product_id)
                ->first();

            array_push($curSubProducts,$subprodExtObject);
            array_push($curSubProductIds,$pm->sub_product_id);
            $subprodExtObject = null;

        }

        //get all the subproducts not in current main product
        $allSubProducts = SubProduct::whereNotIn('id',$curSubProductIds)
            ->orderBy('sub_product_name','asc')
            ->get();

        //return current and all materials
        return json_encode(array('curSubProducts'=>$curSubProducts,'allSubProducts'=>$allSubProducts));
    }


    /**
     * API or removing materials being called from js
     */
    public function removeSubProduct(Request $request){
        $prodId = $request->input('product_id');
        $subProdId = $request->input('sub_product_id');
        //delete sub product
        MainSubProduct::where('product_id',$prodId)
            ->where('sub_product_id',$subProdId)
            ->delete();

        //get all subproducts associated
        $curSubProducts = array();
        $curSubProductIds = array();
        $subProducts = Product::find($prodId)
            ->sub_products()
            ->get();


        foreach ($subProducts as $pm){
            //gets the current set materials
            $subprodExtObject = SubProduct::where('is_active',true)
                ->where('id',$pm->sub_product_id)
                ->first();

            array_push($curSubProducts,$subprodExtObject);
            array_push($curSubProductIds,$pm->sub_product_id);
            $subprodExtObject = null;

        }

        //get all the subproducts not in current main product
        $allSubProducts = SubProduct::whereNotIn('id',$curSubProductIds)
            ->orderBy('sub_product_name','asc')
            ->get();

        //return current and all materials
        return json_encode(array('curSubProducts'=>$curSubProducts,'allSubProducts'=>$allSubProducts));
    }
}
