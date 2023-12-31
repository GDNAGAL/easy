<?php
// Path : api/ClassRooms/getClassRoomList
include("../connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$headers = getallheaders();
	if (array_key_exists('Authorization', $headers) && preg_match('/Bearer\s(\S+)/', $headers['Authorization'], $matches)){

		if(verifyToken($matches[1])){
            $sid = getSchoolID($matches[1]);
			// $class = mysqli_query($conn, "SELECT * FROM `classrooms` JOIN teachers ON classrooms.ClassTeacher = teachers.TeacherID WHERE classrooms.SchoolID = '$sid' ORDER by `ClassRoomID`");
			$class = mysqli_query($conn, "SELECT ClassRoomID,classrooms.Year,ClassRoomName,examgroups.DisplayText as ExamGroupDisplayText,TeacherID,TeacherName FROM `classrooms`
			 LEFT JOIN `teachers` ON `classrooms`.`ClassTeacher` = `teachers`.`TeacherID`
			 LEFT JOIN `examgroups` ON classrooms.ExamGroupID = examgroups.ExamGroupID
			 WHERE classrooms.SchoolID = '$sid' AND classrooms.ClassTeacher IS NULL OR classrooms.SchoolID = '$sid' AND teachers.TeacherID IS NOT NULL");
			http_response_code(200);
			header('Content-Type: application/json');
			if(mysqli_num_rows($class)>0){
				while($row = mysqli_fetch_assoc($class)) {
					$cid = $row['ClassRoomID'];
					$noofSubjects = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS totalSubject FROM `subjects` WHERE ClassRoomID = '$cid'"));
					$row["SubjectCount"] = $noofSubjects['totalSubject'];
					$records[] = $row;
					}
				$data = array ("Status"=> "OK","Message" => "Success", "ClassRoomList" => $records);
				echo json_encode( $data );
			}else{
				$data = array ("Status"=> "NOT_FOUND","Message" => "No Classroom Found");
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