@include('layout.adminheader')  
<div class="container">
<div class="alert alert-success" style="display:none" id="msgsuccess">
  <strong>Success!</strong> Indicates a successful or positive action.
</div>  
<div class="alert alert-danger" style="display:none" id="msgfail">
  <strong>Warning!</strong> Indicates a dangerous or potentially negative action.
</div>    
<form>
   <div class="form-group">
    <label  for="email">enter email address: *</label>
    <input type="email" class="form-control" id="email">
  </div>  
  <div class="form-group">
    <label for="pwd">enter password: *</label>
    <input type="password" class="form-control" id="pwd">
  </div>
  <div class="form-group">
    <label  for="pwd">confirm password: *</label>
    <input type="password" class="form-control" id="cpwd">
  </div>    
  <div class="form-group">
    <label  for="contact">enter contact:</label>
    <input type="text" class="form-control" id="contact">
  </div>  
  <div class="form-group">
    <label  for="firstname">enter first name:</label>
    <input type="firstname" class="form-control" id="firstname">
  </div>
  <div class="form-group">
    <label  for="firstname">enter last name:</label>
    <input type="lastname" class="form-control" id="lastname">
  </div>    
  <div class="checkbox">
      <label><input type="checkbox" id="isadmin">admin</label>
  </div>
  
</form>
  <button  class="btn btn-success" onclick="createUser();">Create</button>
  <a href="{{url()}}/back/user" class="btn btn-info"/>Cancel</button></a>
</div>
