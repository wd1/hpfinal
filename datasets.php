<?php require_once( 'admin/cms.php' ); ?>
<cms:template title='Dataset' order='7'>
</cms:template>
<?php include 'inc/INChead.php';$randal=rand(1,999);  
    echo "<link rel='stylesheet' type='text/css' href='css/datasets.css?version=".$randal."'>";
    echo "<script src='js/jquery.dataTables.js' type='text/javascript'></script>";
    echo "<script src='js/jquery.dataTables.columnFilter.js' type='text/javascript'></script>";
?>    
<script>$(window).load(function () {window.tmp=$('.type option:selected').text();localStorage.setItem('type',tmp); });</script>
<?php

  if ($_FILES[csv][size] > 0) { 
    $conn = new mysqli('localhost','root','deadbeef88','custom');
    $initial = $_GET['z'];
    $init = "z".$initial;

    $first=0;

    $file = $_FILES[csv][tmp_name]; 
    $handle = fopen($file,"r"); 

    do {
        if ($data[0]) { 
          $conte = count($data)-1;
          if($first==0){
            $jack = $data[0];
            $first++; 
          }
        } 
    } while ($data = fgetcsv($handle,1000,",",'"')); 

        if($conte==3 && jack!=''){//upload for staticDouble
                    $sq = "DROP TABLE $init";
                    if ($conn->query($sq) === TRUE) {} else {}

                    $sql = "CREATE TABLE $init (
                      datasetid int(11) AUTO_INCREMENT PRIMARY KEY,
                      series varchar(255),
                      dataline varchar(255),
                      year varchar(255),
                      value real
                    )";

                    if ($conn->query($sql) === TRUE) {} else {}


                    $connect = mysql_connect("localhost","root","deadbeef88");
                    mysql_select_db("custom",$connect);
                    $file = $_FILES[csv][tmp_name]; 
                    $handle = fopen($file,"r"); 
                      
                    do { 
                        if ($data[0]) { 
                            $zero = addslashes($data[0]);
                            $zero = str_replace('"', '', $zero);
                            $zero = str_replace("'", '', $zero);
                            $zero = str_replace('&', '', $zero);
                            $zero = str_replace('™', '', $zero);
                            $zero = trim($zero);
                            $zero = preg_replace("/[^A-Za-z ]/", "", $zero);

                            $one = addslashes($data[1]);
                            $one = str_replace('"', '', $one);
                            $one = str_replace("'", '', $one);
                            $one = str_replace('&', '', $one);
                            $one = str_replace('™', '', $one);
                            $one = trim($one);
                            $one = preg_replace("/[^A-Za-z ]/", "", $one);

                            $two = addslashes($data[2]);
                            $two = str_replace('"', '', $two);
                            $two = str_replace("'", '', $two);
                            $two = str_replace('&', '', $two);
                            $two = str_replace('™', '', $two);
                            $two = preg_replace("/[^0-9]/", "", $two); 

                            $three = addslashes($data[3]);
                            $three = str_replace('"', '', $three);
                            $three = str_replace("'", '', $three);
                            $three = str_replace('&', '', $three);
                            $three = str_replace('™', '', $three);
                            $three = preg_replace("/[^0-9.-]/", "", $three); 

                            //if($three==''){$three='NULL';} 
                            if($three==''){$three=NULL;} 

                            mysql_query("INSERT INTO $init (series, dataline, year, value) VALUES 
                                ( 
                                    '$zero', 
                                    '$one', 
                                    '$two',
                                    $three 
                                ) 
                            "); 
                        } 
                    } while ($data = fgetcsv($handle,1000,",",'"')); 
        } else if($conte==2 && $jack!=''){//upload for staticSingle normalized and dynamic normalized
                    $sq = "DROP TABLE $init";
                    if ($conn->query($sq) === TRUE) {} else {}

                    $sql = "CREATE TABLE $init (
                      datasetid int(11) AUTO_INCREMENT PRIMARY KEY,
                      country varchar(255),
                      year varchar(255),
                      value real
                    )";

                    if ($conn->query($sql) === TRUE) {} else {}

                    $connect = mysql_connect("localhost","root","deadbeef88");
                    mysql_select_db("custom",$connect); 
                    $file = $_FILES[csv][tmp_name]; 
                    $handle = fopen($file,"r"); 
                      
                    do { 
                        if ($data[0]) { 
                            $zero = addslashes($data[0]);
                            $zero = str_replace('"', '', $zero);
                            $zero = str_replace("'", '', $zero);
                            $zero = str_replace('&', '', $zero);
                            $zero = str_replace('™', '', $zero);  
                            $zero = trim($zero);
                            $zero = preg_replace("/[^A-Za-z ]/", "", $zero);                           

                            $one = addslashes($data[1]);
                            $one = str_replace('"', '', $one);
                            $one = str_replace("'", '', $one);
                            $one = str_replace('&', '', $one);
                            $one = str_replace('™', '', $one);
                            $one = preg_replace("/[^0-9]/", "", $one); 

                            $two = addslashes($data[2]);
                            $two = str_replace('"', '', $two);
                            $two = str_replace("'", '', $two);
                            $two = str_replace('&', '', $two);
                            $two = str_replace('™', '', $two);
                            $two = preg_replace("/[^0-9.-]/", "", $two); 

                            //if($two==''){$two='NULL';} 
                            if($two==''){$two=NULL;} 

                            mysql_query("INSERT INTO $init (country, year, value) VALUES 
                                ( 
                                    '$zero', 
                                    '$one', 
                                    $two 
                                ) 
                            "); 
                        } 
                    } while ($data = fgetcsv($handle,1000,",",'"')); 
      } else{//upload for staticSingle NonNormalized (horizontal) and dynamic NonNormalized
                    $conn = new mysqli('localhost','root','deadbeef88','custom');

                    $sq = "DROP TABLE ztest";if ($conn->query($sq) === TRUE) {} else {}
                    $tq = "DROP TABLE $init";if ($conn->query($tq) === TRUE) {} else {}

                    $connect = mysql_connect('localhost','root','deadbeef88');
                    mysql_select_db('custom',$connect); 
                    $file = $_FILES[csv][tmp_name]; 
                    $handle = fopen($file,'r');  

                    $first=0;
                    do { 
                        if($first==1){
                          $dataclone=$data;
                          $counter = count($data)-1;
                          $adder =  count($data)-2;
                          $firstyear = $data[1]; 
                          $lastyear = $data[1]+$adder;
                          $lastyeartemp = $data[$counter];

                          //if($lastyeartemp<$firstyear){
                          //  $firstyear=$firstyear-$adder;
                          //  $lastyear =$lastyear-$adder;
                          //}

                          for($x=1;$x<$counter;$x++){
                            $curval=$data[$x];
                            $yearstretch=$yearstretch.'a'.$curval.',';
                            $gstretch=$gstretch."a".$curval." varchar(255), ";
                          }
                          $gstretch=$gstretch."a".$lastyeartemp." varchar(255)";

                          $sql = "CREATE TABLE ztest (
                            datasetid int(11) AUTO_INCREMENT PRIMARY KEY,
                            country varchar(255),
                            ".$gstretch."
                          )";
                          if ($conn->query($sql) === TRUE) {} else {}
                        }
                        $first++;

                        
                        $qstretch='';
                        for($y=0;$y<$counter;$y++){
                          $qstretch=$qstretch."'".addslashes($data[$y])."',";
                        }
                        $qstretch=$qstretch."'".addslashes($data[$counter])."'";

                        if ($data[0]) { 
                            mysql_query("INSERT INTO ztest (country, ".$yearstretch."a".$lastyeartemp.") VALUES 
                                (".$qstretch.") 
                            "); 
                        } 

                        if (strpos($qstretch, '..') !== false) {
 						   $aesult = mysqli_query($conn,"DELETE FROM ztest WHERE country='?'");
						}			
                        
                    } while ($data = fgetcsv($handle,1000,",",'"')); 


                    $rql = "CREATE TABLE $init (
                      datasetid int(11) AUTO_INCREMENT PRIMARY KEY,
                      country varchar(255),
                      year varchar(255),
                      value real
                    )";

                    if ($conn->query($rql) === TRUE) {} else {}

                    for($z=1;$z<$counter;$z++){
                      $zz=$dataclone[$z];
                      $fstretch=$fstretch."SELECT country, 'a".$zz."' as year, a".$zz." as value from ztest union all "; 
                    }
                    $fstretch=$fstretch."SELECT country, 'a".$lastyeartemp."' as year, a".$lastyeartemp." as value from ztest"; 
                    $aes = mysqli_query($conn,$fstretch); 
                    while($aow = mysqli_fetch_array($aes)){ 
                      $country = $aow['country'];
                      $country = str_replace("?"," ",$country);
                      $year = $aow['year'];
                      $year = ltrim($year, 'a');
                      $value = $aow['value'];
                          //if($value==''){$value='NULL';}
                          if($value==''){$value=NULL;} 

                          $country = addslashes($country);
                          $country = str_replace('"', '', $country);
                          $country = str_replace("'", '', $country);
                          $country = str_replace('&', '', $country);
                          $country = str_replace('™', '', $country);                            
                          $country = trim($country);
                          $country = preg_replace("/[^A-Za-z ]/", "", $country);     

                          $year = addslashes($year);
                          $year = str_replace('"', '', $year);
                          $year = str_replace("'", '', $year);
                          $year = str_replace('&', '', $year);
                          $year = str_replace('™', '', $year);
                          $year = preg_replace("/[^0-9]/", "", $year); 


                          $value = addslashes($value);
                          $value = str_replace('"', '', $value);
                          $value = str_replace("'", '', $value);
                          $value = str_replace('&', '', $value);
                          $value = str_replace('™', '', $value);
                          $value = preg_replace("/[^0-9.-]/", "", $value); 
                      $zesult = mysqli_query($conn,"INSERT INTO $init(country,year,value) VALUES('$country','$year',$value)");
                    }
                    
                    /*if($thisis!=1){
                    	$aesult = mysqli_query($conn,"DELETE FROM $init WHERE datasetid='1'");	
                    }*/
      }

      //START ADD FIRST YEAR/LAST YEAR TO DATASETS TABLE
      $bes = mysqli_query($conn,"SELECT * FROM $init ORDER BY year ASC");
      while($bow = mysqli_fetch_array($bes)){ 
        $fy = $bow['year'];
        break;
      }

      $ces = mysqli_query($conn,"SELECT * FROM $init ORDER BY year DESC");
      while($cow = mysqli_fetch_array($ces)){ 
        $ly = $cow['year'];
        break;
      }   

      // DONT NEED THIS CUZ YOU'RE DOING IT ALL AT THE END$aesult = mysqli_query($conn,"UPDATE datasets set firstyear='$fy', lastyear='$ly' WHERE id='$initial'");
      //END ADD FIRST YEAR/LAST YEAR TO DATASETS TABLE


      //START REMOVE INITIAL COUNTRIES
      $emp=0;
      for($x=$fy;$x<$ly;$x++){ 
        $des = mysqli_query($conn,"SELECT * FROM $init WHERE year='$x'");
        while($dow = mysqli_fetch_array($des)){ 
          if($dow['value']==''){
            $donothing=0;
          } else{
            $emp++;
          }
        }         

        if($emp==0){
          $aesult = mysqli_query($conn,"DELETE FROM $init WHERE year='$x'");          
        } else{
          break;
        }
      }  

      //repeat setting first year as it may have changed after removing initial countries
      $bes = mysqli_query($conn,"SELECT * FROM $init ORDER BY year ASC");
      while($bow = mysqli_fetch_array($bes)){ 
        $fy = $bow['year'];
        break;
      }


      $emp=0;
      for($x=$ly;$x>$fy;$x--){ 
        $des = mysqli_query($conn,"SELECT * FROM $init WHERE year='$x'");
        while($dow = mysqli_fetch_array($des)){ 
          if($dow['value']==''){
            $donothing=0;
          } else{
            $emp++;
          }
        }         

        if($emp==0){
          $aesult = mysqli_query($conn,"DELETE FROM $init WHERE year='$x'");          
        } else{
          break;
        }
      }  

      //repeat setting first year as it may have changed after removing initial countries
      $bes = mysqli_query($conn,"SELECT * FROM $init ORDER BY year ASC");
      while($bow = mysqli_fetch_array($bes)){ 
        $fy = $bow['year'];
        break;
      }

      $ces = mysqli_query($conn,"SELECT * FROM $init ORDER BY year DESC");
      while($cow = mysqli_fetch_array($ces)){ 
        $ly = $cow['year'];
        break;
      } 


      $aesult = mysqli_query($conn,"UPDATE datasets set firstyear='$fy', lastyear='$ly' WHERE id='$initial'");

      //END REMOVE INITIAL COUNTRIES
