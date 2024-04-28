<?php 
require_once('../includes/configData.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result Sheet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arya:wght@400;700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <style>
        *{
            font-family: "Arya", sans-serif !important;
            font-weight: 400;
            font-style: normal;
            margin: 0;
        }
    table,th,td{
        border: 1px solid #999;
        border-collapse: collapse;
    }
    .rot{
        writing-mode: vertical-rl;
    }
    </style>
</head>
<body>
    <div class="text-center">
        <h1 class="m-0">Jawahar Navodaya Vidhyalaya, Gajner, Bikaner</h1>
        <div class="text-start">
            <strong>Class : 2nd</strong>
            <strong class="ms-4">Session : 2023-24</strong>
        </div>
        <table class="w-100 border">
            <tr>
                <td colspan="3">Student Information</td>
                <td colspan="8">Hindi</td>
                <td colspan="8">English</td>
                <td colspan="8">Maths</td>
                <td colspan="4">EVS</td>
                <td colspan="4">Work Exp.</td>
                <td colspan="4">ART Edu.</td>
                <td colspan="4">Health Edu</td>
                <td rowspan="3" class="rot">Subject Total</td>
                <td rowspan="4" class="rot">Percent</td>
                <td rowspan="4s">Final Result</td>
                <td rowspan="3" class="rot">Attendence</td>
                <td rowspan="4" class="rot">Remark</td>
            </tr>
            <tr>
                <td rowspan="3" class="rot">S.No.</td>
                <td rowspan="3" class="rot">Roll No.</td>
                <td rowspan="3">Student Name</td>

                <td colspan="3">Half-Yearly</td>
                <td rowspan="2" class="rot">Total Up To HY</td>
                <td colspan="3">Yearly</td>
                <td rowspan="2" class="rot">Grade</td>

                <td colspan="3">Half-Yearly</td>
                <td rowspan="2" class="rot">Total Up To HY</td>
                <td colspan="3">Yearly</td>
                <td rowspan="2" class="rot">Grade</td>

                <td colspan="3">Half-Yearly</td>
                <td rowspan="2" class="rot">Total Up To HY</td>
                <td colspan="3">Yearly</td>
                <td rowspan="2" class="rot">Grade</td>
                
                <td rowspan="2" class="rot">Half-Yearly</td>
                <td rowspan="2" class="rot">Yearly</td>
                <td rowspan="2" class="rot">Total</td>
                <td rowspan="2" class="rot">Grade</td>

                <td rowspan="2" class="rot">Half-Yearly</td>
                <td rowspan="2" class="rot">Yearly</td>
                <td rowspan="2" class="rot">Total</td>
                <td rowspan="2" class="rot">Grade</td>

                <td rowspan="2" class="rot">Half-Yearly</td>
                <td rowspan="2" class="rot">Yearly</td>
                <td rowspan="2" class="rot">Total</td>
                <td rowspan="2" class="rot">Grade</td>

                <td rowspan="2" class="rot">Half-Yearly</td>
                <td rowspan="2" class="rot">Yearly</td>
                <td rowspan="2" class="rot">Total</td>
                <td rowspan="2" class="rot">Grade</td>
            </tr>
            <tr>
                <td class="rot">Written</td>
                <td class="rot">Oral</td>
                <td class="rot">HY Total</td>
                <td class="rot">Written</td>
                <td class="rot">Oral</td>
                <td class="rot">Yearly Total</td>


                <td class="rot">Written</td>
                <td class="rot">Oral</td>
                <td class="rot">HY Total</td>
                <td class="rot">Written</td>
                <td class="rot">Oral</td>
                <td class="rot">Yearly Total</td>


                <td class="rot">Written</td>
                <td class="rot">Oral</td>
                <td class="rot">HY Total</td>
                <td class="rot">Written</td>
                <td class="rot">Oral</td>
                <td class="rot">Yearly Total</td>

            </tr>
            <tr>
                <td>30</td>
                <td>30</td>
                <td>30</td>
                <td>30</td>
                <td>30</td>
                <td>30</td>
                <td>30</td>
                <td>30</td>
                <td>30</td>
                <td>30</td>
                <td>30</td>
                <td>30</td>
                <td>30</td>
                <td>30</td>
                <td>30</td>
                <td>30</td>
                <td>30</td>
                <td>30</td>
                <td>30</td>
                <td>30</td>
                <td>30</td>
                <td>30</td>
                <td>30</td>
                <td>30</td>
                <td>30</td>
                <td>30</td>
                <td>30</td>
                <td>30</td>
                <td>30</td>
                <td>30</td>
                <td>30</td>
                <td>30</td>
                <td>30</td>
                <td>30</td>
                <td>30</td>
                <td>30</td>
                <td>30</td>
                <td>30</td>
                <td>30</td>
                <td>30</td>
                <td>30</td>
                <td>30</td>
            </tr>
            <tbody id="mbody">

            </tbody>
            
        </table>
    </div>
<input type="hidden" id="url" value="<?php echo $APIurl; ?>">
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<script src="ResultSheetA.js"></script>
</body>
</html>