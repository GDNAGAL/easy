<?php
require_once('../includes/configData.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Result Sheet</title>
</head>
<style>
  table,th,td{
    border:1px solid #999;
    border-collapse : collapse;
  }
</style>
<body>
  <input type="hidden" id="url" value="<?php echo $APIurl; ?>">
  <div id="resultsheetcnt">
    <table>
      <tr></tr>
    </table>
  </div>
</body>
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<script src="../custom/js/ResultSheet.js"></script>
</html>
