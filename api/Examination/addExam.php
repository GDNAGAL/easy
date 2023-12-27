<?php
// Path : api/Subjects/addSubject
include("../connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$headers = getallheaders();
	if (array_key_exists('Authorization', $headers) && preg_match('/Bearer\s(\S+)/', $headers['Authorization'], $matches)){

		if(verifyToken($matches[1])){
            $sid = getSchoolID($matches[1]);
			$ClassRoomID = $_POST['ClassRoomID'];
			$exam_name = $_POST['exam_name'];

			
			$addExam = mysqli_query($conn, "INSERT INTO `examsclasswise`(`Year`, `SchoolID`, `ClassID`, `ExamName`, `isSubType`, `MaxMarks`, `DisplayOrder`) VALUES ('2023','$sid','$ClassRoomID','$exam_name','0','00','0')");
			
			http_response_code(200);
			header('Content-Type: application/json');
			if($addExam == TRUE){
				$data = array ("Status"=> "OK","Message" => "Exam Added Successfully.");
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