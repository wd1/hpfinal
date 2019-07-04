<?php include 'inc/INChead.php';$randal=rand(1,999);
    echo "<link rel='stylesheet' type='text/css' href='css/search.css?version=".$randal."'>";
    echo "<link rel='stylesheet' type='text/css' href='css/dw7.css?version=".$randal."'>";
?>

<div class='rap700'>
  <div class='searchresultstxt'>Content results for <span>'<?php echo $_GET['q'];?>'</span></div>
  <div class='sec art-sec'>    

    <?php 
      include 'inc/conCouch.php';
      $q=$_GET['q'];
      $count=0;
      $couray=0;
      $ray[0]=0;
      $exclusive=0;
      $data=0;
      $news=0;
      $video=0;
      $lifeinnumbers=0;
      $announcement=0;

      $zes = mysqli_query($con,"SELECT couch_data_text.page_id,couch_data_text.field_id,couch_data_text.search_value,couch_pages.page_title FROM couch_data_text INNER JOIN couch_pages ON couch_data_text.page_id=couch_pages.id WHERE couch_pages.template_id=11 AND couch_pages.publish_date <> '0000-00-00 00:00:00' ORDER BY publish_date DESC");
      while($zow = mysqli_fetch_array($zes)){ 
        $pageid=$zow['page_id'];
        $temp = $zow['search_value'];

        if (stripos($temp,$q) !== false)   {       
            $ray[$couray]=$pageid;
            $couray++;      
        }

      }
      
      $des = mysqli_query($con,"SELECT id,page_title FROM couch_pages WHERE template_id=11 AND publish_date <> '0000-00-00 00:00:00' ORDER BY publish_date DESC");
      while($dow = mysqli_fetch_array($des)){ 
        $id=$dow['id'];
        $temp2 = $dow['page_title'];

        if (stripos($temp2,$q) !== false)   {       
            $ray[$couray]=$id;
            $couray++;      
        }

      }
      

      $fray=array_unique($ray);
      $fray = array_values($fray);
      $fraycount=count($fray);

      //print_r($fray);

for($x=0;$x<$fraycount;$x++){
  $pageid=$fray[$x];
  $aes = mysqli_query($con,"SELECT search_value,page_id FROM couch_data_text WHERE page_id=$pageid AND field_id=160");
  while($aow = mysqli_fetch_array($aes)){ 
      $type=$aow['search_value'];
      $pager=$aow['page_id'];
  }

  if($type=='Exclusive'){$exclusive++;}
  if($type=='Data'){$data++;}
  if($type=='News'){$news++;}
  if($type=='Video'){$video++;}
  if($type=='Life in numbers'){$lifeinnumbers++;}
  if($type=='Announcement'){$announcement++;}
}

/*echo $fraycount;
echo $exclusive;
echo $data;
echo $news;
echo $video;
echo $lifeinnumbers;
echo $announcement;*/

