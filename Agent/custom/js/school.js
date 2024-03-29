$( document ).ready(function() {
  var url = $("#url").val();
  getSchoolList()
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
  //$('#schooltable').DataTable();

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
      url: url +  '/Agent/Teachers/addTeacher',
      headers: {
          'Authorization': 'Bearer ' + getCookie("AToken")
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



  function getSchoolList(){
    $("#teacherListTableBody").html("")
    $.ajax({
      type: "POST",
      url: url +  '/Agent/Schools/getSchoolList',
      headers: {
          'Authorization': 'Bearer ' + getCookie("AToken")
        },
      success: function(result){
            $('#cover-spin').hide();
            $('#schooltable').DataTable({
              data: result.SchoolList,  // Get the data object
              // retrieve: true,
              // destroy: true,
              filter:true,
              lengthMenu : [
                  [10,20,50,75,100,-1],
                  [10,20,50,75,100,"ALL"]

              ],
              pageLength : 10,
              language : {
                  lengthMenu: "_MENU_ Records Per Page.",
                  info: "", 
                  //infoEmpty: "No School Found.",
                  zeroRecords: "No School Found."
              },
              columns: [
              { 'data': 'SchoolName',
                  "render": function ( data, type, row, meta ) {
                    var schoolID = row.SchoolID; 
                  return '<a href="SchoolDashboard?schoolID=' + schoolID + '">'+data+'</a>';
                  } 
              },
              { 'data': 'SchoolHeadName' },
              { 'data': 'SchoolHeadMobile' },
              { 'data': 'SchoolAddress' },
              {
                // Add a button in the last column
                "render": function ( data, type, row, meta ) {
                    // var schoolID = row.StatusText;
                    return `<div class="text-center"><span class="label label-${row.StatusColor}">${row.StatusText}</span></div>`;
                }
              },
              { 'data': 'SchoolRegDate' },
              // <span class="label label-success">Coding</span>
              ],
          })

        },
        error : function(err){
          $('#cover-spin').hide();
          if(err.status == 401){
            //document.cookie = "Token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            //window.location = "logout.php";
          }
        }
      });
    }


});