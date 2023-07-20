<?php
include("../includes/connection.php");


//get Session Year List
if(isset($_POST['mobile'])){
$mobile = $_POST['mobile'];

$verifymobile = mysqli_query($conn, "SELECT * FROM `tbl_school_list` WHERE `mobile` = '$mobile'");
$countverift = mysqli_num_rows($verifymobile);
if($countverift>0){
$result = mysqli_query($conn, "SELECT * FROM `tbl_session_list` WHERE `school_username` = '$mobile'");
while($row = mysqli_fetch_assoc($result)) {
$next = $row['purchased_session']+1;
echo "<option value='$row[purchased_session]'>$row[purchased_session]-$next</option>";
}}
else{
	echo 0;
}
};


//Validate Login
if(isset($_POST['login'])){
	$myusername = mysqli_real_escape_string($conn,$_POST['username']);
    $mypassword = mysqli_real_escape_string($conn,$_POST['password']); 
	$session_year = $_POST['session_year'];
    

    //validate session
    $result = mysqli_query($conn, "SELECT * FROM `tbl_session_list` WHERE `school_username` = '$myusername' AND `purchased_session`='$session_year'");
    if (mysqli_num_rows($result)==1) {
    	$sql = mysqli_query($conn,"SELECT * FROM `tbl_school_list` WHERE username = '$myusername' and password = '$mypassword' AND status = 1");
	$rowcount = mysqli_num_rows($sql);
	if($rowcount==1){
		session_start();
		$_SESSION['schoolusername']=$myusername;
		$_SESSION['year']=$session_year;
		echo 1;
	}else{
		echo 0;
	}
   }else{
   	echo 0;
   }
	
};

?>