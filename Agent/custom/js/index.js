
$( document ).ready(function() {
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
    if(getCookie("AToken") == undefined){
      // localStorage.removeItem(userdata);
      window.location = "login";
      return false;
    }

    let data = new FormData();
    data.append("getDashboardData", "");
    $.ajax({
      type: "GET", 
      url: "api/Dashboard/getDashboardData",              
      data: data, 
      contentType: false,       
      cache: false,             
      processData:false,
      headers: {
        'Authorization': 'Bearer ' + getCookie("AToken")
      },
      success: function(result){
        
        $("#totalStudent").html(result.DashboardData.totalschools)
        $("#totalTeacher").html(result.DashboardData.totalagents)
        $('#cover-spin').hide();

      },
      error: function(err){
        if(err.status == 401){
          //window.location = "logout";
        }
        $('#cover-spin').hide();
      }
    });
  }
});