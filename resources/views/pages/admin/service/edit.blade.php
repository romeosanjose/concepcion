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
        <input type ="hidden" id="module_id" value="{{$moduleId}}">
            <label >Project Images: </label><br>
        <span class="btn btn-success fileinput-button">
            <i class="glyphicon glyphicon-plus"></i>
            <span>upload project image</span>
            <input id="fileupload" type="file" name="files[]">
        </span>
      </div>
      <!-- The global progress bar -->
      <div class="form-group">
          <div id="progress" class="progress">
              <div class="progress-bar progress-bar-success"></div>
          </div>
      </div>
      <div class="form-group">
          <span>File Name: </span><div id="files" class="files"></div>
      </div>


      <div id="image_gallery_container">
          <ul id="image_gallery" class="thumbnails list-inline" style="list-style-type: none;">
              @foreach ($servFiles as $servFile)
                  <li class="tmbli span4" >
                      <div class="tmbdiv thumbnail">
                          <a class="close" href="#" onclick="removeImage(this,'{{serialize(array($servFile->id,0,1))}}');">×</a>
                          <img src="{{'/images/'. $servFile->disk_name}}" alt=""  style="width:150px;height:150px;">
                      </div>
                      <input class="tmbval" type="hidden" name="img[]" value="{{serialize(array($servFile->id,$servFile->is_active,1))}}">
                  </li>
              @endforeach
          </ul>
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





