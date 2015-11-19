@include('layout.adminheader')  
<link href="{{URL::asset('assets/css/app.css')}}" rel="stylesheet">
<div class="container">
  

    <div >
       <form action="/back/material">
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
    <div class="add">
        <a href="{{url()}}/back/material/create" class="btn btn-success btn-sm" />Add Material</a>
    </div>


    <table class="table table-hover">
      <thead>
        <tr>
            <th>&nbsp;</th>
            <th><a href="{{url()}}/back/material?sortby=id">ID</a></th>
            <th><a href="{{url()}}/back/material?sortby=material_name">Material Name</a></th>
            <th><a href="{{url()}}/back/material?sortby=is_active">Active</a></th>
            <th><a href="{{url()}}/back/material?sortby=created_at">Created</a></th>
        </tr>
      </thead>
      <tbody>
       @foreach ($materials as $material)
        <tr>
          <td><a href="{{url()}}/back/material/edit/{{$material->id}}" class="btn-success btn-sm"/>edit</a></td>
          <td>{{$material->id}}</td>
          <td>{{$material->material_name}}</td>
          <td>{{$material->created_at}}</td>
        </a>
        </tr>
        @endforeach
      </tbody>
    </table>
</div>
