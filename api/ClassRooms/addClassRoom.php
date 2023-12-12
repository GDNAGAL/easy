<?php
// Path : api/ClassRooms/addClassRoom
include("../connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$headers = getallheaders();
	if (array_key_exists('Authorization', $headers) && preg_match('/Bearer\s(\S+)/', $headers['Authorization'], $matches)){

		if(verifyToken($matches[1])){
            $sid = getSchoolID($matches[1]);
			$classRoomName = $_POST['classRoomName'];
			$classTeacherName = $_POST['classTeacherName'];
			if($classTeacherName == "" || $classTeacherName == null){
				$addClass = mysqli_query($conn, "INSERT INTO `classrooms`(`Year`, `SchoolID`, `ClassRoomName`, `ClassTeacher`) VALUES ('2023','$sid','$classRoomName',NULL)");
			}else{
				$addClass = mysqli_query($conn, "INSERT INTO `classrooms`(`Year`, `SchoolID`, `ClassRoomName`, `ClassTeacher`) VALUES ('2023','$sid','$classRoomName','$classTeacherName')");
			}
			http_response_code(200);
			header('Content-Type: application/json');
			if($addClass == TRUE){
				$data = array ("Status"=> "OK","Message" => "Class Room Added Successfully.");
				echo json_encode( $data );
			}else{
				$data = array ("Status"=> "ERROR","Message" => "Failed");
				echo json_encode( $data );
			}

		}else{
			http_response_code(401);
			header('Content-Type: application/json');
			$data = array ("Message" => "Unauthorized");
			echo json_encode( $data );
		}

	}else{
		http_response_code(401);
		header('Content-Type: application/json');
		$data = array ("Message" => "Unauthorized");
		echo json_encode( $data );
	}
}

?>