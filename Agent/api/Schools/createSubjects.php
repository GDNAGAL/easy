<?php
// Path : api/ClassRooms/addClassRoom
include("../connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$headers = getallheaders();
	if (array_key_exists('Authorization', $headers) && preg_match('/Bearer\s(\S+)/', $headers['Authorization'], $matches)){

		if(verifyToken($matches[1])){
			$schoolID = $_POST['SchoolID'];
			$checkDuplicateSujects = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as sc FROM `subjects` WHERE SchoolID = '$schoolID'"));
			if($checkDuplicateSujects['sc'] == 0){
				$classRoom = mysqli_query($conn, "SELECT * FROM `classrooms` WHERE SchoolID = '$schoolID'");
				if(mysqli_num_rows($classRoom)>0){
					while($row = mysqli_fetch_assoc($classRoom)){
						$ClassIndex = $row['ClassIndex'];
						$classRoomID = $row['ClassRoomID'];

						//for up to second class
						if($ClassIndex>=0 && $ClassIndex<=4){
							$subjectComp = ["HINDI", "ENGLISH","MATHEMATICS"];
							$subjectOptional = ["EVS", "HEALTH EDUCATION","WORK EXPERIENCE","ART EDUCATION"];
						//for 3rd and 4th class
						}elseif($ClassIndex>=5 && $ClassIndex<=6){
							$subjectComp = ["HINDI", "ENGLISH","MATHEMATICS","EVS"];
							$subjectOptional = ["HEALTH EDUCATION","WORK EXPERIENCE","ART EDUCATION"];
						//for 6th and 7th class
						}elseif($ClassIndex>=7 && $ClassIndex<=8){
							$subjectComp = ["HINDI", "ENGLISH","MATHEMATICS","SOCIAL SCIENCE","SCIENCE","SANSKRIT"];
							$subjectOptional = ["H & P EDUCATION","WORK EXPERIENCE","ART EDUCATION"];
						//for 9th class
						}elseif($ClassIndex==9){
							$subjectComp = ["HINDI", "ENGLISH","MATHEMATICS","SOCIAL SCIENCE","SCIENCE","SANSKRIT"];
							$subjectOptional = ["राज. की शौर्य प. एंव स्वतंत्रता संग्राम","H & P EDUCATION","Fou. Of Info. Tech.","SUPW","ART EDUCATION"];
						}

						//for compulsory subjects
						foreach ($subjectComp as $subject) {
							$addSchool = mysqli_query($conn, "INSERT INTO `subjects`(`Year`, `SchoolID`, `ClassRoomID`, `SubjectName`, `SubjectTypeID`, `SubjectTeacher`) VALUES ('2023','$schoolID','$classRoomID','$subject',1,NULL)");
						}

						//for optional subjects
						foreach ($subjectOptional as $subject) {
							$addSchool = mysqli_query($conn, "INSERT INTO `subjects`(`Year`, `SchoolID`, `ClassRoomID`, `SubjectName`, `SubjectTypeID`, `SubjectTeacher`) VALUES ('2023','$schoolID','$classRoomID','$subject',2,NULL)");
						}
					}
				}
				http_response_code(200);
				header('Content-Type: application/json');
				$data = array ("Status"=> "OK", "Message" => "Subject Added Successfully.");
				echo json_encode( $data );
			}else{
				http_response_code(200);
				header('Content-Type: application/json');
				$data = array ("Status"=> "ERROR", "Message" => "Subjects Already Added");
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