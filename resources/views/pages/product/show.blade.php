@include('layout.header')  
<link href="{{URL::asset('assets/css/app.css')}}" rel="stylesheet">




<div class="content">
     <div class="row">
     @foreach ($product as $p)
        <dl class="dl-horizontal">
          <dt>Product Image</dt>
          <dd><img class="img-responsive" src="{{url().'/images/product/'.$p->disk_name}}" alt=""></dd>
        </dl>
        <dl class="dl-horizontal">
          <dt>Product Name</dt>
          <dd>{{$p->product_name}}</dd>
        </dl>
        <dl class="dl-horizontal">
          <dt>Product Description</dt>
          <dd>{{$p->product_desc}}</dd>
        </dl>
        <dl class="dl-horizontal">
          <dt>Product Code</dt>
          <dd>{{$p->product_code}}</dd>
        </dl>
        <dl class="dl-horizontal">
          <dt>Product Price</dt>
          <dd>{{$p->price}}</dd>
        </dl>
        <dl class="dl-horizontal">
          <dt>Product Sizes</dt>
          <dd>size 1: {{$p->size1}}</dd>
          <dd>size 2: {{$p->size2}}</dd>
          <dd>size 3: {{$p->size3}}</dd>
          <dd>size 4: {{$p->size4}}</dd>
        </dl>
        <dl class="dl-horizontal">
          <dt>Product Stocks</dt>
          <dd>{{$p->stocks}}</dd>
         </dl>
     @endforeach     
    </div><!--end of row -->
    

@include('layout.footer')
</div>