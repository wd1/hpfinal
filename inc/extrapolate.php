<?php
include 'con.php';
include 'conint.php';
include 'conext.php';

$dataset=$_GET['dataset'];
$exter = "z".$dataset;

//DROP THE TABLE IF IT EXISTS
$sq = "DROP TABLE $exter";
if ($conext->query($sq) === TRUE) {} else {}

//CREATE NEW TABLE WITHOUT DATA
$rql = "CREATE TABLE $exter (
  datasetid int(11) AUTO_INCREMENT PRIMARY KEY,
  cid int(11),
  country varchar(255),
  year varchar(255),
  value varchar(255)
)";
if ($conext->query($rql) === TRUE) {} else {}

//COPY DATASET FROM 'inter' DB to 'exter' DB
$aes = mysqli_query($conint,"SELECT * FROM $exter");
while($aow = mysqli_fetch_array($aes)){ 
	$country = $aow['country'];
	$cid = $aow['cid'];
	$year = $aow['year'];
	$value = $aow['value'];	
	$aesult = mysqli_query($conext,"INSERT INTO $exter(cid,country,year,value) VALUES('$cid','$country','$year','$value')");
}

//***This script extrapolatess data for each country within each dataset from the interpolate DB to the extrapolate DB
$aes = mysqli_query($con,"SELECT * FROM datasets WHERE id='$dataset'");
while($aow = mysqli_fetch_array($aes)){ 
	$tempid = $aow['id'];
	$querry = "z".$tempid;

	$bes = mysqli_query($con,"SELECT id,name FROM countries");
	while($bow = mysqli_fetch_array($bes)){ 
		$cid = $bow['id'];
		$name = $bow['name'];

		$ly=0;
		$fy=0;
		$vfv=0;
		$vlv=0;

		$something=0;//used to check if the country is in the dataset
		$ces = mysqli_query($conext,"SELECT year,value FROM $querry WHERE cid='$cid' ORDER BY year ASC");//get first year with value
		while($cow = mysqli_fetch_array($ces)){
		    $something++;
			$year=$cow['year'];
		    $value=$cow['value'];
		    if($value!=''){
		    	$fy=$year;
		    	$fv=$value;
		    	break;
		    } 
		}

		$ces = mysqli_query($conext,"SELECT year,value FROM $querry WHERE cid='$cid' ORDER BY year DESC");//get last year with value
		while($cow = mysqli_fetch_array($ces)){
			$year=$cow['year'];
		    $value=$cow['value'];
		    if($value!=''){
		    	$ly=$year;
		    	$lv=$value;
		    	break;
		    } 
		}

		$ces = mysqli_query($conext,"SELECT year,value FROM $querry WHERE cid='$cid' ORDER BY year ASC");//get first year, regardless of whether there is a value
		while($cow = mysqli_fetch_array($ces)){
			$year=$cow['year'];
		    $value=$cow['value'];
		    
	    	$vfy=$year;
	    	$vfv=$value;
	    	break;			    
		}
		$ces = mysqli_query($conext,"SELECT year,value FROM $querry WHERE cid='$cid' ORDER BY year DESC");//get last year, regardless of whether there is a value
		while($cow = mysqli_fetch_array($ces)){
			$year=$cow['year'];
		    $value=$cow['value'];
		    
	    	$vly=$year;
	    	$vlv=$value;
	    	break;
		}
		
		$zount=1;
		if($vfv=='' && $something>0 ){
			$slope=( ($lv-$fv) / ($ly-$fy) );
			for($x=$fy-1;$x>=$vfy;$x--){
				$calc=round( $fv-($slope*$zount),2 );
				$zount++;				

				$checkyearexists=0;
				$ces = mysqli_query($conext,"SELECT * FROM $querry WHERE cid='$cid' AND year='$x'");
				while($cow = mysqli_fetch_array($ces)){	
					$checkyearexists=1;
					break;
				}

				if($checkyearexists==1){
					$besult = mysqli_query($conext,"UPDATE $querry set value='$calc' WHERE cid='$cid' AND year='$x' ");
				} else{
					$aesult = mysqli_query($conext,"INSERT INTO $querry(cid,country,year,value) VALUES('$cid','$name','$x','$calc')");
				}	
			}	
		}

		$zount=1;
		if($vlv=='' && $something>0 ){
			$test = 'very last is blank';
			$slope=( ($lv-$fv) / ($ly-$fy) );
			for($x=$ly+1;$x<=$vly;$x++){
				$calc=round($lv+($slope*$zount),2 );
				$zount++;				

				$checkyearexists=0;
				$ces = mysqli_query($conext,"SELECT * FROM $querry WHERE cid='$cid' AND year='$x'");
				while($cow = mysqli_fetch_array($ces)){	
					$checkyearexists=1;
					break;
				}

				if($checkyearexists==1){
					$besult = mysqli_query($conext,"UPDATE $querry set value='$calc' WHERE cid='$cid' AND year='$x' ");
				} else{
					$aesult = mysqli_query($conext,"INSERT INTO $querry(cid,country,year,value) VALUES('$cid','$name','$x','$calc')");
				}
			}	
		}
	}
	
}  
//***End script









$data = array(1);
echo $_GET['callback'] . '('.json_encode($data).')';


mysqli_close($con);
mysqli_close($conint);
mysqli_close($conext);
?>