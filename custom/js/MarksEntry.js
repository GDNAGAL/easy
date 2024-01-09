$( document ).ready(function() {
   
    
    const urlParams = new URLSearchParams(window.location.search);
    const ClassRoomID = urlParams.get('ClassRoomID');
    const ExamID = urlParams.get('ExamID');
    getlist();

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

        let dataa = new FormData();
        dataa.append("ClassRoomID", ClassRoomID);
        dataa.append("ExamID",ExamID);
        $.ajax({
                type: "POST",
                data: dataa, 
                contentType: false,       
                cache: false,             
                processData:false,
                url: 'api/Examination/getMarkEntryDetail',
                headers: {
                    'Authorization': 'Bearer ' + getCookie("Token")
                },
                success: function(result){
                 $.each(result.ClassRoom, function(i, item) {
                    if(i==0){
                        $("#subjectTabs").append(`<li class="active"><a href="#${item.SubjectID}" data-toggle="tab">${item.SubjectName}</a></li>`)
                        $("#tabcontent").append(`<div class="tab-pane active" id="${item.SubjectID}">
                        <table class="table table-condensed">
                         <tr>
                           <th class="text-center" style="width:60px">Roll No.  ${item.SubjectName}</th>
                           <th style="width:250px">Student Name</th>
                           <th style="width:100px" class="text-center">First Test<br>M.M.(50)</th>
                           <th><button style="margin-left: 10px;" class="btn btn-flat btn-success">Save Changes</button></th>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
       
                       </table>
                     </div>`)
                    }else{
                        $("#subjectTabs").append(`<li><a href="#${item.SubjectID}" data-toggle="tab">${item.SubjectName}</a></li>`)
                        $("#tabcontent").append(`<div class="tab-pane" id="${item.SubjectID}">
                        <table class="table table-condensed">
                         <tr>
                           <th class="text-center" style="width:60px">Roll No.  ${item.SubjectName}</th>
                           <th style="width:250px">Student Name</th>
                           <th style="width:100px" class="text-center">First Test<br>M.M.(50)</th>
                           <th><button style="margin-left: 10px;" class="btn btn-flat btn-success">Save Changes</button></th>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
                         <tr>
                           <td class="text-center">1001</td>
                           <td>Rahul Kumar</td>
                           <td><input type="number" class="form-control"></td>
                           <td></td>
                         </tr>
       
                       </table>
                     </div>`)
                    }

                 })
                },
                error : function(err){
                    $('#cover-spin').hide();
                }
          });
    }

})