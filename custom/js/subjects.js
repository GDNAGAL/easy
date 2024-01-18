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
  const urlParams = new URLSearchParams(window.location.search);
  const classID = urlParams.get('classID');

    $("#addSubjectForm").on("submit", function(e){
      e.preventDefault();
      $('#validationSpan').html("")
      $('#cover-spin').show(0);
      let subjectName = $("#subjectNameInput").val();
      let teacherName = $("#subjectTeacherSelectBox").val();
      let subjectType = $("#subjectTypeSelectBox").val();
      if(subjectName.trim()==""){
        $('#cover-spin').hide();
        $('#validationSpan').html("Please Enter Subject Name")
        $("#subjectNameInput").focus()
        return;
      }
      if(subjectType.trim()==""){
        $('#cover-spin').hide();
        $('#validationSpan').html("Please Select Subject Type")
        $("#subjectTypeSelectBox").focus()
        return;
      }

      
      let data = new FormData();
      data.append("subjectName",subjectName)
      data.append("subjectTeacherName",teacherName)
      data.append("subjectType",subjectType)
      data.append("classID",classID)
      $.ajax({
        type: "POST",
        data: data, 
        contentType: false,       
        cache: false,             
        processData:false,
        url: 'api/Subjects/addSubject.php',
        headers: {
            'Authorization': 'Bearer ' + getCookie("Token")
        },
        success: function(result){
          if(result.Status == "OK"){
            getSubjectList()
            // success,info,error,warning,trash
            Alert.success(`Success! ${result.Message}`,`${result.Message}`,{displayDuration: 4000})
            $('#addSubjectForm')[0].reset();
            $("#subjectTeacherSelectBox").val("").change();
            $("#subjectTypeSelectBox").val("").change();
          }else if(result.Status == "ERROR"){
            // success,info,error,warning,trash
            Alert.error(`Failed! ${result.Message}`,`${result.Message}`,{displayDuration: 4000})
            $('#addSubjectForm')[0].reset();
            $("#subjectTeacherSelectBox").val("").change();
            $("#subjectTypeSelectBox").val("").change();
          }
        },
        error : function(err){
            if(err.status == 401){
              window.location = "logout";
            }
            $('#cover-spin').hide();
            // success,info,error,warning,trash
            Alert.error(`Error! UNKNOWN ERROR`,`UNKNOWN ERROR`,{displayDuration: 4000})
            $('#addSubjectForm')[0].reset();
            $("#subjectTeacherSelectBox").select2("val", "");
        }
        });

    })


    //get Subject Types
    let data = new FormData();
    data.append("classID",classID);
    $.ajax({
      type: "POST",
      data: data, 
      contentType: false,       
      cache: false,             
      processData:false,
      url: 'api/Subjects/getSubjectTypes',
      headers: {
          'Authorization': 'Bearer ' + getCookie("Token")
      },
      success: function(result){
        // $('#cover-spin').hide();
        if(result.ClassDetail == null){
          window.location = "classes";
        }else{
          $('#classLabel').html(result.ClassDetail.ClassRoomName);
        }
        if(result.Status=="OK"){
          $.each(result.SubjectTypes, function(i, item) {
            $("#subjectTypeSelectBox").append(`<option value="${item.SubjectTypeID}">${item.SubjectType}</option>`);
          });
        }
      },
      error : function(err){
          $('#cover-spin').hide();
      }
      });

    // get Subject Teacher List
    $.ajax({
      type: "POST",
      url: 'api/Teachers/getTeacherList.php',
      headers: {
          'Authorization': 'Bearer ' + getCookie("Token")
      },
      success: function(result){
        // $('#cover-spin').hide();
        if(result.Status=="OK"){
          $.each(result.TeacherList, function(i, item) {
            $("#subjectTeacherSelectBox").append(`<option value="${item.TeacherID}">${item.TeacherName}</option>`);
          });
        }
        getSubjectList()
      },
      error : function(err){
          $('#cover-spin').hide();
      }
      });


      function getSubjectList(){
        $("#subjectListTableBody").html("")
        if(classID=="" || classID==null){
          window.location = "classes";
        }
        let data = new FormData();
        data.append("classID",classID);
        $.ajax({
          type: "POST",
          data: data, 
          contentType: false,       
          cache: false,             
          processData:false,
          url: 'api/Subjects/getSubjectList',
          headers: {
            'Authorization': 'Bearer ' + getCookie("Token")
          },
        success: function(result){
          $('#cover-spin').hide();
          if(result.Status=="OK"){
            $.each(result.SubjectList, function(i, item) {
              $("#subjectListTableBody").append(
                `<tr>
                  <td>${i+1}</td>
                  <td>${item.SubjectName}</td>
                  <td class="text-center">${item.TeacherName==null ? '<span style="color:#999">NOT ASSIGNED</span>': item.TeacherName}</td>
                  <td class="text-center">${item.SubjectType== "MANDATORY" ? `<span class="label label-success">${item.SubjectType}</span>` : `<span class="label label-warning">${item.SubjectType}</span>`}</td>
                  <td class='text-center'>
                  <a href='javascript:void(0)' title='Edit ClassRoom' class='text-primary h3' id='editClassInfo'><i class='fa fa-pencil-square'></i></a> &nbsp;&nbsp;&nbsp;
                  </td></tr>`
                  );
                });
              }else if(result.Status=="NOT_FOUND"){
                $("#subjectListTableBody").append(
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
          
        

    
  });