mysqli_close($connect);
mysqli_close($conn);





//BEGIN INTERPOLATION





include 'inc/con.php';
include 'inc/conint.php';

$dataset=$initial;
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
  value real,
  inty varchar(1)
)";
if ($conint->query($rql) === TRUE) {} else {}

//COPY DATASET FROM 'custom' DB to 'interpolate' DB
$aes = mysqli_query($con,"SELECT * FROM $inter");
while($aow = mysqli_fetch_array($aes)){ 
  $country = $aow['country'];
  $year = $aow['year'];
  $value = $aow['value']; 
  if($value==''){$value='NULL';}
  $aesult = mysqli_query($conint,"INSERT INTO $inter(country,year,value) VALUES('$country','$year',$value)");
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
    if(($findcount==0&&$findal==0) ){
      $aesult = mysqli_query($conint,"DELETE FROM $querry WHERE country='$country'");        
    } else{
      $aesult = mysqli_query($conint,"UPDATE $querry set cid='$cid' WHERE country='$country'");

      $zes = mysqli_query($con,"SELECT name FROM countries WHERE id='$cid'");
      while($zow = mysqli_fetch_array($zes)){
        $zname=$zow['name'];
      }  

      $besult = mysqli_query($conint,"UPDATE $querry set country='$zname' WHERE country='$country'");
      /*if($country=='Cte dIvoire'){//IVORY COAST FIX
        $cte="Cote d'Ivoire";
        $cte = mysqli_real_escape_string($conint,$cte);
        $besult = mysqli_query($conint,"UPDATE $querry set country='$cte' WHERE country='$country'");  
      } else{
        $besult = mysqli_query($conint,"UPDATE $querry set country='$zname' WHERE country='$country'");  
      }*/
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

//THIS IS WHERE YOU NEED TO WRITE THE FILE INTO THE 'cooked' DB (SEE EXTRAPOLATE)
include 'inc/concooked.php';

$dataset=$initial;
$cooked = "z".$dataset;

//DROP THE TABLE IF IT EXISTS
$sq = "DROP TABLE $cooked";
if ($concooked->query($sq) === TRUE) {} else {}

//CREATE NEW TABLE WITHOUT DATA in 'cooked' DB
$rql = "CREATE TABLE $cooked (
  datasetid int(11) AUTO_INCREMENT PRIMARY KEY,
  cid int(11),
  country varchar(255),
  year varchar(255),
  value real
)";
if ($concooked->query($rql) === TRUE) {} else {}

//COPY DATASET FROM 'inter' DB to 'cooked' DB
$aes = mysqli_query($conint,"SELECT * FROM $cooked");
while($aow = mysqli_fetch_array($aes)){ 
  $country = $aow['country'];
  $cid = $aow['cid'];
  $year = $aow['year'];
  $value = $aow['value']; 
  if($value==''){$value='NULL';}
  $aesult = mysqli_query($concooked,"INSERT INTO $cooked(cid,country,year,value) VALUES('$cid','$country','$year',$value)");
}



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
            $calc=round( $fv-($slope*$zount),5);
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
              $aesult = mysqli_query($conint,"INSERT INTO $querry(cid,country,year,value,inty) VALUES('$cid','$name','$y','$calc','*')");
            } 
            //echo "<br>";

          }

        }

        if($lv>$fv){
          $slope=(($lv-$fv)/$dif);
          for($y=$ffyy+1;$y<$llyy;$y++){
            $calc=round( $fv+($slope*$zount),5);
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
              $aesult = mysqli_query($conint,"INSERT INTO $querry(cid,country,year,value,inty) VALUES('$cid','$name','$y','$calc','*')");
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
              $aesult = mysqli_query($conint,"INSERT INTO $querry(cid,country,year,value,inty) VALUES('$cid','$name','$y','$calc','*')");
            } 

          }
        }
      }
    }
}  

