<div class="container">
    <div class="main">
    <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left " id="cbp-spmenu-s1">
        <h3>Customize Product by Materials</h3>
        <span class="message">Please fill up the number of items</span>
        @if ($materialCategs)
            @foreach($materialCategs as $matCategs)
                <h5>{{$matCategs->material_categ_name}}</h5>
                <div class="row form-group product-chooser">
                @foreach ($allMaterials as $allMat)
                    @if ($matCategs->id == $allMat->material_categ_id)
                        <div class="checkbox">
                            <label><input class="material_chk" type="checkbox" value="{{$allMat->price}}">{{$allMat->material_name}} -- PHP  {{$allMat->price}}</label>
                        </div>
                            <span >X</span>
                            <input class="price" type="text" />
                    @endif
                @endforeach
                </div>
            @endforeach
            <button type="button" class="btn btn-primary" onclick="process();" style="width:100%;height:50px;">process</button>
            <div class="result"></div>
        @endif
    </nav>
    </div>
</div>