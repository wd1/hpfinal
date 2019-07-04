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
                  $rent="*".$bow['id']."*";
                  if (strpos($temp, $rent) !== false) {
                    $arro[$count][0]=$bow['id'];
                    $arro[$count][1]=$bow['subcat'];
                    $count++;
                  }
                } 

                for($x=0;$x<$count;$x++){
                  $idr="*".$arro[$x][0]."*";
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