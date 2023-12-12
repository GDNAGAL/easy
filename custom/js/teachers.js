$( document ).ready(function() {
  $('#cover-spin').hide();
  function getCookie(cookieName) {
    let cookie = {};
    document.cookie.split(';').forEach(function(el) {
      let [key,value] = el.split('=');
      cookie[key.trim()] = value;
    })
    return cookie[cookieName]+"==";
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
        $('#cover-spin').hide();
        if(result.Status == "OK"){
          // success,info,error,warning,trash
          Alert.success(`Success! ${result.Message}`,`${result.Message}`,{displayDuration: 4000})
          $('#addTeacherForm')[0].reset();
        }else if(result.Status == "ERROR"){
          // success,info,error,warning,trash
          Alert.error(`Failed! ${result.Message}`,`${result.Message}`,{displayDuration: 4000})
          $('#addTeacherForm')[0].reset();
        }
      },
      error : function(err){
          if(err.status == 401){
            window.location = "logout";
          }
          $('#cover-spin').hide();
          // success,info,error,warning,trash
          Alert.error(`Error! UNKNOWN ERROR`,`UNKNOWN ERROR`,{displayDuration: 4000})
          $('#addTeacherForm')[0].reset();
      }
    });
  })
});