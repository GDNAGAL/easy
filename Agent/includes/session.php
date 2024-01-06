<?php 
session_start();
require('connection.php');
$schoolusername=$_SESSION['schoolusername'];
$year=$_SESSION['year'];
$getschooldata = mysqli_query($conn,"SELECT * FROM `tbl_school_list` WHERE username = '$schoolusername'");
while($row = mysqli_fetch_assoc($getschooldata)){
  $schoolid=$row['Id'];
  $nameofschool=$row['nameofschool'];
  $schooladdress=$row['address'];
  $name_of_hm=$row['name_of_hm'];
  $nameofschool=$row['nameofschool'];
}
if (!isset($_SESSION['schoolusername'])||!isset($_SESSION['year'])) {
	header("Location:login");
}

// create Functions 
function teachername($id) {
global $year;
global $conn;
global $schoolid;
$getteacher = mysqli_query($conn,"SELECT * FROM `tbl_teachers` WHERE `Id`='$id' AND `year` = '$year' AND `school_id`='$schoolid'");
while($row = mysqli_fetch_assoc($getteacher)){
  echo $row['teacher_name'];
}
}

?>