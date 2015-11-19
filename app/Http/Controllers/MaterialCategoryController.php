<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use \App\Model\MaterialCategory;
use Redirect;

class MaterialCategoryController extends Controller
{
    /**
     * These are for Front-End Actions
     */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }


    /**
     * The following are for Backend Actions
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('search')){
            $materialcategories = MaterialCategory::where('id','LIKE',"%".$request->input('search')."%")
                    ->orWhere('material_categ_name','LIKE',"%".$request->input('search')."%")
                    ->paginate(5);
        }else{
            if ($request->has('sortby')){
                $materialcategories = MaterialCategory::orderBy($request->input('sortby'))
                    ->paginate(5);
            }else{
                $materialcategories = MaterialCategory::paginate(5);
            }
        }

        $materialcategories->setPath(url().'/back/materialcategory');
        return view('pages.admin.materialcategory.list', ['materialcategories'=>$materialcategories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('pages.admin.materialcategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = "";
        try{


            $this->validate($request, [
                'material_categ_name' => 'required|unique:material_category|max:255|min:3',
                'material_categ_desc' => 'required|min:10',
            ]);


            $matCategObj = new MaterialCategory;
            $matCategObj->material_categ_name = $request->input('material_categ_name');
            $matCategObj->material_categ_desc = $request->input('material_categ_desc');
            $matCategObj->is_active = true;
            $matCategObj->save();

            return Redirect::to('/back/materialcategory/edit/'.$matCategObj->id);

        }catch(Exception $e){
           return Redirect::to('/back/materialcategory/create')->withwith('message','Oops! Something went wrong. Please try again later' );
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
        $matCategObj = new MaterialCategory;
        $materialcateg = $matCategObj->find($id);
        
        return view('pages.admin.materialcategory.edit', ['materialcateg'=>$materialcateg]);
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
                'material_categ_name' => 'required|max:255|min:3',
                'material_categ_desc' => 'required|min:10'
            ]);
            $is_active = ($request->input('is_active'))? true : false;
            $matCategObj = new MaterialCategory;
            $matCategObj->where('id',$id)
                    ->update([
                        'material_categ_name' => $request->input('material_categ_name'),
                        'material_categ_desc' => $request->input('material_categ_desc'),
                        'is_active' => $is_active
                    ]);
            
            return Redirect::to("/back/materialcategory/edit/$id")->with('message', $request->input('material_categ_name') . ' was successfully updated');
        }catch(Exception $e){
            return Redirect::to("/back/materialcategory/edit/$id")->with('message','Oops! Something went wrong. Please try again later' );
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
