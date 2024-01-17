$("#addClassRoomBtn").on("click",function(){
    $("#addClassRoomModal").modal({
        show: true,
        backdrop: 'static'
    })
})

$("#addClassRoomGroupBtn").on("click",function(){
    $("#addClassRoomGroupModal").modal({
        show: true,
        backdrop: 'static'
    })
})

$("#addExamModalBtn").on("click",function(){
    $("#addExamModal").modal({
        show: true,
        backdrop: 'static'
    })
})

getClassRoomGroupList()
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

$("#addClassRoomGroupForm").on("submit",function(e){
    $('#cover-spin').show();
    e.preventDefault();
    let data = new FormData(this);
        $.ajax({
            type: "POST",
            data: data, 
            contentType: false,       
            cache: false,             
            processData:false,
            url: 'api/Default/addClassRoomGroup',
            headers: {
                'Authorization': 'Bearer ' + getCookie("AToken")
            },
            success: function(result){
                $('#cover-spin').hide();
                $("#addClassRoomGroupModal").modal('hide')
                $('#addClassRoomGroupForm').trigger("reset");
                // success,info,error,warning,trash
                Alert.success(`Success! ${result.Message}`,`${result.Message}`,{displayDuration: 4000})
                getClassRoomGroupList()  

            },
            error : function(err){
                $('#cover-spin').hide();
            }
        })
})


$("#addClassRoomForm").on("submit",function(e){
    $('#cover-spin').show();
    e.preventDefault();
    let data = new FormData(this);
        $.ajax({
            type: "POST",
            data: data, 
            contentType: false,       
            cache: false,             
            processData:false,
            url: 'api/Default/addClassRoom',
            headers: {
                'Authorization': 'Bearer ' + getCookie("AToken")
            },
            success: function(result){
                $('#cover-spin').hide();
                $("#addClassRoomModal").modal('hide')
                getClassRoomGroupList()
                $('#addClassRoomForm').trigger("reset");
                // success,info,error,warning,trash
                Alert.success(`Success! ${result.Message}`,`${result.Message}`,{displayDuration: 4000}) 

            },
            error : function(err){
                $('#cover-spin').hide();
            }
        })
})


$("#addExamForm").on("submit",function(e){
    $('#cover-spin').show();
    e.preventDefault();
    let data = new FormData(this);
        $.ajax({
            type: "POST",
            data: data, 
            contentType: false,       
            cache: false,             
            processData:false,
            url: 'api/Default/addExam',
            headers: {
                'Authorization': 'Bearer ' + getCookie("AToken")
            },
            success: function(result){
                getExamList()
                $('#cover-spin').hide();
                $("#addExamModal").modal('hide')
                $('#addExamForm').trigger("reset");
                // success,info,error,warning,trash
                Alert.success(`Success! ${result.Message}`,`${result.Message}`,{displayDuration: 4000}) 
            },
            error : function(err){
                $('#cover-spin').hide();
            }
        })
})


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
                $("#examTable").html("")
                $.each(result.ExamList, function(i, item) {
                    $("#examTable").append(`<tr><td class="text-center">${i + 1}</td><td>${item.ExamText}</td><td class="text-center">${item.ExamTextHindi}</td><td class="text-center"><a href="DefaultView?ClassRoomGroupID=${item.ClassRoomGroupID}"><button class="btn btn-success btn-flat">View</button></a></td></tr>`)
                });
            }
        },
        error : function(err){
            $('#cover-spin').hide();
        }
    });
}

function getClassRoomGroupList(){
    $('#cover-spin').show();
    $.ajax({
        type: "POST",
        url: 'api/Default/getClassRoomGroupList',
        headers: {
            'Authorization': 'Bearer ' + getCookie("AToken")
        },
        success: function(result){
            $('#cover-spin').hide();
            if(result.Status=="OK"){
                $("#classRoomGroupSelectBox").html("")
                $("#classRoomGroupSelectBox").append(`<option value="">Select ClassRoom Group</option>`)
                $.each(result.ClassRoomGroupList, function(i, item) {
                    $("#classRoomGroupSelectBox").append(`<option value="${item.ClassRoomGroupID}">${item.GroupName}</option>`)
                });

                var table = ``;
                $.each(result.ClassRoomGroupList, function(i, citem) {
                    var length = citem.ClassRoomList.length;
                    table += `<tr><td rowspan="${length}">${i + 1}</td><td rowspan="${length}">${citem.GroupName}</td><td>${citem.ClassRoomList[0].ClassRoomName}</td><td rowspan="${length}" class="text-center"><a href="DefaultView?ClassRoomGroupID=${citem.ClassRoomGroupID}"><button class="btn btn-success btn-flat">View</button></a></td></tr>`
                    $.each(citem.ClassRoomList, function(j, pitem){
                        if (j > 0) {
                            table += `<tr><td>${pitem.ClassRoomName}</td></tr>`;
                        }
                    })
                    // table += ``;
                });
                table += `</table>`;
                $("#classRoomTable").html(table)
            }
        },
        error : function(err){
            $('#cover-spin').hide();
        }
    });
}