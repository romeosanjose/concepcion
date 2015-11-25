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
        formData: {'module_id':0},
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
            //1. create image icon with the file id as the name
            addImage(data.fileId,data.fileName)
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

    addImage = function(fileId,fileName){
        console.log(fileId);
        console.log(fileName);
        newValArr = [fileId,fileName];

        var divImagegallery = $('#image_gallery');
        var newLi = $('<li class="tmbli span4" >');
        var enableVal = 'a:2:{i:0;i:'+ fileId +';i:1;i:1;}';
        var newLiHid = '<input class="tmbval" type="hidden" name="img[]" value="' + enableVal  + '">';
        var newDivTMB = $('<div class="tmbdiv thumbnail">');
        var disableVal =  '\'a:2:{i:0;i:'+ fileId +';i:1;i:0;}\'';
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
     * materials setter
     */
    addMaterial = function(){
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
                url: ADD_MATERIAL,
                data: {product_id:prodId,material_id:matId},
                success:function(data){
                    refreshMaterials(data);
                }
            });
            //3. refresh from the callback
    }

    removeMaterial = function(){
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
            url: REMOVE_MATERIAL,
            data: {product_id:prodId,material_id:matId},
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
            $(newOption).html(mat.material_name);
            $('#curr_materials').append(newOption);
        });

        $.each(data.allMaterials,function(key,mat){
            //sets all  materials:
            console.log(mat);
            var newOption = new Option('value',mat.id);
            $(newOption).html(mat.material_name);
            $('#all_materials').append(newOption);
        });
    }

});