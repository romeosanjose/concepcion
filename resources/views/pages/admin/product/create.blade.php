@include('layout.adminheader')
<div class="container">
    <div class="row">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (Session::get('message'))
            <div class="alert alert-danger">
                <ul>
                    <li>{{ Session::get('message') }}</li>
                </ul>
            </div>
        @endif
        <div class="class="class="col-md-12">

            <h2>New Product</h2>
            <form action="/back/product/store" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="product_name">Enter Product Name: *</label>
                    <input type="text" class="form-control" name="product_name">
                </div>
                <div class="form-group">
                    <label for="product_desc">Enter Product Description: *</label>
                    <textarea  class="form-control" name="product_desc"></textarea>
                </div>
                <div class="form-group">
                    <label for="product_category">Select Product Category: *</label>
                    <select class="form-control" id="product_category" name="product_category">
                        <option selected disabled>Please select one option</option>
                        @foreach($productCategories as $productCategory)
                            <option value="{{$productCategory->id}}">{{$productCategory->category_code."---".$productCategory->category_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="product_code">enter sub product code: *</label>
                    <input type="text" class="form-control" id="product_code" name="product_code">
                </div>
                <div class="form-group">
                    <label for="productcateg_code">product code: * </label>
                    <span class="strong" name="productcateg_code_span" id="productcateg_code_span">000</span>
                    <input type="hidden" name="productcateg_code" id="productcateg_code">
                </div>
                <div class="form-group">
                    <label for="price">Enter Price: </label>
                    <input type="text" class="form-control" name="price">
                </div>
                <div class="form-group">
                    <label for="size">Enter Size: </label>
                    <input type="text" class="form-control" name="size">
                </div>
                <div class="form-group">
                    <button  class="btn btn-success" type="submit" style="width:100%;">Create</button>
                </div>
                <div class="form-group">
                    <a href="/back/product" class="btn btn-info" style="width:100%;"/>Cancel</button></a>
                </div>
            </form>
        </div>
    </div>
</div>



