<?php 
  include 'inc/INChead.php';
  include 'inc/DWtop.php';
  include 'inc/mailchimp.php';
  include 'inc/DWtopec.php';
  echo "<div class='rap1200'>";   
  include 'inc/DWmeatTop.php';
?>
<!--START LINE VISUALIZATION-->
<div id='chart_div'></div>
<div id='bLine' class='bee'>
  <div id='slider'>
    <div id='custom-handle' class='ui-slider-handle'></div>
    <div id='custom-handle2' class='ui-slider-handle'></div>
  </div>
</div>
  
<div class='barhighlow' style='margin-top:30px'>
<?php
  if($_GET[high]==1){echo "<div class='barsortlow'>View All Countries/Regions</div>";} 
  else{echo "<div class='barsorthigh'>View Selected Countries/Regions</div>";}  
?>
</div>

<?php if($_GET[r0]>0||$_GET[r1]>0||$_GET[r2]>0||$_GET[r3]>0||$_GET[r4]>0||$_GET[r5]>0||$_GET[r6]>0||$_GET[r7]>0||$_GET[r8]>0||$_GET[r9]>0 ){
  echo "<div class='reger'>"; 
    if($_GET[reg]==1){
      echo "<div class='regsum'>View Regional Sum</div>";
      echo "<div class='regave regsel'>View Regional Average</div>";
      echo "<div class='regwav'>View Regional Weighted Average</div>";      
    } else if($_GET[reg]==2){
      echo "<div class='regsum'>View Regional Sum</div>";
      echo "<div class='regave'>View Regional Average</div>";
      echo "<div class='regwav regsel'>View Regional Weighted Average</div>";
    } else{
      echo "<div class='regsum regsel'>View Regional Sum</div>";
      echo "<div class='regave'>View Regional Average</div>";
      echo "<div class='regwav'>View Regional Weighted Average</div>";
    }
  echo "</div>";
}
?>
<!--END LINE VISUALIZATION-->
<?php
  include 'inc/DWmeatBottom.php';
  echo "</div>";

  if($_GET[p]>0){include 'inc/dwrelated.php';
    echo "<div class='art-foot newsletter'>";
  } else{
    echo "<div style='display:none' class='art-foot newsletter'>";
  }

  include 'inc/DWfoot.php';
?>

