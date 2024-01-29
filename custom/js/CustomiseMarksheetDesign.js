$( document ).ready(function() {
  var url = $("#url").val();
  getPageSize()
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

  $("#pageSize").on("change",function(){
    SetDesign()
  })
  $("#otn").on("change",function(){
    SetDesign()
  })
  $("#topSectionBackground").on("input",function(){
    SetDesign()
  })
  $("#snamefontsize").on("change",function(){
    SetDesign()
  })
  $("#showLogo").on("change",function(){
    SetDesign()
  })


  function setZoom(zoom,el) {
      
    transformOrigin = [0,0];
    // el = el || instance.getContainer();

    var p = ["webkit", "moz", "ms", "o"],
          s = "scale(" + zoom + ")",
          oString = (transformOrigin[0] * 100) + "% " + (transformOrigin[1] * 100) + "%";

    for (var i = 0; i < p.length; i++) {
        el.style[p[i] + "Transform"] = s;
        el.style[p[i] + "TransformOrigin"] = oString;
    }

    el.style["transform"] = s;
    el.style["transformOrigin"] = oString;
    
}

//setZoom(5,document.getElementsByClassName('container')[0]);

$("#rage").on("change",function(){
  showVal($(this).val())
})

function showVal(a){
 var zoomScale = Number(a)/10;
 setZoom(zoomScale,document.getElementById('designCnt'))
}


  function SetDesign(){
    
    let Width = $('#pageSize option:selected').attr('Width');
    let Height = $('#pageSize option:selected').attr('Height');
    let Orientation = $("#otn").val();
    if(Orientation == "P"){
      Width = $('#pageSize option:selected').attr('Width');
      Height = $('#pageSize option:selected').attr('Height');
    }else if(Orientation == "L"){
      Width = $('#pageSize option:selected').attr('Height');
      Height = $('#pageSize option:selected').attr('Width');
    }
    let topSectionBackgroundColorValue = $('#topSectionBackground').val();
    let snamefontsize = $("#snamefontsize").val();
    let showLogo = false;
    $(".logos").html('')
    if($('#showLogo').prop('checked')){
      showLogo = true;
      $(".logos").html(`<img id="logo" src="dist/img/logo.png" width="150px"/>`);
    }





    showVal($("#rage").val())
    $("#designCnt").width(Width);
    $("#designCnt").height(Height);
    $("#topSection").css({
      "background-color":topSectionBackgroundColorValue
    })
    $("#mainHeading").css({
      "font-size":`${snamefontsize}px`
    })
  }


  function getPageSize(){
    $("#pageSize").html("")
    $.ajax({
          "url": "api/getPageSize",
          "type": "POST",
          headers: {
            'Authorization': 'Bearer ' + getCookie("Token")
          },
          success: function(result){
          $('#cover-spin').hide();
            $.each(result.PageSizeList, function(i, item) {
              $("#pageSize").append(`<option value="${item.PageSizeID}" Width="${item.WidthPx}" Height="${item.HeightPx}">${item.Title}</option>`);
            })
            SetDesign();
          },
            error : function(err){
              $('#cover-spin').hide();
            }
          });
  }
})