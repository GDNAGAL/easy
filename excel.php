<?php 
require('xlsxwriter/xlsxwriter.class.php');

 $fname='studentData.xlsx';
 $header1 = [ 
                'Roll No' => 'money',
                'Admission No.' => 'money',
                'Student Name' => 'date',
                'Father Name' => 'string',
                'Mother Name' => 'string',
                'Date of Birth' => 'money',
                'Category' => 'money',
                'Mobile No.' => 'money',
                'Aadhar No.' => 'money',
            ];
$data = [];
$writer = new XLSXWriter();
$writer->setAuthor('Easy School');
$headerStyles = [
    'fill' => '#D3D3D3',
    'border' => 'top:thin,bottom:thin,left:thin,right:thin',
]; 
$writer->writeSheetHeader('Student Bio', $header1, $headerStyles);
foreach ($header1 as $column => $type) {
    $writer->writeSheetRow('Student Bio', [$column], ['auto_size' => true]);
}

$writer->writeSheet($data, 'Student Bio');  // with headers

// $writer->writeSheet($data,'Student Bio', $header1);  // with headers

//  $writer->writeSheet($data2,'MySheet2');            // no headers
//  $writer->writeSheetRow('MySheet2', $rowdata = array(300,234,456,789), $styles2 );

//  $writer->writeToFile($fname);   // creates XLSX file (in current folder) 
//  echo "Wrote $fname (".filesize($fname)." bytes)<br>";

 // ...or instead of creating the XLSX you can just trigger a
 // download by replacing the last 2 lines with:

 header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
 header('Content-Disposition: attachment;filename="'.$fname.'"');
 header('Cache-Control: max-age=0');
 $writer->writeToStdOut();
 ?>