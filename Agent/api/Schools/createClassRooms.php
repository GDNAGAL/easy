<?php
// Path : api/ClassRooms/addClassRoom
include("../connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$headers = getallheaders();
	if (array_key_exists('Authorization', $headers) && preg_match('/Bearer\s(\S+)/', $headers['Authorization'], $matches)){

		if(verifyToken($matches[1])){
			$schoolID = $_POST['SchoolID'];
			$checkDuplicateClassRooms = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as sc FROM `classrooms` WHERE SchoolID = '$schoolID'"));
			if($checkDuplicateClassRooms['sc'] == 0){
				$className = ["PP3+", "PP4+","PP5+", "1st", "2nd", "3rd", "4th", "5th", "6th", "7th", "8th", "9th"];
				foreach ($className as $index => $class) {
				$addClassRoom = mysqli_query($conn, "INSERT INTO `classrooms`(`Year`, `SchoolID`, `ClassRoomName`, `ClassTeacher`, `ExamGroupID`, `ClassIndex`)  VALUES ('2023','$schoolID','$class',NULL,NULL,'$index')");
				$ClassRoomID = mysqli_insert_id($conn);
				$addClassRoom_Section = mysqli_query($conn, "INSERT INTO `classrooms_sections`(`ClassRoomID`, `SectionText`, `ClassTeacher`)  VALUES ('$ClassRoomID','A',NULL)");
				}
				http_response_code(200);
				header('Content-Type: application/json');
				$data = array ("Status"=> "OK", "Message" => "ClassRoom Added Successfully.");
				echo json_encode( $data );
			}else{
				http_response_code(200);
				header('Content-Type: application/json');
				$data = array ("Status"=> "ERROR", "Message" => "ClassRoom Already Added");
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