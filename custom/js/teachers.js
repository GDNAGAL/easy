$( document ).ready(function() {
  getTeacherList()
  // $('#cover-spin').hide();
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

  $("#addTeacherForm").on("submit", function(e){
    e.preventDefault();
    $('#validationSpan').html("")
    $('#cover-spin').show(0);

    let teacherName = $("#teacherNameInput").val();
    let teacherDesignation = $("#teacherDesignationInput").val();
    let teacherMobile = $("#teacherMobileInput").val();

    //validate all field
    if(teacherName.trim()==""){
      $('#cover-spin').hide();
      $('#validationSpan').html("Please Enter Teacher Name")
      $("#teacherNameInput").focus()
      return;
    }
    if(teacherDesignation.trim()==""){
      $('#cover-spin').hide();
      $('#validationSpan').html("Please Enter Teacher Designation")
      $("#teacherDesignationInput").focus()
      return;
    }
    if(teacherMobile.trim()==""){
      $('#cover-spin').hide();
      $('#validationSpan').html("Please Enter Teacher Mobile No.")
      $("#teacherMobileInput").focus()
      return;
    }

    
    let data = new FormData();
    data.append("teacherName",teacherName)
    data.append("teacherDesignation",teacherDesignation)
    data.append("teacherMobile",teacherMobile)
    $.ajax({
      type: "POST",
      data: data, 
      contentType: false,       
      cache: false,             
      processData:false,
      url: 'api/Teachers/addTeacher.php',
      headers: {
          'Authorization': 'Bearer ' + getCookie("Token")
      },
      success: function(result){
        // $('#cover-spin').hide();
        getTeacherList()
        if(result.Status == "OK"){
          // success,info,error,warning,trash
          Alert.success(`${result.Message}`,{displayDuration: 4000})
          $('#addTeacherForm')[0].reset();
        }else if(result.Status == "ERROR"){
          // success,info,error,warning,trash
          Alert.error(`${result.Message}`,{displayDuration: 4000})
          $('#addTeacherForm')[0].reset();
        }
      },
      error : function(err){
          if(err.status == 401){
            window.location = "logout";
          }
          $('#cover-spin').hide();
          // success,info,error,warning,trash
          Alert.error(`UNKNOWN ERROR`,{displayDuration: 4000})
          $('#addTeacherForm')[0].reset();
      }
    });
  })



  function getTeacherList(){
    $("#teacherListTableBody").html("")
    $.ajax({
      type: "POST",
    url: 'api/Teachers/getTeacherList',
    headers: {
        'Authorization': 'Bearer ' + getCookie("Token")
      },
    success: function(result){
      $('#cover-spin').hide();
      if(result.Status=="OK"){
        $.each(result.TeacherList, function(i, item) {
          $("#teacherListTableBody").append(
            `<tr>
              <td>${i+1}</td>
              <td>${item.TeacherName}</td>
              <td>${item.Designation}</td>
              <td>${item.TeacherMobile}</td>
              <td class='text-center'><a href='javascript:void(0)' title='Edit Teacher Info' class='text-primary h3' id='editClassInfo'><i class='fa fa-pencil-square'></i></a></td></tr>`
              );
            });
          }else if(result.Status=="NOT_FOUND"){
            $("#teacherListTableBody").append(
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