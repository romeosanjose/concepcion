@include('layout.adminheader')  
<link href="{{URL::asset('assets/css/app.css')}}" rel="stylesheet">
<div class="container">

    <div class="row" >

        <div class="col-md-3">
            <h3>Material Category List</h3>
            <a href="/back/material/create" class="btn btn-success btn-sm" />Add Material</a>
        </div>
        <div class="col-md-12">
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
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th><a href="/back/material?sortby=id">Material ID</a></th>
                    <th><a href="/back/material?sortby=material_name">Material Name</a></th>
                    <th><a href="/back/material?sortby=is_active">Active</a></th>
                    <th><a href="/back/material?sortby=created_at">Created</a></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($materials as $material)
                    <tr>
                        <td><a href="/back/material/edit/{{$material->id}}" class="btn-success btn-sm"/>edit</a></td>
                        <td>{{$material->id}}</td>
                        <td>{{$material->material_name}}</td>
                        <td>{{$material->is_active}}</td>
                        <td>{{$material->created_at}}</td>
                        </a>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


    {!! str_replace('/?', '?', $materials->render()) !!}
</div>

