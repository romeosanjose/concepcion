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
      <div class="alert alert-info">
        <ul>
          <li>{{ Session::get('message') }}</li>
        </ul>
      </div>
    @endif
    <div class="class="col-md-12">
      <h3>New Product Category</h3>
      <form action="/back/category/store" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
          <label for="category_name">Enter Product Category Name: *</label>
          <input type="text" class="form-control" name="category_name" pattern=".{3,255}" title="minimum characters: 3,  maximum characters: 255 " required>
        </div>
        <div class="form-group">
          <label for="category_code">Enter Product Category Code: *</label>
          <input class="form-control" type="text" name="category_code" pattern="[A-Z]{2}" title="example format: 'CD'" required>
        </div>
        <div class="form-group">
          <label for="category_desc">Enter Product Category Description: *</label>
          <textarea  class="form-control" name="category_desc" maxlength="500" minlength="10" title="minimum characters: 10,  maximum characters: 500 " required></textarea>
        </div>
        <div class="form-group">
          <button class="btn btn-success" type="submit" style="width:100%">Create</button>
        </div>
        <div class="form-group">
          <a href="/back/category" class="btn btn-info" style="width:100%"/>Cancel</button></a>
        </div>
      </form>
    </div>
</div>
</div>
