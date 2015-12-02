<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Material;
use App\Model\MaterialCategory;
use App\Model\Files;
use Redirect;


class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('search')){
            $materials = Material::where('is_active',1)
                ->where('id','LIKE',"%".$request->input('search')."%")
                ->orWhere('material_name','LIKE',"%".$request->input('search')."%")
                ->paginate(5);
        }else{
            if ($request->has('sortby')){
                $materials = Material::where('is_active',1)
                    ->orderBy($request->input('sortby'))
                    ->paginate(5);
            }else{
                $materials = Material::where('is_active',1)
                    ->paginate(5);
            }
        }

        $materials->setPath(url().'/back/material');
        return view('pages.admin.material.list', ['materials'=>$materials]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $materialCategories = MaterialCategory::all();
        return view('pages.admin.material.create',['materialCategories'=>$materialCategories]);
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
                'material_name' => 'required|unique:material|max:255|min:3',
                'material_desc' => 'required|min:10',
                'price' => 'required:numeric',
                'size' => 'required:numeric'
            ]);

            $matObj = new Material;
            $matObj->material_name = $request->input('material_name');
            $matObj->material_desc = $request->input('material_desc');
            $matObj->material_categ_id = $request->input('material_category');
            $matObj->price = $request->input('price');
            $matObj->size = $request->input('size');
            $matObj->is_active = true;
            $matObj->save();

            return Redirect::to('/back/material/edit/'.$matObj->id);

        }catch(Exception $e){
            return Redirect::to('/back/material/create')->withwith('message','Oops! Something went wrong. Please try again later' );
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
        $matObj = new Material;
        $material = $matObj->find($id);
        $materialCategories = MaterialCategory::all();
        $materialCategId = MaterialCategory::find($material->material_categ_id);
        $moduleId = 4; //material
        //get the image assiociates
        $matFiles = Files::where('attachment_id',$material->id)
                           ->where('is_active',True)
                           ->where('module_id',$moduleId)
                           ->get();
        return view('pages.admin.material.edit', ['material'=>$material, 'materialCategories'=>$materialCategories,'materialCategId'=>$materialCategId,'matFiles'=>$matFiles,'moduleId'=>$moduleId]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'material_name' => 'required|max:255|min:3',
                'material_desc' => 'required|min:10',
                'price' => 'required:numeric',
                'size' => 'required:numeric'
            ]);

            $is_active = ($request->input('is_active')) ? true : false;
            $matObj = new Material;
            $matObj->where('id', $id)
                ->update([
                    'material_name' => $request->input('material_name'),
                    'material_desc' => $request->input('material_desc'),
                    'material_categ_id' => $request->input('material_category'),
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
            return Redirect::to("/back/material/edit/$id")->with('message', $request->input('material_name') . ' was successfully updated');
        }catch(Exception $e){
            return Redirect::to("/back/material/edit/$id")->with('message','Oops! Something went wrong. Please try again later' );
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

    public function materialsAllAPI()
    {
        $materials = Material::all();
        return json_encode($materials);
    }


}
