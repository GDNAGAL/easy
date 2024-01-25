<?php
// Path : api/ClassRooms/addClassRoom
include("../connection.php");
include("../../PHPExcel/PHPExcel.php");
error_reporting(0);
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$headers = getallheaders();
	if (array_key_exists('Authorization', $headers) && preg_match('/Bearer\s(\S+)/', $headers['Authorization'], $matches)){

		if(verifyToken($matches[1])){
            $sid = getSchoolID($matches[1]);
			$SectionID = $_POST['ClassRoomID'];
			$secrateCode = $_POST['secrateCode'];

			if($secrateCode == 15361234){

				
				$getClassRoom = mysqli_fetch_assoc(mysqli_query($conn, "SELECT ClassRoomID FROM `classrooms_sections` WHERE SectionID = '$SectionID' LIMIT 1"));
				$classRoomID = $getClassRoom['ClassRoomID'];
				
				$inputFileName = $_FILES["studentDataSheet"]["tmp_name"];
				
				$spreadsheet = PHPExcel_IOFactory::createReaderForFile($inputFileName);
				$excel_obj = $spreadsheet->load($inputFileName);
				$worksheet = $excel_obj->getSheet('0');
				// $data = $worksheet->getCell('A2')->getValue();
				$highestRow = $worksheet->getHighestRow();
				if($highestRow>1){
					$tableName = "student_data";
					
					$temporaryTableName = "TempStudents";
					//Insert data into the temp table
					$createTableQuery = "CREATE TEMPORARY TABLE $temporaryTableName (
						Year INT,
						SchoolID INT,
						StudentName VARCHAR(255),
						StudentFatherName VARCHAR(255),
						StudentMotherName VARCHAR(255),
						DateofBirth DATE,
						Category VARCHAR(255),
						StudentAddress VARCHAR(255),
						ClassRoomID INT,
						SectionID INT,
						AdmissionNo VARCHAR(255),
						Gender VARCHAR(10),
						RollNo VARCHAR(20),
						StudentMobileNo VARCHAR(15),
						StudentAadhar VARCHAR(20),
						StudentPhoto VARCHAR(255)
					)";
					
					$conn->query($createTableQuery);
					
					// Insert data into the temporary table
					for ($row = 2; $row <= $highestRow; ++$row) {
						$rollNo = $worksheet->getCellByColumnAndRow(0, $row)->getValue(); // Assuming Roll No is in column A
						$admissionNo = $worksheet->getCellByColumnAndRow(1, $row)->getValue(); // Assuming Roll No is in column A
						$studentName = $worksheet->getCellByColumnAndRow(2, $row)->getValue(); // Assuming Roll No is in column A
						$fatherName = $worksheet->getCellByColumnAndRow(3, $row)->getValue(); // Assuming Roll No is in column A
						$motherName = $worksheet->getCellByColumnAndRow(4, $row)->getValue(); // Assuming Roll No is in column A
						$dob = $worksheet->getCellByColumnAndRow(5, $row)->getValue(); // Assuming Roll No is in column A
						$category = $worksheet->getCellByColumnAndRow(6, $row)->getValue(); // Assuming Roll No is in column A
						$mobile = $worksheet->getCellByColumnAndRow(7, $row)->getValue(); // Assuming Roll No is in column A
						$aadhar = $worksheet->getCellByColumnAndRow(8, $row)->getValue(); // Assuming Roll No is in column A
						// Retrieve other values from the worksheet columns as needed
						
						if($rollNo != null || $rollNo != ""){
							$insertDataQuery = "INSERT INTO $temporaryTableName 
							(Year, SchoolID, StudentName, StudentFatherName, StudentMotherName, DateofBirth, Category, StudentAddress, ClassRoomID, SectionID, AdmissionNo, Gender, RollNo, StudentMobileNo, StudentAadhar, StudentPhoto) 
							VALUES ('2023', '$sid', '$studentName', '$fatherName', '$motherName', '$dob', '$category', '', '$classRoomID', '$SectionID', '$admissionNo', '', '$rollNo', '$mobile', '$aadhar', NULL)";
							$conn->query($insertDataQuery);
						}
					}
					
					$x = [];
					$t = mysqli_query($conn, "SELECT * FROM $temporaryTableName");
					while($tr = mysqli_fetch_assoc($t)){
						$x[] = $tr;
					}
					
					$dropTableQuery = "DROP TEMPORARY TABLE IF EXISTS $temporaryTableName";
					$conn->query($dropTableQuery);
					
					http_response_code(200);
					header('Content-Type: application/json');
					$data = array ("Status"=> "OK","Message" => "Data Uploaded Successfully", "data" => $x);
					echo json_encode( $data );
					
					
					
					// $addExamGroup = mysqli_query($conn, "INSERT INTO `students`(`Year`, `SchoolID`, `StudentName`, `StudentFatherName`, `StudentMotherName`, `DateofBirth`, `Category`, `StudentAddress`, `ClassRoomID`, `SectionID`, `AdmissionNo`, `Gender`, `RollNo`, `StudentMobileNo`, `StudentAadhar`, `StudentPhoto`)
					//  VALUES ('2023','$sid','$studentname','$fathername','$mothername','$dob','$category','$address','$classRoomID','$SectionID','$adno','$gender','$rollno','$mobile','$aadhar','')");
					
				}else{
					http_response_code(403);
					header('Content-Type: application/json');
					$data = array ("Status"=> "ERROR","Message" => "Sheet have no Data");
					echo json_encode( $data );
				}
		}else{
			http_response_code(403);
			header('Content-Type: application/json');
			$data = array ("Status"=> "ERROR","Message" => "Invalid Secrate Code");
			echo json_encode( $data );
		}
			// http_response_code(200);
			// header('Content-Type: application/json');
			// if($addExamGroup == TRUE){
			// 	$data = array ("Status"=> "OK","Message" => "Student Added Successfully.");
			// 	echo json_encode( $data );
			// }else{
			// 	$data = array ("Status"=> "ERROR","Message" => "Failed");
			// 	echo json_encode( $data );
			// }

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