if($exclusive>0){
  echo "<div class='rec rec-exclusive'><h1>Exclusive</h1>";   
  for($x=0;$x<$fraycount;$x++){
    $pageid=$fray[$x];
    $aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=160");
    while($aow = mysqli_fetch_array($aes)){ 
        $type=$aow['search_value'];
    }

    if($type=='Exclusive'){ 
        echo "<div class='search-block'>";

        $aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=162");
        while($aow = mysqli_fetch_array($aes)){ 
            $subtitle=htmlspecialchars($aow['search_value'], ENT_QUOTES, 'UTF-8');
        }

        $aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=176");
        while($aow = mysqli_fetch_array($aes)){ 
            $url=$aow['search_value'];
        }

        $aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=177");
        while($aow = mysqli_fetch_array($aes)){ 
            $offset=$aow['search_value'];
        }

        $res = mysqli_query($con,"SELECT page_title,publish_date FROM couch_pages WHERE id='$pageid'");
        while($row = mysqli_fetch_array($res)){ 
            $pagetitle= $row['page_title'];
            $date = $row['publish_date'];
        }
        $year = substr($date,0,4);
        $mon = substr($date,5,2);
        $day = substr($date,8,2);
        if($mon=='01'){$month='January';}
        if($mon=='02'){$month='February';}
        if($mon=='03'){$month='March';}
        if($mon=='04'){$month='April';}
        if($mon=='05'){$month='May';}
        if($mon=='06'){$month='June';}
        if($mon=='07'){$month='July';}
        if($mon=='08'){$month='August';}
        if($mon=='09'){$month='September';}
        if($mon=='10'){$month='October';}
        if($mon=='11'){$month='November';}
        if($mon=='12'){$month='December';}
        $dater=$month.' '.$day.', '.$year;

        if($type=='Video'){
            echo "<a class='vidclick' data-id='//www.youtube.com/embed/".$url."?enablejsapi=1&amp;html5=1&rel=0'><h2>".$pagetitle."</h2></a>".$dater."  ";  
            echo "<h4>".$dater."</h4>";
            //echo "<h3>".$subtitle."</h3>";
        }else if($type=='Life in numbers'||$type=='Data'||$type=='Support'||$type=='Quiz'){
            echo "<a href='".$url."'><h2>".$pagetitle."</h2></a>";  
            echo "<h4>".$dater."</h4>";
            //echo "<h3>".$subtitle."</h3>";
        }else if($type=='News'){
            echo "<a href='i?url=".$url."&o=".$offset."'><h2>".$pagetitle."</h2></a>";  
            echo "<h4>".$dater."</h4>";
            //echo "<h3>".$subtitle."</h3>";
        }else if( ($type=='Announcement'||$type=='Exclusive') && $pageid!='' ){
            echo "<a href='article.php?p=".$pageid."'><h2>".$pagetitle."</h2></a>";  
            echo "<h4>".$dater."</h4>";            
            //echo "<h3>".$subtitle."</h3>";
        }    
        
        echo "</div>";  
    }

  }
  echo "</div>";
  echo "<span class='sm sm-exclusive'>Show More</span>";
}

if($data>0){
  echo "<div class='rec rec-data'><h1>Visualizations</h1>";   
  for($x=0;$x<$fraycount;$x++){
    $pageid=$fray[$x];
    $aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=160");
    while($aow = mysqli_fetch_array($aes)){ 
        $type=$aow['search_value'];
    }

    if($type=='Data'){ 
        echo "<div class='search-block'>";

        $aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=162");
        while($aow = mysqli_fetch_array($aes)){ 
            $subtitle=htmlspecialchars($aow['search_value'], ENT_QUOTES, 'UTF-8');
        }

        $aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=176");
        while($aow = mysqli_fetch_array($aes)){ 
            $url=$aow['search_value'];
        }

        $aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=177");
        while($aow = mysqli_fetch_array($aes)){ 
            $offset=$aow['search_value'];
        }

        $res = mysqli_query($con,"SELECT page_title,publish_date FROM couch_pages WHERE id='$pageid'");
        while($row = mysqli_fetch_array($res)){ 
            $pagetitle= $row['page_title'];
            $date = $row['publish_date'];
        }
        $year = substr($date,0,4);
        $mon = substr($date,5,2);
        $day = substr($date,8,2);
        if($mon=='01'){$month='January';}
        if($mon=='02'){$month='February';}
        if($mon=='03'){$month='March';}
        if($mon=='04'){$month='April';}
        if($mon=='05'){$month='May';}
        if($mon=='06'){$month='June';}
        if($mon=='07'){$month='July';}
        if($mon=='08'){$month='August';}
        if($mon=='09'){$month='September';}
        if($mon=='10'){$month='October';}
        if($mon=='11'){$month='November';}
        if($mon=='12'){$month='December';}
        $dater=$month.' '.$day.', '.$year;

        if($type=='Video'){
            echo "<a class='vidclick' data-id='//www.youtube.com/embed/".$url."?enablejsapi=1&amp;html5=1&rel=0'><h2>".$pagetitle."</h2></a>".$dater."  ";  
            echo "<h4>".$dater."</h4>";
            //echo "<h3>".$subtitle."</h3>";
        }else if(($type=='Life in numbers'||$type=='Data'||$type=='Support'||$type=='Quiz') && $pageid!=''){
            echo "<a href='".$url."'><h2>".$pagetitle."</h2></a>";  
            echo "<h4>".$dater."</h4>";
            //echo "<h3>".$subtitle."</h3>";
        }else if($type=='News'){
            echo "<a href='i?url=".$url."&o=".$offset."'><h2>".$pagetitle."</h2></a>";  
            echo "<h4>".$dater."</h4>";
            //echo "<h3>".$subtitle."</h3>";
        }else if($type=='Announcement'||$type=='Exclusive'){
            echo "<a href='article.php?p=".$pageid."'><h2>".$pagetitle."</h2></a>";  
            echo "<h4>".$dater."</h4>";            
            //echo "<h3>".$subtitle."</h3>";
        } 

        echo "</div>";  
    }

  }
  echo "</div>";
  echo "<span class='sm sm-data'>Show More</span>";
}

