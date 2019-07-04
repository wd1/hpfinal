<?php
include 'con.php';
$subid = $_GET['subid']; 
$placeholder=1;

$aes = mysqli_query($con,"SELECT * FROM subcats WHERE id=$subid");
while($aow = mysqli_fetch_array($aes)){ 
	$catid = $aow['catid'];
	$subcat = $aow['subcat'];
} 

$bes = mysqli_query($con,"SELECT * FROM cats WHERE id=$catid");
while($bow = mysqli_fetch_array($bes)){ 
	$cat = $bow['cat'];
} 


if($cat==$subcat){
	$placeholder='fail';
} else{
	$aesult = mysqli_query($con,"DELETE FROM subcats WHERE id='$subid'");
}

$data = array($placeholder);
echo $_GET['callback'] . '('.json_encode($data).')';

mysqli_close($con);
?>
