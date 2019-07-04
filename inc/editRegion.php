<?php
include 'con.php';
$edrid = $_GET['edrid']; 
$regi = htmlentities($_GET['regi'],ENT_QUOTES);  

$aesult = mysqli_query($con,"UPDATE regions set region='$regi' WHERE rid='$edrid'");

$data = array(1);
echo $_GET['callback'] . '('.json_encode($data).')';

mysqli_close($con);
?>