if($news>0){
  echo "<div class='rec rec-news'><h1>News</h1>";   
  for($x=0;$x<$fraycount;$x++){
    $pageid=$fray[$x];
    $aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=160");
    while($aow = mysqli_fetch_array($aes)){ 
        $type=$aow['search_value'];
    }

    if($type=='News'){ 
        echo "<div class='search-block'>";

        $aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=162");
        while($aow = mysqli_fetch_array($aes)){ 
            $subtitle=htmlspecialchars($aow['search_value'], ENT_QUOTES, 'UTF-8');
        }

        $aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=176");
        while($aow = mysqli_fetch_array($aes)){ 
            $url=$aow['search_value'];
        }

        $aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=177");
        while($aow = mysqli_fetch_array($aes)){ 
            $offset=$aow['search_value'];
        }

        $res = mysqli_query($con,"SELECT page_title,publish_date FROM couch_pages WHERE id='$pageid'");
        while($row = mysqli_fetch_array($res)){ 
            $pagetitle= $row['page_title'];
            $date = $row['publish_date'];
        }
        $year = substr($date,0,4);
        $mon = substr($date,5,2);
        $day = substr($date,8,2);
        if($mon=='01'){$month='January';}
        if($mon=='02'){$month='February';}
        if($mon=='03'){$month='March';}
        if($mon=='04'){$month='April';}
        if($mon=='05'){$month='May';}
        if($mon=='06'){$month='June';}
        if($mon=='07'){$month='July';}
        if($mon=='08'){$month='August';}
        if($mon=='09'){$month='September';}
        if($mon=='10'){$month='October';}
        if($mon=='11'){$month='November';}
        if($mon=='12'){$month='December';}
        $dater=$month.' '.$day.', '.$year;


        if($type=='Video'){
            echo "<a class='vidclick' data-id='//www.youtube.com/embed/".$url."?enablejsapi=1&amp;html5=1&rel=0'><h2>".$pagetitle."</h2></a>".$dater."  ";  
            echo "<h4>".$dater."</h4>";
            //echo "<h3>".$subtitle."</h3>";
        }else if($type=='Life in numbers'||$type=='Data'||$type=='Support'||$type=='Quiz'){
            echo "<a href='".$url."'><h2>".$pagetitle."</h2></a>";  
            echo "<h4>".$dater."</h4>";
            //echo "<h3>".$subtitle."</h3>";
        }else if($type=='News' && $pageid!=''){
            echo "<a href='i?url=".$url."&o=".$offset."'><h2>".$pagetitle."</h2></a>";  
            echo "<h4>".$dater."</h4>";
            //echo "<h3>".$subtitle."</h3>";
        }else if($type=='Announcement'||$type=='Exclusive'){
            echo "<a href='article.php?p=".$pageid."'><h2>".$pagetitle."</h2></a>";  
            echo "<h4>".$dater."</h4>";            
            //echo "<h3>".$subtitle."</h3>";
        }  
        
        echo "</div>";  
    }

  }
  echo "</div>";
  echo "<span class='sm sm-news'>Show More</span>";
}

