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
        <div class="alert alert-success">
          <ul>
            <li>{{ Session::get('message') }}</li>
          </ul>
        </div>
      @endif
    <div class="class="col-md-12">
    <h3>Edit Material Category</h3>
    <form action="/back/materialcategory/update/{{$materialcateg->id}}" method="POST">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="form-group">
        <label for="material_categ_name">Enter Material Category Name: *</label>
        <input type="text" class="form-control" name="material_categ_name" pattern=".{3,255}" title="minimum characters: 3,  maximum characters: 255 " required value="{{$materialcateg->material_categ_name}}">
      </div>
      <div class="form-group">
        <label for="material_categ_desc">Enter Material Category Description: *</label>
        <textarea  class="form-control" name="material_categ_desc" maxlength="500" minlength="10" title="minimum characters: 10,  maximum characters: 500 " required>{{$materialcateg->material_categ_desc}}</textarea>
      </div>
      <div class="checkbox">
        @if ($materialcateg->is_active)
          <label><input  type="checkbox" name="is_active" checked>active</label>
        @else
          <label><input type="checkbox" name="is_active">active</label>
        @endif
      </div>
      <button class="btn btn-success" type="submit">Update</button>
      <a href="/back/materialcategory" class="btn btn-info"/>Cancel</button></a>
      <a href="/back/materialcategory/create" class="btn btn-info"/>Add Another Material Category</button></a>
    </form>

  </div>
</div>





