$( document ).ready(function() {
    var url = $("#url").val();
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
  
    $("#uploadStudentForm").on("submit",function(e){
        $("#rollalert").html(``);
        e.preventDefault();
        $('#cover-spin').show(0);
        let data = new FormData(this);
        $.ajax({
            type: "POST",
            data: data,
            url: url+'/Students/uploadStudent',
            headers: {
                'Authorization': 'Bearer ' + getCookie("Token")
            },
            contentType: false,       
            cache: false,             
            processData:false,
            async:true,
            success: function(result){
                $('#cover-spin').hide();
                $('#uploadStudentForm')[0].reset();
                $("#selectclassup").val($("#selectclassup option:first").val());
                // success,info,error,warning,trash
                Alert.success(`${result.Message}`,{displayDuration: 4000})
            },
            error : function(err){
                $('#cover-spin').hide();
                $('#uploadStudentForm')[0].reset();
                $("#selectclassup").val($("#selectclassup option:first").val());
                // success,info,error,warning,trash
                Alert.error(`${err.responseJSON.Message}`,{displayDuration: 4000})
                if(err.responseJSON.RollAlreadyExist){
                    $("#rollalert").append(`<h5 class="text-danger">Remove The Following Students from Sheet.</h5>`);
                    $.each(err.responseJSON.RollAlreadyExist, function(i, item) {
                        $("#rollalert").append(`<h5 class="text-danger">Roll No : ${item}</h5>`);
                    })
                }
            }
      });
    })

    function getclasslist(){
        $.ajax({
                type: "POST",
                url: url+'/ClassRooms/getClassRoomList',
                headers: {
                    'Authorization': 'Bearer ' + getCookie("Token")
                },
                xhrFields: {
                    withCredentials: true
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
            url: url+'/Students/addStudent',
            headers: {
                'Authorization': 'Bearer ' + getCookie("Token")
            },
            contentType: false,       
            cache: false,             
            processData:false,
            success: function(result){
                $('#cover-spin').hide();
                // success,info,error,warning,trash
                Alert.success(`${result.Message}`,{displayDuration: 4000})
                $('#addstudentform')[0].reset();
                $("#selectclass").val("").change();
                $("#genderSelectBox").val("").change();
                $("#categorySelectBox").val("").change();
            },
            error : function(err){
                $('#cover-spin').hide();
                // success,info,error,warning,trash
                Alert.error(`UNKNOWN ERROR`,{displayDuration: 4000})
            }
      });
    })

    
  });