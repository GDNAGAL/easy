const urlParams = new URLSearchParams(window.location.search);
const ClassRoomGroupID = urlParams.get('ClassRoomGroupID');
const ClassRoomGroupTitle = urlParams.get('Titile');
$("#ClassRoomGroupTitle").html(ClassRoomGroupTitle)
$("#addSubjectBtn").on("click",function(){
    $("#addSubjectModal").modal({
        show: true,
        backdrop: 'static'
    })
})

$("#addPaperBtn").on("click",function(){
    $("#addPaperModal").modal({
        show: true,
        backdrop: 'static'
    })
})


getSubjectList()
getExamList()

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

$("#addSubjectForm").on("submit",function(e){
    e.preventDefault();
    let data = new FormData(this);
    data.append("ClassRoomGroupID",ClassRoomGroupID);
        $.ajax({
            type: "POST",
            data: data, 
            contentType: false,       
            cache: false,             
            processData:false,
            url: 'api/Default/addSubject',
            headers: {
                'Authorization': 'Bearer ' + getCookie("AToken")
            },
            success: function(result){
                $("#paperTableBody").html("Select Subject To View Papers.")
                $("#addSubjectModal").modal('hide')
                $('#addSubjectForm').trigger("reset");
                // success,info,error,warning,trash
                Alert.success(`Success! ${result.Message}`,`${result.Message}`,{displayDuration: 4000})
                getSubjectList()

            },
            error : function(err){

            }
        })
})


$("#addPaperForm").on("submit",function(e){
    e.preventDefault();
    let data = new FormData(this);
    data.append("ClassRoomGroupID",ClassRoomGroupID)
        $.ajax({
            type: "POST",
            data: data, 
            contentType: false,       
            cache: false,             
            processData:false,
            url: 'api/Default/addPaper',
            headers: {
                'Authorization': 'Bearer ' + getCookie("AToken")
            },
            success: function(result){
                $("#addPaperModal").modal('hide')
                getPaperList($("#setSubjectID").val())
                $('#addPaperForm').trigger("reset");
                // success,info,error,warning,trash
                Alert.success(`Success! ${result.Message}`,`${result.Message}`,{displayDuration: 2500}) 

            },
            error : function(err){

            }
        })
})



function getSubjectList(){
    let data = new FormData();
    data.append("ClassRoomGroupID",ClassRoomGroupID);
    $.ajax({
        type: "POST",
        data: data, 
        contentType: false,       
        cache: false,             
        processData:false,
        url: 'api/Default/getSubjectList',
        headers: {
            'Authorization': 'Bearer ' + getCookie("AToken")
        },
        success: function(result){
            $('#cover-spin').hide();
            if(result.Status=="OK"){
                $("#subjectTable").html("")
                $.each(result.SubjectList, function(i, item) {
                    $("#subjectTable").append(`<tr><td class="text-center"><input id="selectSubjectID" type="radio" SubjectID="${item.SubjectID}" name="subjectCheckbox"/></td><td>${item.SubjectName}</td><td class="text-center">${item.SubjectType}</td><td class="text-center"><a href="javascript:void(0)">Edit</a></td></tr>`)
                });
            }
        },
        error : function(err){
            $('#cover-spin').hide();
        }
    });
}


$(document).on("change","#selectSubjectID",function(){
    getPaperList($(this).attr("SubjectID"))
})


function getPaperList(subjectId){
    $("#paperTableBody").html("No Paper Found.")
    $("#setSubjectID").val(subjectId)
    $("#addPaperBtn").show()
    let data = new FormData();
    data.append("SubjectID",subjectId)
    $.ajax({
        type: "POST",
        data: data, 
        contentType: false,       
        cache: false,             
        processData:false,
        url: 'api/Default/getPaperList',
        headers: {
            'Authorization': 'Bearer ' + getCookie("AToken")
        },
        success: function(result){
            $('#cover-spin').hide();
            var total = 0;
            if(result.Status=="OK"){
                var table = `Papers For <b>${subjectId}</b>`;
                table += `<table class="table table-bordered table-striped text-center align-middle">
                                <tr><th>#</th><th>Exam Name</th><th>Paper</th><th>Max. Marks</th><th>Action</th></tr>`;
                $.each(result.ExamList, function(i, item) {
                    var length = item.PaperList.length;
                    table += `<tr><td rowspan="${length + 1}">${i + 1}</td><td rowspan="${length + 1}">${item.ExamText}</td></tr>`
                    $.each(item.PaperList, function(j, pitem){
                        total+=Number(pitem.PaperMM);
                        table += `<tr><td>${pitem.PaperDisplayText}</td><td>${pitem.PaperMM}</td><td><a href="javascript:void(0)">Edit</a></td></tr>`;
                    })
                });
                table+=`<tr><th colspan="3">Total Marks : </th><th>${total}</th><td></td></tr>`;
                table += `</table>`;
                $("#paperTableBody").html(table)
            }
        },
        error : function(err){
            $('#cover-spin').hide();
        }
    });
}


function getExamList(){
    $('#cover-spin').show();
    $.ajax({
        type: "POST",
        url: 'api/Default/getExamList',
        headers: {
            'Authorization': 'Bearer ' + getCookie("AToken")
        },
        success: function(result){
            $('#cover-spin').hide();
            if(result.Status=="OK"){
                $("#ExamSelect").html("")
                $("#ExamSelect").append(`<option value="">Select Exam</option>`)
                $.each(result.ExamList, function(i, item) {
                    $("#ExamSelect").append(`<option value="${item.ExamID}">${item.ExamText}</option>`)
                });
            }
        },
        error : function(err){
            $('#cover-spin').hide();
        }
    });
}