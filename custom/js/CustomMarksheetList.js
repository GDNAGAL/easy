$( document ).ready(function() {
  var url = $("#url").val();
  const urlParams = new URLSearchParams(window.location.search);
  const ClassRoomID = urlParams.get('ClassRoomID');
  getMarksheetDesignList()
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

  $(document).on("click","#createDesignBtn",function(){
    $("#addDesignModal").modal({
      show:true,
      backdrop: 'static'
    })
  })

  $("#addDesignForm").on("submit",function(e){
    e.preventDefault();
    let data = new FormData(this);
    $.ajax({
      type: "POST",
      data:data,
      contentType: false,       
      cache: false,             
      processData:false,
      url: url +  '/Marksheet/addMarksheetDesign',
      headers: {
          'Authorization': 'Bearer ' + getCookie("Token")
      },
      success: function(result){
        $('#cover-spin').hide();
        $("#addDesignModal").modal('hide')
        $('#addDesignForm').trigger("reset");
        // success,info,error,warning,trash
        Alert.success(`${result.Message}`,{displayDuration: 4000})
        getMarksheetDesignList()
      },
      error : function(err){
          $('#cover-spin').hide();
      }
    });
  })




  function getMarksheetDesignList(){
    $("#studentTableBody").html("")
    $.ajax({
          "url": url+"/Marksheet/getMarksheetDesignList",
          "type": "POST",
          headers: {
            'Authorization': 'Bearer ' + getCookie("Token")
          },
          success: function(result){
            console.log(result)
          $('#cover-spin').hide();
          if(result.Status=="OK"){
            $("#designTableBody").html("")
            $.each(result.MarksheetDesignList, function(i, item) {
              $("#designTableBody").append(
                `<tr>
                  <td>${i + 1}</td>
                  <td>${item.MarksheetTitle}</td>
                  <td><a href="CustomiseMarksheetDesign"><button class="btn btn-info">Customise Design</button></a></td></tr>`
                  );
                });
              }else if(result.Status=="NOT_FOUND"){
                $("#designTableBody").append(
                  `<tr>
                    <td colspan='5' style='color:#999'>
                      ${result.Message}
                    </td>
                  </tr>`
                  );
              }
            },
            error : function(err){
              $('#cover-spin').hide();
            }
          });
    }

    
  });