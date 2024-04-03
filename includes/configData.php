<?php 
$appMode = "PRODUCTION";   // TEST PRODUCTION


if($appMode == "TEST"){
  $appURL = '';
  $APIurl = 'testapi.royalplay.live';

}elseif ($appMode == "PRODUCTION") {
  $appURL = '';
  $APIurl = 'https://api.royalplay.live';
}
?>