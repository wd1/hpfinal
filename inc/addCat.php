<?php
include 'con.php';
$cat = addslashes($_GET['cat']);
$exists=0;
$id=0;

$aes = mysqli_query($con,"SELECT * FROM cats");
while($aow = mysqli_fetch_array($aes)){ 
	$cur = $aow['cat'];
	if($cat==$cur){
		$exists=1;
	}
} 

if($cat==''){
	$exists=2;
}

if($exists==0){
	$zesult = mysqli_query($con,"INSERT INTO cats(cat) VALUES('$cat')");
	
	$bes = mysqli_query($con,"SELECT * FROM cats WHERE cat='$cat'");
	while($bow = mysqli_fetch_array($bes)){ 
		$id = $bow['id'];	
	} 

	$yesult = mysqli_query($con,"INSERT INTO subcats(catid,subcat) VALUES('$id','$cat')");
}

$data = array($exists,$id);
echo $_GET['callback'] . '('.json_encode($data).')';

mysqli_close($con);
?>