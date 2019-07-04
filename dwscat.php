<?php 
  include 'inc/INChead.php';
  include 'inc/DWtop.php';
  include 'inc/mailchimp.php';
  include 'inc/DWtopec.php';
  
  echo "<div class='rap1200'>";  
  include 'inc/DWmeatTop.php';
  ?>
    <div id="container"></div>
<div id='bScat' class='bee'>
  <div id='slider'>
    <div id='custom-handle' class='ui-slider-handle'></div>
  </div>
  <div class='playfa'>
    <i class='fa fa-play'></i>
  </div>
  <div class='stopfa'>
    <i class='fa fa-stop'></i>
  </div>
  <?php
    //if($_GET['high']==1){echo "<div class='barsortlow butter'>Sort Low to High</div>";} 
    //else{echo "<div class='barsorthigh butter'>Sort High to Low</div>";}
  ?>
</div>
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

<style type='text/css'>
#container{width:1250px;height:800px; margin: 0 auto;}
</style>

<script type='text/javascript' src='js/codejquery191.js'></script>
<script type='text/javascript' src='js/jqueryui1101.js'></script>  
<script src='js/codehighcharts.js'></script>
<script src='js/codehighchartsmore.js'></script>
<script src='cjs/dwglobal.js'></script>

<script type='text/javascript'>$(document).ready(function() {
$('.playwithdata').addClass('on');
$('.sScatter').addClass('selected');
$('.scatter-icon').attr('src','img/scatterhover.png');



<?php
  include 'inc/con.php'; 
  include 'inc/conint.php'; 
  $dset="z".$_GET[p];
  $cset="z".$_GET[c];
  
  $aes = mysqli_query($con,"SELECT firstyear,lastyear,title,subtitle FROM datasets WHERE id=$_GET[p]");
  while($aow = mysqli_fetch_array($aes)){   
    $fy=$aow['firstyear'];
    $ly=$aow['lastyear'];
    $title=$aow['title'];
    $subtitle=$aow['subtitle'];
  }
  
  echo "window.fy=".$fy.";";
  echo "window.ly=".$ly.";";
  echo "window.title='".$title."';";
  echo "window.subtitle='".$subtitle."';";

  $aes = mysqli_query($con,"SELECT firstyear,lastyear,title,subtitle FROM datasets WHERE id=$_GET[c]");
  while($aow = mysqli_fetch_array($aes)){   
    $cfy=$aow['firstyear'];
    $cly=$aow['lastyear'];
    $ctitle=$aow['title'];
    $csubtitle=$aow['subtitle'];
  }
  
  echo "window.cfy=".$cfy.";";
  echo "window.cly=".$cly.";";
  echo "window.ctitle='".$ctitle."';";
  echo "window.csubtitle='".$csubtitle."';";

  if($cfy>$fy){
    $ffy=$cfy;
  }else{
    $ffy=$fy;
  }

  if($cly>$ly){
    $fly=$ly;
  }else{
    $fly=$cly;
  }

  echo "window.ffy=".$ffy.";";
  echo "window.fly=".$fly.";";
  
  for($x=$ffy;$x<=$fly;$x++){
    if($x==$fly){
      echo "var data = ["; 
      $aes = mysqli_query($conint,"SELECT * FROM interpolate.$dset INNER JOIN custom.countries ON $dset.cid=countries.id WHERE year='$x'");
      while($aow = mysqli_fetch_array($aes)){   
        $ciddy=$aow['cid'];
        $bvalue='';

        $xy = "a".$x;

        $bes = mysqli_query($con,"SELECT $xy FROM countries_final WHERE id=$ciddy");
        while($bow = mysqli_fetch_array($bes)){ 
          $pop=$bow[$xy];
        }  

        $bes = mysqli_query($conint,"SELECT * FROM interpolate.$cset WHERE year='$x' AND cid=$ciddy");
        while($bow = mysqli_fetch_array($bes)){ 
          $bvalue=$bow['value'];
        }  

        $bes = mysqli_query($con,"SELECT * FROM zaliases INNER JOIN regions ON zaliases.rid = regions.rid WHERE cid=$ciddy");
        while($bow = mysqli_fetch_array($bes)){ 
          $color=$bow['color'];
        }  

        if($bvalue==''){
          $donothing=1;
        } else{

          echo "{x:".$aow['value'].", y:".$bvalue.", z:".$pop.", name:'".$aow['country']."', country:'".$aow['country']."',color:'".$color."'},";
        }
      }
      echo "];";      
    } 

    echo "var data".$x." = ["; 
      $aes = mysqli_query($conint,"SELECT * FROM interpolate.$dset INNER JOIN custom.countries ON $dset.cid=countries.id WHERE year='$x'");
      while($aow = mysqli_fetch_array($aes)){   
        $ciddy=$aow['cid'];
        $bvalue='';

        $bes = mysqli_query($con,"SELECT $x FROM countries_final WHERE id=$ciddy");
        while($bow = mysqli_fetch_array($bes)){ 
          $pop=$bow[$x];
        }  

        $bes = mysqli_query($conint,"SELECT * FROM interpolate.$cset WHERE year='$x' AND cid=$ciddy");
        while($bow = mysqli_fetch_array($bes)){ 
          $bvalue=$bow['value'];
        }  

        $bes = mysqli_query($con,"SELECT * FROM zaliases INNER JOIN regions ON zaliases.rid = regions.rid WHERE cid=$ciddy");
        while($bow = mysqli_fetch_array($bes)){ 
          $color=$bow['color'];
        }  

        if($bvalue==''){
          $donothing=1;
        } else{

          echo "{x:".$aow['value'].", y:".$bvalue.", z:".$pop.", name:'".$aow['country']."', country:'".$aow['country']."',color:'".$color."'},";
        }
      }
      echo "];";  
  }

  echo "$( function() {";
    echo "var handle = $('#custom-handle');";
    echo "$('#slider').slider({";
      echo "value:".$fly.",";
      echo "min: ".$ffy.",";
      echo "max: ".$fly.",";
      echo "step: 1,";
      echo "create: function() {";
        echo "handle.text( $( this ).slider('value') );";
      echo "},";
      echo "slide: function( event, ui ) {";
        //echo "$( '#amount' ).val( 'year: ' + ui.value );";
        echo "handle.text( ui.value );";
        echo "var ts = ui.value;";
        echo "var tv = 'data'+ts;";
        //echo "console.log(tv);";
        echo "$('#container').highcharts().series[0].setData(eval(tv));";
      echo "}";
    echo "});";
    echo "$( '#amount' ).val( 'year: ' + $( '#slider' ).slider( 'value' ) );";
  echo "} );";




echo "$('.curyear').text(fly);";


echo "function pause(milliseconds) {";
  echo "var dt = new Date();";
  echo "while ((new Date()) - dt <= milliseconds) { /* Do nothing */ }";
echo "}";

echo "var time=0;";
echo "var start=0;";
echo "$(document).on('click', '.playfa', function(){";
  echo "$('.playfa').css('display','none');";
  echo "$('.stopfa').css('display','block');";
  echo "var tempfy=ffy;";

  $tempval=0;
  $increment = 9000/($fly-$ffy);

  while($ffy<=$fly){
    echo "setTimeout(function(){";  
      echo "$('#slider').slider('value',tempfy);";
      echo "$('#custom-handle').text(tempfy);";
      echo "var tempoo = 'data'+tempfy;";
      echo "$('#container').highcharts().series[0].setData(eval(tempoo));";
      echo "tempfy++;";
      if($ffy==$fly){
        echo "$('.playfa').css('display','block');";
        echo "$('.stopfa').css('display','none');";
      }
    echo "}, ".$tempval.");";

    $tempval=$tempval+$increment;
    $ffy++;
  }

  mysqli_close($con);
  mysqli_close($conint);
  ?>
});



