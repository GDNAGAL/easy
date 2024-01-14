$( document ).ready(function() {
   let changes = false;
    
    const urlParams = new URLSearchParams(window.location.search);
    const ClassRoomID = urlParams.get('ClassRoomID');
    const ExamID = urlParams.get('ExamID');
    let activeTab = "";
    getlist();

    window.addEventListener('beforeunload', function (e) {
      if(changes){
        if (confirm("Are you sure you want to leave? Your changes may not be saved.")) {
          return;
        } else {
          e.preventDefault();
        }
      }
    })

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

  
    $(document).on("click","#savebtn", function(){
      $('#cover-spin').show();
      activeTab = $("li.active").children().attr("href").split("#")[1];

      let marksArr = new Array();
      var markInputs = document.querySelectorAll('#markInputBox');
      markInputs.forEach(function(input) {
        let studentid = $(input).attr("studentid");
        let subjectid = $(input).attr("subjectid");
        let paperid = $(input).attr("paperid");
        let marks = input.value;
        let mobj = {
          "StudentId" : studentid,
          "SubjectId" : subjectid,
          "PaperId" : paperid,
          "Marks" : marks,
          "ClassRoomID" :ClassRoomID,
        }
        marksArr.push(mobj)
      });
      let datajson = JSON.stringify(marksArr);
      let dataa = new FormData();
      dataa.append("MarksArr", datajson);
      $.ajax({
                type: "POST",
                data: dataa, 
                contentType: false,       
                cache: false,             
                processData:false,
                url: 'api/Examination/saveStudentMarks',
                headers: {
                    'Authorization': 'Bearer ' + getCookie("Token")
                },
                success:function(result){
                  // success,info,error,warning,trash
                  Alert.success(`Success! ${result.Message}`,`${result.Message}`,{displayDuration: 4000})
                  getlist()
                },
                error:function(){
                  // success,info,error,warning,trash
                  //Alert.error(`Error! UNKNOWN ERROR`,`UNKNOWN ERROR`,{displayDuration: 4000})
                }
      })
    })

    function disableAllInputs() {
      var numberInputs = document.querySelectorAll('input[type="number"]');
      numberInputs.forEach(function(input) {
        input.disabled = true;
      });
    }
    function enableByPidInputs(pid) {
      disableAllInputs();
      let numberInputs = document.querySelectorAll(`[PaperID="${pid}"]`);
      numberInputs.forEach(function(input) {
        input.disabled = false;
      });
    }

    //Enable Disable inputs
    $(document).on("change","#enableRadio",function(){
      enableByPidInputs($(this).attr("ppid"))
    })

    $(document).on("blur","#markInputBox",function(){
      if(!changes){
        $("#subjectTabs").append(`<button class="btn btn-success" id="savebtn" style='float:right' type="submit"><i class="fa fa-save"></i> &nbsp;Save</button>`)
      }
      changes = true;
      $(this).removeClass("v-danger");
        $(this).removeClass("v-success");
      let mm = $(this).attr("MM");
      let inputVal = $(this).val();
      if(inputVal<10 && inputVal>0){
        inputVal = "0"+inputVal;
      }
      if(inputVal>mm){
        $(this).addClass("v-danger");
        // alert("Cannot Fill More than Maximum Marks : "+ mm)
        $(this).focus();
        $(this).val('')
      }else if(inputVal<0){
        $(this).addClass("v-danger");
        // alert("Cannot Fill Less than 0")
        $(this).focus();
        $(this).val('')
      }else if(inputVal==0 || inputVal == ""){
        $(this).removeClass("v-danger");
        $(this).removeClass("v-success");
      }else{
        $(this).removeClass("v-danger");
        $(this).addClass("v-success");
      }
    })

    // Assuming you have a form with an ID, let's say 'myForm'
$("#myForm").submit(function(event) {
  event.preventDefault();
  let allInputValues = [];
      allInputValues.push(rowValues);
});

function getObjectByKeyValue(arr, key, value) {
  let OAr =  arr.find(obj => obj[key] === value);
  if(OAr){
    return OAr.MarksObtained;
  }
}

    function getlist(){
        $("#subjectTabs").html('')
        $("#tabcontent").html('')
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
                  $('#cover-spin').hide();
                  changes = false;
                 $.each(result.Subjects, function(i, item) {
                      let color = ["#EFEFEF","#FBF1F1","#EFEFEF","#FBF1F1","#EFEFEF","#FBF1F1","#EFEFEF","#FBF1F1","#EFEFEF","#FBF1F1","#EFEFEF","#FBF1F1","#EFEFEF"];
                      let papershead = "";
                      let table = `<table class="cell-border hover table-bordered no-footer" style="margin-top:15px">
                                    <tr>
                                      <th style="padding:5px" rowspan="2" class="text-center">Roll No.</th>
                                      <th style="padding:5px" rowspan="2" class="text-center">Student Name</th>`;
                                      $.each(item.Exams, function(ei,eitem){
                                        eitem.Papers.forEach(paperitem => {
                                            let pname = paperitem.PaperDisplayText.split("~")[0];
                                            papershead += `<td style=" background:${color[ei]}" class="text-center">${pname}<br> (${paperitem.PaperMM})<br><input id="enableRadio" ppid="${paperitem.PaperID}" type="radio" name="enable"></td>`;
                                        })
                                        let paperLength = eitem.Papers.length;
                                        let ename = eitem.ExamText.split("~")[0];
                                        if(paperLength == 1){
                                          table += `<th style="width:100px; background:${color[ei]}" colspan="${paperLength}" class="text-center"></th>`;
                                        }else{
                                          table += `<th style="width:100px; background:${color[ei]}" colspan="${paperLength}" class="text-center">${ename}</th>`;
                                        }
                                      })
                        table += `</tr>`;
                        table += `<tr>${papershead}</tr>`;
                        
                        item.Students.forEach(sitem => {
                        let inputs = "";
                                          $.each(item.Exams, function(ei,eitem){
                                            eitem.Papers.forEach(paperitem => {
                                              let mar = getObjectByKeyValue(sitem.Marks,'PaperID',paperitem.PaperID)
                                              if(mar == null){
                                                mar = "";
                                              }
                                              inputs += `<td class="text-center" style="width:100px;padding:4px; background:${color[ei]}"><input id="markInputBox" type="number" value="${mar}" StudentID="${sitem.StudentID}" SubjectID="${item.SubjectID}" PaperID="${paperitem.PaperID}" MM="${paperitem.PaperMM}" class="form-control" disabled></td>`;
                                            })
                                          })
                                          table += `<tr>
                                          <td class="text-center">${sitem.RollNo}</td>
                                          <td style="padding:5px; padding-right:20px;">${sitem.StudentName}</td>
                                          ${inputs}
                                        </tr> `;      
                      })
                        table += `</table>`;
                        let cmark = "";
                        if(item.CompletedPercent==0){
                          cmark = `<i class="fa fa-star-o text-danger"></i>`;
                        }else if(item.CompletedPercent==100){
                          cmark = `<i class="fa fa-star text-green"></i>`;
                        }else{
                          cmark = `<i class="fa fa-star-half-o text-orange"></i>`;
                        }
                        if(activeTab == ""){
                          if(i==0){
                            $("#subjectTabs").append(`<li class="active"><a href="#${item.SubjectID}" data-toggle="tab">${cmark} &nbsp;${item.SubjectName}</a></li>`)
                            $("#tabcontent").html(`<div class="tab-pane active" id="${item.SubjectID}">${table}</div>`)
                          }else{
                            $("#subjectTabs").append(`<li><a href="#${item.SubjectID}" data-toggle="tab">${cmark} &nbsp;${item.SubjectName}</a></li>`)
                            $("#tabcontent").append(`<div class="tab-pane" id="${item.SubjectID}">${table}</div>`)
                          }
                        }else{
                          if(activeTab == item.SubjectID){
                            $("#subjectTabs").append(`<li class="active"><a href="#${item.SubjectID}" data-toggle="tab">${cmark} &nbsp;${item.SubjectName}</a></li>`)
                            $("#tabcontent").html(`<div class="tab-pane active" id="${item.SubjectID}">${table}</div>`)
                          }else{
                            $("#subjectTabs").append(`<li><a href="#${item.SubjectID}" data-toggle="tab">${cmark} &nbsp;${item.SubjectName}</a></li>`)
                            $("#tabcontent").append(`<div class="tab-pane" id="${item.SubjectID}">${table}</div>`)
                          }
                        }
                        

                 })
                },
                error : function(err){
                    $('#cover-spin').hide();
                }
          });
    }

})