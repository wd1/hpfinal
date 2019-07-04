<?php
include 'con.php';
$sub = addslashes($_GET['sub']); 
$catter = $_GET['catter']; 
$exists=0;

$aes = mysqli_query($con,"SELECT * FROM subcats WHERE catid='$catter'");
while($aow = mysqli_fetch_array($aes)){ 
	$cur = $aow['subcat'];
	if($sub==$cur){
		$exists=1;
	}
} 

if($sub==''){
	$exists=2;
}

if($exists==0){
	$zesult = mysqli_query($con,"INSERT INTO subcats(catid,subcat) VALUES('$catter','$sub')");

	$bes = mysqli_query($con,"SELECT * FROM subcats WHERE subcat='$sub'");
	while($bow = mysqli_fetch_array($bes)){ 
		$id = $bow['id'];	
	} 
}

$data = array($exists,$id);
echo $_GET['callback'] . '('.json_encode($data).')';

mysqli_close($con);
?>