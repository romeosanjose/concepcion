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
Route::post('back/login', 'Auth\AuthController@postLogin');
Route::get('back/logout', 'Auth\AuthController@getLogout');
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
Route::post('/back/user/update/{id}', ['middleware' => 'auth','uses'=>'UserController@update']);
/**
 * Admin Cateogry Routes
 */
Route::get('/back/category',['middleware' => 'auth','uses'=>'CategoryController@index']); 
Route::get('/back/category/create',['middleware' => 'auth','uses'=>'CategoryController@create']); 
Route::post('/back/category/store',['middleware' => 'auth','uses'=>'CategoryController@store']);
Route::get('/back/category/edit/{id}',['middleware' => 'auth','uses'=>'CategoryController@edit']);
Route::post('/back/category/update/{id}', ['middleware' => 'auth','uses'=>'CategoryController@update']);
/**
 * Admin Material Cateogry Routes
 */
Route::get('/back/materialcategory',['middleware' => 'auth','uses'=>'MaterialCategoryController@index']);
Route::get('/back/materialcategory/create',['middleware' => 'auth','uses'=>'MaterialCategoryController@create']);
Route::post('/back/materialcategory/store',['middleware' => 'auth','uses'=>'MaterialCategoryController@store']);
Route::get('/back/materialcategory/edit/{id}',['middleware' => 'auth','uses'=>'MaterialCategoryController@edit']);
Route::post('/back/materialcategory/update/{id}', ['middleware' => 'auth','uses'=>'MaterialCategoryController@update']);
/**
 * Admin Product Routes
 */
Route::get('/back/product',['middleware' => 'auth','uses'=>'ProductController@index']); 
Route::get('/back/product/create',['middleware' => 'auth','uses'=>'ProductController@create']); 
Route::post('/back/product/store',['middleware' => 'auth','uses'=>'ProductController@store']);
Route::get('/back/product/edit/{id}',['middleware' => 'auth','uses'=>'ProductController@edit']);
Route::post('/back/product/update/{id}', ['middleware' => 'auth','uses'=>'ProductController@update']);
Route::post('/back/product/upload', ['middleware' => 'auth','uses'=>'ProductController@upload']);
Route::post('/back/product/addMaterial', ['middleware' => 'auth','uses'=>'ProductController@addMaterial']);
Route::post('/back/product/removeMaterial', ['middleware' => 'auth','uses'=>'ProductController@removeMaterial']);
Route::post('/back/product/addSubProduct', ['middleware' => 'auth','uses'=>'ProductController@addSubProduct']);
Route::post('/back/product/removeSubProduct', ['middleware' => 'auth','uses'=>'ProductController@removeSubProduct']);

/**
 * Admin Sub Product Routes
 */
Route::get('/back/subproduct',['middleware' => 'auth','uses'=>'SubProductController@index']);
Route::get('/back/subproduct/create',['middleware' => 'auth','uses'=>'SubProductController@create']);
Route::post('/back/subproduct/store',['middleware' => 'auth','uses'=>'SubProductController@store']);
Route::get('/back/subproduct/edit/{id}',['middleware' => 'auth','uses'=>'SubProductController@edit']);
Route::post('/back/subproduct/update/{id}', ['middleware' => 'auth','uses'=>'SubProductController@update']);
Route::post('/back/subproduct/upload', ['middleware' => 'auth','uses'=>'SubProductController@upload']);
Route::post('/back/subproduct/addMaterial', ['middleware' => 'auth','uses'=>'SubProductController@addMaterial']);
Route::post('/back/subproduct/removeMaterial', ['middleware' => 'auth','uses'=>'SubProductController@removeMaterial']);


/**
 * Material Routes
 */
Route::get('/back/material',['middleware' => 'auth','uses'=>'MaterialController@index']);
Route::get('/back/material/create',['middleware' => 'auth','uses'=>'MaterialController@create']);
Route::post('/back/material/store',['middleware' => 'auth','uses'=>'MaterialController@store']);
Route::get('/back/material/edit/{id}',['middleware' => 'auth','uses'=>'MaterialController@edit']);
Route::post('/back/material/update/{id}', ['middleware' => 'auth','uses'=>'MaterialController@update']);
Route::post('/back/material/upload', ['middleware' => 'auth','uses'=>'MaterialController@upload']);
Route::get('/back/material/all_api', ['middleware' => 'auth','uses'=>'MaterialController@materialsAllAPI']);

