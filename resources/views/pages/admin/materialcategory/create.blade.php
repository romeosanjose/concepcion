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
      <div class="class="col-md-12">
        <h3>New Material Category</h3>
        <form action="/back/materialcategory/store" method="POST">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="form-group">
                <label for="material_categ_name">Enter Material Category Name: *</label>
                <input type="text" class="form-control" name="material_categ_name" pattern=".{3,255}" title="minimum characters: 3,  maximum characters: 255 " required>
              </div>
              <div class="form-group">
                <label for="material_categ_desc">Enter Material Category Description: *</label>
                <textarea  class="form-control" name="material_categ_desc" maxlength="500" minlength="10" title="minimum characters: 10,  maximum characters: 500 " required></textarea>
              </div>
            <button class="btn btn-success" type="submit">Create</button>
            <a href="/back/materialcategory" class="btn btn-info"/>Cancel</button></a>
          </form>

      </div>
    </div>
</div>
