@include('layout.adminheader')  
<link href="{{URL::asset('assets/css/app.css')}}" rel="stylesheet">
<div class="container">
  
    <div class="add">
        <a href="{{url()}}/back/post/create" class="btn btn-success btn-sm" />Add Post</a> 
    </div>    
    <div class="search">
       <form action="{{url()}}/back/post">
         <input id="search" name="search" type="text" class="form-control input-sm" maxlength="64" placeholder="Search" />
         <button type="submit" class="btn btn-primary btn-sm">Search</button>
       </form>
    </div>
    
    
 
    <table class="table table-hover">
      <thead>
        <tr>
            <th>&nbsp;</th>
            <th><a href="{{url()}}/back/post?sortby=id">ID</a></th>
            <th><a href="{{url()}}/back/post?sortby=title">Title</a></th>
            <th><a href="{{url()}}/back/post?sortby=created_at">Created</a></th>
        </tr>
      </thead>
      <tbody>
       @foreach ($posts as $post)    
        <tr>
          <td><a href="{{url()}}/back/post/edit/{{$post->id}}" class="btn-success btn-sm"/>edit</a></td>    
          <td>{{$post->id}}</td>
          <td>{{$post->title}}</td>
          <td>{{$post->created_at}}</td>
        </a>
        </tr>
        @endforeach
      </tbody>
    </table>
     {!! str_replace('/?', '?', $posts->render()) !!}
</div>
