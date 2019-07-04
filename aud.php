<?php
include 'inc/conCouch.php';

$aes = mysqli_query($con,"SELECT * FROM couch_data_text WHERE value='Data'");
while($aow = mysqli_fetch_array($aes)){ 
	$pageid = $aow['page_id'];
	$fieldid = $aow['field_id'];
	$aesult = mysqli_query($con,"UPDATE couch_data_text set value='Visualization', search_value='Visualization' WHERE page_id=$pageid AND field_id=$fieldid");
} 

mysqli_close($con);
?>