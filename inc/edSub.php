<?php
include 'con.php';
$subid = $_GET['subid']; 
$subText = addslashes($_GET['subText']); 
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

$ces = mysqli_query($con,"SELECT * FROM subcats WHERE catid=$catid");
while($cow = mysqli_fetch_array($ces)){ 
	$subTemp = $cow['subcat'];
	if($subText==$subTemp){
		$fail=1;
	} 
} 

if($fail==1){
	$placeholder='failure';
} else if($cat==$subcat){
	$placeholder='fail';
} else{
	$aesult = mysqli_query($con,"UPDATE subcats set subcat='$subText' WHERE id='$subid'");
}

$data = array($placeholder);
echo $_GET['callback'] . '('.json_encode($data).')';

mysqli_close($con);
?>
