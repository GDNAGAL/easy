$( document ).ready(function() {
    getclasslist()

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
  
    $('#studenttable').DataTable();
  
  $('#selectclass').on('change', function(){
        var table = $('#studenttable').DataTable();
        table.clear().draw();
        table.destroy();
        
        getstudents($(this).val())
  })
  
  //function for get data from database
  function getstudents(cls){
        // $('#cover-spin').show(0);
        const dataa = {cls : cls};
        $.ajax({
            "url": "api/Students/getStudentList",
            "type": "POST",
            "data": dataa,
            "datatype": 'json',
            "async": false,
            headers: {
                'Authorization': 'Bearer ' + getCookie("Token")
            },
            "success": function (data) {
                $('#cover-spin').hide();
                if (data.Status == 'NOT_FOUND') {
                    
                    $('#studenttable').DataTable();
                    return ;
                    
                }else{
                    
                    $('#studenttable').DataTable({
                        data: data.StudentList,  // Get the data object
                        // retrieve: true,
                        // destroy: true,
                        filter:true,
                        lengthMenu : [
                            [10,20,50,75,100,-1],
                            [10,20,50,75,100,"ALL"]

                        ],
                        pageLength : 10,
                        language : {
                            lengthMenu: "_MENU_ Records Per Page.",
                            info: "", 
                            infoEmpty: "No Student Found.",
                            zeroRecords: "No Student Found."
                        },
                        columns: [
                        { 'data': 'ClassRoomName' },
                        { 'data': 'RollNo' },
                        { 'data': 'StudentName',
                            "render": function ( data, type, row, meta ) {
                            return '<a href="">'+data+'</a>';
                            } 
                        },
                        { 'data': 'StudentFatherName' },
                        { 'data': 'StudentMotherName' },
                        { 'data': 'DateofBirth' },
                        { 'data': 'Gender' },
                        
                        ],
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print' // Add the buttons you want
                        ]
                    })
                }
            }
        })
    }


    function getclasslist(){
        $.ajax({
                type: "POST",
                url: 'api/ClassRooms/getClassRoomList.php',
                headers: {
                    'Authorization': 'Bearer ' + getCookie("Token")
                },
                success: function(result){
                    $('#cover-spin').hide();
                    $.each(result.ClassRoomList, function(i, item) {
                        $("#selectclass").append(`<option value="${item.SectionID}">${item.ClassRoomName} ${item.SectionText}</option>`);
                    })
                    
                    var table = $('#studenttable').DataTable();
                    //clear datatable
                    table.clear().draw();
                    //destroy datatable
                    table.destroy();
                    // getstudents("all");
                },
                error : function(err){
                    $('#cover-spin').hide();
                }
          });
    }


})