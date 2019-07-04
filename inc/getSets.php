<?php
	include 'con.php';
	$p = $_GET['p'];

	$f='';
	//$f="<i class='fa fa-close-circle-o'></i>";
	$count=0;
	$res=0;
	$result = mysqli_query($con,"SELECT id,subcat FROM subcats WHERE subcat LIKE '%$p%' ORDER BY subcat ASC");
	while($row = mysqli_fetch_array($result))
	{
		$count++;
		if($count==1){
			//$f=$f."<section>Topics</section>";
		}
		//$f=$f."<div class='topo' data-sid='".$row['id']."''>".$row['subcat']."</div>";
	}

	$yount=0;
	$bes = mysqli_query($con,"SELECT id,catid,subcat FROM subcats ORDER BY subcat ASC");
	while($bow = mysqli_fetch_array($bes)){
		$tid=$bow['id'];
		$cid=$bow['catid'];
		$temp=$bow['subcat'];
		$count=0;

		$fucked=0; 
		$les = mysqli_query($con,"SELECT cat FROM cats WHERE id=$cid");	  
		while($low = mysqli_fetch_array($les)){
			$cat=$low['cat'];
		}

		$catidcount=0;

		$zes = mysqli_query($con,"SELECT id FROM subcats WHERE catid=$cid");	  
		while($zow = mysqli_fetch_array($zes)){
			$catidcount++;
		}
		 
		if( $temp==$cat && $catidcount>1 ){	
			$fucked=1;
		}

		$ces = mysqli_query($con,"SELECT id,title,subtitle,seodescr,catsubcat,firstyear,lastyear FROM datasets WHERE title LIKE '%$p%' OR subtitle LIKE '%$p%' OR seodescr LIKE '%$p%' AND type='dynamic'");
		while($cow = mysqli_fetch_array($ces)){ 
			if ( (strpos($cow['catsubcat'],"*".$tid."*") !== false)&&($fucked==0) ) {
				if($yount==0){
					//$f=$f."<section>Datasets</section>";	  	
					$yount++;
				} 
			  $count++;
			  if($count==1){
			    $f=$f."<span>".$temp."</span>";
			  }
			  $f=$f."<a class='relink' href='dwworld?p=".$cow['id']."&c0=2&c1=24&c2=67&c3=11&yf=".$cow['firstyear']."&yl=".$cow['lastyear']."'>".$cow['title'].", ".$cow['subtitle'].", ".$cow['firstyear']."-".$cow['lastyear']." </a>";
			  $res++;
			}
		}
	} 

	if($yount==0){
		$f=$f."<div style='color:#ff6c00'>No results found</div>";
	}


  $data[0]=$f;
  $data[1]=$res;
  echo $_GET['callback'] . '('.json_encode($data).')';
  mysqli_close($con);
?>