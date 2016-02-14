<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use \App\Model\Category;
use Redirect;
use Input;

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
            $categories = Category::where('id','LIKE',"%".$request->input('search')."%")
                    ->orWhere('category_name','LIKE',"%".$request->input('search')."%")
                    ->paginate(5);
        }else{
            if ($request->has('sortby')){
                $categories = Category::orderBy($request->input('sortby'))
                    ->paginate(5);
            }else{
                $categories = Category::paginate(5);
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

            Input::merge(array_map(function ($value) {
                if (is_string($value)) {
                    return trim($value);
                } else {
                    return $value;
                }
            }, Input::all()));


            $this->validate($request, [
                'category_name' => 'required|unique:product_category|max:255|min:3',
                'category_code' => 'required|min:2',
                'category_desc' => 'required|min:10',
            ]);


            $categobj = new Category;
            $categobj->category_name = $request->input('category_name');
            $categobj->category_code = $request->input('category_code');
            $categobj->category_desc = $request->input('category_desc');
            $categobj->is_active = true;
            $categobj->save();

            return Redirect::to('/back/category/edit/'.$categobj->id);

        }catch(Exception $e){
            return Redirect::to('/back/category/create')->withwith('message','Oops! Something went wrong. Please try again later' );
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
    public function update(Request $request,$id)
    {
        try{
            $this->validate($request, [
                'category_name' => 'required|max:255|min:3',
                'category_code' => 'required|min:2',
                'category_desc' => 'required|min:10',
            ]);
            $is_active = ($request->input('is_active'))? true : false;
            $categobj = new Category;
            $categobj->where('id',$id)
                ->update([
                    'category_name' => $request->input('category_name'),
                    'category_code' => $request->input('category_code'),
                    'category_desc' => $request->input('category_desc'),
                    'is_active' => $is_active
                ]);

            return Redirect::to("/back/category/edit/$id")->with('message', $request->input('category_name') . ' was successfully updated');
        }catch(Exception $e){
            return Redirect::to("/back/category/edit/$id")->with('message','Oops! Something went wrong. Please try again later' );
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
