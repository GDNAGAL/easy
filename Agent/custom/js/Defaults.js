getClassRoomGroupList()
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
                $('#addClassRoomGroupForm').trigger("reset");
                // success,info,error,warning,trash
                Alert.success(`Success! ${result.Message}`,`${result.Message}`,{displayDuration: 4000})
                getClassRoomGroupList()  

            },
            error : function(err){

            }
        })
})




function getClassRoomGroupList(){
    $("#examgrouptable").html("")
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
            }
        },
        error : function(err){
            $('#cover-spin').hide();
        }
    });
}