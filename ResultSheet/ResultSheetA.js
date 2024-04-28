const urlParams = new URLSearchParams(window.location.search);
const ExamGroupID = urlParams.get('examGroupId');
var url = $("#url").val();
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
  getList(2)

function getList(SectionID){
    $("#examstable").html("")
    let data = new FormData();
    data.append("SectionID",SectionID)
    data.append("StudentID",'all')
    $.ajax({
        type: "POST",
        data: data, 
        contentType: false,       
        cache: false,             
        processData:false,
        url: url +  '/Marksheet/downloadMarksheetGA',
        headers: {
            'Authorization': 'Bearer ' + getCookie("Token")
        },
        success: function(result){
            $('#cover-spin').hide();
            // $('#cover-spin').hide();
            if(result.Status=="OK"){
                $.each(result.StudentList, function(i, item){
                    $('#mbody').append(
                        `<tr>
                            <td>${i+1}</td>
                            <td>${item.RollNo}</td>
                            <td style='width:300px; padding-left:3px;'>${item.StudentName}</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1000</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                    </tr>`
                    )
                })

                // If the length of StudentList is less than 45, append empty rows
                var remainingRows = 45 - result.StudentList.length;
                for (var i = 0; i < remainingRows; i++) {
                    $('#mbody').append(
                        `<tr>
                            <td>${(result.StudentList.length+1)+i}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>`
                    );
                }
            }
        },
        error : function(err){
            $('#cover-spin').hide();
        }
    });
}