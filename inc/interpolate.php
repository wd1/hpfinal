<?php
include 'con.php';
include 'conint.php';

$dataset=$_GET['dataset'];
$inter = "z".$dataset;

//DROP THE TABLE IF IT EXISTS
$sq = "DROP TABLE $inter";
if ($conint->query($sq) === TRUE) {} else {}

//CREATE NEW TABLE WITHOUT DATA
$rql = "CREATE TABLE $inter (
  datasetid int(11) AUTO_INCREMENT PRIMARY KEY,
  cid int(11),
  country varchar(255),
  year varchar(255),
  value varchar(255)
)";
if ($conint->query($rql) === TRUE) {} else {}

//COPY DATASET FROM 'custom' DB to 'interpolate' DB
$aes = mysqli_query($con,"SELECT * FROM $inter");
while($aow = mysqli_fetch_array($aes)){ 
	$country = $aow['country'];
	$year = $aow['year'];
	$value = $aow['value'];	
	$aesult = mysqli_query($conint,"INSERT INTO $inter(country,year,value) VALUES('$country','$year','$value')");
}

//***This script writes cid values to tables in 'interpolate' DB
$aes = mysqli_query($con,"SELECT * FROM datasets WHERE id='$dataset'");
while($aow = mysqli_fetch_array($aes)){ 
	$tempid = $aow['id'];
	$querry = "z".$tempid;

	$bes = mysqli_query($conint,"SELECT DISTINCT country FROM $querry");
	while($bow = mysqli_fetch_array($bes)){ 
	    $country=$bow['country'];

	    //FIRST CHECK COUNTRY LIST FOR A MATCH
	    $findcount=0;
	    $ces = mysqli_query($con,"SELECT id FROM countries WHERE name='$country'");
	    while($cow = mysqli_fetch_array($ces)){
	      $cid=$cow['id'];
	      $findcount++;
	    }   

	    //IF NOTHING THERE, CHECK ALIASES (aliases)
	    $findal=0;
	    if($findcount==0){
	      $des = mysqli_query($con,"SELECT cid FROM aliases WHERE nombre='$country'");
	      while($dow = mysqli_fetch_array($des)){
	        $cid=$dow['cid'];
	      	$findal++;
	      }   
	    }

	    //IF THERE IS NO MATCH, DONT SET A CID. ELSE ADD IT TO 'interpolate' DB
		if($findcount==0&&$findal==0){
			$donothing=1;          
		} else{
			$aesult = mysqli_query($conint,"UPDATE $querry set cid='$cid' WHERE country='$country'");

			$zes = mysqli_query($con,"SELECT name FROM countries WHERE id='$cid'");
			while($zow = mysqli_fetch_array($zes)){
				$zname=$zow['name'];
			}  
			$besult = mysqli_query($conint,"UPDATE $querry set country='$zname' WHERE country='$country'");
		}
	}
}  
//***End this script


//***This script removes countries with no values at all throughout the dataset
$aes = mysqli_query($con,"SELECT * FROM datasets WHERE id='$dataset'");
while($aow = mysqli_fetch_array($aes)){ 
	$tempid = $aow['id'];
	$querry = "z".$tempid;

	$bes = mysqli_query($con,"SELECT id FROM countries");
	while($bow = mysqli_fetch_array($bes)){ 
		$cid = $bow['id'];
		
		$something=0;
		$hasval=0;
		$ces = mysqli_query($conint,"SELECT value FROM $querry WHERE cid='$cid'");
		while($cow = mysqli_fetch_array($ces)){
			$something++;
		    $value=$cow['value'];
		    if($value!=''){
		    	$hasval=1;
		    } 
		}

		if($hasval==0&&$something>0){
			$aesult = mysqli_query($conint,"DELETE FROM $querry WHERE cid='$cid' ");		
		} 

	}

}  
//***End this script

