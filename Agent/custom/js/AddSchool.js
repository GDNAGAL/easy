$( document ).ready(function() {
   $('#cover-spin').hide();
  function getCookie(cookieName) {
    let cookie = {};
    document.cookie.split(';').forEach(function(el) {
        let indexOfEquals = el.indexOf('=');
        if (indexOfEquals !== -1) {
            let key = el.substring(0, indexOfEquals).trim();
            let value = el.substring(indexOfEquals + 1).trim();
            cookie[key] = value;
        }
    });
    return cookie[cookieName];
  }


  $("#addSchoolform").on("submit", function(e){
    e.preventDefault();
    $('#validationSpan').html("")
    $('#cover-spin').show(0);

    let data = new FormData(this);
    $.ajax({
      type: "POST",
      data: data, 
      contentType: false,       
      cache: false,             
      processData:false,
      url: 'api/Schools/addSchool',
      headers: {
          'Authorization': 'Bearer ' + getCookie("AToken")
      },
      success: function(result){
        $('#cover-spin').hide();
        if(result.Status == "OK"){
          // success,info,error,warning,trash
          Alert.success(`${result.Message}`,{displayDuration: 4000})
          $('#addSchoolform')[0].reset();
        }else if(result.Status == "ERROR"){
          // success,info,error,warning,trash
          Alert.error(`${result.Message}`,{displayDuration: 4000})
          $('#addSchoolform')[0].reset();
        }
      },
      error : function(err){
          if(err.status == 401){
            window.location = "logout";
          }
          $('#cover-spin').hide();
          // success,info,error,warning,trash
          Alert.error(`UNKNOWN ERROR`,{displayDuration: 4000})
          $('#addSchoolform')[0].reset();
      }
    });
  })
});