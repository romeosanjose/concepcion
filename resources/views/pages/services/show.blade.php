@include('layout.header')  
<link href="{{URL::asset('assets/css/app.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/vendor/Gallery-master/css/blueimp-gallery.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/vendor/Bootstrap-Image-Gallery-3.1.3/css/bootstrap-image-gallery.min.css')}}" rel="stylesheet">



<div class="content">
     <div class="row">

         <div class="col-lg-12">
             <h1 align="center">SERVICE OFFERED:</h1>
             <div class="box">
                 <ul>
                 @foreach($services as $service)
                     <li>{{$service->service_name}}</li>
                 @endforeach
                 </ul>
             </div>
         </div>



    </div><!--end of row -->
    
</div>
@include('layout.footer')
