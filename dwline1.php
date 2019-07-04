<?php 
  include 'inc/INChead.php';
  include 'inc/DWtop.php';
  include 'inc/mailchimp.php';
  include 'inc/DWtopec.php';

  echo "<div class='rap1200'>";   
  include 'inc/DWmeatTop.php';
?>
<!--START LINE VISUALIZATION-->
<div id="container" style='height:600px'></div>
<div id='bLine' class='bee'>
  <div id='slider'>
    <div id='custom-handle' class='ui-slider-handle'></div>
    <div id='custom-handle2' class='ui-slider-handle'></div>
  </div>
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

<script type='text/javascript' src='js/codejquery191.js'></script>
<script type='text/javascript' src='js/jqueryui1101.js'></script>  

<script src='js/codehighcharts.js'></script>
<script src='js/codehighchartsmore.js'></script>
<!--<script src='js/highcharts1.js'></script> 
<script src='js/highcharts-more.js'></script>
<script src='js/pattern-fill-v2.js'></script>
<script src='js/broken-axis.js'></script>-->
<script src='cjs/dwglobal.js'></script>

<script type='text/javascript'>$( document ).ready(function() {
$('.playwithdata').addClass('on');
$('.sLine').addClass('selected');
$('.line-icon').attr('src','img/linehover.png');
$('#dLine').show();

$(document).on('click', '.linesortlow', function(){
  var loc=window.location.href;
  loc = loc.replace("&high=1","");
  window.history.pushState('update','title',loc);
  location.reload();
});

$(document).on('click', '.linesorthigh', function(){
  var loc=window.location.href;
  loc = loc+"&high=1";
  window.history.pushState('update','title',loc);
  location.reload();
});











<?php
  include 'inc/con.php'; 
  include 'inc/conint.php'; 
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
  
  echo "window.fy=".$fy.";";
  echo "window.ly=".$ly.";";
  echo "window.title='".$title."';";
  echo "window.subtitle='".$subtitle."';";


  echo "var data = ["; 
        $aes = mysqli_query($con,"SELECT * FROM countries");
        while($aow = mysqli_fetch_array($aes)){   
          $tc=$aow['id'];
          $country=$aow['name'];
             
          echo "{name:'".$country."',data:["; 
          for($x=$fy;$x<=$ly;$x++){
            $bes = mysqli_query($conint,"SELECT value FROM $dset WHERE cid=$tc and year=$x");
            while($bow = mysqli_fetch_array($bes)){   
              $value=$bow['value'];
              if($value==''){
                echo "null,";
              } else {
                echo $value.",";
              }              
            } 
          } 
          echo "]},";

        }
        echo "];";      
    }
    





/*    echo "var data = [
      {name: 'Installation',
      data: [43934, 52503, 57177, 69658, 97031, 119931, 137133, 154175]
      }, 


      {
        name: 'Manufacturing',
        data: [24916, 24064, 29742, 29851, 32490, 30282, 38121, 40434]
    }, {
        name: 'Sales & Distribution',
        data: [11744, 17722, 16005, 19771, 20185, 24377, 32147, 39387]
    }, {
        name: 'Project Development',
        data: [null, null, 7988, 12169, 15112, 22452, 34400, 34227]
    }, {
        name: 'Other',
        data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
    }];";*/


    
  



  echo "$( function() {";
    echo "var handle = $('#custom-handle');";
    echo "$('#slider').slider({";
      echo "value:".$ly.",";
      echo "min: ".$fy.",";
      echo "max: ".$ly.",";
      echo "step: 1,";
      echo "create: function() {";
        echo "handle.text( $( this ).slider('value') );";
      echo "},";
      echo "slide: function( event, ui ) {";
        //echo "$( '#amount' ).val( 'year: ' + ui.value );";
        echo "handle.text( ui.value );";
        echo "var ts = ui.value;";
        echo "var tv = 'data'+ts;";
        echo "var tbs = 'cat'+ts;";
        
        echo "$('#container').highcharts().series[0].setData(eval(tv));";
        echo "$('#container').highcharts().xAxis[0].setCategories(eval(tbs));";
      echo "}";
    echo "});";
    echo "$( '#amount' ).val( 'year: ' + $( '#slider' ).slider( 'value' ) );";
  echo "} );";




//echo "$('.curyear').text(ly);";


echo "function pause(milliseconds) {";
  echo "var dt = new Date();";
  echo "while ((new Date()) - dt <= milliseconds) { /* Do nothing */ }";
echo "}";

echo "var time=0;";
echo "var start=0;";
echo "$(document).on('click', '.fa-play', function(){";
  echo "$('.fa-play').css('display','none');";
  echo "$('.fa-pause').css('display','block');";
  echo "var tempfy=fy;";

  $tempval=0;
  $increment = 9000/($ly-$fy);

  while($fy<=$ly){
    echo "setTimeout(function(){";  
      echo "$('#slider').slider('value',tempfy);";
      echo "$('#custom-handle').text(tempfy);";
      echo "var tempoo = 'data'+tempfy;";
      echo "var tempar = 'cat'+tempfy;";
      echo "$('#container').highcharts().series[0].setData(eval(tempoo));";
      echo "$('#container').highcharts().xAxis[0].setCategories(eval(tempar));";
      echo "tempfy++;";
      if($fy==$ly){
        echo "$('.fa-play').css('display','block');";
        echo "$('.fa-pause').css('display','none');";
      }
    echo "}, ".$tempval.");";

    $tempval=$tempval+$increment;
    $fy++;
  }

  mysqli_close($con);
  mysqli_close($conint);
  ?>
});



Highcharts.chart('container', {

    title: {
        text: ''
    },

    subtitle: {
        text: ''
    },

    yAxis: {
        title: {
            text: subtitle
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
            pointStart: <?php echo $_GET[yf]?>
        }
    },

    series: data,

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});



<?php
  include 'inc/con.php'; 
  $dset="z".$_GET[p];
  
  $aes = mysqli_query($con,"SELECT firstyear,lastyear FROM datasets WHERE id=$_GET[p]");
  while($aow = mysqli_fetch_array($aes)){   
    $fy=$aow['firstyear'];
    $ly=$aow['lastyear'];
  }
  
  echo "window.fy=".$fy.";";
  echo "window.ly=".$ly.";";
  
mysqli_close($con);
?>


  $(document).on('click', '.fa-tree', function(){
    $('#container').highcharts().series[0].setData(data2015);
  });


});</script>
<script src='cjs/srcbtm.js'></script>
</body>
</html>

