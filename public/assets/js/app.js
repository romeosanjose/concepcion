/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var process = function(){
    var totalPrice = 0;
    $('.checkbox').each(function(index){
            if ($(this).find('.material_chk').is( ':checked')){
                var price = $(this).find('.material_chk').val();
                var items = $(this).nextAll('input').first().val();
                //if (items == ''){
                //    console.log(1);
                //    setTimeout(function(){ $('.message').fadeOut('slow'); }, 5000);
                //    return false;
                //}
                var total = price * items;
                totalPrice = totalPrice + total;
            }
    });
    console.log(totalPrice);
    var label = '<h5>Total Price ------------------------- PHP  ' + totalPrice + '</h5>';
    $('.result').html($(label));
}
