<?php
include 'con.php'; 
$region = addslashes($_GET['region']); 
$count=0;
$exists=0;

$aes = mysqli_query($con,"SELECT * FROM regions WHERE region='$region'");
while($aow = mysqli_fetch_array($aes)){ 
	$count++;
} 

if($count>0){
	$exists=1;
}else{
	$zesult = mysqli_query($con,"INSERT INTO regions(region) VALUES('$region')");
}

$data = array($exists);
echo $_GET['callback'] . '('.json_encode($data).')';

mysqli_close($con);
?>