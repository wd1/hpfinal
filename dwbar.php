<?php 
  include 'inc/INChead.php';
  include 'inc/DWtop.php';
  include 'inc/mailchimp.php';
  include 'inc/DWtopec.php';

  echo "<div class='rap1200'>";   
  include 'inc/DWmeatTop.php';
?>
<!--START BAR VISUALIZATION-->
<div id="container" style='height:600px;width:98%'></div>
<div id='bBar' class='bee'>
  <div id='slider'>
    <div id='custom-handle' class='ui-slider-handle'></div>
  </div>
  <div class='playfa'>
    <i class='fa fa-play'></i>
  </div>
  <div class='stopfa'>
    <i class='fa fa-stop'></i>
  </div>

  <div class='barhighlow'>
  <?php
    if($_GET[high]==1){echo "<div class='barsortlow'>Sort Low to High</div>";} 
    else{echo "<div class='barsorthigh'>Sort High to Low</div>";}
  ?>
  </div>
  <!--<i class='fa fa-pause'></i>-->
</div>
<!--END BAR VISUALIZATION-->
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
$('.sBar').addClass('selected');
$('.bar-icon').attr('src','img/barhover.png');
$('#dBar').show();
window.stopnow=0;

$(document).on('click', '.barsortlow', function(){
  var loc=window.location.href;
  loc = loc.replace("&high=1","");
  window.history.pushState('update','title',loc);
  location.reload();
});

