@include('layout.header')  
@include('layout.banner')
<div class="content">
     <div class="row">
          <!-- Menu -->
          <div class="side-menu col-sm-3">
    
              <!-- Search body -->
              <div id="search" >
                        <div class="">
                            <form class="form-horizontal" role="search" action="{{url()}}/material" method="GET">
                                <div class="form-group">
                                    <input type="text" class="form-control text-search" placeholder="Search" name="search">
                                    <button type="submit" class="btn btn-search"><span class="glyphicon glyphicon-search"></span></button>
                                </div>
                                
                            </form>
                        </div>
              </div>

              <!-- Main Menu -->
              <div class="filters">
                    <h3>Material Categories</h3>
                    <div class="list-group">
                        @foreach ($categories as $category)
                          <a class="list-group-item" href="{{url()}}/material?filter={{$category->id}}"><span class="glyphicon"></span>{{$category->material_categ_name}}</a>
                        @endforeach

                    </div>
              </div>
      
    
          </div><!--end of menu -->
    
        
    
          
          <!-- Main Content -->
          <div class="container-fluid col-sm-9">
              <div class="side-body">
                       @foreach ($materials as $material)  
                        <div class="list-group box-glow">
                            <a href="/material/show/{{$material->id}}" class="list-group-item ">
                                   @if ($material->disk_name != '')
                                    <img class="img-responsive img-rounded item-thumb" src="{{url().'/images/'. $material->disk_name}}" alt="" width="150" height="150" >
                                   @else
                                    <img class="img-responsive img-rounded item-thumb" src="/assets/images/noimage.png" alt="NO IMAGE" width="150" height="150" style="float:left;">
                                   @endif
                                
                                  <h3>{{$material->material_name}}</h3>
                                  <p>{{$material->material_desc}}</p>
                                
                            </a>
                        </div>
                       @endforeach 
                 </div>
          </div>  



      
      

  </div><!--end of row -->
</div>    
    

@include('layout.footer')
