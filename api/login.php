<?php
include("connection.php");
require("encryption.php");
date_default_timezone_set("Asia/Calcutta");
//Validate Login
if(isset($_POST['login'])){
	$myusername = mysqli_real_escape_string($conn,$_POST['username']);
    $mypassword = mysqli_real_escape_string($conn,$_POST['password']); 

    $result = mysqli_query($conn, "SELECT SchoolName, SchoolAddress, SchoolHeadName, SchoolHeadMobile, CurrentYear FROM `schools` WHERE `SchoolUserName` = '$myusername' AND `SchoolPassword` = '$mypassword'");
    if (mysqli_num_rows($result)==1) {

		$schoolArray = [];
		$row = mysqli_fetch_assoc($result);
		$row['LoginTime'] = date("Y-m-d h:m:s"); 
		$schoolArray[] = $row;
		

		$accesstoken = encrypt(json_encode($schoolArray));
		http_response_code(200);
		header('Content-Type: application/json');
		$data = array ("Status" => "Success", "Message" => "Login Success", "UserData" => $schoolArray, "Token" => $accesstoken);
		echo json_encode( $data );

	}else{

		http_response_code(401);
		header('Content-Type: application/json');
		$data = array ("Status" => "Failed", "Message" => "Wrong UserName And Password");
		echo json_encode( $data );

	}
	
}else{

	http_response_code(401);
    header('Content-Type: application/json');
    $data = array ("Message" => "UnAuthorized Access");
    echo json_encode( $data );
	
}

?>