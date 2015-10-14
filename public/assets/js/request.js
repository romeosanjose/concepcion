var sendPostRequest = function(method,url,data,successCallBack,failCallBack){
    $.ajax({
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },  
      method: method,
      url: url,
      data: data,
      success:function(data){
           eval(successCallBack + "("+ data + ")");
      },
      error:function(xhr){
           eval(failCallBack + "("+ xhr.responseText + ")");
      }
    });
    
}

var sendGetRequest = function(method,url,callback){
    $.ajax({
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },  
      method: method,
      url: url,
    })
    .done(function( msg ) {
        exefunc = callback + "(" + msg + ")";
        eval(exefunc);
    });
}

