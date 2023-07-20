<?php
include("../includes/connection.php");
include("../includes/session.php");
$class_teacherid = $_POST['class_teacherid'];

$selecttecherlist = mysqli_query($conn, "SELECT * FROM `tbl_teachers` WHERE `school_id` = '$schoolid' AND `year`='$year'");
while($row = mysqli_fetch_assoc($selecttecherlist)) {
 if($class_teacherid == $row['Id']){
 	echo "<option value='$row[Id]' selected>$row[teacher_name]</option>";
 }else{
 	echo "<option value='$row[Id]'>$row[teacher_name]</option>";
 }

}

?>