//***This script interpolates data for each country within a dataset
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
			$ces = mysqli_query($conint,"SELECT year,value FROM $querry WHERE cid='$cid' ORDER BY year ASC");
			while($cow = mysqli_fetch_array($ces)){
				$year=$cow['year'];
			    $value=$cow['value'];
			    if($value!=''){
			    	$fy=$year;
			    	break;
			    } 
			}
			$ces = mysqli_query($conint,"SELECT year,value FROM $querry WHERE cid='$cid' ORDER BY year DESC");
			while($cow = mysqli_fetch_array($ces)){
				$year=$cow['year'];
			    $value=$cow['value'];
			    if($value!=''){
			    	$ly=$year;
			    	break;
			    } 
			}

			/*START OF WHERE I NEED TO BE CODING*/
			$count=0;
			$arr = array();
			for($x=$fy;$x<=$ly;$x++){
				$ces = mysqli_query($conint,"SELECT year,value FROM $querry WHERE cid='$cid' AND year='$x'");
				while($cow = mysqli_fetch_array($ces)){			
					$year=$cow['year'];
					$value=$cow['value'];
					if($value!=''){
						$arr[$count][0]=$year;
						$arr[$count][1]=$value;
						$count++;
					}
				}
			}

			$seq=count($arr);

			
			for($x=0;$x<$seq-1;$x++){
				$ffyy=$arr[$x][0];
				$llyy=$arr[$x+1][0];
				$fv=$arr[$x][1];
				$lv=$arr[$x+1][1];
				//echo $ffyy;
				//echo "...";
				//echo $llyy;
				//echo "...";
				$dif=$llyy-$ffyy;
				//echo $dif;

				//echo "<br>";
				//echo "year=".$ffyy.", value=".$fv."";
				//echo "<br>";
				$zount=1;

				if($fv>$lv){
					$slope=(($fv-$lv)/$dif);
					for($y=$ffyy+1;$y<$llyy;$y++){
						$calc=round( $fv-($slope*$zount),2 );
						//echo "year=".$y.", value=".$calc."";
						$zount++;				

						$checkyearexists=0;
						$ces = mysqli_query($conint,"SELECT * FROM $querry WHERE cid='$cid' AND year='$y'");
						while($cow = mysqli_fetch_array($ces)){	
							$checkyearexists=1;
							break;
						}

						if($checkyearexists==1){
							//echo "exists";
							$besult = mysqli_query($conint,"UPDATE $querry set value='$calc' WHERE cid='$cid' AND year='$y' ");
						} else{
							//echo "doesnt exist";
							$aesult = mysqli_query($conint,"INSERT INTO $querry(cid,country,year,value) VALUES('$cid','$name','$y','$calc')");
						}	
						//echo "<br>";

					}

				}

				if($lv>$fv){
					$slope=(($lv-$fv)/$dif);
					for($y=$ffyy+1;$y<$llyy;$y++){
						$calc=round( $fv+($slope*$zount),2 );
						//echo "year=".$y.", value=".$calc."";
						//echo "<br>";
						$zount++;
						$checkyearexists=0;
						$ces = mysqli_query($conint,"SELECT * FROM $querry WHERE cid='$cid' AND year='$y'");
						while($cow = mysqli_fetch_array($ces)){	
							$checkyearexists=1;
							break;
						}

						if($checkyearexists==1){
							//echo "exists";
							$besult = mysqli_query($conint,"UPDATE $querry set value='$calc' WHERE cid='$cid' AND year='$y' ");
						} else{
							//echo "doesnt exist";
							$aesult = mysqli_query($conint,"INSERT INTO $querry(cid,country,year,value) VALUES('$cid','$name','$y','$calc')");
						}	

					}

				}

				if($lv==$fv){
					for($y=$ffyy+1;$y<$llyy;$y++){
						$calc=$lv;
						//echo "year=".$y.", value=".$calc."";
						//echo "<br>";
						$zount++;

						$checkyearexists=0;
						$ces = mysqli_query($conint,"SELECT * FROM $querry WHERE cid='$cid' AND year='$y'");
						while($cow = mysqli_fetch_array($ces)){	
							$checkyearexists=1;
							break;
						}

						if($checkyearexists==1){
							//echo "exists";
							$besult = mysqli_query($conint,"UPDATE $querry set value='$calc' WHERE cid='$cid' AND year='$y' ");
						} else{
							//echo "doesnt exist";
							$aesult = mysqli_query($conint,"INSERT INTO $querry(cid,country,year,value) VALUES('$cid','$name','$y','$calc')");
						}	

					}
				}

				/*CHECK IF YEAR EXISTS, AND IF SO UPDATE WITH RELATIVE $CALC VALUE. OTHERWISE ADD ROW WITH CALC VALUE*/

				/*END CHECK*/

				//echo "<br>";

			}
			/*END OF WHERE I NEED TO BE CODING*/
		}
	
}  
//***ENd this script











$data = array(1);
echo $_GET['callback'] . '('.json_encode($data).')';


mysqli_close($con);
mysqli_close($conint);
?>