mysqli_close($con);
mysqli_close($conint);



//START EXTRAPOLATION

/*

include 'inc/con.php';
include 'inc/conint.php';
include 'inc/conext.php';

$dataset=$initial;
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
  value real,
  inty varchar(1)
)";
if ($conext->query($rql) === TRUE) {} else {}

//COPY DATASET FROM 'inter' DB to 'exter' DB
$aes = mysqli_query($conint,"SELECT * FROM $exter");
while($aow = mysqli_fetch_array($aes)){ 
  $country = $aow['country'];
  $cid = $aow['cid'];
  $year = $aow['year'];
  $value = $aow['value'];
  $inty= $aow['inty'];

  if($value==''){$value='NULL';} 
  $aesult = mysqli_query($conext,"INSERT INTO $exter(cid,country,year,value,inty) VALUES('$cid','$country','$year',$value,'$inty')");
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
        $calc=round( $fv-($slope*$zount),5);
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
          $aesult = mysqli_query($conext,"INSERT INTO $querry(cid,country,year,value,inty) VALUES('$cid','$name','$x','$calc','e')");
        } 
      } 
    }

    $zount=1;
    if($vlv=='' && $something>0 ){
      $test = 'very last is blank';
      $slope=( ($lv-$fv) / ($ly-$fy) );
      for($x=$ly+1;$x<=$vly;$x++){
        $calc=round($lv+($slope*$zount),5);
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
          $aesult = mysqli_query($conext,"INSERT INTO $querry(cid,country,year,value,inty) VALUES('$cid','$name','$x','$calc','e')");
        }
      } 
    }
  }
  
}  
//***End script


mysqli_close($con);
mysqli_close($conint);
mysqli_close($conext);

*/


