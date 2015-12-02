<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Files;
use Config;

class FileController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('files')) {
            if ($request->file('files')[0]->isValid()) {
                $file = new Files;
                $fileName = md5(time()) . '.jpg';
                $file->disk_name = $fileName;
                $file->file_name = $request->file('files')[0]->getClientOriginalName();
                $file->module_id = $request->input('module_id'); //should be 1 = material
                $file->is_active = true;
                $file->save();
                $request->file('files')[0]->move(base_path() . Config::get('app.filepath') . '/', $fileName);
                echo json_encode(array('fileId' => $file->id,'fileName'=>$file->disk_name,'moduleId'=>$file->module_id));

            }
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
        //
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
        //
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
