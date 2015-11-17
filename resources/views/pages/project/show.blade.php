@include('layout.header')  
<link href="{{URL::asset('assets/css/app.css')}}" rel="stylesheet">




<div class="content">
     <div class="row">
     @foreach ($project as $p)
        <dl class="dl-horizontal">
          <dt>Project Image</dt>
          <dd><img class="img-responsive" src="{{url().'/images/product/'.$p->disk_name}}" alt=""></dd>
        </dl>
        <dl class="dl-horizontal">
          <dt>Project Name</dt>
          <dd>{{$p->project_name}}</dd>
        </dl>
        <dl class="dl-horizontal">
          <dt>Project Description</dt>
          <dd>{{$p->project_desc}}</dd>
        </dl>
        <dl class="dl-horizontal">
          <dt>Last Updated</dt>
          <dd>{{$p->updated_at}}</dd>
         </dl>
     @endforeach     
    </div><!--end of row -->
    

@include('layout.footer')
</div>