include 'inc/con.php';
include 'inc/conint.php';
include 'inc/conregionsum.php';
include 'inc/conregionave.php';
include 'inc/conregionwav.php';
//********************************BEGIN REGIONALIZATION************************************

//DROP THE TABLE IF IT EXISTS
$sq = "DROP TABLE $inter";
if ($conregionsum->query($sq) === TRUE) {} else {}

//CREATE NEW TABLE WITHOUT DATA
$rql = "CREATE TABLE $inter (
  datasetid int(11) AUTO_INCREMENT PRIMARY KEY,
  rid int(11),
  rname varchar(255),
  year varchar(255),
  value real
)";
if ($conregionsum->query($rql) === TRUE) {} else {}

//DROP THE TABLE IF IT EXISTS
$sq = "DROP TABLE $inter";
if ($conregionave->query($sq) === TRUE) {} else {}

//CREATE NEW TABLE WITHOUT DATA
$rql = "CREATE TABLE $inter (
  datasetid int(11) AUTO_INCREMENT PRIMARY KEY,
  rid int(11),
  rname varchar(255),
  year varchar(255),
  value real
)";
if ($conregionave->query($rql) === TRUE) {} else {}

//DROP THE TABLE IF IT EXISTS
$sq = "DROP TABLE $inter";
if ($conregionwav->query($sq) === TRUE) {} else {}

