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

            <h2>New Sub Product</h2>
            <form action="/back/subproduct/store" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="product_name">Enter Sub Product Name: *</label>
                    <input type="text" class="form-control" name="sub_product_name" pattern=".{3,255}" title="minimum characters: 3,  maximum characters: 255 " required>
                </div>
                <div class="form-group">
                    <label for="product_desc">Enter Sub Product Description: *</label>
                    <textarea  class="form-control" name="sub_product_desc" maxlength="500" minlength="10" title="minimum characters: 10,  maximum characters: 500 " required></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Enter Price: </label>
                    <input  class="form-control" type="number" name="price" min="0" max="9999" step="0.01" size="4" required>
                </div>
                <div class="form-group">
                    <label for="size">Enter Size: </label>
                    <input type="text" class="form-control" name="size" required>
                </div>
                <div class="form-group">
                    <button  class="btn btn-success" type="submit" style="width:100%;">Create</button>
                </div>
                <div class="form-group">
                    <a href="/back/subproduct" class="btn btn-info" style="width:100%;"/>Cancel</button></a>
                </div>

            </form>
        </div>
    </div>
</div>



