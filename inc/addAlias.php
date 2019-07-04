<?php
include 'con.php';
$cid = $_GET['condid']; 
$nombre = strtolower(addslashes($_GET['alias'])); 
$count=0;

$bes = mysqli_query($con,"SELECT * FROM countries WHERE id='$cid'");
while($bow = mysqli_fetch_array($bes)){ 
	$name=strtolower($bow['name']);
} 

if($name==$nombre){
	$count++;
} else{
	$aes = mysqli_query($con,"SELECT * FROM aliases WHERE cid='$cid'");
	while($aow = mysqli_fetch_array($aes)){ 
		$exinombre=$aow['nombre'];
		if($nombre==$exinombre){
			$count++;
		}
	} 
}

if($count==0){
	$zesult = mysqli_query($con,"INSERT INTO aliases(cid,nombre) VALUES('$cid','$nombre')");
}

$data = array(1);
echo $_GET['callback'] . '('.json_encode($data).')';

mysqli_close($con);
?>