//CREATE NEW TABLE WITHOUT DATA
$rql = "CREATE TABLE $inter (
  datasetid int(11) AUTO_INCREMENT PRIMARY KEY,
  rid int(11),
  rname varchar(255),
  year varchar(255),
  value real
)";
if ($conregionwav->query($rql) === TRUE) {} else {}



//This script extrapolatess data for each country within each dataset from the interpolate DB to the extrapolate DB
$aes = mysqli_query($con,"SELECT * FROM datasets WHERE type='dynamic' AND id='$dataset'");
while($aow = mysqli_fetch_array($aes)){ 
  $tempid = $aow['id'];
  $querry = "z".$tempid;
  $fy=$aow['firstyear'];
  $ly=$aow['lastyear'];

  for($x=$fy;$x<=$ly;$x++){//Go through each year of the dataset
    $bes = mysqli_query($con,"SELECT rid,region FROM regions");//Run a loop for all the regions 
    while($bow = mysqli_fetch_array($bes)){ 
      $rid = $bow['rid'];
      $region = $bow['region'];
      $regpop=0;
      $parpop=0;
      $valwav=0;
      $value='';
      $count=0;

      $ces = mysqli_query($con,"SELECT cid FROM zaliases WHERE rid='$rid'");//Get population of all countries within region
      while($cow = mysqli_fetch_array($ces)){
        $cid=$cow['cid'];

        $xy="a".$x;
      
        $des = mysqli_query($con,"SELECT $xy FROM countries_final WHERE id=$cid ");//CALCULATE REGIONAL TOTAL
        while($dow = mysqli_fetch_array($des)){
          $regpop=$regpop+$dow[$xy];
        }

        $exists=0;
        $ees = mysqli_query($conint,"SELECT value FROM $querry WHERE cid=$cid AND year=$x");
        while($eow = mysqli_fetch_array($ees)){
          if($eow['value']==''){
            $donothing=1;
          } else{
            $value=$value+$eow['value'];
            
            $fes = mysqli_query($con,"SELECT $xy FROM countries_final WHERE id=$cid ");
            while($fow = mysqli_fetch_array($fes)){
              $parpop=$parpop+$fow[$xy];
              $valwav=$valwav+($eow['value']*$fow[$xy]);
              $count++;
            }            
          }

        }
      }

      $ave = $value/$count;
      if($ave==0){
        $ave='';
      }
      $wav = $valwav/$parpop;
      if($wav==0){
        $wav='';
      }

      if( $parpop >= $regpop*.75 ){
        //$region=$region.$parpop." (parpop) *".$regpop. " (regpop)". $value. " (value)". $count. " (count)";
        $aesult = mysqli_query($conregionsum,"INSERT INTO $querry(rid,rname,year,value) VALUES('$rid','$region','$x','$value')");
        $besult = mysqli_query($conregionave,"INSERT INTO $querry(rid,rname,year,value) VALUES('$rid','$region','$x','$ave')");
        $cesult = mysqli_query($conregionwav,"INSERT INTO $querry(rid,rname,year,value) VALUES('$rid','$region','$x','$wav')");
      } 

      /*echo "yearrr: ".$x."<br>";
      echo "ridddd: ".$rid."<br>";
      echo "regpop: ".$regpop."<br>";
      echo "parpop: ".$parpop."<br>";
      echo "valuee: ".$value."<br>";
      echo "wavvvv: ".$wav."<br>";
      echo "<br>";*/
    }
  }
}  

