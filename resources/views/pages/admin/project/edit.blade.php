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
            <div class="alert alert-info">
                <ul>
                    <li>{{ Session::get('message') }}</li>
                </ul>
            </div>
        @endif
        <div class="class="class="col-md-12">
            <h2>Edit Project</h2>
            <form action="/back/project/update/{{$project->id}}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="project_name">Enter Project Name: *</label>
                    <input type="text" class="form-control" name="project_name" value="{{$project->project_name}}">
                </div>
                <div class="form-group">
                    <label for="project_desc">Enter Project Description: *</label>
                    <textarea  class="form-control" name="project_desc">{{$project->project_desc}}</textarea>
                </div>
                <div class="form-group">
                    <label for="price">Enter Price: </label>
                    <input type="text" class="form-control" name="price" value="{{$project->price}}">
                </div>
                <div class="form-group">
                    <label for="size">Enter Size: </label>
                    <input type="text" class="form-control" name="size" value="{{$project->size}}">
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        @if ($user->is_admin)
                            @if ($project->is_public)
                                <label><input type="checkbox" name="is_public" checked>public</label>
                            @else
                                <label><input type="checkbox" name="is_public" >public</label>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        @if ($project->is_active)
                            <label><input  type="checkbox" name="is_active" checked>active</label>
                        @else
                            <label><input type="checkbox" name="is_active">active</label>
                        @endif
                    </div>
                </div>

                <!-- IMAGE UPLOADER --->
                <div class="form-group">
                <input type ="hidden" id="module_id" value="{{$moduleId}}">
                    <label >Project Images: </label><br>
                <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>upload project image</span>
                    <!-- The file input field used as target for the file upload widget -->
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
                        @foreach ($projFiles as $projFile)
                            <li class="tmbli span4" >
                                <div class="tmbdiv thumbnail">
                                    <a class="close" href="#" onclick="removeImage(this,'{{serialize(array($projFile->id,0,1))}}');">×</a>
                                    <img src="{{'/images/'. $projFile->disk_name}}" alt=""  style="width:150px;height:150px;">
                                </div>
                                <input class="tmbval" type="hidden" name="img[]" value="{{serialize(array($projFile->id,$projFile->is_active,1))}}">
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="form-group">
                    <button  class="btn btn-success" type="submit" style="width:100%;">Update</button>
                </div>
                <div class="form-group">
                    <a href="/back/material" class="btn btn-info" style="width:100%;"/>Cancel</button></a>
                </div>

            </form>

        </div>
    </div>
</div>



