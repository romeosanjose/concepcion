<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use \App\Model\Category;
use \App\Model\CategoryCode;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('search')){
            $categories = Category::where('is_active',1)
                    ->where('id','LIKE',"%".$request->input('search')."%")
                    ->orWhere('category_name','LIKE',"%".$request->input('search')."%")
                    ->paginate(5);
        }else{
            if ($request->has('sortby')){
                $categories = Category::where('is_active',1)
                    ->orderBy($request->input('sortby')) 
                    ->paginate(5);
            }else{
                $categories = Category::where('is_active',1)
                        ->paginate(5);
            }
        }

        $categories->setPath(url().'/back/category');
        return view('pages.admin.category.list', ['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('pages.admin.category.create');
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
                'category_name' => 'required|unique:product_category|max:255|min:3',
                'category_code' => 'required|unique:product_category|min:1|max:4',
                'category_desc' => 'required|min:10',
            ]);

            $categobj = new Category;
            $categobj->category_name = $request->input('category_name');
            $categobj->category_code = $request->input('category_code');
            $categobj->category_desc = $request->input('category_desc');
            $categobj->is_active = true;
            $categobj->save();
            
            return json_encode(array("message"=>"Success! New Category has been added"));
        }catch(Exception $e){
            return json_encode(array("message"=>"Oops! Something went wrong. Please try again later"));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categobj = new Category;
        $categ = $categobj->find($id);
        
        return view('pages.admin.category.edit', ['category'=>$categ]);
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
                'category_name' => 'required|max:255|min:3',
                'category_code' => 'required|min:1|max:4',
                'category_desc' => 'required|min:10',
            ]);
            $is_active = ($request->input('isactive')=='1')? true : false;
            $categobj = new Category;
            $categobj->where('id',$request->input('id'))
                    ->update([
                        'category_name' => $request->input('category_name'),
                        'category_code' => $request->input('category_code'),
                        'category_desc' => $request->input('category_desc'),
                        'is_active' => $is_active
                    ]);
            
            return json_encode(array("message"=>"Success! category ". $request->input('category_name') ." has been updated"));
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
}
