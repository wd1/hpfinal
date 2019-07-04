<?php
include 'con.php';
$temping = $_GET['temping']; 
$type = $_GET['type'];  

$aesult = mysqli_query($con,"UPDATE datasets set type='$type' WHERE id='$temping'");

$data = array(1);
echo $_GET['callback'] . '('.json_encode($data).')';

mysqli_close($con);
?>