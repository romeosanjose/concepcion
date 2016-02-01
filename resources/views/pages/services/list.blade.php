
@include('layout.header')  
@include('layout.banner')
<div class="content">
     <div class="row">
         
          
          <!-- Main Content -->
          <div class="container-fluid col-md-12">
              <div class="side-body">
              		<h2>Services Offered: </h2>
                       @foreach ($services as $service)  
                        <div class="list-group box-glow">
                            <a href="/service/detail/{{$service->id}}" class="list-group-item ">
                                   <h3>{{$service->service_name}}</h3>
                                  <p>{{$service->service_desc}}</p>
                            </a>
                        </div>
                       @endforeach 
                 </div>
          </div>  
          	
          {!! str_replace('/?', '?', $services->render()) !!}

      
      

  </div><!--end of row -->
</div>    
    

@include('layout.footer')
