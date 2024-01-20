<?php
session_start();
session_destroy();
setcookie("AToken", "", time()-3600);
header("Location:login");
 ?>