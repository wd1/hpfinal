<?php
include 'conCouch.php';
$p=$_GET['pid']; 
$match=0;
$totalMatch=0;
$mark=0;

$zes = mysqli_query($con,"SELECT value FROM couch_data_text WHERE page_id='$p' AND field_id=173");
while($zow = mysqli_fetch_array($zes)){ 
	$tempVal1 = $zow['value'];
	$fco=0;
	$arr1 = explode("|", $tempVal1);
	$count1 = count($arr1);
}

$use=0;
$aes = mysqli_query($con,"SELECT id FROM couch_pages WHERE template_id='11' AND id <> '$p' ORDER BY creation_date");
while($aow = mysqli_fetch_array($aes)){ 
	$match=0;
	$id=$aow['id'];
	$xes = mysqli_query($con,"SELECT value FROM couch_data_text WHERE page_id='$id' AND field_id=173");
	while($xow = mysqli_fetch_array($xes)){ 
		$tempVal2 = $xow['value'];
		$arr2 = explode("|", $tempVal2);
		$count2 = count($arr2);
		for($x=0;$x<$count1;$x++){
			for($y=0;$y<$count2;$y++){
				if($arr1[$x]==$arr2[$y]){
					$match++;
				}
			}
		}
	} 

	$mark=0;
	if($match>0 && $totalMatch<6){
		for($l=160;$l<165;$l++){
			if($l==161){/*Because we are getting title from page_title instead of CMS title i check for 161 where title was and insert page title*/
				$res = mysqli_query($con,"SELECT page_title FROM couch_pages WHERE id=$id");
    			while($row = mysqli_fetch_array($res)){ 
    				$final[$totalMatch][$mark]=$row['page_title'];
    			}
			} else{
				$des = mysqli_query($con,"SELECT value FROM couch_data_text WHERE page_id='$id' AND field_id='$l'");
				while($dow = mysqli_fetch_array($des)){ 
					$final[$totalMatch][$mark]=$dow['value'];					
				} 
			}
			$mark++;
		}
		$final[$totalMatch][$mark]=$id;	
		$mark++;
			$res = mysqli_query($con,"SELECT creation_date FROM couch_pages WHERE id='$id'");
			while($row = mysqli_fetch_array($res)){ 
			    $date = $row['creation_date'];
			}
			$year = substr($date,0,4);
			$mon = substr($date,5,2);
			$day = substr($date,8,2);
			if($mon=='01'){$month='jan';}
			if($mon=='02'){$month='feb';}
			if($mon=='03'){$month='mar';}
			if($mon=='04'){$month='apr';}
			if($mon=='05'){$month='may';}
			if($mon=='06'){$month='jun';}
			if($mon=='07'){$month='jul';}
			if($mon=='08'){$month='aug';}
			if($mon=='09'){$month='sep';}
			if($mon=='10'){$month='oct';}
			if($mon=='11'){$month='nov';}
			if($mon=='12'){$month='dec';}
			$final[$totalMatch][$mark]=$day.' '.$month.' '.$year;
			$totalMatch++;
	}
}

//$data = array($match);
$data = array($final[0],$final[1],$final[2],$final[3],$final[4],$final[5]);
echo $_GET['callback'] . '('.json_encode($data).')';

mysqli_close($con);
?>