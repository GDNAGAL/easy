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
				$ClassRoomID = $classRow['ClassRoomID'];
				$totalPaper = mysqli_num_rows(mysqli_query($conn, "SELECT * From examdesign WHERE ClassRoomID = '$ClassRoomID'"));
				$totalPaperMarks = mysqli_num_rows(mysqli_query($conn, "SELECT * From student_paper_marks WHERE ClassRoomID = '$ClassRoomID'"));
				$totalStudents = mysqli_num_rows(mysqli_query($conn, "SELECT * From Students WHERE ClassRoomID = '$ClassRoomID'"));
				$s = $totalPaper * $totalStudents;
				$c_percent = 0;
				if($s != 0){
					$c_percent = ($totalPaperMarks * 100) / ($totalPaper * $totalStudents);
				}
				$classRow['CompletedPercent'] = round($c_percent,2);
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