// $("#resultsheetcnt").html("sdkjgh")
var url = $("#url").val();
const urlParams = new URLSearchParams(window.location.search);
const SectionID = urlParams.get('SectionID');

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
  getStudentList();

function getStudentList(){
    let data = new FormData();
    data.append("SectionID",SectionID)
    $.ajax({
            "url": url+"/ResultSheet/getResultSheetData",
            "type": "POST",
            "data": data,
            contentType: false,       
            cache: false,             
            processData:false,
            headers: {
                'Authorization': 'Bearer ' + getCookie("Token")
            },
            success: function(result){
            $('#cover-spin').hide();
            },
            error : function(err){
            $('#cover-spin').hide();
            }
    });
}