<?php
// Path : 
include("../connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$headers = getallheaders();
	if (array_key_exists('Authorization', $headers) && preg_match('/Bearer\s(\S+)/', $headers['Authorization'], $matches)){

		if(verifyToken($matches[1])){
            $sid = getSchoolID($matches[1]);
		

			$examlist = mysqli_query($conn, "SELECT * FROM `classrooms` WHERE SchoolID = '$sid'");

			http_response_code(200);
			header('Content-Type: application/json');
			if(mysqli_num_rows($examlist)>0){
				while($row = mysqli_fetch_assoc($examlist)) {
                    $cid = $row['ClassRoomID'];
                    $examl = mysqli_query($conn, "SELECT * FROM `examsclasswise` WHERE SchoolID = '$sid' AND ClassID = '$cid'");
                    while($exam = mysqli_fetch_assoc($examl)){
                         $row['ExamsDetail'][] = $exam;
                    }

					$records[] = $row;

					}
				$data = array ("Status"=> "OK","Message" => "Success", "ClassRoomList" => $records);
				echo json_encode( $data );
			}else{
				$data = array ("Status"=> "NOT_FOUND","Message" => "No Classrooms And Exams are Found");
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