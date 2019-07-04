<?php
include 'con.php';
$zid = $_GET['zid']; 

$aesult = mysqli_query($con,"DELETE FROM zaliases WHERE zid='$zid'");

$data = array(1);
echo $_GET['callback'] . '('.json_encode($data).')';

mysqli_close($con);
?>