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
          <label  for="email">Enter Email Address: *</label>
          <input type="email" class="form-control" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Enter Password: *</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <div class="form-group">
            <label  for="password_confirmation">Confirm Password: *</label>
            <input type="password" class="form-control" name="password_confirmation" required>
        </div>
        <div class="form-group">
          <label  for="contact">Enter Contact:</label>
          <input  class="form-control" name="contact" type="number"  min="0" max="9999"  size="4">
        </div>
        <div class="form-group">
          <label  for="firstname">Enter First Name:</label>
          <input type="firstname" class="form-control" name="firstname" pattern=".{3,255}" title="minimum characters: 3,  maximum characters: 255 ">
        </div>
        <div class="form-group">
          <label  for="firstname">Enter Last Name:</label>
          <input type="lastname" class="form-control" name="lastname" pattern=".{3,255}" title="minimum characters: 3,  maximum characters: 255 ">
        </div>
       <div class="form-group">
          <div class="checkbox">
              <label><input type="checkbox" id="is_admin">Admin</label>
          </div>
       </div>
        <div class="form-group">
            <button class="btn btn-success" type="submit" style="width:100%;">Create</button>
        </div>
        <div class="form-group">
            <a href="/back/user" class="btn btn-info" style="width:100%;"/>Cancel</button></a>
        </div>
    </form>

  </div>
</div>
</div>
