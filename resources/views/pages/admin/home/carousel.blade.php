@include('layout.adminheader')
<div class="container">
    <div class="row">

        <h2>UPLOAD NEWS BACKGROUND</h2>
        <div class="news col-md-12">
            <!-- IMAGE UPLOADER --->
            <div class="form-group">
                <input type ="hidden" id="module_id">
                            <span class="btn btn-success fileinput-button">
                                <i class="glyphicon glyphicon-plus"></i>
                                <span>upload image</span>
                                <!-- The file input field used as target for the file upload widget -->
                                <input id="news_upload" type="file" name="files[]">
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
                    <li class="tmbli span4" >
                        <div class="tmbdiv thumbnail">
                            <img src="{{'/assets/images/news.jpg'}}" alt=""  style="width:150px;height:150px;">
                        </div>
                    </li>

                </ul>
            </div>

        </div> <!--end of news -->


        <h2>UPLOAD PROJECT BACKGROUND</h2>
        <div class="news col-md-12">
            <!-- IMAGE UPLOADER --->
            <div class="form-group">
                <input type ="hidden" id="module_id">
                            <span class="btn btn-success fileinput-button">
                                <i class="glyphicon glyphicon-plus"></i>
                                <span>upload image</span>
                                <!-- The file input field used as target for the file upload widget -->
                                <input id="project_upload" type="file" name="files[]">
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
                    <li class="tmbli span4" >
                        <div class="tmbdiv thumbnail">
                            <img src="{{'/assets/images/project.jpg'}}" alt=""  style="width:150px;height:150px;">
                        </div>
                    </li>

                </ul>
            </div>

        </div> <!--end of news -->


        <h2>UPLOAD PRODUCT BACKGROUND</h2>
        <div class="news col-md-12">
            <!-- IMAGE UPLOADER --->
            <div class="form-group">
                <input type ="hidden" id="module_id">
                            <span class="btn btn-success fileinput-button">
                                <i class="glyphicon glyphicon-plus"></i>
                                <span>upload image</span>
                                <!-- The file input field used as target for the file upload widget -->
                                <input id="product_upload" type="file" name="files[]">
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
                    <li class="tmbli span4" >
                        <div class="tmbdiv thumbnail">
                            <img src="{{'/assets/images/product.jpg'}}" alt=""  style="width:150px;height:150px;">
                        </div>
                    </li>

                </ul>
            </div>

        </div> <!--end of news -->
    </div>
</div>