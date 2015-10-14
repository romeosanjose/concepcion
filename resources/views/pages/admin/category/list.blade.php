@include('layout.adminheader')  
<link href="{{URL::asset('assets/css/app.css')}}" rel="stylesheet">
<div class="container">
  
    <div class="add">
        <a href="{{url()}}/back/category/create" class="btn btn-success btn-sm" />Add Category</a> 
    </div>    
    <div class="search">
       <form action="{{url()}}/back/category">
         <input id="search" name="search" type="text" class="form-control input-sm" maxlength="64" placeholder="Search" />
         <button type="submit" class="btn btn-primary btn-sm">Search</button>
       </form>
    </div>
    
    
 
    <table class="table table-hover">
      <thead>
        <tr>
            <th>&nbsp;</th>
            <th><a href="{{url()}}/back/category?sortby=id">ID</a></th>
            <th><a href="{{url()}}/back/category?sortby=category_name">Category Name</a></th>
            <th><a href="{{url()}}/back/category?sortby=created_at">Created</a></th>
        </tr>
      </thead>
      <tbody>
       @foreach ($categories as $category)    
        <tr>
          <td><a href="{{url()}}/back/category/edit/{{$category->id}}" class="btn-success btn-sm"/>edit</a></td>    
          <td>{{$category->id}}</td>
          <td>{{$category->category_name}}</td>
          <td>{{$category->created_at}}</td>
        </a>
        </tr>
        @endforeach
      </tbody>
    </table>
     {!! str_replace('/?', '?', $categories->render()) !!}
</div>
