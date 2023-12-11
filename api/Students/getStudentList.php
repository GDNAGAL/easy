<?php
// Path : api/Students/getStudentList
include("../connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$headers = getallheaders();
	if (array_key_exists('Authorization', $headers) && preg_match('/Bearer\s(\S+)/', $headers['Authorization'], $matches)){

		if(verifyToken($matches[1])){
            $sid = getSchoolID($matches[1]);
			$class = $_POST['cls'];

			if ($class == 'all') {
				$selectstudentlist = mysqli_query($conn, "SELECT * FROM `students` INNER JOIN `classrooms` ON students.student_class = classrooms.ClassRoomID WHERE students.school_id = '$sid'");
			}else{
				$selectstudentlist = mysqli_query($conn, "SELECT * FROM `students` INNER JOIN `classrooms` ON students.student_class = classrooms.ClassRoomID WHERE students.school_id = '$sid' AND students.student_class = '$class'");
			}

			while($row = mysqli_fetch_assoc($selectstudentlist)) {
			$records["data"][] = $row;
			}
			echo json_encode($records);

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