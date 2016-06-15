<?php
set_time_limit(0); 
// Supports all file types 
// URL Here: 
$url = "http://filecdn.72zx.com/download/flv播放器_30@106760.exe"; 
$pi = pathinfo($url); 
$ext = $pi['extension']; 
$name = $pi['filename'];
// create a new cURL resource 
$ch = curl_init(); 
// set URL and other appropriate options 
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_HEADER, false); 
curl_setopt($ch, CURLOPT_BINARYTRANSFER, true); 
curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
// grab URL and pass it to the browser 
$opt = curl_exec($ch); 
// close cURL resource, and free up system resources 
curl_close($ch); 
$saveFile = $name.'.'.$ext; 
if(preg_match("/[^0-9a-z._-]/i", $saveFile)) 
$saveFile = md5(microtime(true)).'.'.$ext; 
$handle = fopen($saveFile, 'wb'); 
fwrite($handle, $opt); 
fclose($handle);