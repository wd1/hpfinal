<?php 
  include 'inc/INChead.php';
  include 'inc/DWtop.php';
  include 'inc/mailchimp.php';
  include 'inc/DWtopec.php';
  
  echo "<div class='rap1200'>";   
  include 'inc/DWmeatTop.php';
?>
<!--START WORLD VISUALIZATION-->
<div class='cont' id='container'></div>
<div id='bWorld' class='bee'>
  <div id='slider'>
    <div id='custom-handle' class='ui-slider-handle'></div>
  </div>
  <div class='playfa'>
    <i class='fa fa-play'></i>
  </div>
  <div class='stopfa'>
    <i class='fa fa-stop'></i>
  </div>
  
  <div class='colchoose'>
    <?php 
    if($_GET[col]==1){
      echo "<div class='multi'>Multi-colored</div>
            <div class='mono ony'>Monochromatic</div>
            <div class='bi'>Bi-chromatic</div>";
    } else if($_GET[col]==2){
      echo "<div class='multi ony'>Multi-colored</div>
            <div class='mono'>Monochromatic</div>
            <div class='bi'>Bi-chromatic</div>";
    } else{
      echo "<div class='multi'>Multi-colored</div>
            <div class='mono'>Monochromatic</div>
            <div class='bi ony'>Bi-chromatic</div>";      
    }
    ?>
    <label>COLOR</label>
  </div>


</div>
<!--END WORLD VISUALIZATION-->
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

<style type="text/css">
#container {
  width:98%;
  margin:0 auto;
  height:750px;
}
</style>

<script src="https://code.highcharts.com/maps/highmaps.js"></script>
<script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
<script src="https://code.highcharts.com/mapdata/custom/world-robinson-highres.js"></script>

<script type="text/javascript">
$('.playwithdata').addClass('on');
$('.sWorld').addClass('selected');
window.stopnow=0;

$(document).on('click', '.mono', function(){
  var loc=window.location.href;
  loc = loc.split('&col=')[0];
  loc = loc+"&col=1";
  window.history.pushState('update','title',loc);
  location.reload();
});

$(document).on('click', '.multi', function(){
  var loc=window.location.href;
  loc = loc.split('&col=')[0];
  loc = loc+"&col=2";
  window.history.pushState('update','title',loc);
  location.reload();
});

$(document).on('click', '.bi', function(){
  var loc=window.location.href;
  loc = loc.split('&col=')[0];
  window.history.pushState('update','title',loc);
  location.reload();
});




