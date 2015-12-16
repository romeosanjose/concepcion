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
        <div class="col-md-12">
            <h2>Edit Post</h2>
            <form action="/back/post/update/{{$post->id}}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="title">enter title: *</label>
                    <input type="title" class="form-control" name="title" pattern=".{3,255}" title="minimum characters: 3,  maximum characters: 255 " required value="{{$post->title}}">
                </div>
                <div class="form-group">
                    <label for="content">enter content: *</label>
                    <textarea  class="form-control" name="content" maxlength="500" minlength="10" title="minimum characters: 10,  maximum characters: 500 " required>{{$post->content}}</textarea>
                </div>
                <select class="form-control" name="post_type">
                    <option  value="{{$post->post_type}}">{{$postTypeId->name}}</option>
                    @foreach($postTypes as $postType)
                        <option value="{{$postType->id}}">{{$postType->name}}</option>
                    @endforeach
                </select>
                <div class="checkbox">
                    @if ($user->is_admin)
                        @if ($post->is_published)
                            <label><input type="checkbox" name="is_published" checked>publish</label>
                        @else
                            <label><input type="checkbox" name="is_published" >publish</label>
                        @endif
                    @endif
                </div>
                <div class="checkbox">
                    @if ($post->is_active)
                        <label><input type="checkbox" name="is_active" checked>active</label>
                    @else
                        <label><input type="checkbox" name="is_active">active</label>
                    @endif
                </div>




                <!-- IMAGE UPLOADER --->
                <div class="form-group">
                    <input type ="hidden" id="module_id" value="{{$moduleId}}">
                <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>upload post image</span>
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
                        @foreach ($postFiles as $postFile)
                            <li class="tmbli span4" >
                                <div class="tmbdiv thumbnail">
                                    <a class="close" href="#" onclick="removeImage(this,'{{serialize(array($postFile->id,0))}}');">×</a>
                                    <img src="{{'/images/'. $postFile->disk_name}}" alt=""  style="width:150px;height:150px;">
                                </div>
                                <input class="tmbval" type="hidden" name="img[]" value="{{serialize(array($postFile->id,$postFile->is_active))}}">
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="form-group">
                    <button  class="btn btn-success" type="submit" style="width:100%;">Update</button>
                </div>
                <div class="form-group">
                    <a href="/back/post" class="btn btn-info" style="width:100%;"/>Cancel</button></a>
                </div>
                <div class="form-group">
                    <a href="/back/post/create" class="btn btn-info" style="width:100%;"/>Add Another Post</button></a>
                </div>

            </form>




        </div>
    </div>
</div>



