<?php
include 'con.php';
$edrid = $_GET['edrid']; 

$aesult = mysqli_query($con,"DELETE FROM regions WHERE rid='$edrid'");

$data = array(1);
echo $_GET['callback'] . '('.json_encode($data).')';

mysqli_close($con);
?>