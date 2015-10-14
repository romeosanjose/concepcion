@include('layout.adminheader')  
<div class="container">
<div class="alert alert-success" style="display:none" id="msgsuccess">
  <strong>Success!</strong> Indicates a successful or positive action.
</div>  
<div class="alert alert-danger" style="display:none" id="msgfail">
  <strong>Warning!</strong> Indicates a dangerous or potentially negative action.
</div>    
<form>
  <input type="hidden" id="id" value="{{$user->id}}"/>  
  <div class="form-group">
    <label  for="email">enter email address: *</label>
    <input type="email" class="form-control" id="email" value="{{$user->email}}">
  </div>
  <div class="form-group">
    <label  for="contact">enter contact:</label>
    <input type="text" class="form-control" id="contact" value="{{$user->contact}}">
  </div>  
  <div class="form-group">
    <label  for="firstname">enter first name:</label>
    <input type="firstname" class="form-control" id="firstname" value="{{$user->firstname}}">
  </div>
  <div class="form-group">
    <label  for="firstname">enter last name:</label>
    <input type="lastname" class="form-control" id="lastname" value="{{$user->lastname}}">
  </div>    
  <div class="checkbox">
      @if ($user->is_admin) 
        <label><input type="checkbox" id="isadmin" checked>admin</label>
      @else
        <label><input type="checkbox" id="isadmin">admin</label>
      @endif
  </div>
  <div class="checkbox">
      @if ($user->is_active) 
        <label><input type="checkbox" id="isactive" checked>active</label>
      @else
        <label><input type="checkbox" id="isactive">active</label>
      @endif
  </div>  
  
</form>
  <button  class="btn btn-success" onclick="updateUser();">Update</button>
  <a href="{{url()}}/back/user" class="btn btn-info"/>Cancel</button></a>
</div>
