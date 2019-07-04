<?php 
  include 'inc/INChead.php';
  include 'inc/DWtop.php';
  include 'inc/mailchimp.php';
  include 'inc/DWtopec.php';

  echo "<div class='rap1200'>";   
  include 'inc/DWmeatTop.php';
?>
<!--START TREE VISUALIZATION-->
<div id="container" style='height:600px'></div>

<div id='bTree' class='bee'>
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

  <div class='treereg'>
    <div class='allcountries treesel'>View All Countries</div>
    <div class='unregions'>View UN Regions</div>  
    <div class='wbregions'>View World Bank Regions</div>
    <div class='imfregions'>View IMF Regions</div>
  </div>

</div>
<!--END TREE VISUALIZATION-->
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


<script src='js/codejquery191.js'></script>
<script src='js/jqueryui1101.js'></script>  
<script src="https://code.highcharts.com/highcharts.src.js"></script>
<script src='js/codehighchartsmore.js'></script>
<script src='js/heatmap.js'></script>
<script src='js/treemap.js'></script>
<script src='cjs/dwglobal.js'></script>


<style type='text/css'>
.treereg{bottom:40px;}
</style>
<script type='text/javascript'>$( document ).ready(function() {
$('.playwithdata').addClass('on');
$('.sTree').addClass('selected');
$('#dTree').show();
window.stopnow=0;

$('.treereg div').click(function(){
    var metasel=$(this).attr('class');
    
    var sub=window.location.href;
    if(metasel=='unregions'){
      sub=sub.replace('dwtree', 'dwtreeUN');
    } else if(metasel=='wbregions'){
      sub=sub.replace('dwtree', 'dwtreeWB');
    } else if(metasel=='imfregions'){
      sub=sub.replace('dwtree', 'dwtreeIMF');
    } 

    window.history.pushState('update','title',sub);
    location.reload();
});



<?php
  include 'inc/con.php'; 
  include 'inc/conint.php'; 
  include 'inc/conregionave.php'; 
  $dset="z".$_GET[p];
  //$cset="z".$_GET[c];
  
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


  if($_GET[yf]>0&&$_GET[yl]>0){
    $donothing=1;
  } else{
    echo "var sub=window.location.href;";
    echo "sub = sub+'&yf='+fy+'&yl='+ly;";
    echo "window.history.pushState('update','title',sub);";
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
        echo "var val=ui.value;";
        echo "var sub=window.location.href;";
        echo "sub = sub.substring(0, sub.indexOf('&yl='));";
        echo "sub = sub+'&yl='+val;";
        echo "window.history.pushState('update','title',sub);";        
        echo "handle.text(val);";
        echo "var ts = val;";
        echo "var tv = 'data'+ts;";
        echo "var tbs = 'cat'+ts;";
        
        echo "$('#container').highcharts().series[0].setData(eval(tv));";
      echo "}";
    echo "});";
    echo "$( '#amount' ).val( 'year: ' + $( '#slider' ).slider( 'value' ) );";
  echo "} );";
  $ogfy=$fy;






  for($x=$ogfy;$x<=$ly;$x++){
    echo "window.timer".$x."=1;";

    if($x==$_GET[yl]){
      echo "var data = [";
      $bes = mysqli_query($conint,"SELECT DISTINCT cid,country,value FROM $dset WHERE year=$x ORDER BY country ASC");
      while($bow = mysqli_fetch_array($bes)){   
        $tc=$bow['cid'];
        $cid=$bow['cid'];
        $country=$bow['country'];
        $value=$bow['value'];

        $xy="a".$ly;
        $res = mysqli_query($con,"SELECT $xy FROM countries_final WHERE id=$cid");
        while($row = mysqli_fetch_array($res)){
          $pop=$row[$xy];
        }   

        if($_GET[c0]==$tc||$_GET[c1]==$tc||$_GET[c2]==$tc||$_GET[c3]==$tc||$_GET[c4]==$tc||$_GET[c5]==$tc||$_GET[c6]==$tc||$_GET[c7]==$tc||$_GET[c8]==$tc||$_GET[c9]==$tc){
          echo "{name:'".$country."',value:".$value.",colorValue:".$value.",color:'#ff6c00'},";
        } else{
          echo "{name:'".$country."',value:".$value.",colorValue:".$value."},";
        }
      }
      echo "];"; 
    }

    echo "var data".$x." = [";
    $bes = mysqli_query($conint,"SELECT DISTINCT cid,country,value FROM $dset WHERE year=$x ORDER BY country ASC");
    while($bow = mysqli_fetch_array($bes)){   
      $cid=$bow['cid'];
      $tc=$cid;
      $country=$bow['country'];
      $value=$bow['value'];
    
      $xy="a".$x;
      $res = mysqli_query($con,"SELECT $xy FROM countries_final WHERE id=$cid");
      while($row = mysqli_fetch_array($res)){
        $pop=$row[$xy];
      }   


      if($_GET[c0]==$tc||$_GET[c1]==$tc||$_GET[c2]==$tc||$_GET[c3]==$tc||$_GET[c4]==$tc||$_GET[c5]==$tc||$_GET[c6]==$tc||$_GET[c7]==$tc||$_GET[c8]==$tc||$_GET[c9]==$tc){
        echo "{name:'".$country."',value:".$value.",colorValue:".$value.",color:'#ff6c00'},";
      } else{
        echo "{name:'".$country."',value:".$value.",colorValue:".$value."},";
      }
    }
    echo "];";     
  }


  mysqli_close($con);
  mysqli_close($conint);
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

  $increment = 10000/($ly-$fy);
  //if($increment<1000){$increment=500;}

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
        echo "$('#container').highcharts().series[0].setData(eval(tempoo));";
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
    credits: {enabled:false},
    colorAxis: {
        //min:0,
        //max:window.hv,
        //tickPositions:[1,5,10],
        minColor: '#FFFFFF',
        maxColor: Highcharts.getOptions().colors[0]
    },
    series: [{
      type: 'treemap',
      layoutAlgorithm: 'squarified',
      allowDrillToNode: true,
      alternateStartingDirection: true,
      data: data
    }],
    title: {
        text: ''
    },
    chart:{
        animation:false,
        type:'treemap',
        backgroundColor:'#f7f7f7',
        style:{
          fontFamily:'ProximaNova-Regular',
          fontColor:'#333',
          fontSize:'22px',
          spacingBottom:700,
        }
    }
});


});</script>
<script src='cjs/srcbtm.js'></script>
</body>
</html>

