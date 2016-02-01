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
    <h3>Edit Service</h3>
    <form action="/back/service/update/{{$service->id}}" method="POST">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="form-group">
        <label for="service_name">Enter New Service: *</label>
        <input type="text" class="form-control" name="service_name" pattern=".{3,255}" title="minimum characters: 3,  maximum characters: 255 " required value="{{$service->service_name}}">
      </div>
      <div class="form-group">
        <label for="service_desc">Enter Description: *</label>
        <textarea  class="form-control" name="service_desc">{{$service->service_desc}}</textarea>
      </div>
      <div class="checkbox">
        @if ($service->is_active)
          <label><input  type="checkbox" name="is_active" checked>active</label>
        @else
          <label><input type="checkbox" name="is_active">active</label>
        @endif
      </div>
      <div class="form-group">
        <button class="btn btn-success" type="submit" style="width:100%">Update</button>
      </div>
      <div class="form-group">
        <a href="/back/service" class="btn btn-info" style="width:100%"/>Cancel</button></a>
      </div>
      <div class="form-group">
        <a href="/back/service/create" class="btn btn-info" style="width:100%"/>Add Another Service</button></a>
      </div>
    </form>

  </div>
</div>





