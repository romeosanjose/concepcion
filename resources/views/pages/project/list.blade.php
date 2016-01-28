@include('layout.header')  
@include('layout.banner')
<div class="content">
     <div class="row">
          <!-- Menu -->
          <div class="side-menu col-sm-3">
    
              <!-- Search body -->
              <div id="search" >
                        <div class="">
                            <form class="form-horizontal" role="search" action="{{url()}}/project" method="GET">
                                <div class="form-group">
                                    <input type="text" class="form-control text-search" placeholder="Search" name="search">
                                    <button type="submit" class="btn btn-search"><span class="glyphicon glyphicon-search"></span></button>
                                </div>
                                
                            </form>
                        </div>
              </div>

              <!-- Main Menu -->
              <div class="filters">
                    <h3>Sort By</h3>
                    <div class="list-group">
                      <a class="list-group-item" href="/project?sortby=project.project_name"><span class="glyphicon"></span>Project Name</a>
                      <a class="list-group-item" href="/project?sortby=project.updated_at"><span class="glyphicon"></span>Project Creation Date</a>
                    </div>
              </div>
      
    
          </div><!--end of menu -->  


          <!-- Main Content -->
          <div class="container-fluid col-sm-8">
              <div class="side-body">
                    <div class="col-lg-12">
                      <h1 class="page-header">PROJECTS</h1>
                    </div>
                      @foreach ($projects as $project)  
                        <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                            <a class="thumbnail box-glow" href="{{url()}}/project/detail/{{$project->id}}">
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

@include('layout.footer')
