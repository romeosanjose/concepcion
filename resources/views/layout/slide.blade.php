<div class="container">
    <div class="main">
    <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left " id="cbp-spmenu-s1">
        <h3>Customize Product by Materials</h3>
        <label style="margin-top:10%">Select the materials and enter item's quantity. Press process to compute the total price</label>
        <span class="message">Please fill up the number of items</span>
        @if ($materialCategs)
            @foreach($materialCategs as $matCategs)
                <h5>{{$matCategs->material_categ_name}}</h5>
                <div class="row form-group product-chooser">
                <ul class="list-group">
                    <li class="list-group-item" style="background-color:#33CC99;padding-right:10%;">
                        <label style="margin-left:5%;">Product</label>
                        <label class="pull-right">Quantity</label>
                    </li>
                <?php $ctr = 0; ?>    
                @foreach ($allMaterials as $allMat)
                    @if ($matCategs->id == $allMat->material_categ_id)
                    <li class="list-group-item" style="background-color:#33CC99;padding-right:10%;"> 
                        <label style="width:60%;" class="items" onclick="enablePrice({{$ctr}});"><input class="material_chk" id="item{{$ctr}}" type="checkbox" value="{{{number_format((float)$allMat->price,2)}}}" style="margin-right:5%;">{{$allMat->material_name}} -- PHP  {{{number_format((float)$allMat->price,2)}}}</label>
                        <input id="price{{$ctr}}" class="price pull-right" type="number" min="0" max="9999" disabled />
                    @endif
                    </li>
                 <?php $ctr++; ?>   
                @endforeach
                </ul>
                </div>
            @endforeach
            <button type="button" class="btn btn-primary" onclick="process();" style="width:100%;height:50px;">process</button>
            <div class="result"></div>
        @endif
    </nav>
    </div>
</div>