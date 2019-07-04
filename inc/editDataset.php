<?php
include 'con.php';
$id = $_GET['temping'];
$oldid = $_GET['oldid'];
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

$yesult = mysqli_query($con,"UPDATE datasets SET oldid='$oldid',
												 title='$title',
												 subtitle='$subtitle',
												 type='$type',
												 pinker='$pinker',
												 sourcedescr='$sourcedescr',
												 sourceurlone='$sourceurlone',
												 sourceurltwo='$sourceurltwo',
												 definition='$definition',
												 seodescr='$seodescr',
												 catsubcat='$catsubcat',
												 updatedate='$updatedate' WHERE id=$id");

$placeholder=1;
$data = array($placeholder);
echo $_GET['callback'] . '('.json_encode($data).')';

mysqli_close($con);
?>