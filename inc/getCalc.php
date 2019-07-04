<?php
include 'con.php';
include 'conint.php'; 

$dset="z".$_GET['p'];
$fy=$_GET['val1'];
$ly=$_GET['val2'];
$c0=$_GET['c0'];
$c1=$_GET['c1'];


$aes = mysqli_query($con,"SELECT title FROM datasets WHERE id=$_GET[p]");
while($aow = mysqli_fetch_array($aes)){   
  $title=$aow['title'];
}

//COUNTRY 0
$c0=$_GET[c0];
$aes = mysqli_query($con,"SELECT name FROM countries WHERE id='$c0'");
while($aow = mysqli_fetch_array($aes)){   
  $coun0=$aow['name'];
}

$cou=0;
$aes = mysqli_query($conint,"SELECT * FROM $dset WHERE year='$fy' AND cid='$c0'");
while($aow = mysqli_fetch_array($aes)){   
  $cou++;
  $val0=$aow['value'];
}

if($cou==0){
  $val0='N/A';
}



//COUNTRY 1
$c1=$_GET[c1];
$aes = mysqli_query($con,"SELECT name FROM countries WHERE id='$c1'");
while($aow = mysqli_fetch_array($aes)){   
  $coun1=$aow['name'];
}

$cou=0;
$aes = mysqli_query($conint,"SELECT * FROM $dset WHERE year='$fy' AND cid='$c1'");
while($aow = mysqli_fetch_array($aes)){   
  $cou++;
  $val1=$aow['value'];
}

if($cou==0){
  $val1='N/A';
}

//CALCULATIONS
if($val0=='N/A'||$val1=='N/A'){
  $val0rel='N/A';
} else{
  $val0rel=round(($val0/$val1)*100,2);
}

if($val1=='N/A'||$val0=='N/A'){
  $val1rel='N/A';
} else{
  $val1rel=round(($val1/$val0)*100,2);
}









//COUNTRY 2
$cou=0;
$aes = mysqli_query($conint,"SELECT * FROM $dset WHERE year='$ly' AND cid='$c0'");
while($aow = mysqli_fetch_array($aes)){   
  $cou++;
  $val2=$aow['value'];
}

if($cou==0){
  $val2='N/A';
}



//COUNTRY 3
$c1=$_GET[c1];
$aes = mysqli_query($con,"SELECT name FROM countries WHERE id='$c1'");
while($aow = mysqli_fetch_array($aes)){   
  $coun1=$aow['name'];
}

$cou=0;
$aes = mysqli_query($conint,"SELECT * FROM $dset WHERE year='$ly' AND cid='$c1'");
while($aow = mysqli_fetch_array($aes)){   
  $cou++;
  $val3=$aow['value'];
}

if($cou==0){
  $val3='N/A';
}

//CALCULATIONS
if($val2=='N/A'||$val3=='N/A'){
  $val2rel='N/A';
} else{
  $val2rel=round(($val2/$val3)*100,2); 
}

if($val3=='N/A'||$val2=='N/A'){
  $val3rel='N/A';
} else{
  $val3rel=round(($val3/$val2)*100,2);
}



//ABSOLUTE 
if($val2=='N/A'||$val0=='N/A'){
  $c0abs='N/A';
} else{
  $c0abs=$val2-$val0;  
}

if($val3=='N/A'||$val1=='N/A'){
  $c1abs='N/A';
} else{
  $c1abs=$val3-$val1;
}
//PERCENT
if($val2=='N/A'||$val0=='N/A'){
  $c0per='N/A';
} else{
  $c0per=round( (($val2-$val0)/$val0)*100 ,2);
}

