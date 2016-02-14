<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Post;
use App\Model\PostType;
use App\Model\Files;
use Config;
use Auth;
use Redirect;
use DB;

class PostController extends Controller
{

    public function lists(Request $request,$postType)
    {

        if ($request->has('search')){
            $posts = DB::select("select post.*,(select disk_name from files where attachment_id=post.id and module_id= 3 and is_active=1 order by id desc limit 1) as disk_name " .
                "from post " .
                "where post.is_active=1 " .
                "and post.post_type=:postType " .
                "and post.id LIKE '%".$request->input('search')."%' OR post.title LIKE '%".$request->input('search'). "%' " .
                "group by post.id ",
                [':postType'=>$postType]

            );
        }else if ($request->has('sortby')){
            $posts = DB::select('select post.*,(select disk_name from files where attachment_id=post.id and module_id= 3 and is_active=1 order by id desc limit 1) as disk_name ' .
                'from post ' .
                'where post.is_active=1 ' .
                "and post.post_type=:postType " .
                'group by post.id ' .
                'order by :sortby ',
                [':postType'=>$postType,':sortby'=>$request->input('sortby')]
            );
        }else{
            $posts = DB::select('select post.*,(select disk_name from files where attachment_id=post.id and module_id= 3 and is_active=1 order by id desc limit 1) as disk_name ' .
                'from post ' .
                'where post.is_active=1 ' .
                "and post.post_type=:postType " .
                'group by post.id ',
                [':postType'=>$postType]
            );

        }

        return view('pages.post.list', ['posts'=>$posts,'postType'=>$postType]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$postType)
    {

        $post = Post::find($id);

        $moduleId = 3; //post

        //get the image assiociates
        $postFiles = Files::where('attachment_id',$post->id)
            ->where('is_active',True)
            ->where('module_id',$moduleId)
            ->get();
        $post->content = htmlspecialchars_decode($post->content,ENT_NOQUOTES);   
        $post->content = $post->content;
        //dd($post);     
        return view('pages.post.show', ['post'=>$post,'postFiles'=>$postFiles]);
    }
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
                'content' => 'required|min:10'
            ]);

            
            $ispublished = ($request->input('is_published'))? true : false;
            $postobj = new Post;
            $postobj->title = $request->input('title');
            $postobj->content = htmlspecialchars($request->input('content'),ENT_NOQUOTES);
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
        $postTypeId = PostType::find($post->post_type);
        $moduleId = 3; //post

        //get the image assiociates
        $postFiles = Files::where('attachment_id',$post->id)
            ->where('is_active',True)
            ->where('module_id',$moduleId)
            ->get();

        return view('pages.admin.post.edit', ['post'=>$post,'user'=>$user,'postTypes'=>$postTypes,'moduleId'=>$moduleId,'postFiles'=>$postFiles,'postTypeId'=>$postTypeId]);
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
                'content' => 'required|min:10'

            ]);

            $ispublished = ($request->input('is_published'))? true : false;
            $isactive = ($request->input('is_active'))? true : false;
            $content = htmlspecialchars($request->input('content'),ENT_NOQUOTES);
            $postobj = new Post;
            $postobj->where('id',$id)
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
