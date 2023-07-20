
$( document ).ready(function() {

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





  //check for ten digit mobile number and get session
  $("#username").keyup(function(){
  $("#validate").text("");
   //console.log($(this).val().trim().length);
   if($(this).val().trim().length > 9){

     $("#session_year").focus();
     //get session list
     let data = {mobile : $(this).val().trim()}

     //Call Ajex
     $.ajax({
            type: "POST",
            url: 'getData/get_SessionList.php',
            data: data,
            success: function(result){
              if(result==0){
                $("#validate").text("** Invalid Mobile Number");
              }else{
                $("#session_year").append(result);
              }
              
             }
           });

   }
   else{
    $("#session_year").html("<option value=''>Select Session--</option>");
   }
});

//Proceed For Login
  $("#login_form").on('submit', function(e){
     e.preventDefault();
     $("#validate").text("");
    const username = $("#username").val();
    const session_year = $("#session_year").val();
    const password = $("#password").val();

    //check validation 
    if(username == "" || session_year == "" || password == ""){
      $("#validate").text("** Please fill all inputs")
      return false;
    }
    // call ajax for login
    loadbtn('#login_submit', 'Loading...');
    let data = new FormData(this);
    data.append(event.submitter.name, event.submitter.value);
    $.ajax({
      type: "POST", 
      url: "getData/get_SessionList.php",              
      data: data, 
      contentType: false,       
      cache: false,             
      processData:false,
      success: function(result){
        if(result==0){
          unloadbtn('#login_submit', 'Login');
          $("#validate").text("** Mobile or password Wrong !!")
        }else if(result==1){
         console.log("Login Success")
         unloadbtn('#login_submit', 'Login');
         window.location.href = "index.php";
        }
      }
      });
    

    
  });







});