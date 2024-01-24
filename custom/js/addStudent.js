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
                url: 'api/ClassRooms/getClassRoomList',
                headers: {
                    'Authorization': 'Bearer ' + getCookie("Token")
                },
                success: function(result){
                    $('#cover-spin').hide();
                    $.each(result.ClassRoomList, function(i, item) {
                        $("#selectclass").append(`<option value="${item.SectionID}">${item.ClassRoomName} ${item.SectionText}</option>`);
                        $("#selectclassup").append(`<option value="${item.SectionID}">${item.ClassRoomName} ${item.SectionText}</option>`);
                    })
                    
                },
                error : function(err){
                    $('#cover-spin').hide();
                }
          });
    }


    $("#addstudentform").on("submit",function(e){
        $('#cover-spin').show(0);
        e.preventDefault();
        let data = new FormData(this);
        $.ajax({
            type: "POST",
            data: data,
            url: 'api/Students/addStudent',
            headers: {
                'Authorization': 'Bearer ' + getCookie("Token")
            },
            contentType: false,       
            cache: false,             
            processData:false,
            success: function(result){
                $('#cover-spin').hide();
                // success,info,error,warning,trash
                Alert.success(`Success! ${result.Message}`,`${result.Message}`,{displayDuration: 4000})
                $('#addstudentform')[0].reset();
                $("#selectclass").val("").change();
                $("#genderSelectBox").val("").change();
                $("#categorySelectBox").val("").change();
            },
            error : function(err){
                $('#cover-spin').hide();
                // success,info,error,warning,trash
                Alert.error(`Error! UNKNOWN ERROR`,`UNKNOWN ERROR`,{displayDuration: 4000})
            }
      });
    })

    $("#uploadStudentForm").on("submit",function(e){
        $('#cover-spin').show(0);
        e.preventDefault();
        let data = new FormData(this);
        $.ajax({
            type: "POST",
            data: data,
            url: 'api/Students/addStudentsd',
            headers: {
                'Authorization': 'Bearer ' + getCookie("Token")
            },
            contentType: false,       
            cache: false,             
            processData:false,
            success: function(result){
                $('#cover-spin').hide();
                // success,info,error,warning,trash
                Alert.success(`Success! ${result.Message}`,`${result.Message}`,{displayDuration: 4000})
            },
            error : function(err){
                $('#cover-spin').hide();
                // success,info,error,warning,trash
                Alert.error(`Error! UNKNOWN ERROR`,`UNKNOWN ERROR`,{displayDuration: 4000})
            }
      });
    })
    
  });