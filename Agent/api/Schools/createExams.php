<?php
// Path : api/ClassRooms/addClassRoom
include("../connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$headers = getallheaders();
	if (array_key_exists('Authorization', $headers) && preg_match('/Bearer\s(\S+)/', $headers['Authorization'], $matches)){

		if(verifyToken($matches[1])){
			$schoolID = $_POST['SchoolID'];
			$checkDuplicateExams = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as sc FROM `exams` WHERE SchoolID = '$schoolID'"));
			if($checkDuplicateExams['sc'] == 0){
				$Exams = ["1st Test~प्रथम परख", "2nd Test~द्वितीय परख ","3rd Test~तृतीय परख","Half-Yearly~अर्द्धवार्षिक","Yearly~वार्षिक"];
				foreach ($Exams as $index => $examss) {
					$addExam = mysqli_query($conn, "INSERT INTO `Exams`(`ExamText`, `ExamIndex`, `SchoolID`) VALUES ('$examss','$index','$schoolID')");
				}
				

				function getExamID($ExamIndex){
					global $conn, $schoolID;
					$eRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT ExamID FROM `exams` WHERE ExamIndex = '$ExamIndex' AND SchoolID = '$schoolID'"));
					return $eRow['ExamID'];
				}

				//select Class
				$classRoom = mysqli_query($conn, "SELECT * FROM `classrooms` WHERE SchoolID = '$schoolID'");
				while($row = mysqli_fetch_assoc($classRoom)){
					$classRoomID = $row['ClassRoomID'];
					$classRoomIndex = $row['ClassIndex'];
					//select Subjects
					$subjects = mysqli_query($conn, "SELECT * FROM `subjects` WHERE SubjectTypeID = 1 AND ClassRoomID = '$classRoomID'");
					if(mysqli_num_rows($subjects)>0){
						while($subjectrow = mysqli_fetch_assoc($subjects)){
							$subjectID = $subjectrow['SubjectID'];
							$subjectIndex = $subjectrow['SubjectIndex'];
							//select Exams

							$papers = mysqli_query($conn, "SELECT * FROM `defaultpaper` WHERE ClassRoomIndex = '$classRoomIndex' AND SubjectIndex = '$subjectIndex'");
							if(mysqli_num_rows($papers)>0){
								while($paperRow = mysqli_fetch_assoc($papers)){
									$ExamID = getExamID($paperRow['ExamIndex']);
									
									$p = $paperRow['PaperDisplayText'];
									$mm = $paperRow['PaperMM'];
									$addPaper = mysqli_query($conn, "INSERT INTO `examdesign`(`ClassRoomID`, `SubjectID`, `ExamID`, `PaperDisplayText`, `PaperMM`) VALUES ('$classRoomID','$subjectID','$ExamID','$p','$mm')");

								}
							}
						}
					}
				}

				http_response_code(200);
				header('Content-Type: application/json');
				$data = array ("Status"=> "OK", "Message" => "Exam Added Successfully.");
				echo json_encode( $data );
			}else{
				http_response_code(200);
				header('Content-Type: application/json');
				$data = array ("Status"=> "ERROR", "Message" => "Exams Already Added");
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