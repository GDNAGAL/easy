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
            if(err.status == 401){
              window.location = "logout";
            }
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
                  <td class='text-center'>${item.ClassRoomID}</td>
                  <td>${item.ClassRoomName}</td>
                  <td>${item.TeacherName==null ? '<span style="color:#999">NOT ASSIGNED</span>': item.TeacherName}</td>
                  <td class='text-center'><a href='javascript:void(0)' class='text-primary' id='editClassInfo'><i class='fa fa-pencil'></i></a></td></tr>`
                  );
                });
              }else if(result.Status=="NOT_FOUND"){
                $("#classRoomTableBody").append(
                  `<tr>
                    <td colspan='4' style='color:#999'>
                      ${result.Message}
                    </td>
                  </tr>`
                  );
              }
            },
            error : function(err){
              $('#cover-spin').hide();
            }
          });
        }
          
        

    
  });