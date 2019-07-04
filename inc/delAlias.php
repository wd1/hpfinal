<?php
include 'con.php';
$aid = $_GET['aid']; 

$aesult = mysqli_query($con,"DELETE FROM aliases WHERE aid='$aid'");

$data = array(a);
echo $_GET['callback'] . '('.json_encode($data).')';

mysqli_close($con);
?>