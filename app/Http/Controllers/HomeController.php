<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    
    public function showHome()
    {
        return view('pages.home');
    }
    
    public function showAdminHome(){
        return view('pages.admin.main');
    }
}