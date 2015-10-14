<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Validator;



class UserController extends Controller
{
  
    public function index(Request $request){
        
        if ($request->has('search')){
            $users = User::where('is_active',1)
                    ->where('id','LIKE',"%".$request->input('search')."%")
                    ->orWhere('email','LIKE',"%".$request->input('search')."%")
                    ->paginate(5);
        }else{
            if ($request->has('sortby')){
                $users = User::where('is_active',1)
                    ->orderBy($request->input('sortby')) 
                    ->paginate(5);
            }else{
                $users = User::where('is_active',1)
                        ->paginate(5);
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
                'email' => 'required|email|max:255|unique:users'
            ]);

            $userobj = new User;
            $userobj->email = $request->input('email');
            $userobj->password = bcrypt($request->input('password'));
            $userobj->contact = $request->input('contact');
            $userobj->firstname = $request->input('firstname');
            $userobj->lastname = $request->input('lastname');
            $userobj->is_admin = ($request->input('isadmin')=='1')? true : false;
            $userobj->is_active = true;
            $userobj->save();
            
            return json_encode(array("message"=>"Success! New user has been added"));
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
    public function update(Request $request)
    {
         try{
            $this->validate($request, [
                'username' => 'required|max:255',
                'email' => 'required|email|max:255'
            ]);

            $is_admin = ($request->input('isadmin')=='1')? true : false;
            $is_active = ($request->input('isactive')=='1')? true : false;
            $userobj = new User;
            $userobj->where('id',$request->input('id'))
                    ->update([
                        'email' => $request->input('email'),
                        'contact' => $request->input('contact'),
                        'firstname' => $request->input('firstname'),
                        'lastname' => $request->input('lastname'),
                        'is_admin' => $is_admin,
                        'is_active' => $is_active
                    ]);
            
            return json_encode(array("message"=>"Success! user ". $request->input('id') ." has been updated"));
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

    private function getRequestVariables($request){
        $user = array();
        if ($request !== null){
            $user = array(
              "username" =>  $request::input('username'),
              "password" =>  $request::input('password'),
              "email" =>  $request::input('email'),
              "firstname" =>  $request::input('firstname'),
              "lastname" =>  $request::input('lastname'),
              "isadmin" =>  $request::input('isadmin')  
            );
        }
       return $user; 
    }
    
}
