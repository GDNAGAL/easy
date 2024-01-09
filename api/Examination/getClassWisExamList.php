<?php
// Path : 
include("../connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$headers = getallheaders();
	if (array_key_exists('Authorization', $headers) && preg_match('/Bearer\s(\S+)/', $headers['Authorization'], $matches)){

		if(verifyToken($matches[1])){
            $sid = getSchoolID($matches[1]);

			$selectClass = mysqli_query($conn, "SELECT ClassRoomName, ClassRoomID FROM `classrooms` WHERE SchoolID = '$sid'");
			http_response_code(200);
			header('Content-Type: application/json');
			if(mysqli_num_rows($selectClass)>0){
			while($classRow = mysqli_fetch_assoc($selectClass)){
				$classRoomID = $classRow['ClassRoomID'];
				$classRow['ExamList'] = [];
					$selectExam = mysqli_query($conn, "SELECT Distinct ed.ExamID, et.ExamText FROM examdesign ed JOIN exams et ON ed.ExamID = et.ExamID WHERE ClassRoomID = '$classRoomID'");
					while($examRow = mysqli_fetch_assoc($selectExam)){
						$classRow['ExamList'][] = $examRow;
					}
				$records[] = $classRow;
			}
				$data = array ("Status"=> "OK","Message" => "Success", "ClassRoom" => $records);
				echo json_encode( $data );
			}else{
				$data = array ("Status"=> "NOT_FOUND","Message" => "No Exams are Found");
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