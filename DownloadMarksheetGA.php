<?php
ini_set('display_errors', 1);
// require("fpdf/fpdf.php");
require_once('tcpdf/tcpdf.php');
require_once('includes/configData.php');

if(isset($_COOKIE['Token']) && isset($_GET['SectionID']) && isset($_GET['StudentID'])){
  $token = $_COOKIE['Token'];
  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => $APIurl.'/Marksheet/downloadMarksheetGA',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array('SectionID' => $_GET['SectionID'],'StudentID' => $_GET['StudentID']),
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer '.$token
    ),
  ));
  
  $response = curl_exec($curl);
  curl_close($curl);
  $responseJSON = json_decode($response,true);
  if($response == "Invalid Token"){
    setcookie("Token", "", time()-3600);
    header("Location: login");
  }
  $Status = $responseJSON['Status'];
  if($Status === "OK"){
    $SchoolName = $responseJSON['School']['SchoolName'];
    $SchoolAddress = $responseJSON['School']['SchoolAddress'];
    $SchoolRegNo = $responseJSON['School']['SchoolRegNo'];
    $Students = $responseJSON['StudentList'];

    

  }else{
    echo "<script>alert('Something Went Wrong!!!')</script>";
    // echo "<script>window.close();</script>";
  }
}else{
  header("Location: login");
}



  function grade($MAX,$MOB){
    $per = ($MOB/$MAX)*100;
    if ($per >= 90) {
      return 'A';
    } else if ($per >= 80) {
        return 'B';
    } else if ($per >= 70) {
        return 'C';
    } else if ($per >= 60) {
        return 'D';
    } else {
        return 'F';
    }
  }



  class PDF extends TCPDF
  {
    function Header(){
       global $SchoolName, $SchoolAddress, $SchoolRegNo;
      // $this->Image("dist/img/logo.jpg", 50, 100, 100, 100, '', '', '', false, 300, '', false, false, 0);
      $this->SetFont('dejavusans','B',14);
      $this->Image("dist/img/logo.jpg",10,10,20,25);
      $this->SetFont('dejavusans','B',24);
      $this->SetY(7);
      $this->Cell(190,10,$SchoolName,0,1,'C');
      $this->SetFont('dejavusans','',14);
      $this->Cell(190,7,$SchoolAddress,0,1,'C');
      $this->SetFont('dejavusans','B',14);
      $this->Cell(190,10,"MARKSHEET-2023-24",0,1,'C');
      $this->SetFont('dejavusans','',10);
      $this->Cell(190,7, ($SchoolRegNo ? "School Reg. No.  : $SchoolRegNo" : ''),0,1,'R');
      $this->SetFillColor(222,137,137);
      $this->SetTextColor(255,255,255);
      $this->Rect(0, 41, 210, 8, 'F');
      $this->SetXY(10, 41); 
      $this->Cell(190,8,"Student Profile",0,1,'C',true);
    }
    
    function body($Students,$COMSubjects,$OPTSubjects){

      $totalExam = $Students['COMSubjects'][0]['Exams'];
      $StudentPhoto = $Students['StudentPhoto'];
      $dataURI = "data:image/png;base64,$StudentPhoto";
      $img = explode(',',$dataURI,2)[1];
      $pic = 'data://text/plain;base64,'. $img;
      $imageInfo = @getimagesize($pic);

      if ($imageInfo !== false) {
        
      } else {
          $pic = "custom/img/noimg.jpg";
      }

      $this->SetY(55);
      $this->SetX(10);
      $this->SetFont("dejavusans",'B',10);
      $this->Cell(30,7,"Student Name",0,0);
      $this->SetFont('dejavusans','',10);
      $this->Cell(75,7,":  ".$Students['StudentName'],0,0);

      $this->SetFont('dejavusans','B',10);
      $this->Cell(19,7,"Class",0,0);
      $this->SetFont('dejavusans','',10);
      $this->Cell(40,7,":  ".$Students['ClassRoomName'],0,1);

      $this->SetFont('dejavusans','B',10);
      $this->Cell(30,7,"Father Name",0,0);
      $this->SetFont('dejavusans','',10);
      $this->Cell(75,7,":  ".$Students['StudentFatherName'],0,0);

      $this->SetFont('dejavusans','B',10);
      $this->Cell(19,7,"Roll No.",0,0);
      $this->SetFont('dejavusans','',10);
      $this->Cell(40,7,":  ".$Students['RollNo'],0,1);

      $this->SetFont('dejavusans','B',10);
      $this->Cell(30,7,"Mother Name",0,0);
      $this->SetFont('dejavusans','',10);
      $this->Cell(75,7,":  ".$Students['StudentMotherName'],0,0);

      $this->SetFont('dejavusans','B',10);
      $this->Cell(32,7,"Admission No.",0,0);
      $this->SetFont('dejavusans','',10);
      $this->Cell(40,7,": ".$Students['AdmissionNo'],0,1);

      $this->SetFont('dejavusans','B',10);
      $this->Cell(30,7,"Date of Birth",0,0);
      $this->SetFont('dejavusans','',10);
      $this->Cell(30,7,":  ".$Students['DateofBirth'],0,1);




      //Display Student Image
      // $this->Image($pic,175,55,20,25,"JPG");

      $this->SetFillColor(222,137,137);
      $this->SetTextColor(255,255,255);
      $this->Rect(0, 90, 210, 8, 'F');
      $this->SetXY(10, 90);
      $this->SetFont('dejavusans','B',12);
      $this->Cell(190,8,"Academic Performance",0,1,'C',true);
      $this->SetTextColor(0,0,0);
      $this->SetFont('dejavusans','',12);
      
      $W = (190-40)/((count($totalExam)*2)+3);
      $this->SetY(105);
      $this->SetX(10);
      $this->SetFillColor(239, 239, 239);
      $this->SetFont('dejavusans','B',10);
      $this->Cell(40,14,"SUCJECTS","TRL",0,'C',true);
      
      
      foreach($totalExam as $te){
        $this->Cell($W*2,7,$te['ExamText'],"TLB",0,"C",true);
      }
      $this->Cell($W*3,7,"Grand Total","TLBR",0,"C",true);
      $this->Ln(7);
      $this->Cell(40,7,"","BRL",0,'C');
      $this->SetFont('dejavusans','',8);
      foreach($totalExam as $tm){
        $this->Cell($W,7,"MM.","LTB",0,"C",true);
        $this->Cell($W,7,"MO.","LTB",0,"C",true);
      }
      $this->Cell($W,7,"MM.","LTB",0,"C",true);
      $this->Cell($W,7,"MO.","LTB",0,"C",true);
      $this->Cell($W,7,"GRADE",1,0,"C",true);
      $this->Ln(7);
      $this->SetFont('dejavusans','',10);
      
      $fmm = 0;
      $fob = 0;
      foreach($COMSubjects as $cos){
        $this->Cell(40,9,$cos["SubjectName"],"LRB",0,'C');
        $gmm = 0;
        $gob = 0;
        foreach($cos['Exams'] as $ex){
          $mm = 0;
          $ob = 0;
          foreach($ex['Papers'] as $pep){
            $mm+=$pep['PaperMM'];
            $ob+=$pep['MarksObtained'];
          }
          $this->Cell($W,9,$mm,"LRB",0,'C');
          $this->Cell($W,9,$ob,"LRB",0,'C');
          $gmm+=$mm;
          $gob+=$ob;
        }
        $this->Cell($W,9,$gmm,"LRB",0,'C');
        $this->Cell($W,9,$gob,"LRB",0,'C');
        $this->Cell($W,9,grade($gmm,$gob),"LRB",1,'C');
        $fmm += $gmm;
        $fob += $gob;
      }
        $this->SetFont('dejavusans','B',10);
        $fw = (190-($W*3));
        $this->Cell($fw,7,"Grand Total   ","LRTB",0,'R',true);
        $this->Cell($W,7,$fmm,1,0,'C',true);
        $this->Cell($W,7,$fob,1,0,'C',true);
        $this->Cell($W,7,grade($fmm,$fob),1,1,'C',true);

        $this->Cell(47,7,"Final Result","TLB",0,'C',true);
        $this->SetFont('dejavusans','',10);
        $this->Cell(48,7,":  Pass","TBR",0,'L',true);
        $this->SetFont('dejavusans','B',10);
        $this->Cell(47,7,"Percentage",1,0,'C',true);
        $this->SetFont('dejavusans','',10);
        $result = round(($fob / $fmm) * 100, 2);
        $this->Cell(48,7,$result. " %",1,1,'C',true);
        $this->Ln(7);


    //OPT Subjects
    $this->SetFont('dejavusans','B',10);
    $this->Cell(40,7,"SUCJECTS","TRBL",0,'C',true);
    $this->SetFont('dejavusans','B',10);
    $this->Cell(30,7,"MAX. MARKS",1,0,'C',true);
    $this->Cell(30,7,"MARKS OBT.",1,0,'C',true);
    $this->Cell(12,7,"",0,0,'C');
    $this->Cell(78,7,"Attendence",1,1,'C');
    
    $this->SetFont('dejavusans','',10);
      foreach($OPTSubjects as $index => $cos){
        $this->Cell(40,7,$cos["SubjectName"],"LRB",0,'C');
        $gmm = 0;
        $gob = 0;
        foreach($cos['Exams'] as $ex){
          $mm = 0;
          $ob = 0;
          foreach($ex['Papers'] as $pep){
            $mm+=$pep['PaperMM'];
            $ob+=$pep['MarksObtained'];
          }
          $gmm+=$mm;
          $gob+=$ob;
        }
        $this->Cell(30,7,$gmm,"LRB",0,'C');
        $this->Cell(30,7,$gob,"LRB",0,'C');
        if($index==0){
          $this->Cell(12,7,"",0,0,'C');
          $this->Cell(26,7,"Total Mettings","RBL",0,'C');
          $this->Cell(26,7,"Present","RB",0,'C');
          $this->Cell(26,7,"Att. %","RB",0,'C');
        }
        if($index==1){
          $this->Cell(12,7,"",0,0,'C');
          $this->Cell(26,7,$Students['TotalAttnDay'],"RBL",0,'C');
          $this->Cell(26,7,$Students['Present'],"RB",0,'C');
          $present = intval($Students['Present']);
          $totalAttnDay = intval($Students['TotalAttnDay']);
          $attendancePercentage = ($totalAttnDay > 0) ? (($present / $totalAttnDay) * 100) : 0;
          $this->Cell(26, 7, round($attendancePercentage,2) . "%", "RB", 0, 'C');
        }
        $this->ln(7);
      }

      $this->ln(10);
      $this->Cell(50,10,"Signature of Student","RTL",0,'C',true);
      $this->Cell(50,10,"","RT",1,'C');
      $this->Cell(50,10,"Signature of Exam I/C","RTL",0,'C',true);
      $this->Cell(50,10,"","TR",1,'C');
      $this->Cell(50,10,"Signature of H.M.",1,0,'C',true);
      $this->Cell(50,10,"","TRB",1,'C');

      
    }
    
  }

$pdf=new PDF("P","mm","A4");
foreach($Students as $st){
  $pdf->AddPage();
  $pdf->body($st,$st['COMSubjects'],$st['OPTSubjects']);
}
if($_GET['StudentID']=='all'){
  $filename = 'Marksheet_'.$Students[0]['ClassRoomName'];
}else{
  $filename = 'Marksheet_'.$Students[0]['ClassRoomName'].'_'.$Students[0]['RollNo'];
}
$pdf->SetTitle($filename);
$pdf->Output($filename.'.pdf', "I" );

?>

