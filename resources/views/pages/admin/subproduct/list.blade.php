@include('layout.adminheader')
<link href="{{URL::asset('assets/css/app.css')}}" rel="stylesheet">
<div class="container">

    <div class="row" >

        <div class="col-md-3">
            <h3>Product List</h3>
            <a href="/back/subproduct/create" class="btn btn-success btn-sm" />Add Sub Product</a>
        </div>
        <div class="col-md-12">
            <form action="/back/subproduct">
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
                    <th><a href="/back/subproduct?sortby=id">Sub Product ID</a></th>
                    <th><a href="/back/subproduct?sortby=product_name">Sub Product Name</a></th>
                    <th><a href="/back/subproduct?sortby=is_active">Active</a></th>
                    <th><a href="/back/subproduct?sortby=created_at">Created</a></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td><a href="/back/subproduct/edit/{{$product->id}}" class="btn-success btn-sm"/>edit</a></td>
                        <td>{{$product->id}}</td>
                        <td>{{$product->sub_product_name}}</td>
                        <td>{{$product->is_active}}</td>
                        <td>{{$product->created_at}}</td>
                        </a>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


    {!! str_replace('/?', '?', $products->render()) !!}
</div>

