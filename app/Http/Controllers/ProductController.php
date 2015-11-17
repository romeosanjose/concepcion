<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Category;
use App\Model\Files;
use App\Model\Module;
use Config;
use DB;

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
                $products = Product::where('is_active',1)
                    ->orderBy($request->input('sortby')) 
                    ->paginate(5);
            }else{
                $products = Product::where('is_active',1)
                        ->paginate(5);
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
        $categories = Category::all();
        return view('pages.admin.product.create',['categories'=>$categories]);
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
                'pre_stocks' => 'required|numeric',
                'price' => 'required|numeric'
            ]);
            $productobj = new Product;
            $productobj->product_name = $request->input('product_name');
            $productobj->product_desc = $request->input('product_desc');
            $productobj->category_id = $request->input('category');
            $productobj->product_code = $request->input('productcateg_code');
            $productobj->size1 = $request->input('size1');
            $productobj->size2 = $request->input('size2');
            $productobj->size3 = $request->input('size3');
            $productobj->size4 = $request->input('size4');
            $productobj->pre_stocks = $request->input('pre_stocks');
            $productobj->stocks = $request->input('stocks');
            $productobj->price = $request->input('price');
            $productobj->gross_price = $request->input('gross_price');
            $productobj->is_active = true;
            $productobj->save();
            
            
            if ($request->input('fileId')!='' && $request->input('fileId')!=null ){
                Files::where('id',$request->input('fileId'))
                        ->update([
                            'attachment_id' => $productobj->id
                        ]);
            }
            
            return json_encode(array("message"=>"Success! New Category has been added"));
        }catch(Exception $e){
            return json_encode(array("message"=>"Oops! Something went wrong. Please try again later"));
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
        $categories = Category::all();
        return view('pages.admin.product.edit', ['product'=>$product,'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
         try{
            $this->validate($request, [
                'product_name' => 'required|max:255|min:3',
                'product_desc' => 'required|min:1|max:500',
                'pre_stocks' => 'required|numeric',
                'price' => 'required|numeric'
            ]);
            
            $is_active = ($request->input('isactive')=='1')? true : false;
            $productobj = new Product;
            $productobj->where('id',$request->input('id'))
                    ->update([
                            'product_name' => $request->input('product_name'),
                            'product_desc' => $request->input('product_desc'),
                            'category_id' => $request->input('category'),
                            'product_code' => $request->input('productcateg_code'),
                            'size1' => $request->input('size1'),
                            'size2' => $request->input('size2'),
                            'size3' => $request->input('size3'),
                            'size4' => $request->input('size4'),
                            'pre_stocks' => $request->input('pre_stocks'),
                            'stocks' => $request->input('stocks'),
                            'price' => $request->input('price'),
                            'gross_price' => $request->input('gross_price'),
                            'is_active' => $is_active
                    ]);
            
            if ($request->input('fileId')!='' && $request->input('fileId')!=null ){
                Files::where('id',$request->input('fileId'))
                        ->update([
                            'attachment_id' => $request->input('id')
                        ]);
            }
            
            return json_encode(array("message"=>"Success! Product ". $request->input('product_name') ." has been updated"));
        }catch(Exception $e){
            return json_encode(array("message"=>"Oops! Something went wrong. Please try again later"));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function upload(Request $request){
        if ($request->hasFile('files'))
        {
         if ($request->file('files')[0]->isValid()){    
             $module = Module::find(2);
             $file = new Files;
             $fileName = $module->module_name . md5(time()) . '.jpg';
             $file->disk_name = $fileName;
             $file->file_name = $request->file('files')[0]->getClientOriginalName();
             $file->module_id = 2; //product
             $file->save();
             $fileId = $file->id;
             $request->file('files')[0]->move(base_path().Config::get('app.filepath') .'/'. $module->module_name, $fileName);
             echo json_encode(array('fileId'=>$fileId));
            
         }
        }
    }
}
