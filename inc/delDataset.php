<?php
include 'con.php';
$temping = $_GET['temping'];
$dropid = "z".$temping;

$aesult = mysqli_query($con,"DELETE FROM datasets WHERE id='$temping'");
$besult = mysqli_query($con,"DELETE FROM datasets WHERE id='$temping'");

$sq = "DROP TABLE ".$dropid." ";
if ($con->query($sq) === TRUE) {
//echo "Table created successfully";
} else {
//echo "Error creating table: " . $conn->error;
}

$placeholder=1;
$data = array($placeholder);
echo $_GET['callback'] . '('.json_encode($data).')';

mysqli_close($con);
?>