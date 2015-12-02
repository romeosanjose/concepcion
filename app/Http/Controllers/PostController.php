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
use Redirect;

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
            $posts = Post::where('id','LIKE',"%".$request->input('search')."%")
                    ->orWhere('title','LIKE',"%".$request->input('search')."%")
                    ->paginate(5);
        }else{
            if ($request->has('sortby')){
                $posts = Post::orderBy($request->input('sortby'))
                    ->paginate(5);
            }else{
                $posts = Post::paginate(5);
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



            return Redirect::to('/back/post/edit/'.$postobj->id);
        }catch(Exception $e){
            return Redirect::to('/back/post/create')->withwith('message','Oops! Something went wrong. Please try again later' );
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
        $moduleId = 3; //post

        //get the image assiociates
        $postFiles = Files::where('attachment_id',$post->id)
            ->where('is_active',True)
            ->where('module_id',$moduleId)
            ->get();

        return view('pages.admin.post.edit', ['post'=>$post,'user'=>$user,'postTypes'=>$postTypes,'moduleId'=>$moduleId,'postFiles'=>$postFiles]);
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
                'title' => 'required|max:255|min:3',
                'content' => 'required|min:1|max:500'
            ]);
            $ispublished = ($request->input('is_published'))? true : false;
            $isactive = ($request->input('is_active'))? true : false;
            
            $postobj = new Post;
            $postobj->where('id',$request->input('id'))
                    ->update([
                        'title' => $request->input('title'),
                        'content' => $request->input('content'),
                        'post_type' => $request->input('post_type'),
                        'is_published' => $ispublished,
                        'is_active' => $isactive
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
             return Redirect::to("/back/post/edit/$id")->with('message', $request->input('title') . ' was successfully updated');

        }catch(Exception $e){
             return Redirect::to("/back/post/edit/$id")->with('message','Oops! Something went wrong. Please try again later' );
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
