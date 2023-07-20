<?php
include("../includes/connection.php");
include("../includes/session.php");

$selecttecherlist = mysqli_query($conn, "SELECT * FROM `tbl_school_classes` WHERE `school_id` = '$schoolid' AND `year`='$year' ORDER by `Id`");
while($row = mysqli_fetch_assoc($selecttecherlist)) {

 	echo "<option value='$row[Id]'>$row[class_name]</option>";
 }
?>