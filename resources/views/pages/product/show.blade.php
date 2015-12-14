@include('layout.header')

<link href="{{URL::asset('assets/css/app.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/vendor/Gallery-master/css/blueimp-gallery.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/vendor/Bootstrap-Image-Gallery-3.1.3/css/bootstrap-image-gallery.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/css/slide.css')}}" rel="stylesheet">

@include('layout.slide')
<div class="content">
    <div class="row">
        @if (count($prodFiles) > 0)
            <h4>Product Images</h4>
            <div id="blueimp-gallery" class="blueimp-gallery" data-use-bootstrap-modal="false">
                <!-- The container for the modal slides -->
                <div class="slides"></div>
                <!-- Controls for the borderless lightbox -->
                <h3 class="title"></h3>
                <a class="prev">‹</a>
                <a class="next">›</a>
                <a class="close">×</a>
                <a class="play-pause"></a>
                <ol class="indicator"></ol>
                <!-- The modal dialog, which will be used to wrap the lightbox content -->
                <div class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" aria-hidden="true">&times;</button>
                                <h4 class="modal-title"></h4>
                            </div>
                            <div class="modal-body next"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left prev">
                                    <i class="glyphicon glyphicon-chevron-left"></i>
                                    Previous
                                </button>
                                <button type="button" class="btn btn-primary next">
                                    Next
                                    <i class="glyphicon glyphicon-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="links">
                @foreach ($prodFiles as $pf)
                    <a href="{{'/images/'. $pf->disk_name}}"  data-gallery>
                        <img src="{{'/images/'. $pf->disk_name}}" width="100" height="100">
                    </a>
                @endforeach
            </div>
        @endif
        <br>
            <dl class="dl-horizontal">
                <dt>Product Name:</dt>
                <dd>{{$product->product_name}}</dd>
            </dl>
            <dl class="dl-horizontal">
                <dt>Product Description:</dt>
                <dd>{{$product->product_desc}}</dd>
            </dl>
            <dl class="dl-horizontal">
                <dt>Product Code:</dt>
                <dd>{{$product->product_code}}</dd>
            </dl>

        @if (count($curSubProducts) > 0)
                <button  type="button" class="btn btn-primary" aria-label="Left Align" id="showLeftPush">
                    <span>Customize Product</span>
                </button>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Materials</th>
                  @foreach($curSubProducts as $subProd)
                     <th><a href="/subproduct/{{$subProd->sub_product_name}}">{{$subProd->sub_product_name}}</a></th>
                  @endforeach
                </tr>
                </thead>
                <tbody>
                @foreach ($matPriceArray as $key => $val)

                    <tr>
                        <td><a href="/material/detail/{{$key}}">{{$key}}</a></td>
                        @foreach($val as $va)
                            @foreach($va as $v)
                                <td>{{$v}}</td>
                            @endforeach
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>

        @else

                <dl class="dl-horizontal">
                    <dt>Product Price:</dt>
                    <dd>{{$product->price}}</dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>Product Size:</dt>
                    <dd>{{$product->size}}</dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>Last Updated</dt>
                    <dd>{{$product->updated_at}}</dd>
                </dl>
                @if (count($curMaterials) > 0 )
                    <button  type="button" class="btn btn-primary" aria-label="Left Align" id="showLeftPush">
                        <span>Customize Product</span>
                    </button>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Material Name</th>
                                <th>Material Code</th>
                                <th>Material Price</th>
                                <th>Material Size</th>
                            </tr>
                        </thead>
                        @foreach ($curMaterials as $curmat)
                            <tr>
                                <td><a href="/material/detail/{{$curmat->material_name}}">{{$curmat->material_name}}</td>
                                <td>{{$curmat->material_code}}</td>
                                <td>{{$curmat->price}}</td>
                                <td>{{$curmat->size}}</td>
                            </tr>
                        @endforeach
                    </table>
                    <!--insert product custom here -->

                @endif
                <br>

        </div>
                <!-- end of product customization -->
        @endif

    </div><!--end of row -->
</div>
@include('layout.footer')
