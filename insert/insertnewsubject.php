<?php
include("../includes/connection.php");
include("../includes/session.php");

if (isset($_SESSION['year']) && isset($_POST['groupname']) && isset($_POST['new_subject_name'])) {
  $year = $_SESSION['year'];
  $group = $_POST['groupname'];
  $new_subject_name = $_POST['new_subject_name'];

  // Sanitize and validate input (consider using prepared statements).

  $sql = "INSERT INTO tbl_subjects(year, school_id, subject_group, subject_name) VALUES ('{$year}', '{$schoolid}', '{$group}', '{$new_subject_name}')";

  if (mysqli_query($conn, $sql)) {
    echo 1;
  } else {
    echo 0;
  }
} else {
  echo 0; // Handle the case when required data is not available in $_SESSION or $_POST.
}
?>
