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
                url: 'api/Examination/getClassWiseExamList',
                headers: {
                    'Authorization': 'Bearer ' + getCookie("Token")
                },
                success: function(result){
                //  console.log(result)
                 $.each(result.ClassRoomList, function(i, item) {
                    
                    var rawhtml = `<tr>
                    <td>${i+1}</td>
                    <td>${item.ClassRoomName}</td>
                    <td>
                      <div class="progress">
                        <div class="progress-bar progress-bar-success" style="width: 100%"></div>
                      </div>
                    </td>
                    <td class="text-right">`;
                       
                    if(item.ExamsDetail !== undefined){
                        $.each(item.ExamsDetail , function(j, k){
                            rawhtml += `<a href="MarksEntry?ClassRoomID=${item.ClassRoomID}&ExamID=${k.ExamID}"><button class="btn btn-sm btn-primary btn-flat">${k.ExamName}</button></a> &nbsp;`;
                        })
                    }
                    // <a href="MarksEntry.php"><button class="btn btn-sm btn-primary btn-flat">1st Test</button></a>
                rawhtml += `<button class="btn btn-sm btn-info btn-flat" cid="${item.ClassRoomID}" title="Add Exam" id="addExambtn">+</button>`;        
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