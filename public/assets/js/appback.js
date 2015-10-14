/**
 * @user request goes here
 */
var createUser = function(){
    data = { username: $('#username').val(),
              password: $('#pwd').val(),
              password_confirmation: $('#cpwd').val(),
              email: $('#email').val(),
              contact: $('#contact').val(),
              firstname: $('#firstname').val(),
              lastname: $('#lastname').val(),
              isadmin: ($('#isadmin').is(':checked'))?"1":"0"
            };
    sendPostRequest("POST",USER_CREATE,data,"saveSuccess","saveFail");
    resetForm();
}
var updateUser = function(){
    data = {  id: $('#id').val(),
              username: $('#username').val(),
              email: $('#email').val(),
              contact: $('#contact').val(),
              firstname: $('#firstname').val(),
              lastname: $('#lastname').val(),
              isadmin: ($('#isadmin').is(':checked'))?"1":"0",
              isactive: ($('#isactive').is(':checked'))?"1":"0"
            };
    sendPostRequest("POST",USER_UPDATE,data,"saveSuccess","saveFail");
}
/**
 * 
 * @category requests goes here
 */
var createCategory = function(){
    data = { category_name: $('#category_name').val(),
             category_code: $('#category_code').val(),
             category_desc: $('#category_desc').val()
            };
    sendPostRequest("POST",CATEGORY_CREATE,data,"saveSuccess","saveFail");
    resetForm();
}
var updateCategory = function(){
    data = { 
             id: $('#id').val(),   
             category_name: $('#category_name').val(),
             category_code: $('#category_code').val(),
             category_desc: $('#category_desc').val(),
             isactive: ($('#isactive').is(':checked'))?"1":"0"
            };
    sendPostRequest("POST",CATEGORY_UPDATE,data,"saveSuccess","saveFail");
}
/**
 * 
 * @product requests goes here
 */
var createProduct = function(){
    data = { product_name: $('#product_name').val(),
             product_desc: $('#product_desc').val(),
             category: $('#category').val(),
             productcateg_code : $('#productcateg_code').html(),
             size1: $('#size1').val(),
             size2: $('#size2').val(),
             size3: $('#size3').val(),
             size4: $('#size4').val(),
             pre_stocks : $('#pre_stocks').val(),
             stocks : $('#stocks').val(),
             price : $('#price').val(),
             gross_price: $('#gross_price').val(),
             fileId: $('#fileId').html()
            };
    sendPostRequest("POST",PRODUCT_CREATE,data,"saveSuccess","saveFail");
    resetForm();
}
var updateProduct = function(){
    data = { 
             id: $('#id').val(),   
             product_name: $('#product_name').val(),
             product_desc: $('#product_desc').val(),
             category: $('#category').val(),
             productcateg_code : $('#productcateg_code').html(),
             size1: $('#size1').val(),
             size2: $('#size2').val(),
             size3: $('#size3').val(),
             size4: $('#size4').val(),
             pre_stocks : $('#pre_stocks').val(),
             stocks : $('#stocks').val(),
             price : $('#price').val(),
             gross_price: $('#gross_price').val(),
             fileId: $('#fileId').html(),
             isactive: ($('#isactive').is(':checked'))?"1":"0"
            };
    sendPostRequest("POST",PRODUCT_UPDATE,data,"saveSuccess","saveFail");
}
/**
 * 
 * @project requests goes here
 */
var createProject = function(){
    data = { project_name: $('#project_name').val(),
             project_desc: $('#project_desc').val(),
             ispublic: ($('#ispublic').is(':checked'))?"1":"0",
             fileId: $('#fileId').html()
            };
    sendPostRequest("POST",PROJECT_CREATE,data,"saveSuccess","saveFail");
    resetForm();
}
var updateProject = function(){
    data = { 
             id: $('#id').val(),   
             project_name: $('#project_name').val(),
             project_desc: $('#project_desc').val(),
             ispublic: ($('#ispublic').is(':checked'))?"1":"0",
             fileId: $('#fileId').html(),
             isactive: ($('#isactive').is(':checked'))?"1":"0"
            };
    sendPostRequest("POST",PROJECT_UPDATE,data,"saveSuccess","saveFail");
}
/**
 * 
 * @post requests goes here
 */
var createPost = function(){
    data = { title: $('#title').val(),
             content: $('#content').val(),
             post_type: $('#post_type').val(),
             ispublished: ($('#ispublished').is(':checked'))?"1":"0",
             fileId: $('#fileId').html()
            };
    sendPostRequest("POST",POST_CREATE,data,"saveSuccess","saveFail");
    resetForm();
}
var updatePost = function(){
    data = { 
             id: $('#id').val(),   
             title: $('#title').val(),
             content: $('#content').val(),
             post_type: $('#post_type').val(),
             ispublished: ($('#ispublished').is(':checked'))?"1":"0",
             fileId: $('#fileId').html(),
             isactive: ($('#isactive').is(':checked'))?"1":"0"
            };
    sendPostRequest("POST",POST_UPDATE,data,"saveSuccess","saveFail");
}






/**
 *  @callback goes here
 * */        
var saveSuccess = function(msg){
    var message = "";
    $.each(msg,function(key,value){
        message = message + value + "</br>";
    });
    $("#msgsuccess").html(message);
    $("#msgsuccess").css("display", "block").delay(2000)
                                            .queue(function (next) { 
                                                $(this).css('display', 'none').fadeOut(1000); 
                                                 next(); 
                                             });;
    $("#msgfail").css("display", "none");
}
var saveFail = function(msg){
    //$('#msgfail').html(msg.msg);
    var message = "";
    $.each(msg,function(key,value){
        message = message + value + "</br>";
    });
    $("#msgfail").html(message);
    $("#msgfail").css("display", "block");
    
}
var resetForm = function(){
    if ($('#username'))$('#username').val('');
    if ($('#pwd'))$('#pwd').val('');
    if ($('#cpwd'))$('#cpwd').val('');
    if ($('#email'))$('#email').val('');
    if ($('#contact'))$('#contact').val('');
    if ($('#firstname'))$('#firstname').val('');
    if ($('#lastname')) $('#lastname').val('');
    if ($('#isadmin'))$('#isadmin').prop('checked',false);
    
    if ($('#category_name')) $('#category_name').val('');
    if ($('#category_code')) $('#category_code').val('');
    if ($('#category_desc')) $('#category_desc').val('');
}

