<?php
	include 'con.php';
	
	$f='';
	$count=0;
	$yount=0;
	$res=0;
	$bes = mysqli_query($con,"SELECT id,catid,subcat FROM subcats ORDER BY subcat ASC");
	
	while($bow = mysqli_fetch_array($bes)){
		$tid=$bow['id'];
		$cid=$bow['catid'];

		$temp=$bow['subcat'];
		$count=0;
		$yount++;

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

		$ces = mysqli_query($con,"SELECT id,title,subtitle,seodescr,catsubcat,firstyear,lastyear FROM datasets WHERE type='dynamic'");
		while($cow = mysqli_fetch_array($ces)){ 
			if ( (strpos($cow['catsubcat'],"*".$tid."*") !== false)&&($fucked==0) ) {
				$count++;
			
				if($count==1){
					$f=$f."<span>".$temp."</span>";
				}
			
				$f=$f."<a class='relink' href='dwworld?p=".$cow['id']."&c0=2&c1=24&c2=67&c3=11&c4=-1&c5=-1&c6=-1&c7=-1&c8=-1&c9=-1&r0=-1&r2=-1&r3=-1&r4=-1&r5=-1&r6=-1&r7=-1&r8=-1&r9=-1&z=-1&yf=-1&yl=-1'>".$cow['title'].", ".$cow['subtitle'].", ".$cow['firstyear']."-".$cow['lastyear']."</a>";
				$res++;
			}
		}
	} 

	$data[0]=$f;
	$data[1]=$res;
	echo $_GET['callback'] . '('.json_encode($data).')';
	mysqli_close($con);
?>