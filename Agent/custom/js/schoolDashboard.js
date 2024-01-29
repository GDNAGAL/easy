$(function(){
    var url = $("#url").val();
    const urlParams = new URLSearchParams(window.location.search);
    const schoolID = urlParams.get('schoolID');

    getSchoolDashboardData()
    
    
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



    function getSchoolDashboardData(){
        $('#cover-spin').show(0)
        let data = new FormData();
        data.append("SchoolID",$("#schoolinputId").val());
        $.ajax({
            type: "POST",
            url: url +  '/Schools/getSchoolDashboardData',
            data:data,
            contentType: false,       
            cache: false,             
            processData:false,
            headers: {
            'Authorization': 'Bearer ' + getCookie("AToken")
            },
            success: function(result){
                $('#cover-spin').hide();
                $("#idSchoolName").html(result.SchoolList[0].SchoolName)
                $("#idHMName").html(result.SchoolList[0].SchoolHeadName)
                $("#idMobile").html("+91 "+result.SchoolList[0].SchoolHeadMobile)
                $("#idAddress").html(result.SchoolList[0].SchoolAddress)
                $("#sstatus").html(`<span class="label label-${result.SchoolList[0].StatusColor}">${result.SchoolList[0].StatusText}</span>`)
                //fill inputs
                $("#sid").val(result.SchoolList[0].SchoolID)
                $("#schoolName").val(result.SchoolList[0].SchoolName)
                $("#schoolAddress").val(result.SchoolList[0].SchoolAddress)
                $("#principal").val(result.SchoolList[0].SchoolHeadName)
                $("#headmobile").val(result.SchoolList[0].SchoolHeadMobile)
                $("#username").val(result.SchoolList[0].SchoolUserName)
                $("#password").val(result.SchoolList[0].SchoolPassword)
                $("#lbtn").html(`<a href="${$("#url").val()}/login?user=${result.SchoolList[0].SchoolUserName}&pass=${result.SchoolList[0].SchoolPassword}" target="_blank"><button class="btn btn-primary btn-block">Login To School Dashboard</button></a>`)
                $("#statusSelect").html("")
                let s = result.SchoolList[0].SchoolStatus;
                $.each(result.StatusArr, function(i, item) {
                    if(item.SchoolStatusID == s){
                        $("#statusSelect").append(`<option value="${item.SchoolStatusID}" selected>${item.StatusText}</option>`);
                    }else{
                        $("#statusSelect").append(`<option value="${item.SchoolStatusID}">${item.StatusText}</option>`);
                    }
                })
                


                if(result.ClassRooms.length>0){
                    let isSubjects = false;
                    $("#classlist").html('');
                    $("#classBox").removeClass("box-danger")
                    $("#classBox").addClass("box-success")
                    $("#classStatusLogo").addClass("fa fa-check-circle bg-green");
                    $("#classHeading").addClass("text-green");
                    $("#classStatusIcon").html(`<i class="fa fa-check-circle text-green"></i> <span class="text-green">Completed</span>`);
                    $.each(result.ClassRooms, function(i, item) {
                        if(item.Subjects.length>0){
                            isSubjects = true;
                        }else{
                            isSubjects = false;
                        }
                        $("#classlist").append(`<span class="label label-success" style="margin-right:5px">${item.ClassRoomName} (${item.SectionText})</span>`)
                    })
                    $("#classlist").append(`<button class="btn btn-danger btn-sm" style="margin-top:10px">UNDO</button>`)
                    
                    
                    //subjects
                    $("#Subjectlist").html(`<button class="btn btn-danger btn-flat" id="genratesubjects">Genrate Subjects</button>`)
                    $("#examlist").html(`<strong class="text-muted">Please Complete Above All Steps.</strong>`)
                    $("#activateAccountlist").html(`<strong class="text-muted">Please Complete Above All Steps.</strong>`)
                    
                    if(isSubjects){
                        //set Subjects
                        setSubjects(result.ClassRooms);
                        if(result.isExamAdded == true){
                            setExams()
                        }
                        if(result.isSchoolActive == true){
                            $("#activateAccountBox").removeClass("box-danger")
                            $("#activateAccountBox").addClass("box-success")
                            $("#activateAccountStatusLogo").addClass("fa fa-check-circle bg-green");
                            $("#finalStatusLogo").addClass("fa fa-check-circle bg-green");
                            $("#activateAccountHeading").addClass("text-green");
                            $("#activateAccountStatusIcon").html(`<i class="fa fa-check-circle text-green"></i> <span class="text-green">Completed</span>`);
                            $("#activateAccountlist").html(`<strong class="text-muted text-green"><i class="fa fa-check-circle"></i> School Activated Successfully.</strong>`)
                        }
                    }
                }else{
                    $("#classlist").html(`<button class="btn btn-danger btn-flat" id="genrateclassrooms">Genrate Class Rooms</button>`)
                    $("#Subjectlist").html(`<strong class="text-muted">Please Complete Above All Steps.</strong>`)
                    $("#examlist").html(`<strong class="text-muted">Please Complete Above All Steps.</strong>`)
                    $("#activateAccountlist").html(`<strong class="text-muted">Please Complete Above All Steps.</strong>`)
                }
            },
            error : function(err){
                $('#cover-spin').hide();
            }
        });
    }

    function setSubjects(data){
        if(data.length>0){
            $("#subjectBox").removeClass("box-danger")
            $("#subjectBox").addClass("box-success")
            $("#subjectStatusLogo").addClass("fa fa-check-circle bg-green");
            $("#subjectHeading").addClass("text-green");
            $("#subjectStatusIcon").html(`<i class="fa fa-check-circle text-green"></i> <span class="text-green">Completed</span>`);
            $("#Subjectlist").html(`<table id="subjectTable" class="table table-striped">
            <tr>
            <th>Class</th>
            <th><div style='display:flex'><div style="width:30%">Subjects</div> <div class='text-right' style="width:70%"><span class="scard" style='background:green'>COMPULSORY SUBJECTS</span><span class="scard" style='background:orange'>OPTIONAL SUBJECTS</span></div></div></th>
            </tr>
            </table>`);
            let CsubjectsHtml = "";
            let OsubjectsHtml = "";
    
            $.each(data, function(i, item) {
                 CsubjectsHtml="";
                 OsubjectsHtml="";
                $.each(item.Subjects, function (i, subject) {
                    if(subject.SubjectTypeID == 1){
                        CsubjectsHtml += `<span class="scard" style='background:green'>${subject.SubjectName}</span>`;
                    }else if(subject.SubjectTypeID == 2){
                        OsubjectsHtml += `<span class="scard" style='background:orange'>${subject.SubjectName}</span>`;
                    }
                });
                $("#subjectTable").append(`<tr>
                    <td class="text-center text-green text-bold">${item.ClassRoomName} ${item.SectionText}</td>
                    <td>
                        <div>${CsubjectsHtml}</div>
                        <div>${OsubjectsHtml}</div>
                    </td>
                </tr>`);
            })
            $("#subjectTable").append(`<button class="btn btn-danger btn-sm">UNDO</button>`)
            $("#examlist").html(`<button class="btn btn-danger btn-flat" id="examAddBtn">Add Exam Details</button>`)
            $("#activateAccountlist").html(`<strong class="text-muted">Please Complete Above All Steps.</strong>`)
        }
    }

    function setExams(){
            $("#examBox").removeClass("box-danger")
            $("#examBox").addClass("box-success")
            $("#examStatusLogo").addClass("fa fa-check-circle bg-green");
            $("#examHeading").addClass("text-green");
            $("#examStatusIcon").html(`<i class="fa fa-check-circle text-green"></i> <span class="text-green">Completed</span>`);
            $("#examlist").html(`<strong class="text-muted text-green"><i class="fa fa-check-circle"></i> Exam Added Successfully. <button class="btn btn-danger pull-right btn-sm">UNDO</button></strong>`)
            $("#activateAccountlist").html(`<button class="btn btn-danger btn-flat" id="activateAccountBtn">Activate Account</button>`)
    }
    //create Classrooms
    $(document).on("click","#genrateclassrooms",function(){
        $('#cover-spin').show(0)
        let data = new FormData();
        data.append("SchoolID",$("#schoolinputId").val());
        $.ajax({
            type: "POST",
            url: url +  '/Schools/createClassRooms',
            data:data,
            contentType: false,       
            cache: false,             
            processData:false,
            headers: {
            'Authorization': 'Bearer ' + getCookie("AToken")
            },
            success: function(result){
                if(result.Status=="ERROR"){
                    $('#cover-spin').hide();
                    // success,info,error,warning,trash
                    Alert.error(`${result.Message}`,{displayDuration: 4000})
                    return;
                }
                getSchoolDashboardData()
            },
            error : function(err){
                $('#cover-spin').hide();
            }
        });
    })

    //create Subject
    $(document).on("click","#genratesubjects",function(){
        $('#cover-spin').show()
        let data = new FormData();
        data.append("SchoolID",$("#schoolinputId").val());
        $.ajax({
            type: "POST",
            url: url +  '/Schools/createSubjects',
            data:data,
            contentType: false,       
            cache: false,             
            processData:false,
            headers: {
            'Authorization': 'Bearer ' + getCookie("AToken")
            },
            success: function(result){
                if(result.Status=="ERROR"){
                    $('#cover-spin').hide();
                    // success,info,error,warning,trash
                    Alert.error(`${result.Message}`,{displayDuration: 4000})
                    return;
                }
                getSchoolDashboardData()
            },
            error : function(err){
                $('#cover-spin').hide();
            }
        });
    })

    //create Exams
    $(document).on("click","#examAddBtn",function(){
        $('#cover-spin').show()
        let data = new FormData();
        data.append("SchoolID",$("#schoolinputId").val());
        $.ajax({
            type: "POST",
            url: url +  '/Schools/createExams',
            data:data,
            contentType: false,       
            cache: false,             
            processData:false,
            headers: {
            'Authorization': 'Bearer ' + getCookie("AToken")
            },
            success: function(result){
                if(result.Status=="ERROR"){
                    $('#cover-spin').hide();
                    // success,info,error,warning,trash
                    Alert.error(`${result.Message}`,{displayDuration: 4000})
                    return;
                }
                getSchoolDashboardData()
            },
            error : function(err){
                $('#cover-spin').hide();
            }
        });
    })

    //Activate School
    $(document).on("click","#activateAccountBtn",function(){
        $('#cover-spin').show()
        let data = new FormData();
        data.append("SchoolID",$("#schoolinputId").val());
        $.ajax({
            type: "POST",
            url: url +  '/Schools/activateSchool',
            data:data,
            contentType: false,       
            cache: false,             
            processData:false,
            headers: {
            'Authorization': 'Bearer ' + getCookie("AToken")
            },
            success: function(result){
                if(result.Status=="ERROR"){
                    $('#cover-spin').hide();
                    // success,info,error,warning,trash
                    Alert.error(`${result.Message}`,{displayDuration: 4000})
                    return;
                }
                getSchoolDashboardData()
            },
            error : function(err){
                $('#cover-spin').hide();
            }
        });
    })

    $("#username").on("blur",function(){
        $('#cover-spin').show(0);
        $("#updatebtn").prop("disabled",true);
        $("#validateusername").html("");
        let data = new FormData();
        data.append("UserID",$("#username").val());
        data.append("SchoolID",$("#sid").val());
        $.ajax({
            type: "POST",
            url: url +  '/Schools/ValidateUserName',
            data:data,
            contentType: false,       
            cache: false,             
            processData:false,
            headers: {
            'Authorization': 'Bearer ' + getCookie("AToken")
            },
            success: function(result){
                $('#cover-spin').hide();
                $("#updatebtn").prop("disabled",false);
                $("#validateusername").html(`<span class="text-green"><i class="fa fa-check-circle"></i> ${result.Message}</span>`);
            },
            error : function(err){
                $('#cover-spin').hide();
                $("#validateusername").html(`<span class="text-danger"><i class="fa fa-check-circle"></i> ${err.responseJSON.Message}</span>`);
            }
        });
    })

    $("#updateSchoolForm").on("submit",function(e){
        e.preventDefault()
        $('#cover-spin').show(0);
        let data = new FormData(this);
        $.ajax({
            type: "POST",
            url: url +  '/Schools/UpdateSchool',
            data:data,
            contentType: false,       
            cache: false,             
            processData:false,
            headers: {
            'Authorization': 'Bearer ' + getCookie("AToken")
            },
            success: function(result){
                $('#cover-spin').hide();
                // success,info,error,warning,trash
                Alert.success(`${result.Message}`,{displayDuration: 7000})
                getSchoolDashboardData()
                $("#updatebtn").prop("disabled",false);
                $("#validateusername").html('');

            },
            error : function(err){
                $('#cover-spin').hide();
                // success,info,error,warning,trash
                Alert.error(`${err.responseJSON.Message}`,{displayDuration: 4000})
                getSchoolDashboardData()
                $("#validateusername").html('');
            }
        });
    })


})


