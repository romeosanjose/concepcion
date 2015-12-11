<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Post;
use App\Model\Product;
use App\Model\Project;

class HomeController extends Controller
{
    
    public function showHome()
    {
        //gets latest post
        $post = Post::where('is_published',1)
                    ->where('is_active',1)
                    ->orderBy('updated_at','desc')
                    ->first();
        $product = Product::where('is_active',1)
                    ->orderby('updated_at','desc')
                    ->first();
        $project = Project::where('is_public',1)
                    ->where('is_active',1)
                    ->orderBy('updated_at','desc')
                    ->first();

        return view('pages.home',['post'=> $post, 'product'=>$product, 'project'=>$project]);
    }
    
    public function showAdminHome(){
        return view('pages.admin.main');
    }
    
    
}