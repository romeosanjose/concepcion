<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Post;
use App\Model\PostType;
use App\Model\Files;
use App\Model\Module;
use Config;
use Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         if ($request->has('search')){
            $posts = Post::where('is_active',1)
                    ->where('id','LIKE',"%".$request->input('search')."%")
                    ->orWhere('title','LIKE',"%".$request->input('search')."%")
                    ->paginate(5);
        }else{
            if ($request->has('sortby')){
                $posts = Post::where('is_active',1)
                    ->orderBy($request->input('sortby')) 
                    ->paginate(5);
            }else{
                $posts = Post::where('is_active',1)
                        ->paginate(5);
            }
        }

        $posts->setPath(url().'/back/post');
        return view('pages.admin.post.list', ['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $postTypes = PostType::all();
        return view('pages.admin.post.create',['user'=>$user,'postTypes' => $postTypes]);
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
                'title' => 'required|unique:post|max:255|min:3',
                'content' => 'required|min:1|max:500'
            ]);
            $ispublished = ($request->input('ispublished')=='1')? true : false;
            $postobj = new Post;
            $postobj->title = $request->input('title');
            $postobj->content = $request->input('content');
            $postobj->post_type = $request->input('post_type');
            $postobj->is_published = $ispublished;
            $postobj->is_active = true;
            $postobj->save();
            
            if ($request->input('fileId')!='' && $request->input('fileId')!=null ){
                $fileIdArr = explode(' ', $request->input('fileId'));
                foreach($fileIdArr as $fileId){
                    Files::where('id',$fileId)
                            ->update([
                                'attachment_id' => $postobj->id
                            ]);
                }
            }
            
            return json_encode(array("message"=>"Success! New Post has been added"));
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
        $user = Auth::user();
        $postobj = new Post;
        $post = $postobj->find($id);
        $postTypes = PostType::all();
        return view('pages.admin.post.edit', ['post'=>$post,'user'=>$user,'postTypes'=>$postTypes]);
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
                'title' => 'required|max:255|min:3',
                'content' => 'required|min:1|max:500'
            ]);
            $ispublished = ($request->input('ispublished')=='1')? true : false;
            $isactive = ($request->input('isactive')=='1')? true : false;
            
            $postobj = new Post;
            $postobj->where('id',$request->input('id'))
                    ->update([
                        'title' => $request->input('title'),
                        'content' => $request->input('content'),
                        'post_type' => $request->input('post_type'),
                        'is_published' => $ispublished,
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
            
            return json_encode(array("message"=>"Success! Post ". $request->input('title') ." has been updated"));
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
                $module = Module::find(3); //post
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