<script type='text/javascript' src='js/gstatic.js'></script>
<script type='text/javascript'>
google.charts.load('current', {'packages':['line', 'corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
  var button = document.getElementById('change-chart');
  var chartDiv = document.getElementById('chart_div');

  var data = google.visualization.arrayToDataTable([
    ['Year', 'Germany', 'France'],

    ['2004', 1000, 400],
    ['2005', 1170, 460],
    ['2006', 660, 1120],
    ['2007', 1030, 540],
    <?php
      /*include 'inc/con.php'; 
      include 'inc/conint.php'; 
      include 'inc/conregionsum.php'; 
      include 'inc/conregionave.php';
      include 'inc/conregionwav.php';  
      $dset="z".$_GET[p];
      
      $aes = mysqli_query($con,"SELECT firstyear,lastyear,title,subtitle FROM datasets WHERE id=$_GET[p]");
      while($aow = mysqli_fetch_array($aes)){   
        $fy=$aow['firstyear'];
        $ly=$aow['lastyear'];
        $title=$aow['title'];
        $subtitle=$aow['subtitle'];
      }

      //GET HIGHEST VALUE TO SET AS MAX
      $aes = mysqli_query($conint,"SELECT value FROM $dset ORDER BY value DESC");
      while($aow = mysqli_fetch_array($aes)){   
        echo "window.hv=".$aow['value'].";";    
        break;
      }

      if($_GET[yf]>$_GET[yl]){
        $yearlast=$_GET[yf];
        $yearfirst=$_GET[yl];
      } else{
        $yearfirst=$_GET[yf];
        $yearlast=$_GET[yl];  
      }

      if($_GET[r0]>0||$_GET[r1]>0||$_GET[r2]>0||$_GET[r3]>0||$_GET[r4]>0||$_GET[r5]>0||$_GET[r6]>0||$_GET[r7]>0||$_GET[r8]>0||$_GET[r9]>0 ){
        if($_GET[reg]==1){
          $constance=$conregionave;
        } else if($_GET[reg]==2){
          $constance=$conregionwav;
        } else{
          $constance=$conregionsum;
        }
      }


    if($_GET[high]==1){
      $aes = mysqli_query($conint,"SELECT * FROM $dset WHERE year>=$yearfirst AND year <=$yearlast");
      while($aow = mysqli_fetch_array($aes)){   
        $tc=$aow[cid];
        $year=$aow['year'];
        $country=$aow['country'];
        $value=$aow['value'];
        if($_GET[c0]==$tc||$_GET[c1]==$tc||$_GET[c2]==$tc||$_GET[c3]==$tc||$_GET[c4]==$tc||$_GET[c5]==$tc||$_GET[c6]==$tc||$_GET[c7]==$tc||$_GET[c8]==$tc||$_GET[c9]==$tc ){
          echo '["'.$year.'", "name":"'.$country.'", "value":'.$value.',"value2":'.rand(10,100).'},';
        }
      }

      if($_GET[r0]>0||$_GET[r1]>0||$_GET[r2]>0||$_GET[r3]>0||$_GET[r4]>0||$_GET[r5]>0||$_GET[r6]>0||$_GET[r7]>0||$_GET[r8]>0||$_GET[r9]>0 ){
        $aes = mysqli_query($constance,"SELECT * FROM $dset WHERE year>=$yearfirst AND year <=$yearlast");
        while($aow = mysqli_fetch_array($aes)){   
          $tc=$aow[rid];
          $year=$aow['year'];
          $rname=html_entity_decode($aow['rname']);
          $value=$aow['value'];
          
          if($_GET[r0]==$tc||$_GET[r1]==$tc||$_GET[r2]==$tc||$_GET[r3]==$tc||$_GET[r4]==$tc||$_GET[r5]==$tc||$_GET[r6]==$tc||$_GET[r7]==$tc||$_GET[r8]==$tc||$_GET[r9]==$tc ){
            echo '{"year":'.$year.', "name":"'.$rname.'", "value":'.$value.'},';
          }
        }    
      }

    } else {
      echo 'window.sam'.$yearfirst.' = ['; //GET COUNTRIES FROM INTERPOLATED DB
      $aes = mysqli_query($conint,"SELECT * FROM $dset WHERE year>=$yearfirst AND year <=$yearlast");
      while($aow = mysqli_fetch_array($aes)){   
        $year=$aow['year'];
        $country=$aow['country'];
        $value=$aow['value'];
        echo '{"year":'.$year.', "name":"'.$country.'", "value":'.$value.'},';      
      }

      if($_GET[r0]>0||$_GET[r1]>0||$_GET[r2]>0||$_GET[r3]>0||$_GET[r4]>0||$_GET[r5]>0||$_GET[r6]>0||$_GET[r7]>0||$_GET[r8]>0||$_GET[r9]>0 ){//ONLY PULL REGIONS IF THERE IS AT LEAST ONE REGION SELECTED
        $aes = mysqli_query($constance,"SELECT * FROM $dset WHERE year>=$yearfirst AND year <=$yearlast");
        while($aow = mysqli_fetch_array($aes)){   
          $tc=$aow[rid];
          $year=$aow['year'];
          $rname=html_entity_decode($aow['rname']);
          $value=$aow['value'];
          
          if($_GET[r0]==$tc||$_GET[r1]==$tc||$_GET[r2]==$tc||$_GET[r3]==$tc||$_GET[r4]==$tc||$_GET[r5]==$tc||$_GET[r6]==$tc||$_GET[r7]==$tc||$_GET[r8]==$tc||$_GET[r9]==$tc ){
            echo '{"year":'.$year.', "name":"'.$rname.'", "value":'.$value.'},';  
          }
        }    
      }

      echo '];';
    }
    */
    ?>

  ]);

  var materialOptions = {
    chart: {
      title: 'Cambio Title'
    },
    //width: 900,
    height: 600,
    series: {
      // Gives each series an axis name that matches the Y-axis below.
      0: {axis:'subtitle1'},
      1: {axis:'subtitle2'}
    },
    axes: {
      // Adds labels to each axis; they don't have to match the axis names.
      y: {
        Temps: {label:'subtitle1'},
        Daylight: {label:'subtitle2'}
      }
    }
  };


  function drawMaterialChart() {
    var materialChart = new google.charts.Line(chartDiv);
    materialChart.draw(data, materialOptions);
  }


  drawMaterialChart();
}
</script>