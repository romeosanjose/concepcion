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
<form>
  <div class="form-group">
    <label for="project_name">enter project name: *</label>
    <input type="project_name" class="form-control" id="project_name">
  </div>
  <div class="form-group">
    <label for="project_desc">enter project description: *</label>
    <textarea  class="form-control" id="project_desc"></textarea>
  </div>
 <div class="checkbox">
      @if ($user->is_admin) 
        <label><input type="checkbox" id="ispublic">public</label>
      @endif
  </div>   
    
  <div class="form-group">
    <span class="btn btn-success fileinput-button">
        <i class="glyphicon glyphicon-plus"></i>
        <span>upload project images</span>
        <!-- The file input field used as target for the file upload widget -->
        <input id="fileupload" type="file" name="files[]" multiple>
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
</form>
  <button  class="btn btn-success" onclick="createProject();">Create</button>
  <a href="{{url()}}/back/project" class="btn btn-info"/>Cancel</button></a>
</div>

<script>
 $(document).ready(function(){
   
     $('#fileupload').fileupload({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },  
        url: PROJECT_UPLOAD_FILE, 
        dataType: 'json',
        done: function (e, data) {
            $.each(data.files, function (index, file) {
             // $('#files').html(file.name);
             //$('<p/>').text(file.name + ' ').appendTo('#files');
             $('#files').append(file.name + ' ');
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
            //$('#fileId').html(data.fileId);
             //$('<p/>').text(data.fileId + ' ').appendTo('#fileId');
             $('#fileId').append(data.fileId + ' ');
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
    
 });   

 
</script>

