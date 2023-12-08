<?php
// Path : api/Dashboard/getDashboardData

include("../connection.php");
require("../encryption.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET'){
	$headers = getallheaders();
	if (array_key_exists('Authorization', $headers) && preg_match('/Bearer\s(\S+)/', $headers['Authorization'], $matches)){
		$data = decrypt(json_encode($matches[1]));
		echo $data;
	}else{
		echo "Missing";
	}
}

// if(isset($_POST['getstudent'])){

//     $student = mysqli_query($conn, "SELECT * FROM `students`");
//     if (mysqli_num_rows($student)>0) {

// 		$studentArr = [];
// 		while($row = mysqli_fetch_assoc($student)){
// 			$studentArr[] = $row;
// 		}

// 		http_response_code(200);
// 		header('Content-Type: application/json');
// 		$data = array ("Status" => "Success", "StudentList" => $studentArr);
// 		echo json_encode( $data );

// 	}else{

// 		http_response_code(404);
// 		header('Content-Type: application/json');
// 		$data = array ("Status" => "Failed", "Message" => "No Data Found");
// 		echo json_encode( $data );

// 	}
	
// }else{

// 	http_response_code(401);
//     header('Content-Type: application/json');
//     $data = array ("Message" => "UnAuthorized Access");
//     echo json_encode( $data );
	
// }

?>