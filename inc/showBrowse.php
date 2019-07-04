<?php
include 'con.php';

$final="<i class='fa fa-times-circle topicFa'></i>";
$final=$final."<span>Choose a Topic Below</span> <div class='moody-link'>";

$aes = mysqli_query($con,"SELECT * FROM cats ORDER BY cat ASC");
while($aow = mysqli_fetch_array($aes)){ 
	$final=$final."<a class='tl a".$aow['id']."' data-id='".$aow['id']."'>".$aow['cat']."</a>";
}
$final=$final."</div>";

$data=array($final);
echo $_GET['callback'] . '('.json_encode($data).')';

mysqli_close($con);
?>