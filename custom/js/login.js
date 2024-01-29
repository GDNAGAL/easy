$( document ).ready(function() {
var url = 'https://api.royalplay.live';
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


//Proceed For Login
$("#login_form").on('submit', function(e){
  e.preventDefault();
  $("#validate").html("");
  const username = $("#username").val();
  const password = $("#password").val();

  //check validation 
  if(username == "" || password == ""){
    $("#validate").html(`<span style='color:red'>Please fill all inputs</span>`)
    return false;
  }

  //Call ajax for login
  loadbtn('#login_submit', 'Loading...') 
  let data = new FormData(this);
  data.append(event.submitter.name, event.submitter.value);
  $.ajax({
    type: "POST", 
    url: `${url}/login`,              
    data: data, 
    contentType: false,       
    cache: false,             
    processData:false,
    success: function(result){
      unloadbtn('#login_submit', 'Login');
      $("#validate").html(`<span style='color:green'>${result.Message}</span>`)
      $("#login_form")[0].reset() 
      document.cookie=  `Token=${result.Token}`; 
      //window.localStorage.userdata = JSON.stringify(result);
      window.location = "index";
    },
    error: function(err){
      $("#validate").html(`<span style='color:red'> ${err.responseJSON.Message}</span>`)
      unloadbtn('#login_submit', 'Login')
      $($("#login_form")[0][1]).val('')
    }
  });

  



});







});