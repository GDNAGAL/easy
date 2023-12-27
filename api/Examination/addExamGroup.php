<?php
// Path : api/Subjects/addSubject
include("../connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$headers = getallheaders();
	if (array_key_exists('Authorization', $headers) && preg_match('/Bearer\s(\S+)/', $headers['Authorization'], $matches)){

		if(verifyToken($matches[1])){
            $sid = getSchoolID($matches[1]);
			$examGroupName = $_POST['examGroupName'];

			
			$addExamGroup = mysqli_query($conn, "INSERT INTO `examgroups`(`DisplayText`, `SchoolID`, `Year`) VALUES ('$examGroupName','$sid','2023')");
			
			http_response_code(200);
			header('Content-Type: application/json');
			if($addExamGroup == TRUE){
				$data = array ("Status"=> "OK","Message" => "ExamGroup Added Successfully.");
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