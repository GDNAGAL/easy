<?php
include("../includes/connection.php");
include("../includes/session.php");
error_reporting(0);

$class = $_POST['cls'];
//$records = array(''); 

if ($class == 'all') {
    $selectstudentlist = mysqli_query($conn, "SELECT * FROM `tbl_student` INNER JOIN `tbl_school_classes` ON tbl_student.student_class = tbl_school_classes.Id WHERE tbl_student.year = '$year' AND tbl_student.school_id = '$schoolid' ");
}else{
    $selectstudentlist = mysqli_query($conn, "SELECT * FROM `tbl_student` INNER JOIN `tbl_school_classes` ON tbl_student.student_class = tbl_school_classes.Id WHERE tbl_student.year = '$year' AND tbl_student.school_id = '$schoolid' AND tbl_student.student_class = '$class'");
}

while($row = mysqli_fetch_assoc($selectstudentlist)) {
$records["data"][] = $row;
 }
 echo json_encode($records);
?>