if($val3=='N/A'||$val1=='N/A'){
  $c1per='N/A';
} else{
  $c1per=round( (($val3-$val1)/$val1)*100 ,2);
}









  $fin=$fin."<div class='calcy calcol1'>";
    $fin=$fin."<div class='calin'>";
      $fin=$fin."<div class='yeary yeary1' >".$fy."</div>";
          $fin=$fin."<div class='toptop'>";
            $fin=$fin."<div class='topleft'>";
              $fin=$fin."<div class='topleftval calcval'>".$val0."</div>";
              $fin=$fin."<div class='topleftcoun calccoun'>".$coun0."</div>";
              $fin=$fin."<div class='toplefttitle calctit'>".$title."</div>";
            $fin=$fin."</div>";
            $fin=$fin."<div class='topright'>";
              $fin=$fin."<div class='toprightval calcval'>".$val1."</div>";
              $fin=$fin."<div class='toprightcoun calccoun'>".$coun1."</div>";
              $fin=$fin."<div class='toprighttitle calctit'>".$title."</div>";
            $fin=$fin."</div>";  
          $fin=$fin."</div>";
          $fin=$fin."<div class='botbot'>";
            $fin=$fin."<div class='botleft'>";
              $fin=$fin."<div class='botleftval calcval'>".$val0rel." %</div>";
              $fin=$fin."<div class='botleftcoun calccoun'>".$coun0." Relative To ".$coun1."</div>";
              $fin=$fin."<div class='botlefttitle calctit'>".$title."</div>";
            $fin=$fin."</div>";
            $fin=$fin."<div class='botright'>";
              $fin=$fin."<div class='botrightval calcval'>".$val1rel." %</div>";
              $fin=$fin."<div class='botrightcoun calccoun'>".$coun1." Relative To ".$coun0."</div>";
              $fin=$fin."<div class='botrighttitle calctit'>".$title."</div>";
            $fin=$fin."</div>";  
          $fin=$fin."</div>";
    $fin=$fin."</div>";
  $fin=$fin."</div>";
  $fin=$fin."<div class='calcy calcol2'>";
    $fin=$fin."<div class='calin'>";
      $fin=$fin."<div class='yeary yeary1' >".$ly."</div>";
          $fin=$fin."<div class='toptop'>";
            $fin=$fin."<div class='topleft'>";
              $fin=$fin."<div class='topleftval calcval'>".$val2."</div>";
              $fin=$fin."<div class='topleftcoun calccoun'>".$coun0."</div>";
              $fin=$fin."<div class='toplefttitle calctit'>".$title."</div>";
            $fin=$fin."</div>";
            $fin=$fin."<div class='topright'>";
              $fin=$fin."<div class='toprightval calcval'>".$val3."</div>";
              $fin=$fin."<div class='toprightcoun calccoun'>".$coun1."</div>";
              $fin=$fin."<div class='toprighttitle calctit'>".$title."</div>";
            $fin=$fin."</div>";  
          $fin=$fin."</div>";
          $fin=$fin."<div class='botbot'>";
            $fin=$fin."<div class='botleft'>";
              $fin=$fin."<div class='botleftval calcval'>".$val2rel." %</div>";
              $fin=$fin."<div class='botleftcoun calccoun'>".$coun0." Relative To ".$coun1."</div>";
              $fin=$fin."<div class='botlefttitle calctit'>".$title."</div>";
            $fin=$fin."</div>";
            $fin=$fin."<div class='botright'>";
              $fin=$fin."<div class='botrightval calcval'>".$val3rel." %</div>";
              $fin=$fin."<div class='botrightcoun calccoun'>".$coun1." Relative To ".$coun0."</div>";
              $fin=$fin."<div class='botrighttitle calctit'>".$title."</div>";
            $fin=$fin."</div>";  
          $fin=$fin."</div>";
    $fin=$fin."</div>";
  $fin=$fin."</div>";
  $fin=$fin."<div class='calcy calcol3'>";
    $fin=$fin."<div class='calin'>";
      $fin=$fin."<div class='yeary yeary1' >".$fy."-".$ly." Summary</div>";
          $fin=$fin."<div class='toptop'>";
            $fin=$fin."<div class='topleft'>";
              $fin=$fin."<div class='topleftval calcval'>".$c0abs."</div>";
              $fin=$fin."<div class='topleftcoun calccoun'>".$coun0." Absolute Change</div>";
              $fin=$fin."<div class='toplefttitle calctit'>".$title."</div>";
            $fin=$fin."</div>";
            $fin=$fin."<div class='topright'>";
              $fin=$fin."<div class='toprightval calcval'>".$c1abs."</div>";
              $fin=$fin."<div class='toprightcoun calccoun'>".$coun1." Absolute Change</div>";
              $fin=$fin."<div class='toprighttitle calctit'>".$title."</div>";
            $fin=$fin."</div>";  
          $fin=$fin."</div>";
          $fin=$fin."<div class='botbot'>";
            $fin=$fin."<div class='botleft'>";
              $fin=$fin."<div class='botleftval calcval'>".$c0per." %</div>";
              $fin=$fin."<div class='botleftcoun calccoun'>% Change in ".$coun0."</div>";
              $fin=$fin."<div class='botlefttitle calctit'>".$title." </div>";
            $fin=$fin."</div>";
            $fin=$fin."<div class='botright'>";
              $fin=$fin."<div class='botrightval calcval'>".$c1per." %</div>";
              $fin=$fin."<div class='botrightcoun calccoun'>% Change in ".$coun1."</div>";
              $fin=$fin."<div class='botrighttitle calctit'>".$title."</div>";
            $fin=$fin."</div>";  
          $fin=$fin."</div>";
    $fin=$fin."</div>";
  $fin=$fin."</div>";
  
$data = array($fin);
echo $_GET['callback'] . '('.json_encode($data).')';

mysqli_close($con);
mysqli_close($conint);?>