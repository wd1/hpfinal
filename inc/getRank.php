<?php
include 'con.php';
include 'conint.php'; 
$dset="z".$_GET['p'];
$fy=$_GET['val1'];
$ly=$_GET['val2'];

$fin=$fin."<div id='svgContainer'>";
  $fin=$fin."<svg id='svg' width='0' height='0'>";
    $cou=0;
    $aes = mysqli_query($conint,"SELECT * FROM $dset WHERE year='$fy' ORDER BY value DESC");
    while($aow = mysqli_fetch_array($aes)){   
      $oldval=$newval;
      $cid=$aow['cid'];
      $country=$aow['country'];
      $value=$aow['value'];

      if($value!=''){
        $fin=$fin."<path data-id='".$country."' id='path".$cid."' />";
      }
    }
  $fin=$fin."</svg>";
$fin=$fin."</div>";






$fin=$fin."<div class='ranker rank-outer'>";
  $fin=$fin."<div class='ff first'>";
    $fin=$fin."<span class='a' >".$fy." Ranking</span>";
      $cou=0;
      $aes = mysqli_query($conint,"SELECT * FROM $dset WHERE year='$fy' ORDER BY value DESC");
      while($aow = mysqli_fetch_array($aes)){   
        $oldval=$newval;
        $cid=$aow['cid'];
        $country=$aow['country'];
        $value=$aow['value'];

        if($value!=''){
          $newval=$value;              
          $cou++;
          if($newval!=$oldval){
            if($value<10){
              $fin=$fin."<section class='s".$cid."'><div class='bolnum'>".$cou.".</div> <div class='context'>".$country."</div> <div class='a".$cid." secnum'>".round($value,2)."</div></section>"; 
            } else{
              $fin=$fin."<section class='s".$cid."'><div class='bolnum'>".$cou.".</div> <div class='context'>".$country."</div> <div class='a".$cid." secnum'>".round($value,1)."</div></section>";
            }
          } else{
            if($value<10){
              $fin=$fin."<section class='s".$cid."'><div class='bolnum' style='visibility:hidden'>".$cou.".</div> <div class='context'>".$country."</div> <div class='a".$cid." secnum'>".round($value,2)."</div></section>"; 
            } else{
              $fin=$fin."<section class='s".$cid."'><div class='bolnum' style='visibility:hidden'>".$cou.".</div> <div class='context'>".$country."</div> <div class='a".$cid." secnum'>".round($value,1)."</div></section>";  
            }
          }            
        }
      }
  $fin=$fin."</div>";
$fin=$fin."</div>";





$fin=$fin."<div class='ranker rank-outer'>";
  $fin=$fin."<div class='ff last'>";
    $fin=$fin."<span class='b'>".$ly." Ranking</span>";
      $cou=0;
      $aes = mysqli_query($conint,"SELECT * FROM $dset WHERE year='$ly' ORDER BY value DESC");
      while($aow = mysqli_fetch_array($aes)){   
        $oldval=$newval;
        $cid=$aow['cid'];
        $country=$aow['country'];
        $value=$aow['value'];

        if($value!=''){
          $newval=$value;
          $cou++;
          if($newval!=$oldval){
            if($value<10){
              $fin=$fin."<section class='s".$cid."'><div class='b".$cid." bolnum'>".$cou.".</div> <div class='context'>".$country."</div> <div class='secnum'>".round($value,2)."</div></section>";
            } else{
              $fin=$fin."<section class='s".$cid."'><div class='b".$cid." bolnum'>".$cou.".</div> <div class='context'>".$country."</div> <div class='secnum'>".round($value,1)."</div></section>";              
            }
          } else{
            if($value<10){
              $fin=$fin."<section class='s".$cid."'><div class='b".$cid." bolnum' style='visibility:hidden'>".$cou.".</div> <div class='context'>".$country."</div> <div class='secnum'>".round($value,2)."</div></section>";
            } else{
              $fin=$fin."<section class='s".$cid."'><div class='b".$cid." bolnum' style='visibility:hidden'>".$cou.".</div> <div class='context'>".$country."</div> <div class='secnum'>".round($value,1)."</div></section>"; 
            }
          }
        }
      }
  $fin=$fin."</div>";
$fin=$fin."</div>";




$ccount=0;
$oco=array();
$aes = mysqli_query($conint,"SELECT * FROM $dset WHERE year='$fy' ORDER BY value DESC");
while($aow = mysqli_fetch_array($aes)){   
  $country=$aow['country'];
  $value=$aow['value'];
  $cid=$aow['cid'];

  $vount=0;
  $res = mysqli_query($conint,"SELECT * FROM $dset WHERE year='$ly' AND country='$country'");
  while($row = mysqli_fetch_array($res)){   
    $vount++;
  }

  if($value!=''&&$vount==1){
    $oco[$ccount]=$cid;
    $ccount++;
    //echo "connectElements($('#svg'),$('#path".$cid."'),$('.a".$cid."'),$('.b".$cid."'));";  
  } 

}







  
$data = array($fin,$oco,$ccount);
echo $_GET['callback'] . '('.json_encode($data).')';

mysqli_close($con);
mysqli_close($conint);?>