if($video>0){
  echo "<div class='rec rec-video'><h1>Video</h1>";   
  for($x=0;$x<$fraycount;$x++){
    $pageid=$fray[$x];
    $aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=160");
    while($aow = mysqli_fetch_array($aes)){ 
        $type=$aow['search_value'];
    }

    if($type=='Video'){ 
        echo "<div class='search-block'>";

        $aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=162");
        while($aow = mysqli_fetch_array($aes)){ 
            $subtitle=htmlspecialchars($aow['search_value'], ENT_QUOTES, 'UTF-8');
        }

        $aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=176");
        while($aow = mysqli_fetch_array($aes)){ 
            $url=$aow['search_value'];
        }

        $aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=177");
        while($aow = mysqli_fetch_array($aes)){ 
            $offset=$aow['search_value'];
        }

        $res = mysqli_query($con,"SELECT page_title,publish_date FROM couch_pages WHERE id='$pageid'");
        while($row = mysqli_fetch_array($res)){ 
            $pagetitle= $row['page_title'];
            $date = $row['publish_date'];
        }
        $year = substr($date,0,4);
        $mon = substr($date,5,2);
        $day = substr($date,8,2);
        if($mon=='01'){$month='January';}
        if($mon=='02'){$month='February';}
        if($mon=='03'){$month='March';}
        if($mon=='04'){$month='April';}
        if($mon=='05'){$month='May';}
        if($mon=='06'){$month='June';}
        if($mon=='07'){$month='July';}
        if($mon=='08'){$month='August';}
        if($mon=='09'){$month='September';}
        if($mon=='10'){$month='October';}
        if($mon=='11'){$month='November';}
        if($mon=='12'){$month='December';}
        $dater=$month.' '.$day.', '.$year;


        if($type=='Video' && $pageid!=''){
            echo "<a class='vidclick' data-id='//www.youtube.com/embed/".$url."?enablejsapi=1&amp;html5=1&rel=0'><h2>".$pagetitle."</h2></a>";  
            echo "<h4>".$dater."</h4>";
            //echo "<h3>".$subtitle."</h3>";
        }else if($type=='Life in numbers'||$type=='Data'||$type=='Support'||$type=='Quiz'){
            echo "<a href='".$url."'><h2>".$pagetitle."</h2></a>";  
            echo "<h4>".$dater."</h4>";
            //echo "<h3>".$subtitle."</h3>";
        }else if($type=='News'){
            echo "<a href='i?url=".$url."&o=".$offset."'><h2>".$pagetitle."</h2></a>";  
            echo "<h4>".$dater."</h4>";
            //echo "<h3>".$subtitle."</h3>";
        }else if($type=='Announcement'||$type=='Exclusive'){
            echo "<a href='article.php?p=".$pageid."'><h2>".$pagetitle."</h2></a>";  
            echo "<h4>".$dater."</h4>";            
            //echo "<h3>".$subtitle."</h3>";
        }    
        
        echo "</div>";  
    }
  }
  echo "</div>";
  echo "<span class='sm sm-video'>Show More</span>";
}

