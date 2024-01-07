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
				
				//select Class
				$classRoom = mysqli_query($conn, "SELECT * FROM `classrooms` WHERE SchoolID = '$schoolID'");
				while($row = mysqli_fetch_assoc($classRoom)){
					$classRoomID = $row['ClassRoomID'];
					//select Subjects
					$subjects = mysqli_query($conn, "SELECT * FROM `subjects` WHERE SubjectTypeID = 1 AND ClassRoomID = '$classRoomID'");
					while($subjectrow = mysqli_fetch_assoc($subjects)){
						$subjectID = $subjectrow['SubjectID'];
						//select Exams
						$examsData = mysqli_query($conn, "SELECT * FROM `exams` WHERE SchoolID = '$schoolID'");
						while($examRow = mysqli_fetch_assoc($examsData)){
							$ExamID = $examRow['ExamID'];
							//for upto 2nd Class
							if($row['ClassIndex']>=0 && $row['ClassIndex']<=4 && $examRow['ExamIndex'] >= 3 && $examRow['ExamIndex'] <= 4){
								$papers = ["Oral~मौखिक@70", "Written~लिखित@30"];
								foreach ($papers as $paper) {
									$pa = explode('@', $paper);
									$p = $pa[0];
									$mm = $pa[1];

									$addPaper = mysqli_query($conn, "INSERT INTO `examdesign`(`ClassRoomID`, `SubjectID`, `ExamID`, `PaperDisplayText`, `PaperMM`) VALUES ('$classRoomID','$subjectID','$ExamID','$p','$mm')");
								}
							}elseif($row['ClassIndex']>=5 && $row['ClassIndex']<=6){
								if($examRow['ExamIndex'] >= 3 && $examRow['ExamIndex'] <= 4){
									//for Half-yearly
									if($examRow['ExamIndex'] == 3){
										$papers = ["Oral~मौखिक@20", "Written~लिखित@50"];
									//for Yearly
									}elseif($examRow['ExamIndex'] == 4){
										$papers = ["Oral~मौखिक@40", "Written~लिखित@60"];
									}

									//for Half-yearly English
									if($examRow['ExamIndex'] == 3 && $subjectrow['SubjectName']=="ENGLISH"){
										$papers = ["Oral~मौखिक@10", "Written~लिखित@25"];
									//for Yearly English
									}elseif($examRow['ExamIndex'] == 4 && $subjectrow['SubjectName']=="ENGLISH"){
										$papers = ["Oral~मौखिक@20", "Written~लिखित@30"];
									}

									foreach ($papers as $paper) {
										$pa = explode('@', $paper);
										$p = $pa[0];
										$mm = $pa[1];

										$addPaper = mysqli_query($conn, "INSERT INTO `examdesign`(`ClassRoomID`, `SubjectID`, `ExamID`, `PaperDisplayText`, `PaperMM`) VALUES ('$classRoomID','$subjectID','$ExamID','$p','$mm')");
									}
								}else{
									if($subjectrow['SubjectName']=="ENGLISH"){
										$mm = 5;
									}else{
										$mm = 10;
									}
									$p = $examRow['ExamText'];
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