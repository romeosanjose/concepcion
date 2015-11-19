@include('layout.adminheader')  
<div class="container">
<div class="alert alert-success" style="display:none" id="msgsuccess">
  <strong>Success!</strong> Indicates a successful or positive action.
</div>  
<div class="alert alert-danger" style="display:none" id="msgfail">
  <strong>Warning!</strong> Indicates a dangerous or potentially negative action.
</div>    
<form>
  <input type="hidden" id="id" value="{{$category->id}}"/>    
  <div class="form-group">
    <label for="category_name">enter category name: *</label>
    <input type="category_name" class="form-control" id="category_name" value="{{$category->category_name}}">
  </div>
  <div class="form-group">
    <label for="category_code">enter category code: *</label>
    <input type="category_code" class="form-control" id="category_code" value="{{$category->category_code}}">
  </div>
  <div class="form-group">
    <label for="category_desc">enter category description: *</label>
    <textarea  class="form-control" id="category_desc" value="{{$category->category_desc}}">{{$category->category_desc}}</textarea>
  </div>
   <div class="checkbox">
      @if ($category->is_active) 
        <label><input type="checkbox" id="isactive" checked>active</label>
      @else
        <label><input type="checkbox" id="isactive">active</label>
      @endif
  </div>  
</form>
  <button  class="btn btn-success" onclick="updateCategory();">Update</button>
  <a href="{{url()}}/back/category" class="btn btn-info"/>Cancel</button></a>
</div>
