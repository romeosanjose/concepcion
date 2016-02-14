<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Service;
use App\Model\Files;
use Redirect;
use DB;
use Input;

class ServiceController extends Controller
{

    
    public function lists(Request $request)
    {
        //$services = Service::paginate(5);
        //$services->setPath(url().'/service');
        $services = DB::select('select service.*,(select disk_name from files where attachment_id=service.id and module_id= 5 and is_active=1 order by id desc limit 1) as disk_name ' .
                'from service ' .
                'where service.is_active=1 ' .
                'group by service.id '
            );

        return view('pages.services.list', ['services'=>$services]);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('search')){
            $services = Service::where('id','LIKE',"%".$request->input('search')."%")
                ->orWhere('service_name','LIKE',"%".$request->input('search')."%")
                ->paginate(5);
        }else{
            if ($request->has('sortby')){
                $services = Service::orderBy($request->input('sortby'))
                    ->paginate(5);
            }else{
                $services = Service::paginate(5);
            }
        }
        $services->setPath(url().'/back/service');
        return view('pages.admin.service.list', ['services'=>$services]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.service.create');
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
                'service_name' => 'required|unique:service|max:255|min:3'
            ]);


            $service = new Service;
            $service->service_name = $request->input('service_name');
            $service->service_desc = $request->input('service_desc');
            $service->is_active = true;
            $service->save();

            return Redirect::to('/back/service/edit/'.$service->id);

        }catch(Exception $e){
            return Redirect::to('/back/service/create')->withwith('message','Oops! Something went wrong. Please try again later' );
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
        $services = Service::where('id',$id)->where('is_active',true)->get();
        $service = null;
        foreach($services as $s) {
            $service = $s;
        }
        $moduleId = 5;
        $servFiles = Files::where('attachment_id',$service->id)
            ->where('is_active',True)
            ->where('module_id',$moduleId)
            ->get();

        return view('pages.services.detail', ['service'=>$service,'servFiles'=>$servFiles,'moduleId'=>$moduleId]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::find($id);
        $moduleId = 5; //service
         //get the image assiociates
        $servFiles = Files::where('attachment_id',$service->id)
            ->where('is_active',True)
            ->where('module_id',$moduleId)
            ->get();

        return view('pages.admin.service.edit', ['service'=>$service,'servFiles'=>$servFiles,'moduleId'=>$moduleId]);

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
        try{
            $this->validate($request, [
                'service_name' => 'required|max:255|min:3'
            ]);
            $is_active = ($request->input('is_active'))? true : false;
            $service = new Service;
            $service->where('id',$id)
                ->update([
                    'service_name' => $request->input('service_name'),
                    'service_desc' => $request->input('service_desc'),
                    'is_active' => $is_active
                ]);


            if ($request->input('fileId')!='' && $request->input('fileId')!=null ){
                $fileIdArr = explode(' ', $request->input('fileId'));
                foreach($fileIdArr as $fileId){
                    Files::where('id',$fileId)
                            ->update([
                                'attachment_id' => $request->input('id')
                            ]);
                }
            }

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

            return Redirect::to("/back/service/edit/$id")->with('message', 'Service was successfully updated');
        }catch(Exception $e){
            return Redirect::to("/back/service/edit/$id")->with('message','Oops! Something went wrong. Please try again later' );
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
