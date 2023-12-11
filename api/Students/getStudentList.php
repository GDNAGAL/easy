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
				$selectstudentlist = mysqli_query($conn, "SELECT * FROM `students` INNER JOIN `classrooms` ON students.ClassRoomID = classrooms.ClassRoomID WHERE students.SchoolID = '$sid'");
			}else{
				$selectstudentlist = mysqli_query($conn, "SELECT * FROM `students` INNER JOIN `classrooms` ON students.ClassRoomID = classrooms.ClassRoomID WHERE students.SchoolID = '$sid' AND students.ClassRoomID = '$class'");
			}

			http_response_code(200);
			header('Content-Type: application/json');
			if(mysqli_num_rows($selectstudentlist)>0){
				while($row = mysqli_fetch_assoc($selectstudentlist)) {
					$records[] = $row;
					}
				$data = array ("Status"=> "OK","Message" => "Success", "StudentList" => $records);
				echo json_encode( $data );
			}else{
				$data = array ("Status"=> "NOT_FOUND","Message" => "No Student Found");
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