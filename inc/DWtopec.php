<?php
  echo "<div class='topec'>";
    echo "<div class='in-wrap'><div class='in-in-wrap'><input type='text' placeholder='Search Datasets & Topics'><i class='fa fa-search searcha'></i>";

    $ser = $_SERVER['PHP_SELF'];
    if( $_GET[p]>0 && ((strpos($ser, 'dwline')!==false)||(strpos($ser, 'dwscat')!==false)) ){
      echo "<div class='comp-but'>Compare Datasets</div>";
    }

    echo "</div></div>";
      $ser = $_SERVER['PHP_SELF'];

      if($_GET[p]>0){
        $donothing=1;
      } else{
        echo "<div class='vad'>View All Datasets</div>";
        echo "<div class='had'>Hide All Datasets</div>";
      } 
     
    echo "<div class='partial' id='tries'></div>";       
  echo "</div>";
?>