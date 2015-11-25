@include('layout.adminheader')
<link href="{{URL::asset('assets/css/app.css')}}" rel="stylesheet">
<div class="container">

    <div class="row" >

        <div class="col-md-3">
            <h3>Product Category List</h3>
            <a href="/back/category/create" class="btn btn-success btn-sm" />Add Product Category</a>
        </div>
        <div class="col-md-12">
            <form action="/back/category">
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
                    <th><a href="/back/category?sortby=id">Product Category ID</a></th>
                    <th><a href="/back/category?sortby=category_name">Product Category Name</a></th>
                    <th><a href="/back/category?sortby=is_active">Active</a></th>
                    <th><a href="/back/category?sortby=created_at">Created</a></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td><a href="/back/category/edit/{{$category->id}}" class="btn-success btn-sm"/>edit</a></td>
                        <td>{{$category->id}}</td>
                        <td>{{$category->category_name}}</td>
                        <td>{{$category->is_active}}</td>
                        <td>{{$category->created_at}}</td>
                        </a>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


    {!! str_replace('/?', '?', $categories->render()) !!}
</div>
