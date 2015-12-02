@include('layout.adminheader')
<link href="{{URL::asset('assets/css/app.css')}}" rel="stylesheet">
<div class="container">

    <div class="row" >

        <div class="col-md-3">
            <h3>Material Category List</h3>
            <a href="/back/user/create" class="btn btn-success btn-sm" />Add User</a>
        </div>
        <div class="col-md-12">
            <form action="/back/user">
                <div id="custom-search-input">
                    <div class="input-group col-md-12">
                        <input name="search" type="text" class="  search-query form-control" placeholder="Search" />
                                    <span class="input-group-btn">
                                        <button class="btn btn-danger" type="button">
                                            <span class=" glyphicon glyphicon-search"></span>
                                        </button>
                                    </span>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-12">
            <table class="table table-hover">
              <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th><a href="{{url()}}/back/user?sortby=id">ID</a></th>
                    <th><a href="{{url()}}/back/user?sortby=username">User Name</a></th>
                    <th><a href="{{url()}}/back/user?sortby=email">Email</a></th>
                    <th><a href="{{url()}}/back/user?sortby=created_at">Created</a></th>
                    <th><a href="{{url()}}/back/user?sortby=is_admin">Admin</a></th>
                    <th><a href="{{url()}}/back/user?sortby=is_active">Active</a></th>
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
                  <td>{{$user->is_active}}</td>
                </a>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>
    </div>

             {!! str_replace('/?', '?', $users->render()) !!}
</div>
