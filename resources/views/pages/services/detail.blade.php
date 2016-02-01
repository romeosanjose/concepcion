@include('layout.header')  
@include('layout.banner')
<link href="{{URL::asset('assets/css/app.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/vendor/Gallery-master/css/blueimp-gallery.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/vendor/Bootstrap-Image-Gallery-3.1.3/css/bootstrap-image-gallery.min.css')}}" rel="stylesheet">



<div class="content">
   <div class="row">
      	<div class="col-md-6">
                <dl class="dl-horizontal">
                    <dt>Service Name:</dt>
                    <dd>{{$service->service_name}}</dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>Service Description:</dt>
                    @if ($service->service_desc == '')
                    	<dd>No Description</dd>
                    @else 
                    	<dd>{{$service->service_desc}}</dd>
                    @endif	
                </dl>
               
        </div>   
   </div><!--end of row -->

</div>
@include('layout.footer')
