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

    $.ajax({
      type: "POST",
      url: 'api/Teachers/getTeacherList.php',
      headers: {
          'Authorization': 'Bearer ' + getCookie("Token")
      },
      success: function(result){
        $('#cover-spin').hide();
        $("#ClassTeacher").html("<option value=''>Select Class Teacher</option>")
        if(result.Status=="OK"){
          $.each(result.TeacherList, function(i, item) {
            $("#ClassTeacher").append(`<option value="${item.TeacherID}">${item.TeacherName}</option>`);
          });
        }
        $("#ClassTeacherAdd").html("<option value=''>Select Class Teacher</option>")
        if(result.Status=="OK"){
          $.each(result.TeacherList, function(i, item) {
            $("#ClassTeacherAdd").append(`<option value="${item.TeacherID}">${item.TeacherName}</option>`);
          });
        }
        getClassRoomList()
      },
      error : function(err){
          $('#cover-spin').hide();
      }
      });


      function getClassRoomList(){
        $('#cover-spin').show(0);
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
            let showStudents = "";
            let showSubjects = "";

            const uniqueClassRoomIDs = new Set();

            // Filter the array to get objects with unique ClassRoomID
            const uniqueObjects = result.ClassRoomList.filter(obj => {
                const isUnique = !uniqueClassRoomIDs.has(obj.ClassRoomID);
                uniqueClassRoomIDs.add(obj.ClassRoomID);
                return isUnique;
            });
            // console.log(uniqueObjects)
            $("#classRoomSelect").html("<option value=''>Select Class Room</option>")
            $.each(uniqueObjects, function(i, item){
              $("#classRoomSelect").append(`<option value="${item.ClassRoomID}">${item.ClassRoomName}</option>`)
            })

            $.each(result.ClassRoomList, function(i, item) {
              if(item.SubjectCount == 0){
                showSubjects = `<a href='javascript:void(0)' title='View Subjects' class='text-muted h3'><i class="fa fa-book" aria-hidden="true"></i></a>`;
              }else{
                showSubjects = `<a href='Subjects?classID=${item.ClassRoomID}' title='View Subjects' class='text-success h3'><i class="fa fa-book" aria-hidden="true"></i></a>`;
              }
              if(item.StudentCount == 0){
                showStudents = `<a href='javascript:void(0)' title='No Student' class='text-muted h3'><i class='fa fa-user'></i></a>`;
              }else{
                showStudents = `<a href='ClassWiseStudent?SectionID=${item.SectionID}' title='View Students' class='text-danger h3'><i class='fa fa-user'></i></a>`;
              }
              $("#classRoomTableBody").append(
                `<tr>
                  <td>${i+1}</td>
                  <td>${item.ClassRoomName} ${item.SectionText}</td>
                  <td>${item.TeacherName==null ? '<span style="color:#999">NOT ASSIGNED</span>': item.TeacherName}</td>
                  <td class='text-center'>
                  <a href='javascript:void(0)' ClassRoomID="${item.ClassRoomID}" ClassRoomName="${item.ClassRoomName}" SectionID="${item.SectionID}" SectionText="${item.SectionText}" ClassTeacher="${item.ClassTeacher}" title='Edit ClassRoom' class='text-primary h3' id='editClassInfo'><i class='fa fa-pencil-square'></i></a> &nbsp;&nbsp;&nbsp;
                  ${showStudents}&nbsp;&nbsp;&nbsp;
                  ${showSubjects}
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
        
        function ResetEditModal(){
          $("#ClassTeacher option:selected").each(function () {
            $(this).removeAttr('selected'); 
            });
          $("#ClassRoomID").val("");
          $("#ClassRoomName").val("");
          $("#SectionID").val("");
          $("#SectionText").val("");
          $("#ClassTeacher").val($("#ClassTeacher option:first").val());
          // $(`#ClassTeacher option[0]`).attr("selected", "selected");
        }

        // Edit Class
        $(document).on("click","#editClassInfo",function(){
          ResetEditModal();
          $("#classEditModal").modal({
            show:true,
            backdrop: 'static'
          })
          $("#ClassRoomID").val($(this).attr("ClassRoomID"));
          $("#ClassRoomName").val($(this).attr("ClassRoomName"));
          $("#SectionID").val($(this).attr("SectionID"));
          $("#SectionText").val($(this).attr("SectionText"));
          $(`#ClassTeacher option[value="${$(this).attr("ClassTeacher")}"]`).attr("selected", "selected");
        })

        $("#editclassform").on("submit",function(e){
          e.preventDefault();
          let data = new FormData(this);
          $.ajax({
            type: "POST",
            data:data,
            contentType: false,       
            cache: false,             
            processData:false,
            url: 'api/ClassRooms/updateClassRoom',
            headers: {
                'Authorization': 'Bearer ' + getCookie("Token")
            },
            success: function(result){
              $('#cover-spin').hide();
              $("#classEditModal").modal('hide')
              // success,info,error,warning,trash
              Alert.success(`${result.Message}`,{displayDuration: 4000})
              getClassRoomList()
            },
            error : function(err){
                $('#cover-spin').hide();
            }
            });
        })
        


        // Edit Class
        $(document).on("click","#addSection",function(){
          ResetEditModal();
          $("#addSectionModal").modal({
            show:true,
            backdrop: 'static'
          })
        })
    
        $("#addSectionform").on("submit",function(e){
          e.preventDefault();
          let data = new FormData(this);
          $.ajax({
            type: "POST",
            data:data,
            contentType: false,       
            cache: false,             
            processData:false,
            url: 'api/ClassRooms/addSection',
            headers: {
                'Authorization': 'Bearer ' + getCookie("Token")
            },
            success: function(result){
              $('#cover-spin').hide();
              $("#addSectionModal").modal('hide')
              // success,info,error,warning,trash
              Alert.success(`${result.Message}`,{displayDuration: 4000})
              getClassRoomList()
            },
            error : function(err){
                $('#cover-spin').hide();
            }
            });
        })

  });