<?php
include 'con.php';
$dataid = $_GET['dataid']; 
$catText = htmlentities($_GET['catText'],ENT_QUOTES);  

$aes = mysqli_query($con,"SELECT * FROM cats");
while($aow = mysqli_fetch_array($aes)){ 
	$cat = $aow['cat'];
	if($cat==$catText){
		$fail=1;
	}
} 

$aes = mysqli_query($con,"SELECT * FROM subcats WHERE catid='$dataid' ORDER BY id ASC");
while($aow = mysqli_fetch_array($aes)){ 
	$id = $aow['id'];
	break;
} 

if($fail==1){
	$placeholder='fail';
} else{
	$aesult = mysqli_query($con,"UPDATE cats set cat='$catText' WHERE id='$dataid'");
	$besult = mysqli_query($con,"UPDATE subcats set subcat='$catText' WHERE catid='$dataid' AND id='$id'");
	$placeholder=$id;
}
$data = array($placeholder);
echo $_GET['callback'] . '('.json_encode($data).')';

mysqli_close($con);
?>