$(document).on('click', '.timeline span', function(){
  var ts = $(this).text();
  $('.curyear').text(ts);
  var tv = 'data'+ts;
  $('#container').highcharts().series[0].setData(eval(tv));
});








Highcharts.chart('container', {
    credits: { enabled: false },
    chart: {
        type: 'bubble',
        plotBorderWidth: 1,
        zoomType: 'xy'
    },

    legend: {
        enabled: false
    },

    title: {
        text: ''
    },

    subtitle: {
        text: ''
    },

    xAxis: {
        gridLineWidth: 1,
        title: {
            text: window.title+', '+window.subtitle
        },
        labels: {
            format: '{value}'
        }
    },

    yAxis: {
        startOnTick: false,
        endOnTick: false,
        title: {
            text: window.ctitle+', '+window.csubtitle
        },
        labels: {
            format: '{value}'
        },
        maxPadding: 0.2
    },

    tooltip: {
        useHTML: true,
        headerFormat: '<table>',
        pointFormat: '<tr><th colspan="2"><h3>{point.country}</h3></th></tr>' +
            '<tr><th>'+window.title+': </th><td>{point.x}g</td></tr>' +
            '<tr><th>'+window.ctitle+': </th><td>{point.y}g</td></tr>' +
            '<tr><th>Population: </th><td>{point.z}%</td></tr>',
        footerFormat: '</table>',
        followPointer: true
    },

    plotOptions: {
        series: {
            dataLabels: {
                enabled: true,
                format: '{point.name}'
            }
        }
    },

    series: [{
        data: data
    }]
});






});</script>
<script src='cjs/srcbtm.js'></script>
</body>
</html>

