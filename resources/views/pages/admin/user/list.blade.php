@include('layout.adminheader')  
<link href="{{URL::asset('assets/css/app.css')}}" rel="stylesheet">
<div class="container">
  
    <div class="add">
        <a href="{{url()}}/back/user/create" class="btn btn-success btn-sm" />Add user</a> 
    </div>    
    <div class="search">
       <form action="{{url()}}/back/user">
         <input id="search" name="search" type="text" class="form-control input-sm" maxlength="64" placeholder="Search" />
         <button type="submit" class="btn btn-primary btn-sm">Search</button>
       </form>
    </div>
    
    
 
    <table class="table table-hover">
      <thead>
        <tr>
            <th>&nbsp;</th>
            <th><a href="{{url()}}/back/user?sortby=id">ID</a></th>
            <th><a href="{{url()}}/back/user?sortby=username">User Name</a></th>
            <th><a href="{{url()}}/back/user?sortby=email">Email</a></th>
            <th><a href="{{url()}}/back/user?sortby=created_at">Created</a></th>
            <th><a href="{{url()}}/back/user?sortby=is_admin">Admin</a></th>
        </tr>
      </thead>
      <tbody>
       @foreach ($users as $user)    
        <tr>
          <td><a href="{{url()}}/back/user/edit/{{$user->id}}" class="btn-success btn-sm"/>edit</a></td>    
          <td>{{$user->id}}</td>
          <td>{{$user->username}}</td>
          <td>{{$user->email}}</td>
          <td>{{$user->created_at}}</td>
          <td>{{$user->is_admin}}</td>  
        </a>
        </tr>
        @endforeach
      </tbody>
    </table>
     {!! str_replace('/?', '?', $users->render()) !!}
</div>
