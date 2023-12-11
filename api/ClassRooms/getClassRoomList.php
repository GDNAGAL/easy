<?php
// Path : api/ClassRooms/getClassRoomList
include("../connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$headers = getallheaders();
	if (array_key_exists('Authorization', $headers) && preg_match('/Bearer\s(\S+)/', $headers['Authorization'], $matches)){

		if(verifyToken($matches[1])){
            $sid = getSchoolID($matches[1]);
			$class = mysqli_query($conn, "SELECT * FROM `classrooms` WHERE `School` = '$sid' ORDER by `ClassRoomID`");
			while($row = mysqli_fetch_assoc($class)) {

				echo "<option value='$row[ClassRoomID]'>$row[ClassRoomName]</option>";

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