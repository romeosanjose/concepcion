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
        $news = Post::where('is_published',1)
                    ->where('is_active',1)
                    ->where('post_type',1)
                    ->orderBy('updated_at','desc')
                    ->first();
        $job = Post::where('is_published',1)
                    ->where('is_active',1)
                    ->where('post_type',2)
                    ->orderBy('updated_at','desc')
                    ->first();            
        $product = Product::where('is_active',1)
                    ->orderby('updated_at','desc')
                    ->first();
        $project = Project::where('is_public',1)
                    ->where('is_active',1)
                    ->orderBy('updated_at','desc')
                    ->first();
        $newsContent = htmlspecialchars_decode($news->content,ENT_NOQUOTES);   
        $news->content = $newsContent; 
        //dd($news);                   
        return view('pages.home',['news'=> $news,'job'=>$job, 'product'=>$product, 'project'=>$project]);
    }
    
    public function showAdminHome(){
        return view('pages.admin.main');
    }

    public function adminHomeCarousel(){
        return view('pages.admin.home.carousel');
    }
    
    
}