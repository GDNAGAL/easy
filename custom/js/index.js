$( document ).ready(function() {

  function getCookie(cookieName) {
    let cookie = {};
    document.cookie.split(';').forEach(function(el) {
      let [key,value] = el.split('=');
      cookie[key.trim()] = value;
    })
    return cookie[cookieName];
  }

  //Call ajax for login
  if(getCookie("Token") == undefined){
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

    },
    error: function(err){

    }
  });

});