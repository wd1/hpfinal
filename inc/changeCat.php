<?php
include 'con.php';
$did = $_GET['retid'];
$nid = $_GET['newid'];
$sid = $_GET['sid']; 

$aes = mysqli_query($con,"SELECT * FROM cats WHERE id='$did'");
while($aow = mysqli_fetch_array($aes)){ 
	$cat=$aow['cat'];
} 

$bes = mysqli_query($con,"SELECT * FROM subcats WHERE id='$sid'");
while($bow = mysqli_fetch_array($bes)){ 
	$subcat=$bow['subcat'];
} 

if($cat==$subcat){
	$place=1;
} else{
	$place=0;
	$ces = mysqli_query($con,"UPDATE subcats set catid='$nid' WHERE id='$sid'");
}

$data = array($place,$cat,$subcat);
echo $_GET['callback'] . '('.json_encode($data).')';

mysqli_close($con);
?>