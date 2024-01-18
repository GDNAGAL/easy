$( document ).ready(function() {
  const urlParams = new URLSearchParams(window.location.search);
  const ClassRoomID = urlParams.get('ClassRoomID');
  getStudentList()
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



  function getStudentList(){
    const dataa = {cls : ClassRoomID};
    $("#studentTableBody").html("")
    $.ajax({
          "url": "api/Students/getStudentList",
          "type": "POST",
          "data": dataa,
          "datatype": 'json',
          "async": false,
          headers: {
            'Authorization': 'Bearer ' + getCookie("Token")
          },
          success: function(result){
            console.log(result)
          $('#cover-spin').hide();
          if(result.Status=="OK"){
            $.each(result.StudentList, function(i, item) {
              $("#setClassName").html(item.ClassRoomName);
              $("#studentTableBody").append(
                `<tr>
                  <td style="vertical-align: middle;">${item.RollNo}</td>
                  <td style="vertical-align: middle;"><img class="studentIamge" src="https://cdn-icons-png.flaticon.com/512/149/149071.png" width="50px" height="50px"/></td>
                  <td style="vertical-align: middle;">${item.StudentName}</td>
                  <td class='text-center' style="vertical-align: middle;">${item.StudentFatherName}</td>
                  <td class='text-center' style="vertical-align: middle;">${item.StudentMotherName}</td>
                  <td class='text-center' style="vertical-align: middle;">${item.DateofBirth}</td></tr>`
                  );
                });
              }else if(result.Status=="NOT_FOUND"){
                $("#studentTableBody").append(
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