if($lifeinnumbers>0){
  echo "<div class='rec rec-ylin'><h1>Your Life in Numbers</h1>";   
  for($x=0;$x<$fraycount;$x++){
    $pageid=$fray[$x];
    $aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=160");
    while($aow = mysqli_fetch_array($aes)){ 
        $type=$aow['search_value'];
    }

    if($type=='Life in Numbers'){ 
        echo "<div class='search-block'>";

        $aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=162");
        while($aow = mysqli_fetch_array($aes)){ 
            $subtitle=htmlspecialchars($aow['search_value'], ENT_QUOTES, 'UTF-8');
        }

        $aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=176");
        while($aow = mysqli_fetch_array($aes)){ 
            $url=$aow['search_value'];
        }

        $aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=177");
        while($aow = mysqli_fetch_array($aes)){ 
            $offset=$aow['search_value'];
        }

        $res = mysqli_query($con,"SELECT page_title,publish_date FROM couch_pages WHERE id='$pageid'");
        while($row = mysqli_fetch_array($res)){ 
            $pagetitle= $row['page_title'];
            $date = $row['publish_date'];
        }
        $year = substr($date,0,4);
        $mon = substr($date,5,2);
        $day = substr($date,8,2);
        if($mon=='01'){$month='January';}
        if($mon=='02'){$month='February';}
        if($mon=='03'){$month='March';}
        if($mon=='04'){$month='April';}
        if($mon=='05'){$month='May';}
        if($mon=='06'){$month='June';}
        if($mon=='07'){$month='July';}
        if($mon=='08'){$month='August';}
        if($mon=='09'){$month='September';}
        if($mon=='10'){$month='October';}
        if($mon=='11'){$month='November';}
        if($mon=='12'){$month='December';}
        $dater=$month.' '.$day.', '.$year;

        if($type=='Video'){
            echo "<a class='vidclick' data-id='//www.youtube.com/embed/".$url."?enablejsapi=1&amp;html5=1&rel=0'><h2>".$pagetitle."</h2></a>".$dater."  ";  
            echo "<h4>".$dater."</h4>";
            //echo "<h3>".$subtitle."</h3>";
        }else if( ($type=='Life in numbers'||$type=='Data'||$type=='Support'||$type=='Quiz') && $pageid!='' ){
            echo "<a href='".$url."'><h2>".$pagetitle."</h2></a>";  
            echo "<h4>".$dater."</h4>";
            //echo "<h3>".$subtitle."</h3>";
        }else if($type=='News'){
            echo "<a href='i?url=".$url."&o=".$offset."'><h2>".$pagetitle."</h2></a>";  
            echo "<h4>".$dater."</h4>";
            //echo "<h3>".$subtitle."</h3>";
        }else if($type=='Announcement'||$type=='Exclusive'){
            echo "<a href='article.php?p=".$pageid."'><h2>".$pagetitle."</h2></a>";  
            echo "<h4>".$dater."</h4>";            
            //echo "<h3>".$subtitle."</h3>";
        } 
        echo "</div>";  
    }
  }
  echo "</div>";
  echo "<span class='sm sm-ylin'>Show More</span>";
}

if($announcement>0){
  echo "<div class='rec rec-announcement'><h1>Announcement</h1>";   
  for($x=0;$x<$fraycount;$x++){
    $pageid=$fray[$x];
    $aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=160");
    while($aow = mysqli_fetch_array($aes)){ 
        $type=$aow['search_value'];
    }

    if($type=='Announcement'){ 
        echo "<div class='search-block'>";

        $aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=162");
        while($aow = mysqli_fetch_array($aes)){ 
            $subtitle=htmlspecialchars($aow['search_value'], ENT_QUOTES, 'UTF-8');
        }

        $aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=176");
        while($aow = mysqli_fetch_array($aes)){ 
            $url=$aow['search_value'];
        }

        $aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=177");
        while($aow = mysqli_fetch_array($aes)){ 
            $offset=$aow['search_value'];
        }

        $res = mysqli_query($con,"SELECT page_title,publish_date FROM couch_pages WHERE id='$pageid'");
        while($row = mysqli_fetch_array($res)){ 
            $pagetitle= $row['page_title'];
            $date = $row['publish_date'];
        }
        $year = substr($date,0,4);
        $mon = substr($date,5,2);
        $day = substr($date,8,2);
        if($mon=='01'){$month='January';}
        if($mon=='02'){$month='February';}
        if($mon=='03'){$month='March';}
        if($mon=='04'){$month='April';}
        if($mon=='05'){$month='May';}
        if($mon=='06'){$month='June';}
        if($mon=='07'){$month='July';}
        if($mon=='08'){$month='August';}
        if($mon=='09'){$month='September';}
        if($mon=='10'){$month='October';}
        if($mon=='11'){$month='November';}
        if($mon=='12'){$month='December';}
        $dater=$month.' '.$day.', '.$year;


        if($type=='Video'){
            echo "<a class='vidclick' data-id='//www.youtube.com/embed/".$url."?enablejsapi=1&amp;html5=1&rel=0'><h2>".$pagetitle."</h2></a>".$dater."  ";  
            echo "<h4>".$dater."</h4>";
            //echo "<h3>".$subtitle."</h3>";
        }else if($type=='Life in numbers'||$type=='Data'||$type=='Support'||$type=='Quiz'){
            echo "<a href='".$url."'><h2>".$pagetitle."</h2></a>";  
            echo "<h4>".$dater."</h4>";
            //echo "<h3>".$subtitle."</h3>";
        }else if($type=='News'){
            echo "<a href='i?url=".$url."&o=".$offset."'><h2>".$pagetitle."</h2></a>";  
            echo "<h4>".$dater."</h4>";
            //echo "<h3>".$subtitle."</h3>";
        }else if( ($type=='Announcement'||$type=='Exclusive') && $pageid!='' ){
            echo "<a href='article.php?p=".$pageid."'><h2>".$pagetitle."</h2></a>";  
            echo "<h4>".$dater."</h4>";            
            //echo "<h3>".$subtitle."</h3>";
        } 
        
        echo "</div>";  
    }
  }
  echo "</div>";
  echo "<span class='sm sm-announcement'>Show More</span>";
}