mysqli_close($con);
mysqli_close($conint);
mysqli_close($conregionsum);
mysqli_close($conregionave);
mysqli_close($conregionwav);


      //*** START CREATING DATA TABLE FILE ***/
      include 'inc/con.php'; 
      include 'inc/concooked.php'; 

      $aes = mysqli_query($con,"SELECT firstyear,lastyear FROM datasets WHERE id=$initial");
      while($aow = mysqli_fetch_array($aes)){   
        $fy=$aow['firstyear'];
        $ly=$aow['lastyear'];
      }

      $fim=$fim."var dataObject = [";
        $aes = mysqli_query($concooked,"SELECT DISTINCT country FROM $init ORDER BY country ASC");
        while($aow = mysqli_fetch_array($aes)){   
              $country=$aow['country'];
          
              $fim=$fim."{";
              $fim=$fim.'country:"'.$country.'",';

              for($x=$fy;$x<=$ly;$x++){              
                $count=0;
                $bes = mysqli_query($concooked,"SELECT value FROM $init WHERE country='$country' AND year='$x'");
                while($bow = mysqli_fetch_array($bes)){   
                  $count++;
                  $bvalue=$bow['value'];
                  if($bvalue==null){
                    $fim=$fim."a".$x.":null,"; 
                  }else{
                    $fim=$fim."a".$x.":'".round($bvalue,5)."',";            
                  }
                }
              }
              $fim=$fim."},";
        }
      $fim=$fim."];";

      $file = fopen('/var/www/html/datatable/'.$initial.".js","w");
      echo fwrite($file,$fim);
      fclose($file);
      
      mysqli_close($con);
      mysqli_close($concooked);
      //*** END CREATING DATA TABLE FILE ***/

      //***START MOVING RAW FILE TO RAW FOLDER***
      if (move_uploaded_file($_FILES['csv']['tmp_name'], "/var/www/html/raw/RAW".$initial.".csv")) {
         
      } else {
          print "Upload failed!";
      }
      //***END MOVING RAW FILE TO RAW FOLDER***

      //ADD MARKER AND GO TO DIFFERENT URL IF THERE ARE MULTIPLE ALIASES MAPPING TO ONE COUNTRY... just check for multiple values
      include 'inc/con.php';
      include 'inc/conint.php';
      $flagged=0;

      $aes = mysqli_query($conint,"SELECT DISTINCT country FROM $init ORDER BY country ASC");
      while($aow = mysqli_fetch_array($aes)){   
        $country=$aow['country'];

        for($x=$fy;$x<=$ly;$x++){
          $cou=0;
          $bes = mysqli_query($conint,"SELECT * FROM $init WHERE country='$country' AND year='$x'");
          while($bow = mysqli_fetch_array($bes)){   
            $cou++;
            $conner=$bow['country'];
          }          
          if($cou>1){
            $flagged=1;
            $fincon=$conner;
          }
        }
      }


      mysqli_close($con);
      mysqli_close($conint);
    
      if($flagged==1){
        header('Location: aaa?z='.$fincon.''); die;
      } else{
        header('Location: review?z='.$initial.''); die; 
      }

  } 



