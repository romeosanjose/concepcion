$(document).ready(function(){
    //NAVBAR
    $(document).scroll(function () {
        
        // var rotation = 90;
         var picture = $('#logo-img');
         var text = $('#logo-text');
         var height = $('.navbar').offset().top;  //0;//document.getElementById('top-navigation').offsetTop;
         
         var rotation = 360;
         var pos = $(document).scrollTop();    
         var opacity = 1;
         var x = 82; 
        if (pos > 100)
        {
            rotation = 360;
            x = 0;
            opacity = 0;
        }
        else
        {
            rotation = 0;
            x = 82;
            opacity = 1;
        }
        text.css({'opacity': opacity, 'transform':'translate('+ x +'px,0px)'});
        picture.css({'transform':'translate(0px,-14px) rotate('+ rotation + 'deg)'});
        
    });
});

var process = function(){
    var totalPrice = 0;
    $('.items').each(function(index){
            if ($(this).find('.material_chk').is( ':checked')){
                var price = $(this).find('.material_chk').val();
                var items = $(this).nextAll('input').first().val();
                var total = price * items;
                totalPrice = totalPrice + total;
            }
    });
    console.log(totalPrice);
    var label = '<h5>Total Price ------------------------- PHP  ' + totalPrice + '</h5>';
    $('.result').html($(label));
}


var enablePrice = function(id){
   console.log(id);
   if($('#item' + id).is(':checked')){
      $('#price' + id).prop('disabled', false);
   }else{
      $('#price' + id).prop('disabled', true);
   }
}

$(window).scroll(function() {
  if ($(document).scrollTop() > 50) {
    $('.navbar-inverse').addClass('navbar-scroll');
  } else {
    $('.navbar-inverse').removeClass('navbar-scroll');
  }
});


