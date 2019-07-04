<?php

//$data = str_replace(' ', '+', $_GET['img']);
//$data = substr($data, 0, strpos($data, '*'));   

$data = base64_decode($_POST['img']);
$fileName = "../upl/".$_POST['locker'].".png";
$fileName=str_replace("?","*",$fileName);
$im = imagecreatefromstring($data);
 
if ($im !== false) {
	header('Content-Type:image/png');
	imagepng($im, $fileName);
	imagedestroy($im);
	echo $data;
}
else {
	echo $data;
}


?>