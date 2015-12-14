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
                          <form class="navbar-form" role="search" action="{{url()}}/project" method="GET">
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
                    <li><a href="{{url()}}/project?sortby=project.project_name"><span class="glyphicon"></span>Sort by Project Name</a></li>
                    <li><a href="{{url()}}/project?sortby=project.updated_at"><span class="glyphicon"></span>Sort by Project Creation Date</a></li>
              </ul>
          </div><!-- /.navbar-collapse -->
      </nav>
    
          </div>

          <!-- Main Content -->
          <div class="container-fluid">
              <div class="side-body">
                    <div class="col-lg-12">
                      <h1 class="page-header">PROJECTS</h1>
                    </div>
                      @foreach ($projects as $project)  
                        <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                            <a class="thumbnail" href="{{url()}}/project/detail/{{$project->id}}">
                               @if ($project->disk_name != '')
                                <img class="img-responsive" src="{{url().'/images/'. $project->disk_name}}" alt="">
                               @else
                                    <img class="img-responsive" src="/assets/images/noimage.png" alt="NO IMAGE" width="150" height="150">
                               @endif
                            </a>
                            <span>{{$project->project_name}}</span>
                        </div>
                       @endforeach 
                 </div>
          </div>  



      
      

  </div><!--end of row -->
</div>
    
    
<script src="{{URL::asset('assets/js/sidebar.js')}}"></script>
@include('layout.footer')
