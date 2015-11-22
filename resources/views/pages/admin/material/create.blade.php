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

            <h2>New Material</h2>
            <form action="/back/material/store" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="form-group">
                <label for="material_name">Enter Material Name: *</label>
                <input type="text" class="form-control" name="material_name">
              </div>
              <div class="form-group">
                <label for="material_desc">Enter Material Description: *</label>
                <textarea  class="form-control" name="material_desc"></textarea>
              </div>
              <div class="form-group">
                <label for="material_category">Select Material Category: *</label>
                <select class="form-control" name="material_category">
                    <option selected disabled>Select option..</option>
                    @foreach($materialCategories as $materialCategory)
                        <option value="{{$materialCategory->id}}">{{$materialCategory->material_categ_name}}</option>
                    @endforeach
                </select>
              </div>
              <div class="form-group">
                    <label for="price">Enter Price: </label>
                    <input type="text" class="form-control" name="price">
              </div>
              <div class="form-group">
                <label for="size1">Enter Size: </label>
                <input type="text" class="form-control" name="size">
              </div>

                <div class="form-group">
                    <button  class="btn btn-success" type="submit" style="width:100%;">Create</button>
                </div>
                <div class="form-group">
                    <a href="/back/material" class="btn btn-info" style="width:100%;"/>Cancel</button></a>
                </div>
            </form>
        </div>
    </div>
</div>



