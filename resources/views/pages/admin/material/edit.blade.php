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
            <h2>Edit Material</h2>
            <form action="/back/material/update/{{$material->id}}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="material_name">Enter Material Name: *</label>
                    <input type="text" class="form-control" name="material_name" pattern=".{3,255}" title="minimum characters: 3,  maximum characters: 255 " required value="{{$material->material_name}}">
                </div>
                <div class="form-group">
                    <label for="material_desc">Enter Material Description: *</label>
                    <textarea  class="form-control" name="material_desc" maxlength="500" minlength="10" title="minimum characters: 10,  maximum characters: 500 " required>{{$material->material_desc}}</textarea>
                </div>
                <div class="form-group">
                    <label for="material_category">Select Material Category: *</label>
                    <select class="form-control" name="material_category">
                        <option selected value="{{$material->material_categ_id}}">{{$materialCategId->material_categ_name}}</option>
                        @foreach($materialCategories as $materialCategory)
                            <option value="{{$materialCategory->id}}">{{$materialCategory->material_categ_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="material_code">Enter Material Code : *</label>
                    <input type="text" class="form-control" id="material_code" name="material_code" pattern="[A-Z]{2}[-]\d{3}" title="example format: 'CD-123' " required value="{{$material->material_code}}">
                </div>
                <div class="form-group">
                    <label for="price">Enter Price: </label>
                    <input class="form-control" type="number" name="price" min="0" max="9999" step="0.01" size="4" required value="{{{number_format((float)$material->price,2)}}}">
                </div>
                <div class="form-group">
                    <label for="size">Enter Size: </label>
                    <input type="text" class="form-control" name="size" required value="{{$material->size}}">
                </div>
                <div class="checkbox">
                    @if ($material->is_active)
                        <label><input  type="checkbox" name="is_active" checked>active</label>
                    @else
                        <label><input type="checkbox" name="is_active">active</label>
                    @endif
                </div>

                <!-- IMAGE UPLOADER --->
                <div class="form-group">
                <input type ="hidden" id="module_id" value="{{$moduleId}}">
                <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>upload material image</span>
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
                        @foreach ($matFiles as $matFile)
                            <li class="tmbli span4" >
                                <div class="tmbdiv thumbnail">
                                    <a class="close" href="#" onclick="removeImage(this,'{{serialize(array($matFile->id,0))}}');">×</a>
                                    <img src="{{'/images/'. $matFile->disk_name}}" alt=""  style="width:150px;height:150px;">
                                </div>
                                <input class="tmbval" type="hidden" name="img[]" value="{{serialize(array($matFile->id,$matFile->is_active))}}">
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
                <div class="form-group">
                    <a href="/back/material/create" class="btn btn-info" style="width:100%;"/>Add Another Material</button></a>
                </div>

            </form>




        </div>
    </div>
</div>



