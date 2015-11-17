<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/','HomeController@showHome');



/**
 * Admin Panel Routings
 */

/**
 * Admin Login Routes
 */
Route::get('/back','Auth\AuthController@getLogin');
Route::get('/back/','Auth\AuthController@getLogin');
Route::post('back/login', 'Auth\AuthController@postLogin');
Route::post('back/login/', 'Auth\AuthController@postLogin');
Route::get('back/logout', 'Auth\AuthController@getLogout');
Route::get('back/logout/', 'Auth\AuthController@getLogout');
/**
 * Admin Password Reset
 */
// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::get('password/email/', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');
Route::post('password/email/', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');
/**
 * Admin Home
 */
Route::get('/back/main',['middleware' => 'auth','uses'=>'HomeController@showAdminHome']);
Route::get('/back/main/',['middleware' => 'auth','uses'=>'HomeController@showAdminHome']);
/**
 * Admin User Routes
 */
Route::get('/back/user',['middleware' => 'auth','uses'=>'UserController@index']);  
Route::get('/back/user/',['middleware' => 'auth','uses'=>'UserController@index']);  
Route::get('/back/user/create',['middleware' => 'auth','uses'=>'UserController@create'] );
Route::post('/back/user/store',['middleware' => 'auth','uses'=>'UserController@store']);
Route::get('/back/user/edit/{id}',['middleware' => 'auth','uses'=>'UserController@edit']);
Route::post('/back/user/update', ['middleware' => 'auth','uses'=>'UserController@update']);
/**
 * Cateogry Routes
 */
Route::get('/back/category',['middleware' => 'auth','uses'=>'CategoryController@index']); 
Route::get('/back/category/create',['middleware' => 'auth','uses'=>'CategoryController@create']); 
Route::post('/back/category/store',['middleware' => 'auth','uses'=>'CategoryController@store']);
Route::get('/back/category/edit/{id}',['middleware' => 'auth','uses'=>'CategoryController@edit']);
Route::post('/back/category/update', ['middleware' => 'auth','uses'=>'CategoryController@update']);
/**
 * Product Routes
 */
Route::get('/back/product',['middleware' => 'auth','uses'=>'ProductController@index']); 
Route::get('/back/product/create',['middleware' => 'auth','uses'=>'ProductController@create']); 
Route::post('/back/product/store',['middleware' => 'auth','uses'=>'ProductController@store']);
Route::get('/back/product/edit/{id}',['middleware' => 'auth','uses'=>'ProductController@edit']);
Route::post('/back/product/update', ['middleware' => 'auth','uses'=>'ProductController@update']);
Route::post('/back/product/upload', ['middleware' => 'auth','uses'=>'ProductController@upload']);

//front end
Route::get('/product','ProductController@lists'); 
Route::get('/product/detail/{id}','ProductController@show'); 

/**
 * Project Routes
 */
Route::get('/back/project',['middleware' => 'auth','uses'=>'ProjectController@index']); 
Route::get('/back/project/create',['middleware' => 'auth','uses'=>'ProjectController@create']); 
Route::post('/back/project/store',['middleware' => 'auth','uses'=>'ProjectController@store']);
Route::get('/back/project/edit/{id}',['middleware' => 'auth','uses'=>'ProjectController@edit']);
Route::post('/back/project/update', ['middleware' => 'auth','uses'=>'ProjectController@update']);
Route::post('/back/project/upload', ['middleware' => 'auth','uses'=>'ProjectController@upload']);
//front end
Route::get('/project','ProjectController@lists'); 
Route::get('/project/detail/{id}','ProjectController@show'); 

/**
 * Post Routes
 */
Route::get('/back/post',['middleware' => 'auth','uses'=>'PostController@index']); 
Route::get('/back/post/create',['middleware' => 'auth','uses'=>'PostController@create']); 
Route::post('/back/post/store',['middleware' => 'auth','uses'=>'PostController@store']);
Route::get('/back/post/edit/{id}',['middleware' => 'auth','uses'=>'PostController@edit']);
Route::post('/back/post/update', ['middleware' => 'auth','uses'=>'PostController@update']);
Route::post('/back/post/upload', ['middleware' => 'auth','uses'=>'PostController@upload']);
/***
* Image Routes
*/
Route::get('/images/product/{filename}', function ($filename=null)
{
	$path = base_path().Config::get('app.filepath') .'/product/'. $filename;
	return Response::download($path);
    
});


