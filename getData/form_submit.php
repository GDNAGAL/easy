<?php
include("../includes/connection.php");
include("../includes/session.php");
error_reporting(0);
//edit Class Info
if(isset($_POST['updateclass'])){
	$class_id=$_POST['class_id'];
	$class_name=$_POST['class_name'];
	$class_teacher=$_POST['class_teacher'];


    if($class_id==0){
        $result = mysqli_query($conn, "INSERT INTO `tbl_school_classes`(`year`, `school_id`, `class_name`, `class_teacher`) VALUES ('$year','$schoolid','$class_name','$class_teacher')");
        if ($result==True) {
        	echo 1;
        }else{
        echo 1;	
        }
 
    }else{
    	$classupdatesql=mysqli_query($conn, "UPDATE `tbl_school_classes` SET `class_name`='$class_name', `class_teacher`='$class_teacher' WHERE `tbl_school_classes`.`Id`='$class_id'");
    	if ($classupdatesql==True) {
    		echo 1;
    	}else{
    		echo 0;
    	}
		
    }
	
}

//Add Student 
if (isset($_POST['addstudent'])) {
	$studentname = $_POST['studentname'];
	$fathername = $_POST['fathername'];
	$mothername = $_POST['mothername'];
	$dob = $_POST['dob'];
	$category = $_POST['category'];
	$address = $_POST['address'];
	$studentclass = $_POST['studentclass'];
	$adno = $_POST['adno'];
	$gender = $_POST['gender'];
	$rollno = $_POST['rollno'];
	$mobile = $_POST['mobile'];
	$aadhar = $_POST['aadhar'];

$insertstudent = mysqli_query($conn, "INSERT INTO `tbl_student`(`year`, `school_id`, `student_name`, `father_name`, `mother_name`, `dateofbirth`, `category`, `address`, `student_class`, `admissionno`, `gender`, `rollno`, `mobile`, `aadhar`, `photo`) VALUES ('$year','$schoolid','$studentname','$fathername','$mothername','$dob','$category','$address','$studentclass','$adno','$gender','$rollno','$mobile','$aadhar','')");
if ($insertstudent==True) {
	echo 1;
}else{
	echo 0;
}

}

?>