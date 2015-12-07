<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Project;
use App\Model\Files;
use Redirect;
use Config;
use Auth;
use DB;

class ProjectController extends Controller
{

    public function lists(Request $request)
    {


        if ($request->has('search')){
            $projects = DB::select("select project.*,(select disk_name from files where attachment_id=project.id and module_id= 1 and is_active=1 order by id desc limit 1) as disk_name " .
                "from project " .
                "where project.is_active=1 " .
                "and project.id LIKE '%".$request->input('search')."%' OR project.project_name LIKE '%".$request->input('search'). "%' " .
                "group by project.id "

            );
        }else if ($request->has('sortby')){
            $projects = DB::select('select project.*,(select disk_name from files where attachment_id=project.id and module_id= 1 and is_active=1 order by id desc limit 1) as disk_name ' .
                'from project ' .
                'where project.is_active=1 ' .
                'group by project.id ' .
                'order by :sortby ',
                [':sortby'=>$request->input('sortby')]
            );
        }else{
            $projects = DB::select('select project.*,(select disk_name from files where attachment_id=project.id and module_id= 1 and is_active=1 order by id desc limit 1) as disk_name ' .
                'from project ' .
                'where project.is_active=1 ' .
                'group by project.id '
            );

        }

        return view('pages.project.list', ['projects'=>$projects]);
    }


    public function show($id)
    {
        //$user = Auth::user();
        $projectobj = new Project;
        $project = $projectobj->find($id);
        $moduleId = 1; //project

        //get the image assiociates
        $projFiles = Files::where('attachment_id',$project->id)
            ->where('is_active',True)
            ->where('module_id',$moduleId)
            ->get();

        return view('pages.project.show', ['project'=>$project,'projFiles'=>$projFiles]);
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
            $ispublic = ($request->input('is_public'))? true : false;
            $projectobj = new Project;
            $projectobj->project_name = $request->input('project_name');
            $projectobj->project_desc = $request->input('project_desc');
            $projectobj->is_public = $ispublic;
            $projectobj->is_active = true;
            $projectobj->save();


            return Redirect::to('/back/project/edit/'.$projectobj->id);

        }catch(Exception $e){
            return Redirect::to('/back/project/create')->withwith('message','Oops! Something went wrong. Please try again later' );
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
        $moduleId = 1; //project

        //get the image assiociates
        $projFiles = Files::where('attachment_id',$project->id)
            ->where('is_active',True)
            ->where('module_id',$moduleId)
            ->get();

        return view('pages.admin.project.edit', ['project'=>$project,'user'=>$user, 'projFiles'=>$projFiles,'moduleId'=>$moduleId]);
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
                'project_name' => 'required|max:255|min:3',
                'project_desc' => 'required|min:1|max:500'
            ]);
            $ispublic = ($request->input('is_public'))? true : false;
            $isactive = ($request->input('is_active'))? true : false;
            $projectobj = new Project;
            $projectobj->where('id',$id)
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

             return Redirect::to("/back/project/edit/$id")->with('message', $request->input('project_name') . ' was successfully updated');
         }catch(Exception $e){
             return Redirect::to("/back/project/edit/$id")->with('message','Oops! Something went wrong. Please try again later' );
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
