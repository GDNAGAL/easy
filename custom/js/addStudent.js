$( document ).ready(function() {
    getclasslist()
    function getCookie(cookieName) {
      let cookie = {};
      document.cookie.split(';').forEach(function(el) {
        let [key,value] = el.split('=');
        cookie[key.trim()] = value;
      })
      return cookie[cookieName]+"==";
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