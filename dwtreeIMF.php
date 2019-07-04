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
</div>
<div class='treereg'>
  <div class='allcountries'>View All Countries</div>
  <div class='unregions'>View UN Regions</div>  
  <div class='wbregions treesel'>View World Bank Regions</div>
  <div class='imfregions'>View IMF Regions</div>
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
<script src='js/codehighcharts.js'></script>
<script src='js/codehighchartsmore.js'></script>
<script src='js/heatmap.js'></script>
<script src='js/treemap.js'></script>
<script src='cjs/dwglobal.js'></script>


<script type='text/javascript'>$( document ).ready(function() {
$('.playwithdata').addClass('on');
$('.sTree').addClass('selected');
$('#dTree').show();
window.stopnow=0;

$('.treereg div').click(function(){
    var metasel=$(this).attr('class');
    
    var sub=window.location.href;
    if(metasel=='unregions'){
      sub=sub.replace('dwtreeIMF', 'dwtreeUN');
    } else if(metasel=='wbregions'){
      sub=sub.replace('dwtreeIMF', 'dwtreeWB');
    } else if(metasel=='allcountries'){
      sub=sub.replace('dwtreeIMF', 'dwtree');
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
      echo "value:".$ly.",";
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
        echo "var ts = ui.value;";
        echo "var tv = 'data'+ts;";
        echo "var tbs = 'cat'+ts;";
        
        echo "$('#container').highcharts().series[0].setData(eval(tv));";
      echo "}";
    echo "});";
    echo "$( '#amount' ).val( 'year: ' + $( '#slider' ).slider( 'value' ) );";
  echo "} );";
  $ogfy=$fy;





  echo "var data = [";
  $bes = mysqli_query($con,"SELECT * FROM regions WHERE metaregion='IMF'");
  while($bow = mysqli_fetch_array($bes)){   
    $cou=0;
    $rid=$bow['rid'];
    $region=$bow['region'];
    $color=$bow['color'];
    $metaregion=$bow['metaregion'];

    $ces = mysqli_query($conint,"SELECT * FROM interpolate.$dset INNER JOIN custom.zaliases ON $dset.cid=zaliases.cid WHERE year=$ly AND rid=$rid");
    while($cow = mysqli_fetch_array($ces)){  
      if($cou==0){
        echo "{id:'".$rid."',name:'".$region."',color:'".$color."'},";
        $cou++;
      }
      $valll=$cow['value'];
      $connn=$cow['country'];   
      echo "{name:'".$connn."',parent:'".$rid."',color:'".$color."',value:".$valll."},";    
    }   

  }
  echo "];";


  for($x=$ogfy;$x<=$ly;$x++){
    echo "window.timer".$x."=1;";
    echo "var data".$x." = [";
    $bes = mysqli_query($con,"SELECT * FROM regions WHERE metaregion='UN'");
    while($bow = mysqli_fetch_array($bes)){   
      $cou=0;
      $rid=$bow['rid'];
      $region=$bow['region'];
      $color=$bow['color'];
      $metaregion=$bow['metaregion'];

      $ces = mysqli_query($conint,"SELECT * FROM interpolate.$dset INNER JOIN custom.zaliases ON $dset.cid=zaliases.cid WHERE year=$x AND rid=$rid");
      while($cow = mysqli_fetch_array($ces)){  
        if($cou==0){
          echo "{id:'".$rid."',name:'".$region."',color:'".$color."'},";
          $cou++;
        }
        $valll=$cow['value'];
        $connn=$cow['country'];   
        echo "{name:'".$connn."',parent:'".$rid."',color:'".$color."',value:".$valll."},";    
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

  $increment = 15000/($ly-$fy);

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
    series: [{
      type: 'treemap',
      layoutAlgorithm: 'squarified',
      allowDrillToNode: true,
      alternateStartingDirection: true,
      dataLabels: {
              enabled: false
          },
      levels: [{
          level: 1,
          layoutAlgorithm: 'squarified',
          dataLabels: {
              enabled: true,
              align: 'left',
              verticalAlign: 'top',
              style: {
                  fontWeight: 'bold',
                  fontSize: '22px'
              }
          }
      }, {
          level: 2,
          layoutAlgorithm: 'squarified',
          dataLabels: {
              enabled: true
          }
      }],
      //data:imfdata2016
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
          spacingBottom:700,
        }
    }
});


});</script>
<script src='cjs/srcbtm.js'></script>
</body>
</html>

