<?php
// Path : api/Teachers/getTeacherList
include("../connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$headers = getallheaders();
	if (array_key_exists('Authorization', $headers) && preg_match('/Bearer\s(\S+)/', $headers['Authorization'], $matches)){

		if(verifyToken($matches[1])){
			$schoolID = $_POST['SchoolID'];

			$classArray = [];
			$schoolslist = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SchoolName, SchoolHeadName, SchoolHeadMobile, SchoolAddress FROM `schools` WHERE SchoolID = '$schoolID'"));

			$classlist = mysqli_query($conn, "SELECT ClassRoomName,ClassRoomID FROM `classrooms` WHERE SchoolID = '$schoolID'");
			if(mysqli_num_rows($classlist)>0){
				while($row = mysqli_fetch_assoc($classlist)) {
					$cid = $row['ClassRoomID'];
					$row['Subjects'] = [];
					$subjectList = mysqli_query($conn, "SELECT SubjectName,ClassRoomID,SubjectTypeID FROM `subjects` WHERE ClassRoomID = '$cid'");
					if(mysqli_num_rows($subjectList)>0){
						while($rows = mysqli_fetch_assoc($subjectList)) {
							$row['Subjects'][] = $rows;
						}
					}
					$classArray[] = $row;
				}
			}
			$examcount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT Count(*) as ECount FROM `exams` WHERE SchoolID = '$schoolID'"));
			if($examcount['ECount']>0){
				$isExamAdded = true;
			}else{
				$isExamAdded = false;
			}
			$activateSchool = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SchoolStatus FROM `schools` WHERE SchoolID = '$schoolID'"));
			if($activateSchool['SchoolStatus']==1){
				$isSchoolActive = true;
			}else{
				$isSchoolActive = false;
			}
			http_response_code(200);
			header('Content-Type: application/json');
			$schoolArray[] = $schoolslist;
			$data = array ("Status"=> "OK","Message" => "Success", "SchoolList" => $schoolArray, "ClassRooms" => $classArray, "isExamAdded" => $isExamAdded, "isSchoolActive" => $isSchoolActive);
			echo json_encode( $data );
			
			

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