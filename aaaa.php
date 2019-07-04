<?php

$data = $_POST['loc'];
	
header ('Content-type:image/gif');
include('GIFEncoder.class.php');

$text = "Hello World";

// Open the first source image and add the text.

//$text_color = imagecolorallocate($image, 200, 200, 200);
//imagestring($image, 5, 5, 5,  $text, $text_color);

// Generate GIF from the $image
// We want to put the binary GIF data into an array to be used later,
//  so we use the output buffer.
$image = imagecreatefrompng('../upl/calc?p=178&c0=2&c1=24&c2=67&c3=11&c4=3&yf=1993&yl=1994.png');
ob_start();
imagegif($image);
$frames[]=ob_get_contents();
$framed[]=40; 
ob_end_clean();

$image = imagecreatefrompng('../upl/calc?p=178&c0=2&c1=24&c2=67&c3=11&c4=3&yf=1993&yl=1995.png');
ob_start();
imagegif($image);
$frames[]=ob_get_contents();
$framed[]=40; 
ob_end_clean();

$image = imagecreatefrompng('../upl/calc?p=178&c0=2&c1=24&c2=67&c3=11&c4=3&yf=1993&yl=1996.png');
ob_start();
imagegif($image);
$frames[]=ob_get_contents();
$framed[]=40; 
ob_end_clean();



// Generate the animated gif and output to screen.
$gif = new GIFEncoder($frames,$framed,0,2,0,0,0,'bin');
$fp = fopen('../upl/a.gif', 'w');
fwrite($fp, $gif->GetAnimation());
fclose($fp);
//echo $gif->GetAnimation();
?>