?>
<script type="text/javascript">
$(document).ready(function(){
    var pedic = window.location.href.split('=')[1];	
    setTimeout(function(){ $('.ida[data-id='+pedic+']').trigger('click'); }, 10); 

    $('#DTB').dataTable({
      'iDisplayLength':20000000000,
      bJQueryUI: true,
        'sPaginationType': 'full_numbers'
    })
    
    .columnFilter({sPlaceHolder: 'head:before',
    aoColumns:[  
    {type:'text'},
    {type:'text'},
    {type:'text'},
    {type:'text'},
    {type:'date'},
    {type:'select', sSelector: '#Filter', values: ['dynamic','static','static double']},
    {type:'select', sSelector: '#Filter', values: ['n','y']}
    ]
    });
});
</script>
<div class='rapper'>
  <table cellpadding='0' cellspacing='0' border='0' class='display' id='DTB'>
      <thead>
        <tr>
          <th class='DTHead' style='width:10px'>id</th>
          <th class='DTHead' style='width:10px'>oldid</th>
          <th class='DTHead'>Title</th>
          <th class='DTHead'>Subtitle</th>
          <th class='DTHead' style='width:10px'>Update Date</th>
          <th class='DTHead'>Data Type</th>
          <th class='DTHead' style='width:10px'>Disabled</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>id</th>
          <th>oldid</th>
          <th>Title</th>
          <th>Subtitle</th>
          <th>Update Date</th>
          <th>Data Type</th>
          <th>Disabled</th>
        </tr>
      </tfoot>
      <tbody>
        <?php
        include 'inc/con.php';
        $result = mysqli_query($con,"SELECT * FROM datasets ORDER BY id");
        while($row = mysqli_fetch_array($result))
          {
            echo "<tr>";
            echo "<td class='ida' data-id='".$row['id']."'>" . html_entity_decode($row['id'],ENT_QUOTES) . "</td>";
            echo "<td>" . html_entity_decode($row['oldid'],ENT_QUOTES) . "</td>";
            echo "<td>" . html_entity_decode($row['title'],ENT_QUOTES) . "</td>";
            echo "<td>" . html_entity_decode($row['subtitle'],ENT_QUOTES) . "</td>";
            echo "<td>" . html_entity_decode($row['updatedate'],ENT_QUOTES) . "</td>";
            echo "<td>" . html_entity_decode($row['type'],ENT_QUOTES) . "</td>";
            echo "<td>" . html_entity_decode($row['pinker'],ENT_QUOTES) . "</td>";
            echo "</tr>";
          }
          mysqli_close($con);
          ?>
      </tbody>
  </table>
