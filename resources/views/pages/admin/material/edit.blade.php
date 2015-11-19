@include('layout.adminheader')  
<div class="container">
<div class="alert alert-success" style="display:none" id="msgsuccess">
  <strong>Success!</strong> Indicates a successful or positive action.
</div>  
<div class="alert alert-danger" style="display:none" id="msgfail">
  <strong>Warning!</strong> Indicates a dangerous or potentially negative action.
</div>    
<form>
  <input type="hidden" id="id" value="{{$product->id}}"/>    
   <div class="form-group">
    <label for="product_name">enter product name: *</label>
    <input type="product_name" class="form-control" id="product_name" value="{{$product->product_name}}">
  </div>
  <div class="form-group">
    <label for="product_desc">enter product description: *</label>
    <textarea  class="form-control" id="product_desc">{{$product->product_desc}}</textarea>
  </div>
  <div class="form-group">
  <label for="category">Select Category:</label>
  <select class="form-control" id="category">
       @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->category_code."---".$category->category_name}}</option>
      @endforeach
  </select>
</div>
  <div class="form-group">
    <label for="product_code">enter sub product code: *</label>
    <input type="text" class="form-control" id="product_code" name="product_code" >
  </div>
  <div class="form-group">  
    <label for="productcateg_code">product code: * </label>  
    <span id="productcateg_code">{{$product->product_code}}</span> 
  </div>
  <div class="form-group">
    <label for="size1">enter size(1): </label>
    <input type="size1" class="form-control" id="size1" value="{{$product->size1}}">
  </div>
  <div class="form-group">
    <label for="size2">enter size(2): </label>
    <input type="size2" class="form-control" id="size2" value="{{$product->size2}}">
  </div>
  <div class="form-group">
    <label for="size3">enter size(3): </label>
    <input type="size3" class="form-control" id="size3" value="{{$product->size3}}">
  </div>
  <div class="form-group">
    <label for="size4">enter size(4): </label>
    <input type="size4" class="form-control" id="size4" value="{{$product->size4}}">
  </div>
  <div class="form-group">
    <label for="pre_stocks">enter pre-stocks: * </label>
    <input type="pre_stocks" class="form-control" id="pre_stocks" value="{{$product->pre_stocks}}">
  </div>
  <div class="form-group">
    <label for="stocks">enter stocks: </label>
    <input type="stocks" class="form-control" id="stocks" value="{{$product->stocks}}">
  </div>
  <div class="form-group">
    <label for="price">enter price: </label>
    <input type="price" class="form-control" id="price" value="{{$product->price}}">
  </div>
   <div class="form-group">
    <label for="gross_price">enter gross price: </label>
    <input type="gross_price" class="form-control" id="gross_price" value="{{$product->gross_price}}">
  </div>

  <div class="form-group">
    <span class="btn btn-success fileinput-button">
        <i class="glyphicon glyphicon-plus"></i>
        <span>upload product image</span>
        <!-- The file input field used as target for the file upload widget -->
        <input id="fileupload" type="file" name="files[]">
    </span>
  </div>
   <!-- The global progress bar -->
   <div id="progress" class="progress">
        <div class="progress-bar progress-bar-success"></div>
    </div>
    <!-- The container for the uploaded files -->
    <div class="form-group"> 
        <span>File ID: </span><div id="fileId" class="files"></div>
    </div>
    <div class="form-group"> 
        <span>File Name: </span><div id="files" class="files"></div>
    </div>
     <div class="checkbox">
      @if ($product->is_active) 
        <label><input type="checkbox" id="isactive" checked>active</label>
      @else
        <label><input type="checkbox" id="isactive">active</label>
      @endif
  </div>  
</form>  
  
  <button  class="btn btn-success" onclick="updateProduct();">Update</button>
  <a href="{{url()}}/back/product" class="btn btn-info"/>Cancel</button></a>
</div>

<script>
 $(document).ready(function(){
   
     $("#product_code").keypress(function(){
        var codeArr = $('#category option:selected').text().split('---');
        var code = codeArr[0];
        $('#productcateg_code').html(code + '-' + $('#product_code').val()); 
    });
   
     $('#fileupload').fileupload({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },  
        url: PRODUCT_UPLOAD_FILE, 
        dataType: 'json',
        done: function (e, data) {
            $.each(data.files, function (index, file) {
              $('#files').html(file.name);
            });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        },
        success: function(data){
            $('#fileId').html(data.fileId);
            //console.log(data.fileId);
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
    
 });   

 
</script>