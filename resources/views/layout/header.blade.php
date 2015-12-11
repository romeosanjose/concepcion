<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <title>Carousel Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="{{URL::asset('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{URL::asset('assets/css/carousel.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/css/thumbnail.css')}}" rel="stylesheet">
    
  </head>
  @if(Request::is('/'))
    @include('layout.carousel',['post'=> $post, 'product'=>$product, 'project'=>$project])
  @endif
  <body>
    <div class="navbar-wrapper">
      <div class="container">

        <nav class="navbar navbar-inverse navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">Concepsion Glass and Aluminum Service</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li><a href="/">Home</a></li>
                <li><a href="/product">Product</a></li>
                <li><a href="/material">Material</a></li>
                <li><a href="/project">Project</a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Post <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="/post/1">News</a></li>
                    <li><a href="/post/2">Job Posting</a></li>
                  </ul>
                </li>
                <li><a href="/about">About</a></li>
                <li><a href="/contact">Contact</a></li>
                <li><a href="/services">Services</a></li>

              </ul>
            </div>
          </div>
        </nav>

      </div>
    </div>
  

    

     
