@include('layout.adminheader')


<style>
 .bar {
    height: 18px;
    background: green;
}
</style>
<div class="container">
<div class="alert alert-success" style="display:none" id="msgsuccess">
  <strong>Success!</strong> Indicates a successful or positive action.
</div>  
<div class="alert alert-danger" style="display:none" id="msgfail">
  <strong>Warning!</strong> Indicates a dangerous or potentially negative action.
</div>
<h2>New Material</h2>
<form action="/back/material/store" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="form-group">
    <label for="material_name">enter material name: *</label>
    <input type="text" class="form-control" name="material_name">
  </div>
  <div class="form-group">
    <label for="material_desc">enter material description: *</label>
    <textarea  class="form-control" name="material_desc"></textarea>
  </div>

  <div class="form-group">
    <label for="product_code">enter sub product code: *</label>
    <input type="text" class="form-control" id="product_code" name="product_code">
  </div>
  <div class="form-group">  
    <label for="productcateg_code">product code: * </label>  
    <span id="productcateg_code">000</span> 
  </div>
  <div class="form-group">
    <label for="size1">enter size(1): </label>
    <input type="size1" class="form-control" id="size1">
  </div>
  <div class="form-group">
    <label for="size2">enter size(2): </label>
    <input type="size2" class="form-control" id="size2">
  </div>
  <div class="form-group">
    <label for="size3">enter size(3): </label>
    <input type="size3" class="form-control" id="size3">
  </div>
  <div class="form-group">
    <label for="size4">enter size(4): </label>
    <input type="size4" class="form-control" id="size4">
  </div>
  <div class="form-group">
    <label for="pre_stocks">enter pre-stocks: * </label>
    <input type="pre_stocks" class="form-control" id="pre_stocks">
  </div>
  <div class="form-group">
    <label for="stocks">enter stocks: </label>
    <input type="stocks" class="form-control" id="stocks">
  </div>
  <div class="form-group">
    <label for="price">enter price: </label>
    <input type="price" class="form-control" id="price">
  </div>
   <div class="form-group">
    <label for="gross_price">enter gross price: </label>
    <input type="gross_price" class="form-control" id="gross_price">
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

    <button  class="btn btn-success" type="submit">Create</button>
    <a href="/back/material" class="btn btn-info"/>Cancel</button></a>
</form>

</div>

<script>
// $(document).ready(function(){
//
//     $("#product_code").keypress(function(){
//        var codeArr = $('#category option:selected').text().split('---');
//        var code = codeArr[0];
//        $('#productcateg_code').html(code + '-' + $('#product_code').val());
//    });
//
//     $('#fileupload').fileupload({
//        headers: {
//            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//        },
//        url: PRODUCT_UPLOAD_FILE,
//        dataType: 'json',
//        done: function (e, data) {
//            $.each(data.files, function (index, file) {
//              $('#files').html(file.name);
//            });
//        },
//        progressall: function (e, data) {
//            var progress = parseInt(data.loaded / data.total * 100, 10);
//            $('#progress .progress-bar').css(
//                'width',
//                progress + '%'
//            );
//        },
//        success: function(data){
//            $('#fileId').html(data.fileId);
//            //console.log(data.fileId);
//        }
//    }).prop('disabled', !$.support.fileInput)
//        .parent().addClass($.support.fileInput ? undefined : 'disabled');
//
// });

 
</script>