</div>
<div class='loader'><img src='img/jiffy.gif'></div>
<div class='modal'>
    <div class='shell'>
        <label>Old ID (optional)</label>
            <input type='text' class='oldid' maxlength='7'>
                <div class='val val-oldid'>oldid placeholder val</div>
        
        <label>Title *</label> 
            <input type='text' class='title' maxlength='499'>
                <div class='val val-title'>Title cannot be blank</div>

        <label>Subtitle *</label>
            <input type='text' class='subtitle' maxlength='499'>
                <div class='val val-subtitle'>Subtitle cannot be blank</div>
        <label>Type *</label>
            <select class='type'>
                <option>dynamic</option>
                <option>single</option>
                <option>double</option>
            </select>
                <div class='val val-type'>Type placeholder</div>
        
        <label>Protected *</label>
            <select class='pinker'>
                <option>n</option>
                <option>y</option>
            </select>
                <div class='val val-pinker'>Pinker placeholder</div>
        
        <label>Source Description *</label>
            <input type='text' class='sourcedescr' maxlength='499'>
                <div class='val val-sourcedescr'>Source description cannot be blank</div>
        
        <label>Source URL 1 *</label>
            <input type='text' class='sourceurlone' maxlength='499'>
                <div class='val val-sourceurlone'>Source URL 1 cannot be blank</div>
        
        <label>Source URL 2</label>
            <input type='text' class='sourceurltwo' maxlength='499'>
                <div class='val val-sourceurltwo'>Sourceurltwo placeholder</div>

        <label>Definition *</label>
            <input type='text' class='definition' maxlength='499'>
                <div class='val val-definition'>Definition cannot be blank</div>

        <label>Seo Description *</label>
            <input type='text' class='seodescr' maxlength='499'>
                <div class='val val-seodescr'>SEO Description cannot be blank</div>
        
        <label>Update Date (yyyy-mm-dd) *</label>
            <input type='text' class='updatedate'>
                <div class='val val-updatedate'>Date must be in correct format, yyyy-mm-dd</div>

        <form method='post' enctype='multipart/form-data' name='form1' id='form1'> 
          <input name='csv' type='file' id='csv' accept='.csv'/> 
          <input class='subclick' type='submit' name='Submit' value='Submit' />

          <a class='reviewer'>Review Aliases</a>
          <br><br><br>
          
          <a class='rawrawraw'>RAW</a>
          <a class='downloader'>Normalize</a>
          <a class='downloadcooked'>Cooked</a>
          <a class='downloadinter'>Interpolate</a>
          <!--<a class='downloadexter'>Extrapolate</a>-->
          <a class='downloadsum'>Region Sum</a>
          <a class='downloadave'>Region Ave</a>
          <a class='downloadwav'>Region Wav</a>
          <!--<a class='downloaddump'>DUMP (beta)</a>-->
        </form> 
        
        <div class='save butter'>Add Dataset</div>
        <div class='edit butter'>Save Edits</div>
        
    </div>
    <div class='temping'></div>
    <!-- THIS CODE IS WHAT PULLS IN ALL CATEGORIES AND SUBCATEGORIES FROM THE admin-cms and displays on backend-->
  
    <?php 
      include 'inc/con.php'; 

      $aes = mysqli_query($con,"SELECT * FROM cats ORDER BY cat ASC");
      while($aow = mysqli_fetch_array($aes)){ 
          $id = $aow['id'];
          $cat = $aow['cat'];

          $bes = mysqli_query($con,"SELECT * FROM subcats WHERE catid=$id");
          while($bow = mysqli_fetch_array($bes)){             
              $sid = $bow['id'];
              $subcat = $bow['subcat'];
              echo "<section><input class='checker' type='checkbox' data-id='".$sid."'> <span>".$cat." - ".$subcat."</span> <br></section>";
          } 

      }
      mysqli_close($con);
    ?>
    <div class='deletecase'><div class='delete'>Delete</div></div>
</div>
<a href='countries' class='gt gtcountries'>Countries</a>
<a href='regions' class='gt gtregions'>Regions</a>
<a href='downloadAll' class='gt'><i class='fa fa-download'></i></a>
<i class='fa fa-plus'></i>
<i class='fa fa-times-circle'></i>
<div class='coverer'></div>
<script type="text/javascript">
$(document).ready(function(){


  $('.downloaddump').on('click', function() {
    for(var z=31;z<40;z++){
      $.ajax({
        url:'aaaa.php',
        type: 'POST',
        data: {z:z},
        async: false
      }).done(function(data){
        console.log(z);
        location.href='download?z='+z+'';  
      });
    }  
    
  }); 

});   

</script>
<?php $randal=rand(1,999);  echo "<script src='cjs/datasets.js?version=".$randal."'></script>"; ?>
</body></html><?php COUCH::invoke(); ?>