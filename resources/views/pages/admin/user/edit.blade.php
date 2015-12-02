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
    <h3>New User</h3>
    <form action="/back/user/update/{{$user->id}}" method="POST">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">

      <div class="form-group">
        <label  for="email">enter email address: *</label>
        <input type="email" class="form-control" name="email" value="{{$user->email}}">
      </div>
      <div class="form-group">
        <label  for="contact">enter contact:</label>
        <input type="text" class="form-control" name="contact" value="{{$user->contact}}">
      </div>
      <div class="form-group">
        <label  for="firstname">enter first name:</label>
        <input type="firstname" class="form-control" name="firstname" value="{{$user->firstname}}">
      </div>
      <div class="form-group">
        <label  for="firstname">enter last name:</label>
        <input type="lastname" class="form-control" name="lastname" value="{{$user->lastname}}">
      </div>

      <div class="checkbox">
        @if ($user->is_admin)
          <label><input type="checkbox" name="is_admin" checked>admin</label>
        @else
          <label><input type="checkbox" name="is_admin">admin</label>
        @endif
      </div>
      <div class="checkbox">
        @if ($user->is_active)
          <label><input type="checkbox" name="is_active" checked>active</label>
        @else
          <label><input type="checkbox" name="is_active">active</label>
        @endif
     </div>

      <button class="btn btn-success" type="submit">Update</button>
      <a href="/back/user" class="btn btn-info"/>Cancel</button></a>
    </form>

  </div>
</div>
</div>
