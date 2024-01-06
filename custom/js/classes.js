$( document ).ready(function() {
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
                  <td>${item.ClassRoomName}</td>
                  <td>${item.TeacherName==null ? '<span style="color:#999">NOT ASSIGNED</span>': item.TeacherName}</td>
                  <td class='text-center'>${item.ExamGroupDisplayText==null ? '<span style="color:#999">NOT ASSIGNED</span>': item.ExamGroupDisplayText}</td>
                  <td class='text-center'>${item.SubjectCount==0 ? '<span class="badge label-danger">0</span>' : '<span class="badge label-success">'+ item.SubjectCount +'</span>' }</td>
                  <td class='text-center'>
                  <a href='javascript:void(0)' title='Edit ClassRoom' class='text-primary h3' id='editClassInfo'><i class='fa fa-pencil-square'></i></a> &nbsp;&nbsp;&nbsp;
                  <a href='Subjects?classID=${item.ClassRoomID}' title='View Subjects' class='text-success h3' id='editClassInfo'><i class="fa fa-book" aria-hidden="true"></i></a> &nbsp;&nbsp;&nbsp;
                  <a href='DesignExam?ClassID=${item.ClassRoomID}' title='Design Exam' class='text-info h3' id='editClassInfo'><i class='fa fa-cogs'></i></a> &nbsp;&nbsp;&nbsp;
                  ${item.SubjectCount==0 ? "<a href='javascript:void(0)' title='Delete ClassRoom' class='h3 text-red' cid='"+item.ClassRoomID+"' id='deleteClassBtn'><i class='fa fa-trash'></i></a>" : "<a href='javascript:void(0)' title='You Can not delete this classroom' class='h3 text-muted'><i class='fa fa-trash'></i></a>"}
                  
                  </td></tr>`
                  );
                });
              }else if(result.Status=="NOT_FOUND"){
                $("#classRoomTableBody").append(
                  `<tr>
                    <td colspan='5' style='color:#999'>
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
        

        // Delete Class
        $(document).on("click","#deleteClassBtn",function(){
          // console.log($(this).attr("cid"))
          let cnf = confirm("Are You Sure to Delete Class ?");
          if(cnf){
            let data = new FormData();
            data.append("ClassRoomID", $(this).attr("cid"))
            $.ajax({
              type: "POST",
              data: data, 
              contentType: false,       
              cache: false,             
              processData:false,
              url: 'api/ClassRooms/deleteClassRoom',
              headers: {
                  'Authorization': 'Bearer ' + getCookie("Token")
              },
              success: function(result){
                if(result.Status=="OK"){
                  // success,info,error,warning,trash
                  Alert.trash(`Success! ${result.Message}`,`${result.Message}`,{displayDuration: 4000})
                }
                getClassRoomList()
              },
              error : function(err){
                  $('#cover-spin').hide();
                  // success,info,error,warning,trash
                  // Alert.error(`Failed! ${err.Message}`,`${err.Message}`,{displayDuration: 4000})
              }
              });
          }

        })
        

    
  });