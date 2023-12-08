<?php
// Path : api/ClassRooms/getClassRoomList
include("../connection.php");

if(isset($_POST['getclassrooms'])){

    $class = mysqli_query($conn, "SELECT * FROM `classrooms` WHERE ClassRoomID = 235");
    if (mysqli_num_rows($class)>0) {

		$classArray = [];
		while($row = mysqli_fetch_assoc($class)){
			$classArray[] = $row;
		}

		http_response_code(200);
		header('Content-Type: application/json');
		$data = array ("Status" => "Success", "ClassRoomList" => $classArray);
		echo json_encode( $data );

	}else{

		http_response_code(404);
		header('Content-Type: application/json');
		$data = array ("Status" => "Failed", "Message" => "No Data Found");
		echo json_encode( $data );

	}
	
}else{

	http_response_code(401);
    header('Content-Type: application/json');
    $data = array ("Message" => "UnAuthorized Access");
    echo json_encode( $data );
	
}

?>