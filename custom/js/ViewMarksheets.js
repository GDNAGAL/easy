$( document ).ready(function() {
  var url = $("#url").val();
  const urlParams = new URLSearchParams(window.location.search);
  const SectionID = urlParams.get('SectionID');
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
    const dataa = {cls : SectionID};
    $("#studentTableBody").html("")
    $.ajax({
          "url": url + "/Students/getStudentList",
          "type": "POST",
          "data": dataa,
          "datatype": 'json',
          "async": false,
          headers: {
            'Authorization': 'Bearer ' + getCookie("Token")
          },
          success: function(result){
          $('#cover-spin').hide();
          if(result.Status=="OK"){
            $.each(result.StudentList, function(i, item) {
              $("#setClassName").html(item.ClassRoomName);
              $("#studentTableBody").append(
                `<tr>
                  <td style="vertical-align: middle;">${item.RollNo}</td>
                  <td style="vertical-align: middle;">${item.StudentName}</td>
                  <td class='text-center' style="vertical-align: middle;">${item.StudentFatherName}</td>
                  <td class='text-center' style="vertical-align: middle;">${item.StudentMotherName}</td>
                  <td class='text-center' style="vertical-align: middle;">${item.DateofBirth}</td>
                  <td class='text-center' style="vertical-align: middle;"><a href="DownloadMarksheetGA?SectionID=${SectionID}&StudentID=${item.StudentID}" target="_blank"><button class="btn btn-info">Download Marksheet</button></a></td></tr>`
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