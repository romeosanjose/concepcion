
@include('layout.header')  
@include('layout.banner')
<div class="content">
     <div class="row">
         
      <h2>Services Offered:</h2>    
          <!-- Main Content -->
           <div class="container-fluid col-sm-9">
              <div class="side-body">
                       @foreach ($services as $service)  
                        <div class="list-group box-glow" >
                            <a href="/service/show/{{$service->id}}" class="list-group-item " >
                                   @if ($service->disk_name != '')
                                    <img class="img-responsive img-rounded item-thumb" src="{{url().'/images/'. $service->disk_name}}" alt="" width="150" height="150" >
                                   @else
                                    <img class="img-responsive img-rounded item-thumb" src="/assets/images/noimage.png" alt="NO IMAGE" width="150" height="150" style="float:left;">
                                   @endif
                                
                                  <h3>{{$service->service_name}}</h3>
                                  <p>{{$service->service_desc}}</p>
                                
                            </a>
                        </div>
                       @endforeach 
                 </div>
          </div> 
          	
        
      
      

  </div><!--end of row -->
</div>    
    

@include('layout.footer')
