<?php 
$appMode = "PRODUCTION";   // TEST PRODUCTION


if($appMode == "TEST"){
  $appURL = '';
  $APIurl = 'https://testapi.royalplay.live';

}elseif ($appMode == "PRODUCTION") {
  $appURL = '';
  $APIurl = 'https://api.royalplay.live';
}
?>