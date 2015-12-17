@include('layout.header')  
<link href="{{URL::asset('assets/css/app.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/css/sidebar.css')}}" rel="stylesheet">

<div class="content">
     <div class="row">
       <!-- uncomment code for absolute positioning tweek see top comment in css -->
    <!-- <div class="absolute-wrapper"> </div> -->
    <!-- Menu -->
    <div class="side-menu">
    
    <nav class="navbar navbar-default" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <div class="brand-wrapper">
            <!-- Hamburger -->
            <button type="button" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Brand -->
            <div class="brand-name-wrapper">
                <a class="navbar-brand" href="#">
                    Search Project
                </a>
            </div>

            <!-- Search -->
            <a data-toggle="collapse" href="#search" class="btn btn-default" id="search-trigger">
                <span class="glyphicon glyphicon-search"></span>
            </a>

                  <!-- Search body -->
                  <div id="search" class="panel-collapse collapse">
                      <div class="panel-body">
                          <form class="navbar-form" role="search" action="{{url()}}/post/{{$postType}}" method="GET">
                              <div class="form-group">
                                  <input type="text" class="form-control" placeholder="Search" name="search">
                              </div>
                              <button type="submit" class="btn btn-default "><span class="glyphicon glyphicon-ok"></span></button>
                          </form>
                      </div>
                  </div>
              </div>

          </div>

          <!-- Main Menu -->
          <div class="side-menu-container">
              <ul class="nav navbar-nav">
                    <li><a href="{{url()}}/post/{{$postType}}?sortby=post.title"><span class="glyphicon"></span>Sort by Post Title</a></li>
                    <li><a href="{{url()}}/post/{{$postType}}?sortby=post.updated_at"><span class="glyphicon"></span>Sort by Post Creation Date</a></li>
              </ul>
          </div><!-- /.navbar-collapse -->
      </nav>
    
          </div>

          <!-- Main Content -->
          <div class="container-fluid">
              <div class="side-body">
                    <div class="col-lg-12">
                      @if ($postType == 1)
                        <h1 class="page-header">NEWS</h1>
                      @else
                        <h1 class="page-header">JOB POSTINGS</h1>
                      @endif
                    </div>

                    <div class="list-group col-lg-12">
                      @foreach ($posts as $post)
                        <a href="{{url()}}/post/detail/{{$post->id}}/{{$postType}}" class="list-group-item">
                            <h3>{{$post->title}}</h3>
                        </a>
                      @endforeach
                    </div>
                 </div>
          </div>  

  </div><!--end of row -->
</div>
    
<script src="{{URL::asset('assets/js/sidebar.js')}}"></script>
@include('layout.footer')
