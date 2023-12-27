getExamGroupList()
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

$("#addExamGroupForm").on("submit",function(e){
    e.preventDefault();
    let data = new FormData(this);
        $.ajax({
            type: "POST",
            data: data, 
            contentType: false,       
            cache: false,             
            processData:false,
            url: 'api/Examination/addExamGroup',
            headers: {
                'Authorization': 'Bearer ' + getCookie("Token")
            },
            success: function(result){
                $('#addExamGroupForm').trigger("reset");
                getExamGroupList()  

            },
            error : function(err){

            }
        })
})




function getExamGroupList(){
    $("#examgrouptable").html("")
    $.ajax({
        type: "POST",
        url: 'api/Examination/getExamGroupList',
        headers: {
            'Authorization': 'Bearer ' + getCookie("Token")
        },
        success: function(result){
            // $('#cover-spin').hide();
            if(result.Status=="OK"){
                $.each(result.ExamGroupList, function(i, item) {
                    $("#examgrouptable").append(`<tr>
                    <td>${i+1}</td>
                    <td>${item.DisplayText}</td>
                    <td class="text-center">${item.TotalExams}</td>
                    <td class="text-center">
                    <a href="ViewExamGroup?examGroupId=${item.ExamGroupID}"><button class="btn btn-primary">View</button></a></td>
                    </tr>`);
                });
            }
        },
        error : function(err){
            $('#cover-spin').hide();
        }
    });
}