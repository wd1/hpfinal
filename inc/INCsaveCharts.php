<?php

//$uni = $_POST[uni];
//echo $uni;

error_reporting(-1); // reports all errors
ini_set("display_errors", "1"); // shows all errors
ini_set("log_errors", 1);
ini_set("error_log", "/tmp/php-error.log");

$data = str_replace(' ', '+', $_POST['bin_data']);
$uni = substr($data, strpos($data, "*") + 1);   
$data = substr($data, 0, strpos($data, '*'));   
//echo $data;
$data = base64_decode($data);
$fileName = '../upl/'.$uni.'.png';
$im = imagecreatefromstring($data);
 
if ($im !== false) {
	imagepng($im, $fileName);
	imagedestroy($im);
	echo $data;
}
else {
	echo $data;
}

?>