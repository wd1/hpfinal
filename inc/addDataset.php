<?php
include 'con.php';
$oldid = addslashes($_GET['oldid']);
$title = addslashes($_GET['title']);
$subtitle = addslashes($_GET['subtitle']);
$type = $_GET['type'];
$pinker = $_GET['pinker'];
$sourcedescr = addslashes($_GET['sourcedescr']); 
$sourceurlone = addslashes($_GET['sourceurlone']); 
$sourceurltwo = addslashes($_GET['sourceurltwo']); 
$definition = addslashes($_GET['definition']); 
$seodescr = addslashes($_GET['seodescr']);  
$catsubcat = addslashes($_GET['catsubcat']); 
$updatedate = $_GET['updatedate']; 

$yesult = mysqli_query($con,"INSERT INTO datasets(oldid,title,subtitle,type,pinker,sourcedescr,sourceurlone,sourceurltwo,definition,seodescr,catsubcat,updatedate) VALUES('$oldid','$title','$subtitle','$type','$pinker','$sourcedescr','$sourceurlone','$sourceurltwo','$definition','$seodescr','$catsubcat','$updatedate')");
$placeholder = mysqli_insert_id($con);

$data = array($placeholder);
echo $_GET['callback'] . '('.json_encode($data).')';

mysqli_close($con);
?>