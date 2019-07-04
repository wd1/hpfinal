<?php

$loc = $_POST['loc'];
$starter = $_POST[realstart];
$ender = $_POST[ender];
$loc=str_replace("?","*",$loc);
$addr=$loc.'&yf='.$starter.'&yl='.$ender;

	
header ('Content-type:image/gif');
include('GIFEncoder.class.php');

//$text_color = imagecolorallocate($image, 200, 200, 200);
//imagestring($image, 5, 5, 5,  $text, $text_color);
//$increment = 9000/($starter-$ender);


for($y=$starter+1;$y<=$ender;$y++){
	$frompng= "../upl/".$loc."&yf=".$starter."&yl=".$y.".png";
	$image = imagecreatefrompng($frompng);
	ob_start();
	imagegif($image);
	$frames[]=ob_get_contents();
	$framed[]=100; 
	ob_end_clean();
}


// Generate the animated gif and output to screen.
$gif = new GIFEncoder($frames,$framed,0,2,0,0,0,'bin');
$fp = fopen('../upl/'.$addr.'.gif', 'w');
fwrite($fp, $gif->GetAnimation());
fclose($fp);
//echo $gif->GetAnimation();
echo $addr;
?>