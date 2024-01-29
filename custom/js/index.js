$( document ).ready(function() {
  var url = $("#url").val();
  getDashboardData();
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

  function getDashboardData(){
    if(getCookie("Token") == undefined){
      // localStorage.removeItem(userdata);
      window.location = "login";
      return false;
    }

    let data = new FormData();
    data.append("getDashboardData", "");
    $.ajax({
      type: "GET", 
      url: `${url}/Dashboard/getDashboardData`,              
      data: data, 
      contentType: false,       
      cache: false,             
      processData:false,
      headers: {
        'Authorization': 'Bearer ' + getCookie("Token")
      },
      xhrFields: {
        withCredentials: true
      },
      success: function(result){
        
        $("#totalStudent").html(result.DashboardData.totalstudent)
        $("#totalTeacher").html(result.DashboardData.totalteacher)
        $('#cover-spin').hide();

      },
      error: function(err){

      }
    });
  }
});