// Prepare demo data
// Data is joined to map using value of 'hc-key' property by default.
// See API docs for 'joinBy' for more info on linking data and map.
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

  if($_GET[yf]>0){$donothing=1;}
  else{ 
    echo "var sub=window.location.href;";
    echo "sub = sub.substring(0, sub.indexOf('&yf='));";
    echo "sub = sub+'&yf=".$fy."&yl=".$ly."';";
    echo "window.history.pushState('update','title',sub);";
  }
  
  echo "window.fy=".$fy.";";
  echo "window.ly=".$ly.";";
  echo "window.title='".$title."';";
  echo "window.subtitle='".$subtitle."';";

  $result = mysqli_query($conint, "SELECT COUNT(*) AS `count` FROM $dset");
  $row = mysqli_fetch_array($result);
  $toty = $row['count'];
  $div12 = floor($toty/12);

  $ind0=0;
  $ind1=$div12*1;
  $ind2=$div12*2;
  $ind3=$div12*3;
  $ind4=$div12*4;
  $ind5=$div12*5;
  $ind6=$div12*6;
  $ind7=$div12*7;
  $ind8=$div12*8;
  $ind9=$div12*9;
  $ind10=$div12*10;
  $ind11=$div12*11;
  $ind12=$toty-1;

  //echo "alert(".$ind12.");";

  $bucount=0;

  $aes = mysqli_query($conint,"SELECT value FROM $dset ORDER by value ASC");
  while($aow = mysqli_fetch_array($aes)){   
    $val=$aow['value'];
    if($ind0==$bucount){
      echo "window.ind0=".$val.";";
    }
    if($ind1==$bucount){
      echo "window.ind1=".$val.";";
    }
    if($ind2==$bucount){
      echo "window.ind2=".$val.";";
    }
    if($ind3==$bucount){
      echo "window.ind3=".$val.";";
    }
    if($ind4==$bucount){
      echo "window.ind4=".$val.";";
    }
    if($ind5==$bucount){
      echo "window.ind5=".$val.";";
    }
    if($ind6==$bucount){
      echo "window.ind6=".$val.";";
    }
    if($ind7==$bucount){
      echo "window.ind7=".$val.";";
    }
    if($ind8==$bucount){
      echo "window.ind8=".$val.";";
    }
    if($ind9==$bucount){
      echo "window.ind9=".$val.";";
    }
    if($ind10==$bucount){
      echo "window.ind10=".$val.";";
    }
    if($ind11==$bucount){
      echo "window.ind11=".$val.";";
    }
    if($ind12==$bucount){
      echo "window.ind12=".$val.";";
    }
    $bucount++;
  }
  

  


  
  for($x=$fy;$x<=$ly;$x++){
    echo "window.timer".$x."=1;";
    if($x==$_GET[yl]){
      echo "var data = ["; 
      $aes = mysqli_query($conint,"SELECT * FROM interpolate.$dset INNER JOIN custom.countries ON $dset.cid=countries.id  WHERE year='$x'");
      while($aow = mysqli_fetch_array($aes)){   
          echo "['".$aow['abbr']."',".round($aow['value'],2)."],";
      }
      echo "];";      
    }

    echo "var data".$x." = ["; 
    $aes = mysqli_query($conint,"SELECT * FROM interpolate.$dset INNER JOIN custom.countries ON $dset.cid=countries.id  WHERE year='$x'");
    while($aow = mysqli_fetch_array($aes)){   
        echo "['".$aow['abbr']."',".round($aow['value'],2)."],";
    }
    echo "];";
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
        echo "$('#container').highcharts().series[0].setData(eval(tv));";
      echo "}";
    echo "});";
    echo "$( '#amount' ).val( 'year: ' + $( '#slider' ).slider( 'value' ) );";
  echo "} );";

mysqli_close($con);
mysqli_close($conext);
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

  $increment = 9000/($ly-$fy);

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

// Create the chart
Highcharts.mapChart('container', {
    chart: {
        animate:false,
        map: 'custom/world-robinson-highres'
    },
    credits: { enabled: false },
    exporting: { enabled: false },
    title: {
        text: ''
    },

    subtitle: {
        text: ''
    },
    legend:{align:'right',verticalAlign:'top',layout:'vertical'},
    mapNavigation: {
        enabled: true,
        buttonOptions: {
            verticalAlign: 'bottom'
        }
    },
    <?php 
      if($_GET[col]==1){
        echo "colorAxis: {
      dataClasses: [
      {
        from:ind0,
        to:ind1,
        color:'#9FA6FC'
      }, 
      {
        from:ind1,
        to:ind2,
        color:'#9299F4'
      }, 
      {
        from:ind2,
        to:ind3,
        color:'#868DEC'
      }, 
      {
        from:ind3,
        to:ind4,
        color:'#7981E4'
      }, 
      {
        from:ind4,
        to:ind5,
        color:'#6D75DC'
      }, 
      {
        from:ind5,
        to:ind6,
        color:'#6169D5'
      }, 
      {
        from:ind6,
        to:ind7,
        color:'#545DCD'
      }, 
      {
        from:ind7,
        to:ind8,
        color:'#4851C5'
      }, 
      {
        from:ind8,
        to:ind9,
        color:'#3B45BD'
      }, 
      {
        from:ind9,
        to:ind10,
        color:'#2F39B5'
      }, 
      {
        from:ind10,
        to:ind11,
        color:'#2E38B5'
      }, 
      {
        from:ind11,
        to:ind12,
        color:'#232DAE'
      }, 
    ]
    },";
    } else if($_GET[col]==2){
        echo "colorAxis: {
      dataClasses: [
      {
        from:ind0,
        to:ind1,
        color:'#ffffff'
      }, 
      {
        from:ind1,
        to:ind2,
        color:'#ffffd9'
      }, 
      {
        from:ind2,
        to:ind3,
        color:'#F6FBC5'
      }, 
      {
        from:ind3,
        to:ind4,
        color:'#EDF8B1'
      }, 
      {
        from:ind4,
        to:ind5,
        color:'#c7e9b4'
      }, 
      {
        from:ind5,
        to:ind6,
        color:'#A3DBB7'
      }, 
      {
        from:ind6,
        to:ind7,
        color:'#7fcdbb'
      }, 
      {
        from:ind7,
        to:ind8,
        color:'#41b6c4'
      }, 
      {
        from:ind8,
        to:ind9,
        color:'#1d91c0'
      }, 
      {
        from:ind9,
        to:ind10,
        color:'#225ea8'
      }, 
      {
        from:ind10,
        to:ind11,
        color:'#253494'
      }, 
      {
        from:ind11,
        to:ind12,
        color:'#081d58'
      }, 
    ]
    },";      
    } else{
        echo "colorAxis: {
      dataClasses: [
      {
        from:ind0,
        to:ind1,
        color:'#f7fbff'
      }, 
      {
        from:ind1,
        to:ind2,
        color:'#E3F0F9'
      }, 
      {
        from:ind2,
        to:ind3,
        color:'#CFE5F3'
      }, 
      {
        from:ind3,
        to:ind4,
        color:'#BBDAED'
      }, 
      {
        from:ind4,
        to:ind5,
        color:'#A7CFE7'
      }, 
      {
        from:ind5,
        to:ind6,
        color:'#93C4E1'
      }, 
      {
        from:ind6,
        to:ind7,
        color:'#7FB9DB'
      }, 
      {
        from:ind7,
        to:ind8,
        color:'#6baed6'
      }, 
      {
        from:ind8,
        to:ind9,
        color:'#4292c6'
      }, 
      {
        from:ind9,
        to:ind10,
        color:'#2171b5'
      }, 
      {
        from:ind10,
        to:ind11,
        color:'#08519c'
      }, 
      {
        from:ind11,
        to:ind12,
        color:'#08306b'
      }, 
    ]
    },";
    }
    ?>
    series: [{
        data: data,
        name: subtitle,
        states: {
            hover: {
                color: '#BADA55'
            }
        },
        dataLabels: {
            enabled: false,
            format: '{point.name}'
        }
    }]
});

</script>


<script src='js/jquery-ui.1.10.1.js'></script>    
<script src='cjs/dwglobal.js'></script>

<script src='cjs/srcbtm.js'></script>
</body>
</html>

