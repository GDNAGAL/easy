const urlParams = new URLSearchParams(window.location.search);
const ExamGroupID = urlParams.get('examGroupId');
var url = $("#url").val();
getExamList(ExamGroupID)
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

$("#addExamForm").on("submit",function(e){
    e.preventDefault();
    let data = new FormData(this);
        $.ajax({
            type: "POST",
            data: data, 
            contentType: false,       
            cache: false,             
            processData:false,
            url: url +  '/Examination/addExam',
            headers: {
                'Authorization': 'Bearer ' + getCookie("Token")
            },
            success: function(result){
                $('#cover-spin').hide();
                // success,info,error,warning,trash
                Alert.success(`${result.Message}`,{displayDuration: 4000});
                $('#addExamForm').trigger("reset");
                getExamList(ExamGroupID) 

            },
            error : function(err){

            }
        })
})




function getExamList(examgroupid){
    $("#examstable").html("")
    let data = new FormData();
    data.append("ExamgroupID",examgroupid)
    $.ajax({
        type: "POST",
        data: data, 
        contentType: false,       
        cache: false,             
        processData:false,
        url: url +  '/Examination/getExamsList',
        headers: {
            'Authorization': 'Bearer ' + getCookie("Token")
        },
        success: function(result){
            $('#cover-spin').hide();
            // $('#cover-spin').hide();
            if(result.Status=="OK"){
                $.each(result.ExamList, function(i, item) {
                    $("#examstable").append(`<tr>
                    <td>${i+1}</td>
                    <td>${item.ExamText}</td>
                    <td class="text-center">
                    <a href="javascript:void(0)" class="text-primary h3"><i class='fa fa-pencil-square'></i></a></td>
                    </tr>`);
                });
            }
        },
        error : function(err){
            $('#cover-spin').hide();
        }
    });
}