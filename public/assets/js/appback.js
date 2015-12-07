$(document).ready(function(){

    /**
     * Makes the product code auto generated
     */
    $("#product_code").keypress(function(){
        var codeArr = $('#product_category option:selected').text().split('---');
        var code = codeArr[0];
        $('#productcateg_code_span').html(code + '-' + $('#product_code').val());
        $('#productcateg_code').val(code + '-' + $('#product_code').val());
    });

    /**
     * image uploader
     */
    $('#fileupload').fileupload({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        url: IMAGE_UPLOAD,
        dataType: 'json',
        formData: {'module_id': $('#module_id').val()},
        done: function (e, data) {
            $.each(data.files, function (index, file) {
                $('#files').html(file.name);
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
            console.log('moduleid' + data.moduleId);
            //1. create image icon with the file id as the name
            addImage(data.fileId,data.fileName,data.moduleId)
            $('#progress .progress-bar').css('width','0%');


        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');


    removeImage = function(obj,newArrVal){
        var imageHidden = $(obj).parents('.tmbli').find('.tmbval');
        imageHidden.val(newArrVal);
        //remove thumbnail
        $(obj).parents('.tmbdiv').remove();
    }

    addImage = function(fileId,fileName,moduleId){
        console.log(fileId);
        console.log(fileName);
        newValArr = [fileId,fileName];

        var divImagegallery = $('#image_gallery');
        var newLi = $('<li class="tmbli span4" >');
        var enableVal = 'a:3:{i:0;i:'+ fileId +';i:1;i:1;i:2;i:'+ moduleId +';}';
        var newLiHid = '<input class="tmbval" type="hidden" name="img[]" value="' + enableVal  + '">';
        var newDivTMB = $('<div class="tmbdiv thumbnail">');
        var disableVal =  '\'a:3:{i:0;i:'+ fileId +';i:1;i:0;i:2;i:'+ moduleId +';}\'';
        var newDivTMBClose =  '<a class="close" href="#" onclick="removeImage(this,' + disableVal +');">×</a>';
        var newDivTMBIMG = '<img src="/images/' + fileName + '" alt=""  style="width:150px;height:150px;">';

        //build components
        //1. attach a and img to div
        newDivTMB.append(newDivTMBClose);
        newDivTMB.append(newDivTMBIMG);
        //2. attach hidden and div to LI
        newLi.append(newLiHid);
        newLi.append(newDivTMB);
        //3. attach LI to image gallery
        divImagegallery.append(newLi);

    }

    /**
     * product materials setter
     */
    addProductMaterial = function(){
        //checks if value of items are more than one
            var foo = [];
            var prodId = $('#product_id').val();
            var matId = 0;
            //1. get the value of the selected in listbox and store it
            $('#all_materials :selected').each(function(i, selected){
                foo[i] = $(selected).text();
                matId = $(selected).val();
            });
            if (foo.length > 1 || foo.length == 0){
                alert('Please select only one from the list below');
                return 0;
            }
            //2.. send the value to the api
            waitingDialog.show('Saving Materials');setTimeout(function () {waitingDialog.hide();}, 500);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'POST',
                url: ADD_PRODUCT_MATERIAL,
                data: {product_id:prodId,material_id:matId},
                success:function(data){
                    refreshMaterials(data);
                }
            });
            //3. refresh from the callback
    }

    removeProductMaterial = function(){
        //checks if value of items are more than one
        var foo = [];
        var prodId = $('#product_id').val();
        var matId = 0;
        //1. get the value of the selected in listbox and store it
        $('#curr_materials :selected').each(function(i, selected){
            foo[i] = $(selected).text();
            matId = $(selected).val();
        });
        if (foo.length > 1 || foo.length == 0){
            alert('Please select only one from the list below');
            return 0;
        }
        //2.. send the value to the api
        waitingDialog.show('Saving Materials');setTimeout(function () {waitingDialog.hide();}, 500);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            url: REMOVE_PRODUCT_MATERIAL,
            data: {product_id:prodId,material_id:matId},
            success:function(data){
                refreshMaterials(data);
            }
        });
        //3. refresh from the callback
    }

    /**
     * Sub product materials setter
     */
    addSubProductMaterial = function(){
        //checks if value of items are more than one
        if ($('#mat_price').val()==''){
            alert('Please set a price first on this material for this sub-product,before adding it');
            return false;
        }
        var foo = [];
        var prodId = $('#product_id').val();
        var matId = 0;
        var matPrice = $('#mat_price').val();
        //1. get the value of the selected in listbox and store it
        $('#all_materials :selected').each(function(i, selected){
            foo[i] = $(selected).text();
            matId = $(selected).val();
        });
        if (foo.length > 1 || foo.length == 0){
            alert('Please select only one from the list below');
            return 0;
        }
        //2.. send the value to the api
        waitingDialog.show('Saving Materials');setTimeout(function () {waitingDialog.hide();}, 500);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            url: ADD_SUB_PRODUCT_MATERIAL,
            data: {sub_product_id:prodId,material_id:matId,price:matPrice},
            success:function(data){
                $('#mat_price').val('');
                refreshMaterials(data);
            }
        });
        //3. refresh from the callback
    }

    removeSubProductMaterial = function(){
        //checks if value of items are more than one
        var foo = [];
        var prodId = $('#product_id').val();
        var matId = 0;
        //1. get the value of the selected in listbox and store it
        $('#curr_materials :selected').each(function(i, selected){
            foo[i] = $(selected).text();
            matId = $(selected).val();
        });
        if (foo.length > 1 || foo.length == 0){
            alert('Please select only one from the list below');
            return 0;
        }
        //2.. send the value to the api
        waitingDialog.show('Saving Materials');setTimeout(function () {waitingDialog.hide();}, 500);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            url: REMOVE_SUB_PRODUCT_MATERIAL,
            data: {sub_product_id:prodId,material_id:matId},
            success:function(data){
                refreshMaterials(data);
            }
        });
        //3. refresh from the callback
    }

    refreshMaterials = function(response){
        ////clears listbox
        $('#curr_materials').empty();
        $('#all_materials').empty();
        data = $.parseJSON(response);

        $.each(data.curMaterials,function(key,mat){
            //sets current materials:
            console.log(mat);
            var newOption = new Option('value',mat.id );
            $(newOption).html(mat.material_name +' -- '+ mat.price);
            $('#curr_materials').append(newOption);
        });

        $.each(data.allMaterials,function(key,mat){
            //sets all  materials:
            console.log(mat);
            var newOption = new Option('value',mat.id);
            $(newOption).html(mat.material_name +' -- '+ mat.price);
            $('#all_materials').append(newOption);
        });
    }

    //search materials
    SearchMaterials = function(selection)
    {
        console.log(selection);
        var l = document.getElementById('all_materials');
        var tb = document.getElementById('search_all_materials');
        if (selection == 'curr'){
            l = document.getElementById('curr_materials');
            tb = document.getElementById('search_curr_materials');
        }
        if(tb.value == ""){
            ClearSelection(l);
        }
        else{

            for (var i=0; i < l.options.length; i++){
                if (l.options[i].text.toLowerCase().match(tb.value.toLowerCase()))
                {

                    l.options[i].selected = true;
                    return false;
                }
                else
                {
                    ClearSelection(l);
                }
            }
        }
    }

    ClearSelection = function(lb){
        lb.selectedIndex = -1;
    }


    /***
     * These section is being called upon add and remove sub products as well as search
     *
     */
    addSubProduct = function(){
        //checks if value of items are more than one
        var foo = [];
        var prodId = $('#product_id').val();
        var subProdId = 0;
        //1. get the value of the selected in listbox and store it
        $('#all_subproducts :selected').each(function(i, selected){
            foo[i] = $(selected).text();
            subProdId = $(selected).val();
        });
        if (foo.length > 1 || foo.length == 0){
            alert('Please select only one from the list below');
            return 0;
        }
        //2.. send the value to the api
        waitingDialog.show('Saving Sub Products');setTimeout(function () {waitingDialog.hide();}, 500);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            url: ADD_SUB_PRODUCT,
            data: {product_id:prodId,sub_product_id:subProdId},
            success:function(data){
                refreshSubProducts(data);
            }
        });
        //3. refresh from the callback
    }

    removeSubProduct = function(){
        //checks if value of items are more than one
        var foo = [];
        var prodId = $('#product_id').val();
        var subProdId = 0;
        //1. get the value of the selected in listbox and store it
        $('#curr_subproducts :selected').each(function(i, selected){
            foo[i] = $(selected).text();
            subProdId = $(selected).val();
        });
        if (foo.length > 1 || foo.length == 0){
            alert('Please select only one from the list below');
            return 0;
        }
        //2.. send the value to the api
        waitingDialog.show('Saving Sub Products');setTimeout(function () {waitingDialog.hide();}, 500);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            url: REMOVE_SUB_PRODUCT,
            data: {product_id:prodId,sub_product_id:subProdId},
            success:function(data){
                refreshSubProducts(data);
            }
        });
        //3. refresh from the callback
    }

    refreshSubProducts = function(response){
        ////clears listbox
        $('#curr_subproducts').empty();
        $('#all_subproducts').empty();
        data = $.parseJSON(response);

        $.each(data.curSubProducts,function(key,subprod){
            //sets current materials:
            console.log(subprod);
            var newOption = new Option('value',subprod.id );
            $(newOption).html(subprod.sub_product_name +' -- '+ subprod.price);
            $('#curr_subproducts').append(newOption);
        });

        $.each(data.allSubProducts,function(key,subprod){
            //sets all  materials:
            console.log(subprod);
            var newOption = new Option('value',subprod.id);
            $(newOption).html(subprod.sub_product_name +' -- '+ subprod.price);
            $('#all_subproducts').append(newOption);
        });
    }

    //search materials
    SearchMaterials = function(selection)
    {
        console.log(selection);
        var l = document.getElementById('all_subproducts');
        var tb = document.getElementById('search_all_subproducts');
        if (selection == 'curr'){
            l = document.getElementById('curr_subproducts');
            tb = document.getElementById('search_curr_subproducts');
        }
        if(tb.value == ""){
            ClearSelection(l);
        }
        else{

            for (var i=0; i < l.options.length; i++){
                if (l.options[i].text.toLowerCase().match(tb.value.toLowerCase()))
                {

                    l.options[i].selected = true;
                    return false;
                }
                else
                {
                    ClearSelection(l);
                }
            }
        }
    }
});