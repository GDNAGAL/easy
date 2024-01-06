<?php
session_start();
session_destroy();
setcookie("Token", "", time()-3600);
header("Location:login");
 ?>