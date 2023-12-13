$( document ).ready(function() {
    getclasslist()
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
  
    function getclasslist(){
        $.ajax({
                type: "POST",
                url: 'api/ClassRooms/getClassRoomList.php',
                headers: {
                    'Authorization': 'Bearer ' + getCookie("Token")
                },
                success: function(result){
                    $('#cover-spin').hide();
                    $("#selectclass").append(result);
                },
                error : function(err){
                    $('#cover-spin').hide();
                }
          });
    }
    
  });