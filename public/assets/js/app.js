/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var loadHome = function(){
    alert(1);
    $.ajax({
      method: "GET",
      url: "http://localhost/laravel/thesis/Ecom/public/home",
      datatype: "html"
    })
    .done(function( msg ) {
        $('#body').html(msg);
    });
}
