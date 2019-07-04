    <?php
      if($_GET[p]>0){
        echo "<div class='holder'>";
      } else{
        echo "<div class='holder' style='display:none'>";
      } 
    ?>       
      <div class='title-holder'>
        <?php
        include 'inc/con.php';
        $p=$_GET['p']; 
        $zes = mysqli_query($con,"SELECT title,subtitle,firstyear,lastyear FROM datasets WHERE id='$p'");
        while($zow = mysqli_fetch_array($zes)){ 
            $title = $zow['title'];
            $subtitle = $zow['subtitle'];
            $firstyear= $zow['firstyear'];
            $lastyear = $zow['lastyear'];
        }
        echo "<div class='title-txt'>".$title."</div>";
        
        $rr="<div class='subtitle-txt'><section>".$subtitle.", ".$firstyear."-".$lastyear."</section>";
        if($_GET[p]>0){
          $rr=$rr. "<div class='soco'><span class='dwdown'><i class='fa fa-download'></i> Download</span><span class='dwshare'><i class='fa fa-share-alt'></i> Share</span></div>";
        } 
        $rr=$rr."</div>";
        echo $rr;
        ?>    
      </div>
      <a class='change-but' href='dws7' style='display:none'>
        <i class='fa fa-exchange'></i>
        Change Dataset
      </a>
      <?php
        $ser = $_SERVER['PHP_SELF'];
        if( $_GET[p]>0&&(strpos($ser, 'dwworld')== false)&&(strpos($ser, 'dwdata')== false) ){
          echo "<div class='country-holder'>";
        } else{
          echo "<div class='country-holder' style='display:none'>";
        } 
      ?>  
        <form action='' method='post'><input type='text' name='country' value='' class='auto' placeholder='Select Country/Region to Visualize'></form>
        <div class='countries'>
          <?php

            for($x=0;$x<$_GET[cc];$x++){
              $tempx="c".$x;
              if($_GET[$tempx]>0){
                include 'inc/con.php'; 
                $aes = mysqli_query($con,"SELECT * FROM countries WHERE id=$_GET[$tempx]");
                while($aow = mysqli_fetch_array($aes)){ 
                  echo "<span data-cid='".$aow[id]."'>".$aow['name']." <i class='fa fa-times-circle-o'></i></span> ";
                }
              }            
            }
            mysqli_close($con);

          ?>
        </div>
      </div>
      <div class='viz-holder'>
        <span class='sWorld'>
          <i class='fa fa-globe'></i>
          <section>World Map</section>
        </span>
        <span class='sScatter'>
          <img class='scatter-icon' src='img/scatter.png'>
          <section>Scatter Chart</section>
        </span>
        <span class='sLine'>
          <img class='line-icon' src='img/line.png'>
          <section>Line Chart</section>
        </span>
        <span class='sBar'>
          <img class='bar-icon' src='img/bar.png'>
          <section>Bar Chart</section>
        </span>
        <span class='sTree'>
          <i class='fa fa-th-large'></i>
          <section>Tree Map</section>
        </span>
        <span class='sRank'>
          <i class='fa fa-list-ol'></i>
          <section>Rank List</section>
        </span>
        <span class='sCalc'>
          <i class='fa fa-table'></i>
          <section>Calc Table</section>
        </span>
        <span class='sData'>
          <i class='fa fa-th-list'></i>
          <section>Data Table</section>
        </span>
      </div>
      <div class='placeholderimg'>
        <div class='cont' id='hWorld'></div>
        <div id='bWorld'>
          <div id='slider'>
            <div id='custom-handle' class='ui-slider-handle'></div>
          </div>
          <i class='fa fa-play'></i>
          <i class='fa fa-pause'></i>
        </div>
        
        <div class='cont' id='dScat'></div>
        
        <div class='cont' id='hScat'></div>
        
        <div class='cont' id='dLine'></div>
        
        <div class='cont' id='hLine'></div>
        
        <div class='cont' id='dBar'></div>
        
        <div class='cont' id='hBar'></div>
        
        <div class='cont' id='dTree'></div>
        
        <div class='cont' id='hTree'></div>
        
        <div id='rank'><?php include 'DWrank.php';?></div>
        
        <div class='cont' id='calc'></div>
        
        <div class='cont hot-container' id='dData'></div>
      </div>
    </div>


<?php if($_GET[p]>0){echo "<div class='categories' style='display:none'>";}else{echo "<div style='display:none' class='categories'>";}?>
        <span>Topics</span>
        <?php 
            include 'inc/con.php'; 
            $aes = mysqli_query($con,"SELECT catsubcat FROM datasets WHERE id=$_GET[p]");
            while($aow = mysqli_fetch_array($aes)){ 
                $temp = $aow['catsubcat'];
                $arr = explode("*", $temp);
                $arr=array_filter($arr);
                $arr=array_values($arr);
                $count = count($arr);
                for($x=0;$x<$count;$x++){
                    $test = $arr[$x];
                  
                    $bes = mysqli_query($con,"SELECT * FROM subcats WHERE id=$test");
                    while($bow = mysqli_fetch_array($bes)){
                        $catid=$bow['catid'];
                        $sid=$bow['id'];
                        $subcatr=$bow['subcat'];
                    } 
                    $arrTest = explode("*", $test);
                    if($x==($count-1)){
                        echo "<a href='index?cid=".$catid."&sid=".$sid."' class='cat cat1'>".$subcatr."</a>";   
                    } else{
                        echo "<a href='index?cid=".$catid."&sid=".$sid."' class='cat cat1'>".$subcatr."</a><span class='fs'>/</span>";   
                    }
                }
            } 
            mysqli_close($con);
        ?>
    </div>

    <div class='relist'>
            <?php 
                include 'inc/con.php'; 
                $aes = mysqli_query($con,"SELECT catsubcat FROM datasets WHERE id=$_GET[p]");
                while($aow = mysqli_fetch_array($aes)){ 
                    $temp = $aow['catsubcat'];
                }

                $count=0;
                $bes = mysqli_query($con,"SELECT id,subcat FROM subcats");
                while($bow = mysqli_fetch_array($bes)){ 
                  if (strpos($temp, $bow['id']) !== false) {
                    $arro[$count][0]=$bow['id'];
                    $arro[$count][1]=$bow['subcat'];
                    $count++;
                  }
                } 

                for($x=0;$x<$count;$x++){
                  $idr=$arro[$x][0];
                  $ttr=$arro[$x][1];
                  echo "<section class='relist-header'>Related <span style='color:#ff6c00'>".$ttr."</span> Datasets</section>";
                  $ces = mysqli_query($con,"SELECT id,title,subtitle,catsubcat,firstyear,lastyear FROM datasets");
                  while($cow = mysqli_fetch_array($ces)){ 
                    if (strpos($cow['catsubcat'],$idr) !== false) {
                      $act = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                      $act = explode('&',$act,2);

                      $firstact= explode('?',$act[0],2);

                      $act = $firstact[0]."?p=".$cow['id']."&".$act[1];
                      echo "<a class='relink' href='".$act."'>".$cow['title'].", ".$cow['subtitle'].", ".$firstyear."-".$lastyear."</a>";
                    }
                  }
                  echo "<br>";
                }

                mysqli_close($con);
            ?>
    </div>