$(document).on('click', '.barsorthigh', function(){
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

  for($x=$fy;$x<=$ly;$x++){
    echo "window.timer".$x."=1;";
    if($_GET[high]==1){
      echo "var data".$x." = ["; 
      $aes = mysqli_query($conint,"SELECT cid,country,year,value FROM $dset WHERE year='$x' ORDER BY value DESC");
      while($aow = mysqli_fetch_array($aes)){   
          $tc=$aow['cid'];
          if($aow['value']==''){
            echo "{y:null,year:'".$x."',color:'#2099bc'},";
          } else if($_GET[c0]==$tc||$_GET[c1]==$tc||$_GET[c2]==$tc||$_GET[c3]==$tc||$_GET[c4]==$tc||$_GET[c5]==$tc||$_GET[c6]==$tc||$_GET[c7]==$tc||$_GET[c8]==$tc||$_GET[c9]==$tc){
            echo "{y:".$aow['value'].",year:'".$x."',color:'#ff6c00'},";
          } else{
            echo "{y:".$aow['value'].",year:'".$x."',color:'#2099bc'},";
          }
      }
      echo "];";       

      echo "var cat".$x." = ["; //SET CATEGORIES JS VARIABLES
      $aes = mysqli_query($conint,"SELECT country FROM $dset WHERE year='$x' ORDER BY value DESC");
      while($aow = mysqli_fetch_array($aes)){   
        echo "'".$aow['country']."',";  
      }
      echo "];";         
  




      if($x==$ly){
        echo "var cat = ["; //SET CATEGORIES JS VARIABLES
        $aes = mysqli_query($conint,"SELECT country FROM $dset WHERE year='$x' ORDER BY value DESC");
        while($aow = mysqli_fetch_array($aes)){   
          echo "'".$aow['country']."',";  
        }
        echo "];";       

        echo "var data = ["; 
        $aes = mysqli_query($conint,"SELECT  cid,country,year,value FROM $dset WHERE year='$x' ORDER BY value DESC");
        while($aow = mysqli_fetch_array($aes)){   
          $tc=$aow['cid'];
          if($aow['value']==''){
            echo "{y:null,color:'#2099bc'},";
          } else if($_GET[c0]==$tc||$_GET[c1]==$tc||$_GET[c2]==$tc||$_GET[c3]==$tc||$_GET[c4]==$tc||$_GET[c5]==$tc||$_GET[c6]==$tc||$_GET[c7]==$tc||$_GET[c8]==$tc||$_GET[c9]==$tc){
            echo "{y:".$aow['value'].",year:'".$x."',color:'#ff6c00'},";
          } else {
            echo "{y:".$aow['value'].",year:'".$x."',color:'#2099bc'},";
          }
        }
        echo "];";      
      }
    } else{
      echo "var data".$x." = ["; 
      $aes = mysqli_query($conint,"SELECT cid,country,year,value FROM $dset WHERE year='$x' ORDER BY value ASC");
      while($aow = mysqli_fetch_array($aes)){   
          $tc=$aow['cid'];
          if($aow['value']==''){
            echo "{y:null,year:'".$x."',color:'#2099bc'},";
          } else if($_GET[c0]==$tc||$_GET[c1]==$tc||$_GET[c2]==$tc||$_GET[c3]==$tc||$_GET[c4]==$tc||$_GET[c5]==$tc||$_GET[c6]==$tc||$_GET[c7]==$tc||$_GET[c8]==$tc||$_GET[c9]==$tc){
            echo "{y:".$aow['value'].",year:'".$x."',color:'#ff6c00'},";
          } else{
            echo "{y:".$aow['value'].",year:'".$x."',color:'#2099bc'},";
          }
      }
      echo "];";       

      echo "var cat".$x." = ["; //SET CATEGORIES JS VARIABLES
      $aes = mysqli_query($conint,"SELECT country FROM $dset WHERE year='$x' ORDER BY value ASC");
      while($aow = mysqli_fetch_array($aes)){   
        echo "'".$aow['country']."',";  
      }
      echo "];";         




      if($x==$ly){
        echo "var cat = ["; //SET CATEGORIES JS VARIABLES
        $aes = mysqli_query($conint,"SELECT country FROM $dset WHERE year='$x' ORDER BY value ASC");
        while($aow = mysqli_fetch_array($aes)){   
          echo "'".$aow['country']."',";  
        }
        echo "];";     

        echo "var data = ["; 
        $aes = mysqli_query($conint,"SELECT  cid,country,year,value FROM $dset WHERE year='$x' ORDER BY value ASC");
        while($aow = mysqli_fetch_array($aes)){   
          $tc=$aow['cid'];
          if($aow['value']==''){
            echo "{y:null,color:'#2099bc'},";
          } else if($_GET[c0]==$tc||$_GET[c1]==$tc||$_GET[c2]==$tc||$_GET[c3]==$tc||$_GET[c4]==$tc||$_GET[c5]==$tc||$_GET[c6]==$tc||$_GET[c7]==$tc||$_GET[c8]==$tc||$_GET[c9]==$tc){
            echo "{y:".$aow['value'].",year:'".$x."',color:'#ff6c00'},";
          } else {
            echo "{y:".$aow['value'].",year:'".$x."',color:'#2099bc'},";
          }
        }
        echo "];";      
      }
    }
  }



  echo "$( function() {";
    echo "var handle = $('#custom-handle');";
    echo "$('#slider').slider({";
      echo "value:".$_GET[yl].",";
      echo "min: ".$fy.",";
      echo "max: ".$ly.",";
      echo "step: 1,";
      echo "create: function() {";
        echo "handle.text( $( this ).slider('value') );";
      echo "},";
      echo "slide: function( event, ui ) {";
        if($_GET[high]==1){
          echo "var val=ui.value;";
          echo "var sub=window.location.href;";
          echo "sub = sub.substring(0, sub.indexOf('&yl='));";
          echo "sub = sub+'&yl='+val+'&high=1';";
          echo "window.history.pushState('update','title',sub);";        
          echo "handle.text(val);";
          echo "var ts = ui.value;";
          echo "var tv = 'data'+ts;";
          echo "var tbs = 'cat'+ts;";          
        } else{
          echo "var val=ui.value;";
          echo "var sub=window.location.href;";
          echo "sub = sub.substring(0, sub.indexOf('&yl='));";
          echo "sub = sub+'&yl='+val;";
          echo "window.history.pushState('update','title',sub);";        
          echo "handle.text(val);";
          echo "var ts = ui.value;";
          echo "var tv = 'data'+ts;";
          echo "var tbs = 'cat'+ts;";               
        }
        
        echo "$('#container').highcharts().series[0].setData(eval(tv));";
        echo "$('#container').highcharts().xAxis[0].setCategories(eval(tbs));";
      echo "}";
    echo "});";
    echo "$( '#amount' ).val( 'year: ' + $( '#slider' ).slider( 'value' ) );";
  echo "} );";
?>



var time=0;
var start=0;
$(document).on('click', '.playfa', function(){
  stopnow=0;
  $('.playfa').css('display','none')
  $('.stopfa').css('display','block');
  var tempfy=fy;

  <?php 
  include 'inc/con.php';   
  $aes = mysqli_query($con,"SELECT firstyear,lastyear FROM datasets WHERE id=$_GET[p]");
  while($aow = mysqli_fetch_array($aes)){   
    $fy=$aow['firstyear'];
    $ffy=$fy;
    $ly=$aow['lastyear'];
  }

  $tempval=0;

  $increment = 7000/($ly-$fy);

  while($fy<=$ly){
    echo "window.timer".$fy." = setTimeout(function(){";  
      echo "if(stopnow==0){";
        echo "var val=".$fy.";";
        echo "var sub=window.location.href;";
        echo "sub = sub.substring(0, sub.indexOf('&yl='));";
        echo "sub = sub+'&yl='+val;";
        echo "window.history.pushState('update','title',sub);";

        echo "$('#slider').slider('value',tempfy);";
        echo "$('#custom-handle').text(tempfy);";
        echo "var tempoo = 'data'+tempfy;";
        echo "var tempar = 'cat'+tempfy;";
        echo "$('#container').highcharts().series[0].setData(eval(tempoo));";
        echo "$('#container').highcharts().xAxis[0].setCategories(eval(tempar));";
        echo "tempfy++;";
        if($fy==$ly){
          echo "$('.playfa').css('display','block');";
          echo "$('.stopfa').css('display','none');";
        }
      echo "} else{return false;}";
    echo "}, ".$tempval.");";

    $tempval=$tempval+$increment;
    $fy++;
  }

echo "});";

echo "$(document).on('click', '.stopfa', function(){";
  echo "stopnow=1;";
  while($ffy<=$ly){
    echo "clearTimeout(timer".$ffy.");";
    $ffy++;
  }

  echo "$('.playfa').css('display','block');";
  echo "$('.stopfa').css('display','none');";
echo "});";

mysqli_close($con);
?>




Highcharts.chart('container', {
    legend:{enabled:false},
    credits:{enabled:false},
    chart: {
        marginBottom: 150,
        type: 'column'
    },
    title: {
        text: ''
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: cat,
        crosshair: true
    },
    yAxis: {
        //min: 0,
        max:window.hv,
        title: {
            text: ''
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        //pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>'+'<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
        pointFormat: '<tr><td style="color:{series.color};padding:0"></td>'+'<td style="padding:0"><span>Value:</span> {point.y:.1f} <br><span>Year:</span> {point.year}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{data:data}]
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



});</script>
<script src='cjs/srcbtm.js'></script>
</body>
</html>

