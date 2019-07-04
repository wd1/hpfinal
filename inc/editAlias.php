<?php
include 'con.php';
$aid = $_GET['aid']; 
$newcoun = addslashes($_GET['newcoun']);  

$aesult = mysqli_query($con,"UPDATE aliases set nombre='$newcoun' WHERE aid='$aid'");

$data = array(1);
echo $_GET['callback'] . '('.json_encode($data).')';

mysqli_close($con);
?>