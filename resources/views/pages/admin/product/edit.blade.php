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
            <h2>Edit Product</h2>
            <form action="/back/product/update/{{$product->id}}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="product_name">Enter Product Name: *</label>
                    <input type="text" class="form-control" name="product_name" value="{{$product->product_name}}">
                </div>
                <div class="form-group">
                    <label for="product_desc">Enter Product Description: *</label>
                    <textarea  class="form-control" name="product_desc">{{$product->product_desc}}</textarea>
                </div>
                <div class="form-group">
                    <label for="product_category">Select Product Category: *</label>
                    <select class="form-control" name="product_category">
                        <option selected value="{{$product->categ_id}}">{{$productCategId->category_name}}</option>
                        @foreach($productCategories as $productCategory)
                            <option value="{{$productCategory->id}}">{{$productCategory->category_name}}</option>
                        @endforeach
                    </select>
                </div>
                <!-- PUT MATERIALS HERE -->
                <div class="form-group">
                    <label >Select Product Materials: *</label>
                    <input type="hidden" id="product_id" value="{{$product->id}}">
                    <div class="container-fluid" >
                        <div class="col-sm-5">
                            <label>All Product Materials</label>
                            <select multiple id="all_materials" class="form-control" style="width:100%;height:400px;">
                                @foreach($allMaterials as $allMaterial)
                                    <option value="{{$allMaterial->id}}">{{$allMaterial->material_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-2" style="height:400px;padding-top:10%;">
                            <button  class="btn btn-success glyphicon glyphicon-chevron-left" style="width:100%;margin-bottom:20px;" onclick="event.preventDefault();removeMaterial();"></button>
                            <button  class="btn btn-success glyphicon glyphicon-chevron-right" style="width:100%;" onclick="event.preventDefault();addMaterial();"></button>
                        </div>
                        <div class="col-sm-5">
                            <label>Current Product Materials </label>
                            <select multiple id="curr_materials" class="form-control" style="width:100%;height:400px;">
                                @foreach($curMaterials as $curMaterial)
                                    <option value="{{$curMaterial['id']}}">{{$curMaterial['material_name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="price">Enter Price: </label>
                    <input type="text" class="form-control" name="price" value="{{$product->price}}">
                </div>
                <div class="form-group">
                    <label for="size">Enter Size: </label>
                    <input type="text" class="form-control" name="size" value="{{$product->size}}">
                </div>
                <div class="form-group">
                    <label >Set Product State: </label>
                    <div class="checkbox">
                        @if ($product->is_active)
                            <label><input  type="checkbox" name="is_active" checked>active</label>
                        @else
                            <label><input type="checkbox" name="is_active">active</label>
                        @endif
                    </div>
                </div>

                <!-- IMAGE UPLOADER --->
                <div class="form-group">
                    <label >Product Images: </label><br>
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
                        @foreach ($prodFiles as $prodFile)
                            <li class="tmbli span4" >
                                <div class="tmbdiv thumbnail">
                                    <a class="close" href="#" onclick="removeImage(this,'{{serialize(array($prodFile->id,0))}}');">×</a>
                                    <img src="{{'/images/'. $prodFile->disk_name}}" alt=""  style="width:150px;height:150px;">
                                </div>
                                <input class="tmbval" type="hidden" name="img[]" value="{{serialize(array($prodFile->id,$prodFile->is_active))}}">
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="form-group">
                    <button  class="btn btn-success" type="submit" style="width:100%;">Update</button>
                </div>
                <div class="form-group">
                    <a href="/back/product" class="btn btn-info" style="width:100%;"/>Cancel</button></a>
                </div>
            </form>




        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        var materials = $('#materials').bootstrapDualListbox({
            nonSelectedListLabel: 'Non-selected',
            selectedListLabel: 'Selected',
            preserveSelectionOnMove: 'moved',
            moveOnSelect: false

        });

    });

</script>



