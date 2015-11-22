$(document).ready(function(){
    $('#fileupload').fileupload({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        url: IMAGE_UPLOAD,
        dataType: 'json',
        formData: {module_id:4},
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

});