?>
  </div>
    
    <?php
    echo "<div class='searchresultstxt' style='margin-top:75px'>Data results for <span>'".$_GET['q']."'</span></div>";
    echo "<div class='partial' style='border-top:3px solid #eee;'>";
        include 'inc/con.php';
        $p = $_GET['q'];

        $yount=0;
        $bes = mysqli_query($con,"SELECT id,catid,subcat FROM subcats ORDER BY subcat ASC");
        while($bow = mysqli_fetch_array($bes)){
            $tid=$bow['id'];
            $cid=$bow['catid'];
            $temp=$bow['subcat'];
            $count=0;

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

          $ces = mysqli_query($con,"SELECT id,title,subtitle,seodescr,catsubcat FROM datasets WHERE title LIKE '%$p%' OR subtitle LIKE '%$p%' OR seodescr LIKE '%$p%'");
          while($cow = mysqli_fetch_array($ces)){ 
            if ( (strpos($cow['catsubcat'],"*".$tid."*") !== false)&&($fucked==0) ) {
                if($yount==0){
                    //echo "<section style='font-size:33px'>Datasets</section>";        
                    $yount++;
                } 
              $count++;
              if($count==1){
                echo "<span>".$temp."</span>";
              }
              echo "<a class='relink' href='dws7?p=".$cow['id']."'>".$cow['title'].", ".$cow['subtitle']."</a>";
            }
          }
        } 

        if($yount==0){
            echo "<div style='color:#ff6c00'>No datasets found</div>";
        }
      mysqli_close($con);
    ?>
    </div>
</div>
<div class='youtube-back'>
    <iframe id="video" width="800" height="600" frameborder="0" allowfullscreen></iframe>
    <i class='fa fa-times-circle youtubeFa'></i>
</div>
</body>
<script type='text/javascript'>
<?php echo "var testy = '".$_GET['q']."';";?>
$("h2:contains("+testy+")").html(function(_, html) {
   return html.split(testy).join("<span class='smallcaps'>"+testy+"</span>");
});

$("h3:contains("+testy+")").html(function(_, html) {
   return html.split(testy).join("<span class='smallcaps'>"+testy+"</span>");
});

if($('.rec-exclusive').css('height')!=undefined){
    var rexclusive = $('.rec-exclusive').css('height');
    var fexclusive = rexclusive.replace('px','');
    if(fexclusive<260){
        $('.sm-exclusive').hide();
    } else{
        $('.rec-exclusive').css('height','260px');
    }
}

if($('.rec-data').css('height')!=undefined){
    var rdata = $('.rec-data').css('height');
    var fdata = rdata.replace('px','');
    if(fdata<260){
        $('.sm-data').hide();
    } else{
        $('.rec-data').css('height','260px');
    }
}

