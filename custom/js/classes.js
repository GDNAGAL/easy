$( document ).ready(function() {
    function getCookie(cookieName) {
      let cookie = {};
      document.cookie.split(';').forEach(function(el) {
        let [key,value] = el.split('=');
        cookie[key.trim()] = value;
      })
      return cookie[cookieName]+"==";
    }

    $("#addClassRoomForm").on("submit", function(e){
      e.preventDefault();
      $('#validationSpan').html("")
      $('#cover-spin').show(0);
      let clsName = $("#classRoomNameInput").val();
      let clsTName = $("#ClassTeacherSelectBox").val();
      if(clsName.trim()==""){
        $('#cover-spin').hide();
        $('#validationSpan').html("Please Enter Class Room Name")
        return;
      }

      
      let data = new FormData();
      data.append("classRoomName",clsName)
      data.append("classTeacherName",clsTName)
      $.ajax({
        type: "POST",
        data: data, 
        contentType: false,       
        cache: false,             
        processData:false,
        url: 'api/ClassRooms/addClassRoom.php',
        headers: {
            'Authorization': 'Bearer ' + getCookie("Token")
        },
        success: function(result){
          console.log(result)
          if(result.Status == "OK"){
            getClassRoomList()
            // success,info,error,warning,trash
            Alert.success(`Success! ${result.Message}`,`${result.Message}`,{displayDuration: 4000})
            $('#addClassRoomForm')[0].reset();
            $("#ClassTeacherSelectBox").val("").change();;
          }else if(result.Status == "ERROR"){
            // success,info,error,warning,trash
            Alert.error(`Failed! ${result.Message}`,`${result.Message}`,{displayDuration: 4000})
            $('#addClassRoomForm')[0].reset();
            $("#ClassTeacherSelectBox").val("").change();;
          }
        },
        error : function(err){
            $('#cover-spin').hide();
            // success,info,error,warning,trash
            Alert.error(`Error! UNKNOWN ERROR`,`UNKNOWN ERROR`,{displayDuration: 4000})
            $('#addClassRoomForm')[0].reset();
            $("#ClassTeacherSelectBox").select2("val", "");
        }
        });

    })

    $.ajax({
      type: "POST",
      url: 'api/Teachers/getTeacherList.php',
      headers: {
          'Authorization': 'Bearer ' + getCookie("Token")
      },
      success: function(result){
        $('#cover-spin').hide();
        if(result.Status=="OK"){
          $.each(result.TeacherList, function(i, item) {
            $("#ClassTeacherSelectBox").append(`<option value="${item.TeacherID}">${item.TeacherName}</option>`);
          });
        }
        getClassRoomList()
      },
      error : function(err){
          $('#cover-spin').hide();
      }
      });


      function getClassRoomList(){
        $("#classRoomTableBody").html("")
        $.ajax({
          type: "POST",
        url: 'api/ClassRooms/getClassRoomList',
        headers: {
            'Authorization': 'Bearer ' + getCookie("Token")
          },
        success: function(result){
          $('#cover-spin').hide();
          if(result.Status=="OK"){
            $.each(result.ClassRoomList, function(i, item) {
              $("#classRoomTableBody").append(
                `<tr>
                  <td>${i+1}</td>
                  <td>${item.ClassRoomName}</td>
                  <td>${item.TeacherName}</td>
                  <td class='text-center'>
                  <a href='#' id='editclass'><i class='fa fa-pencil'></i></a>
                  </td>
                  </tr>`
                  );
                });
              }
            },
            error : function(err){
              $('#cover-spin').hide();
            }
          });
        }
          
        

    
  });