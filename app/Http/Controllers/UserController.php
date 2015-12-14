<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Validator;
use Redirect;



class UserController extends Controller
{
  
    public function index(Request $request){
        
        if ($request->has('search')){
            $users = User::where('id','LIKE',"%".$request->input('search')."%")
                    ->orWhere('email','LIKE',"%".$request->input('search')."%")
                    ->paginate(5);
        }else{
            if ($request->has('sortby')){
                $users = User::orderBy($request->input('sortby'))
                    ->paginate(5);
            }else{
                $users = User::paginate(5);
            }
        }

        $users->setPath(url().'/back/user');
        return view('pages.admin.user.list', ['users'=>$users]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.user.create');
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
                'password' => 'required|confirmed|min:6',
                'password_confirmation' => 'required|min:6',
                'email' => 'required|email|max:255|unique:users'
            ]);
            $is_admin = ($request->input('is_admin'))?true:false;
            $userobj = new User;
            $userobj->email = $request->input('email');
            $userobj->password = bcrypt($request->input('password'));
            $userobj->contact = $request->input('contact');
            $userobj->firstname = $request->input('firstname');
            $userobj->lastname = $request->input('lastname');
            $userobj->is_admin = $is_admin;
            $userobj->is_active = true;
            $userobj->save();

            return Redirect::to('/back/user/edit/'.$userobj->id);
        }catch(Exception $e){
            return Redirect::to('/back/user/create')->withwith('message','Oops! Something went wrong. Please try again later' );
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
        $userobj = new User;
        $user = $userobj->find($id);
        
        return view('pages.admin.user.edit', ['user'=>$user]);
        
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
                'email' => 'required|email|max:255'
            ]);

            $is_admin = ($request->input('is_admin'))? true : false;
            $is_active = ($request->input('is_active'))? true : false;
            $userobj = new User;

            $userobj->where('id',$id)
                    ->update([
                        'email' => $request->input('email'),
                        'contact' => $request->input('contact'),
                        'firstname' => $request->input('firstname'),
                        'lastname' => $request->input('lastname'),
                        'is_admin' => $is_admin,
                        'is_active' => $is_active
                    ]);

             return Redirect::to("/back/user/edit/$id")->with('message', $request->input('email') . ' was successfully updated');
        }catch(Exception $e){
             return Redirect::to("/back/user/edit/$id")->with('message','Oops! Something went wrong. Please try again later' );
        }
    }


    
}
