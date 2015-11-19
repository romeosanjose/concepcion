@include('layout.adminheader')  
<link href="{{URL::asset('assets/css/app.css')}}" rel="stylesheet">
<div class="container">
  
    <div class="add">
        <a href="{{url()}}/back/project/create" class="btn btn-success btn-sm" />Add Product</a> 
    </div>    
    <div class="search">
       <form action="{{url()}}/back/project">
         <input id="search" name="search" type="text" class="form-control input-sm" maxlength="64" placeholder="Search" />
         <button type="submit" class="btn btn-primary btn-sm">Search</button>
       </form>
    </div>
    
    
 
    <table class="table table-hover">
      <thead>
        <tr>
            <th>&nbsp;</th>
            <th><a href="{{url()}}/back/project?sortby=id">ID</a></th>
            <th><a href="{{url()}}/back/project?sortby=project_name">Project Name</a></th>
            <th><a href="{{url()}}/back/project?sortby=created_at">Created</a></th>
        </tr>
      </thead>
      <tbody>
       @foreach ($projects as $project)    
        <tr>
          <td><a href="{{url()}}/back/project/edit/{{$project->id}}" class="btn-success btn-sm"/>edit</a></td>    
          <td>{{$project->id}}</td>
          <td>{{$project->project_name}}</td>
          <td>{{$project->created_at}}</td>
        </a>
        </tr>
        @endforeach
      </tbody>
    </table>
     {!! str_replace('/?', '?', $projects->render()) !!}
</div>