if($('.rec-news').css('height')!=undefined){
    var rnews = $('.rec-news').css('height');
    var fnews = rnews.replace('px','');
    if(fnews<260){
        $('.sm-news').hide();
    } else{
        $('.rec-news').css('height','260px');
    }
}

if($('.rec-video').css('height')!=undefined){
    var rvideo = $('.rec-video').css('height');
    var fvideo = rvideo.replace('px','');
    if(fvideo<260){
        $('.sm-video').hide();
    } else{
        $('.rec-video').css('height','260px');
    }
}

if($('.rec-ylin').css('height')!=undefined){
    var rylin = $('.rec-ylin').css('height');
    var fylin = rylin.replace('px','');
    if(fylin<260){
        $('.sm-ylin').hide();
    } else{
        $('.rec-ylin').css('height','260px');
    }
}

if($('.rec-announcement').css('height')!=undefined){
    var rannouncement = $('.rec-announcement').css('height');
    var fannouncement = rannouncement.replace('px','');
    if(fannouncement<260){
        $('.sm-announcement').hide();
    } else{
        $('.rec-announcement').css('height','260px');
    }
}
$(document).on('click', '.sm-exclusive', function(){
    $('.sm-exclusive').addClass('rm-exclusive').removeClass('sm-exclusive');
    $('.rm-exclusive').text('Show Less');
    $('.rec-exclusive').css('height','auto');
});
$(document).on('click', '.rm-exclusive', function(){
    $('.rm-exclusive').addClass('sm-exclusive').removeClass('rm-exclusive');
    $('.sm-exclusive').text('Show More');
    $('.rec-exclusive').css('height','260px');
});

$(document).on('click', '.sm-data', function(){
    $('.sm-data').addClass('rm-data').removeClass('sm-data');
    $('.rm-data').text('Show Less');
    $('.rec-data').css('height','auto');
});
$(document).on('click', '.rm-data', function(){
    $('.rm-data').addClass('sm-data').removeClass('rm-data');
    $('.sm-data').text('Show More');
    $('.rec-data').css('height','260px');
});

$(document).on('click', '.sm-news', function(){
    $('.sm-news').addClass('rm-news').removeClass('sm-news');
    $('.rm-news').text('Show Less');
    $('.rec-news').css('height','auto');
});
$(document).on('click', '.rm-news', function(){
    $('.rm-news').addClass('sm-news').removeClass('rm-news');
    $('.sm-news').text('Show More');
    $('.rec-news').css('height','260px');
});

$(document).on('click', '.sm-video', function(){
    $('.sm-video').addClass('rm-video').removeClass('sm-video');
    $('.rm-video').text('Show Less');
    $('.rec-video').css('height','auto');
});
$(document).on('click', '.rm-video', function(){
    $('.rm-video').addClass('sm-video').removeClass('rm-video');
    $('.sm-video').text('Show More');
    $('.rec-video').css('height','260px');
});

$(document).on('click', '.sm-ylin', function(){
    $('.sm-ylin').addClass('rm-ylin').removeClass('sm-ylin');
    $('.rm-ylin').text('Show Less');
    $('.rec-ylin').css('height','auto');
});
$(document).on('click', '.rm-ylin', function(){
    $('.rm-ylin').addClass('sm-ylin').removeClass('rm-ylin');
    $('.sm-ylin').text('Show More');
    $('.rec-ylin').css('height','260px');
});
$(document).on('click', '.sm-announcement', function(){
    $('.sm-announcement').addClass('rm-announcement').removeClass('sm-announcement');
    $('.rm-announcement').text('Show Less');
    $('.rec-announcement').css('height','auto');
});
$(document).on('click', '.rm-announcement', function(){
    $('.rm-announcement').addClass('sm-announcement').removeClass('rm-announcement');
    $('.sm-announcement').text('Show More');
    $('.rec-announcement').css('height','260px');
});
</script>
<?php $randal=rand(1,999);echo "<script type='text/javascript' src='cjs/srcbtm.js?version=".$randal."'>'></script>";?>
</html>


