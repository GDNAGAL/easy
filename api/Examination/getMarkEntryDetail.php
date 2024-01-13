<?php
// Path : 
include("../connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$headers = getallheaders();
	if (array_key_exists('Authorization', $headers) && preg_match('/Bearer\s(\S+)/', $headers['Authorization'], $matches)){

		if(verifyToken($matches[1])){
            $sid = getSchoolID($matches[1]);
			$ClassRoomID = $_POST['ClassRoomID'];
			$ExamID = $_POST['ExamID'];
			$StudentArr = [];
			$studentList = mysqli_query($conn, "SELECT * From Students WHERE ClassRoomID = '$ClassRoomID'");
			if(mysqli_num_rows($studentList)>0){
				while($studentRow = mysqli_fetch_assoc($studentList)){
					$StudentArr[] = $studentRow; 
				}
			}

			$selectSubject = mysqli_query($conn, "SELECT Distinct ed.SubjectID, su.SubjectName FROM examdesign ed JOIN subjects su ON ed.SubjectID = su.SubjectID WHERE ed.ClassRoomID = '$ClassRoomID'");
			http_response_code(200);
			header('Content-Type: application/json');
			if(mysqli_num_rows($selectSubject)>0){
			while($subjectRow = mysqli_fetch_assoc($selectSubject)){
				$subjectID = $subjectRow['SubjectID'];
				$subjectRow['Students'] = $StudentArr;
				$subjectRow['Exams'] = [];
				$examName = mysqli_query($conn, "SELECT * FROM exams WHERE ExamID IN (SELECT DISTINCT ExamID FROM `examdesign` WHERE ClassRoomID = '$ClassRoomID' AND SubjectID = '$subjectID')");
				while($examNameRow = mysqli_fetch_assoc($examName)){
					$ExamID = $examNameRow['ExamID'];
					$examNameRow['Papers'] = [];
					
					$paper = mysqli_query($conn, "SELECT PaperID ,PaperDisplayText, PaperMM FROM `examdesign` WHERE ExamID = '$ExamID' AND ClassRoomID = '$ClassRoomID' AND SubjectID = '$subjectID'");
					while($paperRow = mysqli_fetch_assoc($paper)){
						$examNameRow['Papers'][] = $paperRow;
					}

					$subjectRow['Exams'][] = $examNameRow;
				}
				$records[] = $subjectRow;
			}
				$data = array ("Status"=> "OK","Message" => "Success", "Subjects" => $records);
				echo json_encode( $data );
			}else{
				$data = array ("Status"=> "NOT_FOUND","Message" => "No Data Found");
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