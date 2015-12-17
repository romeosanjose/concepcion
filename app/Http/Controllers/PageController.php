<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Pages;
use Redirect;

class PageController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showContacts()
    {
        $page = Pages::where('is_active',true)
                        ->where('type','contacts')
                        ->first();
        if ($page)
            $page->content = htmlspecialchars_decode($page->content,ENT_NOQUOTES);                                
        
        return view('pages.contactus.show', ['page'=>$page]);
    }

    public function showAbout()
    {
        $page = Pages::where('is_active',true)
                        ->where('type','about')
                        ->first();
        if ($page)    
            $page->content = htmlspecialchars_decode($page->content,ENT_NOQUOTES);                                                        
        return view('pages.aboutus.show', ['page'=>$page]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('search')){
            $pages = Pages::where('id','LIKE',"%".$request->input('search')."%")
                    ->orWhere('type','LIKE',"%".$request->input('search')."%")
                    ->paginate(5);
        }else{
            if ($request->has('sortby')){
                $pages = Pages::orderBy($request->input('sortby'))
                    ->paginate(5);
            }else{
                $pages = Pages::paginate(5);
            }
        }

        $pages->setPath(url().'/back/page');
        return view('pages.admin.page.list', ['pages'=>$pages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.page.create');
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
                'type' => 'required',
                'content' => 'required|min:10'
            ]);

            $pageobj = new Pages;
            $pageobj->type = $request->input('type');
            $pageobj->content = htmlspecialchars($request->input('content'),ENT_NOQUOTES);
            $pageobj->is_active = true;
            $pageobj->save();



            return Redirect::to('/back/page/edit/'.$pageobj->id);
        }catch(Exception $e){
            return Redirect::to('/back/page/create')->withwith('message','Oops! Something went wrong. Please try again later' );
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
        $page = Pages::find($id);
        return view('pages.admin.page.edit', ['page'=>$page]);
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
                'type' => 'required',
                'content' => 'required|min:10'

            ]);

            $isactive = ($request->input('is_active'))? true : false;
            $content = htmlspecialchars($request->input('content'),ENT_NOQUOTES);
            $pageobj = new Pages;
            $pageobj->where('id',$id)
                    ->update([
                        'type' => $request->input('type'),
                        'content' => $request->input('content'),
                        'is_active' => $isactive
                    ]);


             return Redirect::to("/back/page/edit/$id")->with('message', $request->input('type') . ' was successfully updated');

        }catch(Exception $e){
             return Redirect::to("/back/page/edit/$id")->with('message','Oops! Something went wrong. Please try again later' );
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
