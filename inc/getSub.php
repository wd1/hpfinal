<?php
include 'con.php';
$retid = $_GET['retid']; 

$final = $final."<input type='text' class='add as'>";
$final = $final."<span class='but add-sub'>Add SubCategory</span>";  
$final = $final."<span class='tit'>SubCategories</span>";  
$aes = mysqli_query($con,"SELECT * FROM subcats WHERE catid='$retid'");
while($aow = mysqli_fetch_array($aes)){ 
	$temp="<div class='sub-div sub-div".$aow['id']."' data-id='".$aow['id']."'>".$aow['subcat']."<i data-id='".$aow['id']."' class='fa fa-exchange'></i></div>";
	$final=$final.$temp;
} 

$data = array($final);
echo $_GET['callback'] . '('.json_encode($data).')';

mysqli_close($con);
?>