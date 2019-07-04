    <?php
      if($_GET[p]>0){
        echo "<div class='holder' id='holder'>";
      } else{
        echo "<div class='holder' id='holder' style='display:none'>";
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
            include 'inc/con.php'; 
            for($x=0;$x<=9;$x++){
              $tempx="c".$x;
              if($_GET[$tempx]>0){
                $aes = mysqli_query($con,"SELECT * FROM countries WHERE id=$_GET[$tempx]");
                while($aow = mysqli_fetch_array($aes)){ 
                  echo "<span data-cid='".$aow[id]."'>".$aow['name']." <i class='fa fa-times-circle-o'></i></span> ";
                }
              }  
            }

            for($x=0;$x<=9;$x++){
              $tempy="r".$x;
              if($_GET[$tempy]>0){
                $aes = mysqli_query($con,"SELECT * FROM regions WHERE rid=$_GET[$tempy]");
                while($aow = mysqli_fetch_array($aes)){ 
                  echo "<span class='regy' data-rid='".$aow[rid]."'>".$aow['region']." <i class='fa fa-times-circle-o'></i></span> ";
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
      