@include('layout.adminheader')  
<link href="{{URL::asset('assets/css/app.css')}}" rel="stylesheet">
<div class="container">
  
    <div class="add">
        <a href="{{url()}}/back/product/create" class="btn btn-success btn-sm" />Add Product</a> 
    </div>    
    <div class="search">
       <form action="{{url()}}/back/product">
         <input id="search" name="search" type="text" class="form-control input-sm" maxlength="64" placeholder="Search" />
         <button type="submit" class="btn btn-primary btn-sm">Search</button>
       </form>
    </div>
    
    
 
    <table class="table table-hover">
      <thead>
        <tr>
            <th>&nbsp;</th>
            <th><a href="{{url()}}/back/product?sortby=id">ID</a></th>
            <th><a href="{{url()}}/back/product?sortby=product_name">Product Name</a></th>
            <th><a href="{{url()}}/back/product?sortby=created_at">Created</a></th>
        </tr>
      </thead>
      <tbody>
       @foreach ($products as $product)    
        <tr>
          <td><a href="{{url()}}/back/product/edit/{{$product->id}}" class="btn-success btn-sm"/>edit</a></td>    
          <td>{{$product->id}}</td>
          <td>{{$product->product_name}}</td>
          <td>{{$product->created_at}}</td>
        </a>
        </tr>
        @endforeach
      </tbody>
    </table>
     {!! str_replace('/?', '?', $products->render()) !!}
</div>
