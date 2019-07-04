<?php
include 'con.php';
$dataid = $_GET['dataid']; 

$aesult = mysqli_query($con,"DELETE FROM cats WHERE id='$dataid'");
$besult = mysqli_query($con,"DELETE FROM subcats WHERE catid='$dataid'");

$placeholder=1;
$data = array($placeholder);
echo $_GET['callback'] . '('.json_encode($data).')';

mysqli_close($con);
?>