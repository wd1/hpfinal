<?php
include 'con.php';
$stid = $_GET['tempo'];
$txtsec='';

$txtsec=$txtsec."<i class='fa fa-times-circle topicFa'></i>";
$txtsec=$txtsec."<span>Choose a Dataset Below</span> <div class='moody-link'>";

$aesult = mysqli_query($con,"SELECT * FROM datasets ORDER BY title ASC");
while($aow = mysqli_fetch_array($aesult))
{
  $catsubcat=$aow['catsubcat']; 	
  $count=0;
  $result = mysqli_query($con,"SELECT * FROM subcats WHERE id='$stid'");
  while($row = mysqli_fetch_array($result))
  {

  	$tempid = "*".$row['id']."*";
  	if( strpos( $catsubcat, $tempid ) !== false && $count==0) {
        $temptable="z".$aow['id'];
        /*$bount=0;
        $besult = mysqli_query($con,"SELECT * FROM $temptable ORDER BY year ASC ");
        while($bow = mysqli_fetch_array($besult))
        {
            if($bount==0){$firstyear=$bow['year'];$bount++;}
            $lastyear=$bow['year'];
        }*/

        $txtsec=$txtsec."<a href='dws?p=".$aow['id']."' data-id=".$aow['id'].">".$aow['title'].", ".$aow['subtitle']."</a>";  
        /*if($bount>0){
    		  $txtsec=$txtsec."<a data-id=".$aow['id'].">".$aow['title'].", ".$aow['subtitle'].", ".$firstyear."-".$lastyear."</a>";	
        }*/
    	  $count++;
	  }
  
  }
}
$txtsec=$txtsec."</div>";
$data = array($txtsec);
echo $_GET['callback'] . '('.json_encode($data).')';
mysqli_close($con);
?>