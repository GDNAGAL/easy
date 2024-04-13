$( document ).ready(function() {
  var url = $("#url").val();
   let changes = false;
    
   window.addEventListener('keydown', function (event) {
    if ((event.ctrlKey || event.metaKey) && event.key === 's') {
        event.preventDefault()
          if(changes){
            saveData()
          }
        }
    });

    const urlParams = new URLSearchParams(window.location.search);
    const ClassRoomID = urlParams.get('ClassRoomID');
    const SectionID = urlParams.get('SectionID');
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
      saveData();
    })

    function saveData(){
      $('#cover-spin').show();
      activeTab = $("li.active").children().attr("href").split("#")[1];

      let marksArr = new Array();
      var markInputs = document.querySelectorAll('#markInputBox');
      markInputs.forEach(function(input) {
        let studentid = $(input).attr("studentid");
        let subjectid = $(input).attr("subjectid");
        let paperid = $(input).attr("paperid");
        let marks = input.value;
        let mm = $(input).attr("mm");
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
                url: url +  '/Examination/saveStudentMarks',
                headers: {
                    'Authorization': 'Bearer ' + getCookie("Token")
                },
                success:function(result){
                  // success,info,error,warning,trash
                  Alert.success(`${result.Message}`,{displayDuration: 4000})
                  getlist()
                },
                error:function(){
                  success,info,error,warning,trash
                  Alert.error(`UNKNOWN ERROR`,{displayDuration: 4000})
                }
      })
    }

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
        dataa.append("cls", SectionID);
        // dataa.append("SectionID",SectionID);
        $.ajax({
                type: "POST",
                data: dataa, 
                contentType: false,       
                cache: false,             
                processData:false,
                url: url +  '/Students/getStudentList',
                headers: {
                    'Authorization': 'Bearer ' + getCookie("Token")
                },
                success: function(result){
                  $('#cover-spin').hide();
                  changes = false;
                  let table = `<table class="cell-border hover table-bordered no-footer" style="margin-top:15px">
                                <tr>
                                  <th style="padding:5px" rowspan="2" class="text-center">Roll No.</th>
                                  <th style="padding:5px" rowspan="2" class="text-center">Student Name</th>
                                  <th style="padding:5px" rowspan="2" class="text-center">Attendence</th>
                                </tr><tbody>`;
                 $.each(result.StudentList, function(i, item) {
                  table += `<tr>
                            <td class="text-center">${item.RollNo}</td>
                            <td style="padding:5px; padding-right:20px;">${item.StudentName}</td>
                            <td class="text-center" style="width:100px;padding:4px;"><input id="markInputBox" type="number" value="${0}" StudentID="${item.StudentID}" class="form-control"></td>
                          </tr> `;      
                  })
                  table += `</tbody></table>`;
                  $("#tabcontent").html(`<div class="tab-pane active">${table}</div>`)
                },
                error : function(err){
                    $('#cover-spin').hide();
                }
          });
    }

})