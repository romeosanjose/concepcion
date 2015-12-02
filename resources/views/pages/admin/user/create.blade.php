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
    <form action="/back/user/store" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
          <label  for="email">enter email address: *</label>
          <input type="email" class="form-control" name="email">
        </div>
        <div class="form-group">
            <label for="password">enter password: *</label>
            <input type="password" class="form-control" name="password">
        </div>
        <div class="form-group">
            <label  for="password_confirmation">confirm password: *</label>
            <input type="password" class="form-control" name="password_confirmation">
        </div>
        <div class="form-group">
          <label  for="contact">enter contact:</label>
          <input type="text" class="form-control" name="contact" >
        </div>
        <div class="form-group">
          <label  for="firstname">enter first name:</label>
          <input type="firstname" class="form-control" name="firstname">
        </div>
        <div class="form-group">
          <label  for="firstname">enter last name:</label>
          <input type="lastname" class="form-control" name="lastname">
        </div>
       <div class="form-group">
          <div class="checkbox">
              <label><input type="checkbox" id="is_admin">admin</label>
          </div>
       </div>

      <button class="btn btn-success" type="submit">Create</button>
      <a href="/back/user" class="btn btn-info"/>Cancel</button></a>
    </form>

  </div>
</div>
</div>
