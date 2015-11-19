@include('layout.adminheader')  
<link href="{{URL::asset('assets/css/app.css')}}" rel="stylesheet">
<div class="container">

    <div class="row" >

        <div class="col-md-3">
            <h3>Material Category List</h3>
            <a href="/back/materialcategory/create" class="btn btn-success btn-sm" />Add Material Category</a>
        </div>
        <div class="col-md-12">
            <form action="/back/materialcategory">
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
                    <th><a href="/back/materialcategory?sortby=id">Material Category ID</a></th>
                    <th><a href="/back/materialcategory?sortby=material_categ_name">Material Category Name</a></th>
                    <th><a href="/back/materialcategory?sortby=is_active">Active</a></th>
                    <th><a href="/back/materialcategory?sortby=created_at">Created</a></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($materialcategories as $materialcategory)
                    <tr>
                        <td><a href="/back/materialcategory/edit/{{$materialcategory->id}}" class="btn-success btn-sm"/>edit</a></td>
                        <td>{{$materialcategory->id}}</td>
                        <td>{{$materialcategory->material_categ_name}}</td>
                        <td>{{$materialcategory->is_active}}</td>
                        <td>{{$materialcategory->created_at}}</td>
                        </a>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


     {!! str_replace('/?', '?', $materialcategories->render()) !!}
</div>
