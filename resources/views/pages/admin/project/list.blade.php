@include('layout.adminheader')
<link href="{{URL::asset('assets/css/app.css')}}" rel="stylesheet">
<div class="container">

    <div class="row" >

        <div class="col-md-3">
            <h3>Material Category List</h3>
            <a href="/back/project/create" class="btn btn-success btn-sm" />Add Project</a>
        </div>
        <div class="col-md-12">
            <form action="/back/project">
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
                    <th><a href="{{url()}}/back/project?sortby=id">ID</a></th>
                    <th><a href="{{url()}}/back/project?sortby=project_name">Project Name</a></th>
                    <th><a href="{{url()}}/back/project?sortby=is_public">Status</a></th>
                    <th><a href="{{url()}}/back/project?sortby=is_active">State</a></th>
                    <th><a href="{{url()}}/back/project?sortby=created_at">Created</a></th>
                </tr>
              </thead>
              <tbody>
               @foreach ($projects as $project)
                <tr>
                  <td><a href="{{url()}}/back/project/edit/{{$project->id}}" class="btn-success btn-sm"/>edit</a></td>
                  <td>{{$project->id}}</td>
                  <td>{{$project->project_name}}</td>
                  <td>{{($project->is_public == 1)?'Public' : 'Private'}}</td>
                  <td>{{($project->is_active == 1)? 'Active' : 'In-Active'}}</td>
                  <td>{{$project->created_at->format('M j, Y')}}</td>
                </a>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>
    </div>
     {!! str_replace('/?', '?', $projects->render()) !!}
</div>
