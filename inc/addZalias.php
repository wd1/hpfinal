<?php
include 'con.php';
$rid = $_GET['rid']; 
$cid = $_GET['cid']; 
$count=0;

$aes = mysqli_query($con,"SELECT * FROM zaliases WHERE rid='$rid' AND cid='$cid'");
while($aow = mysqli_fetch_array($aes)){ 
	$count++;
} 

if($count==0){
	$zesult = mysqli_query($con,"INSERT INTO zaliases(cid,rid) VALUES('$cid','$rid')");
}

$data = array(1);
echo $_GET['callback'] . '('.json_encode($data).')';

mysqli_close($con);
?>