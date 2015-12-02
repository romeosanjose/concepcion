<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Concepcion Admin Panel</title>

    <!-- Bootstrap core CSS -->
    <link href="{{URL::asset('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{URL::asset('assets/css/nav-bar.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/vendor/jquery-file-upload/css/style.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/css/blue.css')}}" rel="stylesheet"> 
    <link href="{{URL::asset('assets/vendor/jquery-file-upload/css/jquery.fileupload.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/vendor/jquery-file-upload/css/jquery.fileupload-ui.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/css/dual-list-box.css')}}" rel="stylesheet">
  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/back">Concepcion</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            @if (Auth::user()->is_admin)
                <li><a href="{{url()}}/back/user">User</a></li>
            @endif
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Products <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="{{url()}}/back/category">Product Category</a></li>
                <li><a href="{{url()}}/back/materialcategory">Material Category</a></li>
                <li><a href="{{url()}}/back/product">Product</a></li>
                <li><a href="{{url()}}/back/subproduct">Sub Product</a></li>
                <li><a href="{{url()}}/back/material">Material</a></li>
              </ul>
            </li>
            <li><a href="{{url()}}/back/project">Project</a></li>
            <li><a href="{{url()}}/back/post">Post</a></li>
            <li><a href="{{url()}}/back/logout">Logout</a></li>
          </ul>
        
        </div><!--/.nav-collapse -->
      </div>
    </nav>


    


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{URL::asset('assets/js/jquery-1.11.3.min.js')}}"></script>
    <script src="{{URL::asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="{{URL::asset('assets/js/ie10-viewport-bug.js')}}"></script>
    <script>var BASE_URL = "{{url()}}";  </script>
    <script src="{{URL::asset('assets/js/common.js')}}"></script>
    <script src="{{URL::asset('assets/js/request.js')}}"></script>
    <script src="{{URL::asset('assets/js/loading.js')}}"></script>
    <script src="{{URL::asset('assets/js/dual-list-box.js')}}"></script>
    <script src="{{URL::asset('assets/js/appback.js')}}"></script>

    
    <script src="{{URL::asset('assets/vendor/jquery-file-upload/js/vendor/jquery.ui.widget.js')}}"></script>
    <script src="{{URL::asset('assets/vendor/jquery-file-upload/js/jquery.iframe-transport.js')}}"></script>
    <script src="{{URL::asset('assets/vendor/jquery-file-upload/js/jquery.fileupload.js')}}"></script>

  </body>
</html>
