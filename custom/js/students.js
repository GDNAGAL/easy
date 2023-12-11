$( document ).ready(function() {
    getclasslist()

    function getCookie(cookieName) {
        let cookie = {};
        document.cookie.split(';').forEach(function(el) {
          let [key,value] = el.split('=');
          cookie[key.trim()] = value;
        })
        return cookie[cookieName]+"==";
    }

    $(function () {
      $('.select2').select2()
    })
  
    var table = $('#studenttable').DataTable();
  
  $('#selectclass').on('change', function(){
     var table = $('#studenttable').DataTable();
     //clear datatable
     table.clear().draw();
     //destroy datatable
     table.destroy();
     //call funtion for get student data from database
     getstudents($(this).val())
  })
  
  //function for get data from database
  function getstudents(cls){
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
                //console.log(data)
                if (data == 'null') {
                var table = $('#studenttable').DataTable();
                    return ;
                }else{
        
                data = JSON.parse(data);  // Parse the JSON strin
                var table = $('#studenttable').DataTable({
                    data: data.data,  // Get the data object
                    retrieve: true,
                    destroy: true,
                    columns: [
                    { 'data': 'class_name' },
                    { 'data': 'rollno' },
                    { 'data': 'admissionno' },
                    { 'data': 'student_name',
                        "render": function ( data, type, row, meta ) {
                        return '<a href="">'+data+'</a>';
                        } 
                    },
                    { 'data': 'father_name' },
                    { 'data': 'mother_name' },
                    { 'data': 'dateofbirth' },
                    { 'data': 'gender' },
                    { 'data': 'category' },
                    { 'data': 'mobile' },
                    { 'data': 'aadhar' },
                    
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
                    $("#selectclass").append(result);
                    getstudents("all")
                },
                error : function(err){
                    $('#cover-spin').hide();
                }
          });
    }


})