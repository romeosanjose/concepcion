<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Project;
use App\Model\Files;
use App\Model\Module;
use Config;
use Auth;
use DB;

class ProjectController extends Controller
{

/**
     * Display a listing of the resource in front end.
     *
     * @return \Illuminate\Http\Response
     */
    public function lists(Request $request)
    {
         if ($request->has('search')){
            $projects = DB::select('select project.*,(select disk_name from files where attachment_id=project.id and module_id= 1) as disk_name ' .
                                                        'from project ' .
                                                        'where project.is_active=1 ' .
                                                        'and project.is_public=1 ' .
                                                        'where project.id LIKE %:search% OR project.project_name LIKE %:search% ' .
                                                        'group by project.id ',
                                                    [':search'=>$request->input('search')] 
                                                    );
        }else if ($request->has('sortby')){
             $projects = DB::select('select project.*,(select disk_name from files where attachment_id=project.id and module_id= 1) as disk_name ' .
                                                        'from project ' .
                                                        'where project.is_active=1 ' .
                                                        'and project.is_public=1 ' .
                                                        'group by project.id ' .
                                                        'order by :sortby', 
                                                    [':sortby'=>$request->input('sortby')] 
                                                    );
        }else{
           $projects = DB::select('select project.*,(select disk_name from files where attachment_id=project.id and module_id= 1) as disk_name ' .
                                                        'from project ' .
                                                        'where project.is_active=1 ' .
                                                        'and project.is_public=1 ' .
                                                        'group by project.id '
                                                    );
           
        }
        return view('pages.project.list', ['projects'=>$projects]);
    }
    
     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

         $project = DB::select('select project.*,(select disk_name from files where attachment_id=project.id and module_id= 1) as disk_name ' .
                                                        'from project ' .
                                                        'where project.is_active=1 ' .
                                                        'and project.is_public=1 ' .
                                                        'and project.id=:id ' .
                                                        'group by project.id ',
                                                    [':id'=>$id]  
                                                    );
        return view('pages.project.show', ['project'=>$project]);   
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         if ($request->has('search')){
            $projects = Project::where('is_active',1)
                    ->where('id','LIKE',"%".$request->input('search')."%")
                    ->orWhere('project_name','LIKE',"%".$request->input('search')."%")
                    ->paginate(5);
        }else{
            if ($request->has('sortby')){
                $projects = Project::where('is_active',1)
                    ->orderBy($request->input('sortby')) 
                    ->paginate(5);
            }else{
                $projects = Project::where('is_active',1)
                        ->paginate(5);
            }
        }

        $projects->setPath(url().'/back/project');
        return view('pages.admin.project.list', ['projects'=>$projects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('pages.admin.project.create',['user'=>$user]);
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
                'project_name' => 'required|unique:project|max:255|min:3',
                'project_desc' => 'required|min:1|max:500'
            ]);
            $ispublic = ($request->input('ispublic')=='1')? true : false;
            $projectobj = new Project;
            $projectobj->project_name = $request->input('project_name');
            $projectobj->project_desc = $request->input('project_desc');
            $projectobj->is_public = $ispublic;
            $projectobj->is_active = true;
            $projectobj->save();
            
            if ($request->input('fileId')!='' && $request->input('fileId')!=null ){
                $fileIdArr = explode(' ', $request->input('fileId'));
                foreach($fileIdArr as $fileId){
                    Files::where('id',$fileId)
                            ->update([
                                'attachment_id' => $projectobj->id
                            ]);
                }
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
        $user = Auth::user();
        $projectobj = new Project;
        $project = $projectobj->find($id);
        return view('pages.admin.project.edit', ['project'=>$project,'user'=>$user]);
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
                'project_name' => 'required|max:255|min:3',
                'project_desc' => 'required|min:1|max:500'
            ]);
            $ispublic = ($request->input('ispublic')=='1')? true : false;
            $isactive = ($request->input('isactive')=='1')? true : false;
            $projectobj = new Project;
            $projectobj->where('id',$request->input('id'))
                    ->update([
                        'project_name' => $request->input('project_name'),
                        'project_desc' => $request->input('project_desc'),
                        'is_public' => $ispublic,
                        'is_active' => $isactive
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
            
            return json_encode(array("message"=>"Success! Product ". $request->input('project_name') ." has been updated"));
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
                $module = Module::find(1);
                $file = new Files;
                $fileName = $module->module_name . md5(time()) . '.jpg';
                $file->disk_name = $fileName;
                $file->file_name = $request->file('files')[0]->getClientOriginalName();
                $file->module_id = $module->id; //project
                $file->save();
                $fileId = $file->id;
                $request->file('files')[0]->move(base_path().Config::get('app.filepath') .'/'. $module->module_name, $fileName);
                echo json_encode(array('fileId'=>$fileId));

            }
        }
    }
}
