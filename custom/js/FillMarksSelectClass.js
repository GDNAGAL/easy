$( document ).ready(function() {
   
    getlist()

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

    $(function () {
      $('.select2').select2()
    })
  
    $(document).on("click","#addExambtn",function(){
        $('#addExamModal').modal();
          $("#classId").val($(this).attr("cid"))
          $("#modal_exam_name").val('')
    })

    $("#addExamForm").on("submit",function(e){
        console.log("submiited")
        e.preventDefault()
        let data = new FormData(this);
        $.ajax({
            type: "POST",
            data: data, 
            contentType: false,       
            cache: false,             
            processData:false,
            url: 'api/Examination/addExam',
            headers: {
                'Authorization': 'Bearer ' + getCookie("Token")
            },
            success: function(result){
                getlist()
                $('#addExamModal').modal('hide');

            },
            error : function(err){

            }
        })
    })


    function getlist(){
        $("#exambody").html("")
        $.ajax({
                type: "POST",
                url: 'api/Examination/getClassWisExamList',
                headers: {
                    'Authorization': 'Bearer ' + getCookie("Token")
                },
                success: function(result){
                 $.each(result.ClassRoom, function(i, item) {  
                    let bar; 
                    if(item.CompletedPercent == 0){
                        bar = `<div class="progress">
                                        <div class="progress-bar progress-bar-success" style="width: 0%"></div>
                                    </div>`
                    }else if(item.CompletedPercent == 100){
                        bar = `<div class="progress">
                                    <div class="progress-bar progress-bar-success" style="width: ${item.CompletedPercent}%">${item.CompletedPercent}%</div>
                                </div>`
                    }else{
                        bar = `<div class="progress progress-striped active">
                                    <div class="progress-bar progress-bar-danger" style="width: ${item.CompletedPercent}%">${item.CompletedPercent}%</div>
                                </div>`
                    }
                    var rawhtml = `<tr>
                    <td>${i+1}</td>
                    <td>${item.ClassRoomName} ${item.SectionText}</td>
                    <td>
                      ${bar}
                    </td>
                    <td class="text-center">
                    <a href="MarksEntry?ClassRoomID=${item.ClassRoomID}&SectionID=${item.SectionID}"><button class="btn btn-sm btn-primary btn-flat">Fill Marks</button></a>`;       
                    rawhtml += `</td></tr>`;
                    $("#exambody").append(rawhtml)
                 })
                },
                error : function(err){
                    $('#cover-spin').hide();
                }
          });
    }

})