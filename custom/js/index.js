$( document ).ready(function() {
  getDashboardData();
  function getCookie(cookieName) {
    let cookie = {};
    document.cookie.split(';').forEach(function(el) {
      let [key,value] = el.split('=');
      cookie[key.trim()] = value;
    })
    return cookie[cookieName]+"==";
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
      url: "api/Dashboard/getDashboardData",              
      data: data, 
      contentType: false,       
      cache: false,             
      processData:false,
      headers: {
        'Authorization': 'Bearer ' + getCookie("Token")
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