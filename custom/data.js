$( document ).ready(function() {
//Some Important Functions 
//function for loading button
  function loadbtn(id, text){
    $(id).attr("disabled", true);
    $(id).addClass("disabled");
    $(id).text(text);
  }


 //function for un-loading button
  function unloadbtn(id, text){
    $(id).attr("disabled", false);
    $(id).removeClass("disabled");
    $(id).text(text);
  }	

 //Get Teacher List
function getteacherlist(data){
	$.ajax({
            type: "POST",
            data: data,
            url: 'getData/get_teacher_list.php',
            success: function(result){
                $("#class_teacher_list").append(result);
             }
           });
}
//get class List
function getclasslist(){
	$.ajax({
            type: "POST",
            url: 'getData/get_Class_list.php',
            success: function(result){
                $("#selectclass").append(result);
             }
      });
}
 



// Edit Class Info.	
$(document).on('click', '#editclass', function(){
	     var currentRow=$(this).closest("tr"); 
         var classId=currentRow.find("td:eq(1)").text(); 
         var class_name=currentRow.find("td:eq(2)").text(); 
         var class_teacher=currentRow.find("td:eq(3)").text(); 

         $("#class_teacher_list").html('<option selected="selected" value="">Select Class Teacher</option>');
		 $('#modal-default').modal({backdrop: 'static', keyboard: false});
		 const data = {class_teacherid : class_teacher}
		 //get Teacher List
		  getteacherlist(data);
		  $('.modal-title').text("Update Class Name");
		 $('#modal_class_Id').val(classId);
		 $('#modal_class_name').val(class_name);
})

// Edit class modal form submit
$('#editclassform').submit(async function(e){
	 e.preventDefault();
	loadbtn('#editclasssubmit', 'Saving...');
	let data = new FormData(this);
    data.append(event.submitter.name, event.submitter.value);
    await $.ajax({
      type: "POST", 
      url: "getData/form_submit.php",              
      data: data, 
      contentType: false,       
      cache: false,             
      processData:false,
      success: function(result){
       if(result==1){
       	unloadbtn('#editclasssubmit', 'Save Changes');
        $('#modal-default').modal('hide');
       	alert("Success")
       	location.reload(true);
       }
      }
      });
})

// Create New Class
$("#createnewclass").on('click', function(){
  const data = {class_teacherid : 0}
  $("#class_teacher_list").html('<option selected="selected" value="">Select Class Teacher</option>');
  getteacherlist(data);
  $('#modal-default').modal({backdrop: 'static', keyboard: false});
  $('#modal_class_Id').val(0);
  $('#modal_class_name').val("");
  $('.modal-title').text("Add New Class");
})


//Set Classes in Select Box on load Add Student PAge
getclasslist();
//Add New Student
$('#addstudentform').submit(function(e){
	e.preventDefault();
	let data = new FormData(this);
    data.append(event.submitter.name, event.submitter.value);
    $.ajax({
      type: "POST", 
      url: "getData/form_submit.php",              
      data: data, 
      contentType: false,       
      cache: false,             
      processData:false,
      success: function(result){
      	if(result==1){
      		alert("Student Added Successfully");
      		//document.getElementById("addstudentform").reset();
      		location.reload(true);
      	}
      }
      });
})



});