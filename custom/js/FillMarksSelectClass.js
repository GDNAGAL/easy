$( document ).ready(function() {
    var url = $("#url").val();
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
        e.preventDefault()
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
                url: url +  '/Examination/getClassWisExamList',
                headers: {
                    'Authorization': 'Bearer ' + getCookie("Token")
                },
                success: function(result){
                    $('#cover-spin').hide();
                let CompletedMarksAverage = 0;
                let ccount = result.ClassRoom.length;
                let fillbtn = "";
                 $.each(result.ClassRoom, function(i, item) {  
                    let bar; 
                    let MarkseetBtn ="";
                    let AttenBtn;
                    let ResultSheetBtn;
                    CompletedMarksAverage+=Number(item.CompletedPercent);
                    if(item.CompletedPercent == 0){
                        bar = `<div class="progress">
                                        <div class="progress-bar progress-bar-success" style="width: 0%"></div>
                                    </div>`
                        MarkseetBtn = `<button class="btn btn-sm btn-primary" disabled>View Marksheets</button>`;
                        ResultSheetBtn = `<button class="btn btn-sm btn-info" disabled>View ResultSheet</button>`;
                    }else if(item.CompletedPercent == 100){
                        bar = `<div class="progress">
                                    <div class="progress-bar progress-bar-success" style="width: ${item.CompletedPercent}%">${item.CompletedPercent}%</div>
                                </div>`
                        MarkseetBtn = `<a href="ViewMarksheets?ClassRoomID=${item.ClassRoomID}&SectionID=${item.SectionID}"><button class="btn btn-sm btn-primary">View Marksheets</button></a>`;
                        ResultSheetBtn = `<a target="_blank" href="ResultSheet/ResultSheet?ClassRoomID=${item.ClassRoomID}&SectionID=${item.SectionID}"><button class="btn btn-sm btn-info">View ResultSheet</button></a>`;
                        
                    }else{
                        bar = `<div class="progress progress-striped active">
                                    <div class="progress-bar progress-bar-danger" style="width: ${item.CompletedPercent}%">${item.CompletedPercent}%</div>
                                </div>`
                        MarkseetBtn =  `<button class="btn btn-sm btn-primary" disabled>View Marksheets</button>`;
                        ResultSheetBtn =  `<button class="btn btn-sm btn-info" disabled>View ResultSheet</button>`;
                        
                    }
                    if(item.Students>0){
                        fillbtn =`<a href="MarksEntry?ClassRoomID=${item.ClassRoomID}&SectionID=${item.SectionID}&text=${item.ClassRoomName} ${item.SectionText}"><button class="btn btn-sm btn-success">Fill Marks</button></a>`; 
                        AttenBtn = `<a href="AttendenceEntry?ClassRoomID=${item.ClassRoomID}&SectionID=${item.SectionID}"><button class="btn btn-sm btn-warning">Fill Attendence</button></a>`;
                    }else{
                        fillbtn = `<button title="No Student in Class." class="btn btn-sm btn-danger" disabled>Fill Marks</button>`;
                        AttenBtn =  `<button class="btn btn-sm btn-warning" disabled>Fill Attendence</button>`;
                    }
                    var rawhtml = `<tr>
                    <td>${i+1}</td>
                    <td>${item.ClassRoomName} ${item.SectionText}</td>
                    <td class="text-center">${item.Students}</td>
                    <td style="width:35%">
                      ${bar}
                    </td>
                    <td style="text-align:right;">
                    ${fillbtn} ${MarkseetBtn} ${AttenBtn} ${ResultSheetBtn}</td></tr>`;       
                    $("#exambody").append(rawhtml)
                 })
                 $("#mfper").html((CompletedMarksAverage/ccount).toFixed(2)+" %")
                },
                error : function(err){
                    $('#cover-spin').hide();
                }
          });
    }

})