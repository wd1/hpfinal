<?php
include 'con.php';
$catid = addslashes($_GET['tempo']);
$catex = addslashes($_GET['texto']);
$count=0;

$final="<i class='fa fa-times-circle topicFa'></i>";
$final=$final."<div class='back-sec'><i class='fa fa-chevron-left'></i> Back</div>";
$final=$final."<span>Browse Datasets by Subtopics Below </span> <div class='moody-link'>";

$aes = mysqli_query($con,"SELECT * FROM subcats WHERE catid='$catid' ORDER BY subcat ASC");
while($aow = mysqli_fetch_array($aes)){ 
	$count++;
	$id=$aow['id'];
	$final=$final."<a class='subtoplink' data-cid='".$catid."' data-id='".$id."'>".$aow['subcat']."</a>";
} 
$final=$final."</div>";

if($count==1){
	$data=array(0,$catid);
} else{
	$data=array($final);	
}
echo $_GET['callback'] . '('.json_encode($data).')';

mysqli_close($con);
?>