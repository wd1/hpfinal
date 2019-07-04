<?php
include 'con.php';
include 'conint.php'; 
include 'conregionsum.php'; 
include 'conregionave.php';
include 'conregionwav.php';  

$dset="z".$_GET['p'];
$fy=$_GET['val1'];
$ly=$_GET['val2'];
$high=$_GET[high];

if($_GET[r0]>0||$_GET[r1]>0||$_GET[r2]>0||$_GET[r3]>0||$_GET[r4]>0||$_GET[r5]>0||$_GET[r6]>0||$_GET[r7]>0||$_GET[r8]>0||$_GET[r9]>0 ){
	if($_GET[reg]==1){
	  $constance=$conregionave;
	} else if($_GET[reg]==2){
	  $constance=$conregionwav;
	} else{
	  $constance=$conregionsum;
	}
}


$fin='';

if($high==1){
	$fin=$fin.'['; 

	$aes = mysqli_query($conint,"SELECT * FROM $dset where year>=$fy AND year<=$ly");
	while($aow = mysqli_fetch_array($aes)){   
	  $tc=$aow[cid];
	  $year=$aow['year'];
	  $country=$aow['country'];
	  $value=$aow['value'];
	  if(($_GET[c0]==$tc||$_GET[c1]==$tc||$_GET[c2]==$tc||$_GET[c3]==$tc||$_GET[c4]==$tc||$_GET[c5]==$tc||$_GET[c6]==$tc||$_GET[c7]==$tc||$_GET[c8]==$tc||$_GET[c9]==$tc )){
	    $fin=$fin.'{"year":'.$year.', "name":"'.$country.'", "value":'.$value.'},';    
	  }
	}
	
	if($_GET[r0]>0||$_GET[r1]>0||$_GET[r2]>0||$_GET[r3]>0||$_GET[r4]>0||$_GET[r5]>0||$_GET[r6]>0||$_GET[r7]>0||$_GET[r8]>0||$_GET[r9]>0 ){
		$aes = mysqli_query($constance,"SELECT * FROM $dset where year>=$fy AND year<=$ly");
		while($aow = mysqli_fetch_array($aes)){   
		  $tc=$aow['rid'];
		  $year=$aow['year'];
		  $rname=html_entity_decode($aow['rname']);
		  $value=$aow['value'];
		  if(($_GET[r0]==$tc||$_GET[r1]==$tc||$_GET[r2]==$tc||$_GET[r3]==$tc||$_GET[r4]==$tc||$_GET[r5]==$tc||$_GET[r6]==$tc||$_GET[r7]==$tc||$_GET[r8]==$tc||$_GET[r9]==$tc )){
		    $fin=$fin.'{"year":'.$year.', "name":"'.$rname.'", "value":'.$value.'},';    
		  }  
		}
	}

	$fin=$fin.'];';	
} else{
	$fin=$fin.'['; 

	$aes = mysqli_query($conint,"SELECT * FROM $dset where year>=$fy AND year<=$ly");
	while($aow = mysqli_fetch_array($aes)){   
	  $year=$aow['year'];
	  $country=$aow['country'];
	  $value=$aow['value'];
	  $fin=$fin.'{"year":'.$year.', "name":"'.$country.'", "value":'.$value.'},';    
	}
	
	if($_GET[r0]>0||$_GET[r1]>0||$_GET[r2]>0||$_GET[r3]>0||$_GET[r4]>0||$_GET[r5]>0||$_GET[r6]>0||$_GET[r7]>0||$_GET[r8]>0||$_GET[r9]>0 ){
	$aes = mysqli_query($constance,"SELECT * FROM $dset where year>=$fy AND year<=$ly");
		while($aow = mysqli_fetch_array($aes)){   
		  $year=$aow['year'];
		  $rname=html_entity_decode($aow['rname']);
		  $value=$aow['value'];
		  $fin=$fin.'{"year":'.$year.', "name":"'.$rname.'", "value":'.$value.'},';    
		}
	}

	$fin=$fin.'];';	
}



  
$data = array($fin);
echo $_GET['callback'] . '('.json_encode($data).')';

mysqli_close($con);
mysqli_close($conint);?>