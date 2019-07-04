<?php
	include 'inc/con.php'; 
	include 'inc/conint.php'; 
	include 'inc/conregionave.php'; 
	$dset="z31";
	$rid=13;
	$x=1960;
	$count=0;

    $ces = mysqli_query($conint,"SELECT * FROM interpolate.$dset INNER JOIN custom.zaliases ON $dset.cid=zaliases.cid WHERE year=$x AND rid=$rid");
    while($cow = mysqli_fetch_array($ces)){  
      $cid=$cow['cid'];
      $valll=$cow['value'];
      $connn=$cow['country'];   
      echo "{name:'".$connn."',parent:'".$rid."',color:'".$color."',value:".$valll."},";    
      $count++;
    }    
    echo $count;
?>