/**
 * Project Routes
 */
Route::get('/back/project',['middleware' => 'auth','uses'=>'ProjectController@index']); 
Route::get('/back/project/create',['middleware' => 'auth','uses'=>'ProjectController@create']); 
Route::post('/back/project/store',['middleware' => 'auth','uses'=>'ProjectController@store']);
Route::get('/back/project/edit/{id}',['middleware' => 'auth','uses'=>'ProjectController@edit']);
Route::post('/back/project/update/{id}', ['middleware' => 'auth','uses'=>'ProjectController@update']);
Route::post('/back/project/upload', ['middleware' => 'auth','uses'=>'ProjectController@upload']);

/**
 * Post Routes
 */
Route::get('/back/post',['middleware' => 'auth','uses'=>'PostController@index']); 
Route::get('/back/post/create',['middleware' => 'auth','uses'=>'PostController@create']); 
Route::post('/back/post/store',['middleware' => 'auth','uses'=>'PostController@store']);
Route::get('/back/post/edit/{id}',['middleware' => 'auth','uses'=>'PostController@edit']);
Route::post('/back/post/update/{id}', ['middleware' => 'auth','uses'=>'PostController@update']);
Route::post('/back/post/upload', ['middleware' => 'auth','uses'=>'PostController@upload']);
/**
 * Service Routes
 */
Route::get('/back/service',['middleware' => 'auth','uses'=>'ServiceController@index']);
Route::get('/back/service/create',['middleware' => 'auth','uses'=>'ServiceController@create']);
Route::post('/back/service/store',['middleware' => 'auth','uses'=>'ServiceController@store']);
Route::get('/back/service/edit/{id}',['middleware' => 'auth','uses'=>'ServiceController@edit']);
Route::post('/back/service/update/{id}', ['middleware' => 'auth','uses'=>'ServiceController@update']);
/**
* Pages Routes
*/
Route::get('/back/page',['middleware' => 'auth','uses'=>'PageController@index']); 
Route::get('/back/page/create',['middleware' => 'auth','uses'=>'PageController@create']); 
Route::post('/back/page/store',['middleware' => 'auth','uses'=>'PageController@store']);
Route::get('/back/page/edit/{id}',['middleware' => 'auth','uses'=>'PageController@edit']);
Route::post('/back/page/update/{id}', ['middleware' => 'auth','uses'=>'PageController@update']);

/***
* Image Routes
*/
Route::post('/back/images/store',['middleware' => 'auth','uses'=>'FileController@store']);
Route::post('/back/images/carousel/store',['middleware' => 'auth','uses'=>'FileController@carouselStore']);
Route::get('/back/home/carousel',['middleware' => 'auth','uses'=>'HomeController@adminHomeCarousel']);



/***
 * FRONT END STARTS HERE
 */


//front end : PRODUCT
Route::get('/product','ProductController@lists');
Route::get('/product/detail/{id}','ProductController@show');

//front end : SUB-PRODUCT
Route::get('/subproduct/{name}','SubProductController@show');

//front end : MATERIAL
Route::get('/material','MaterialController@lists');
Route::get('/material/detail/{name}','MaterialController@detail');
Route::get('/material/show/{id}','MaterialController@show');

//front end : PROJECT
Route::get('/project','ProjectController@lists');
Route::get('/project/detail/{id}','ProjectController@show');

//front end : POST
Route::get('/post/{postType}','PostController@lists');
Route::get('/post/detail/{id}/{postType}','PostController@show');

//front end :SERVICES
Route::get('/services','PageController@showService');

//front end :CONTACTS
Route::get('/contact','PageController@showContacts');
//front end :ABOUT
Route::get('/about','PageController@showAbout');

//front end: IMAGES
Route::get('/images/{filename}', function ($filename=null)
{
	$path = base_path().Config::get('app.filepath') . $filename;
	return Response::download($path);

});