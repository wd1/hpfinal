<?php 
  include 'inc/INChead.php';
  include 'inc/DWtop.php';
  include 'inc/mailchimp.php';
  include 'inc/DWtopec.php';

  echo "<div class='rap1200'>";   
  include 'inc/DWmeatTop.php';
?>
<!--START LINE VISUALIZATION-->
<div id="viz" style='height:600px'></div>
<div id='bLine' class='bee'>
  <div id='slider'>
    <div id='custom-handle' class='ui-slider-handle'></div>
    <div id='custom-handle2' class='ui-slider-handle'></div>
  </div>
  <div class='playfa'>
    <i class='fa fa-play'></i>
  </div>
  <div class='stopfa'>
    <i class='fa fa-stop'></i>
  </div>
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

<!--<script src='js/codehighcharts.js'></script>
<script src='js/codehighchartsmore.js'></script>
<script src='js/highcharts1.js'></script> 
<script src='js/highcharts-more.js'></script>
<script src='js/pattern-fill-v2.js'></script>
<script src='js/broken-axis.js'></script>-->
<script src='js/d3.js'></script>
<script src='js/d3plus.js'></script>
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

  if($_GET[yf]>$_GET[yl]){
    $yearlast=$_GET[yf];
    $yearfirst=$_GET[yl];
  } else{
    $yearfirst=$_GET[yf];
    $yearlast=$_GET[yl];  
  }

  for($x=$fy;$x<=$ly;$x++){
    echo 'window.sam'.$x.' = ['; 
    $aes = mysqli_query($conint,"SELECT * FROM $dset WHERE year>=$x");
    while($aow = mysqli_fetch_array($aes)){   
      $year=$aow['year'];
      $country=$aow['country'];
      $value=$aow['value'];
      echo '{"year":'.$year.', "name":"'.$country.'", "value":'.$value.'},';
    }
    echo '];';
  }

  
  echo "window.fy=".$yearfirst.";";
  echo "window.ly=".$yearlast.";";
  echo "window.title='".$title."';";
  echo "window.subtitle='".$subtitle."';";
  
  echo "window.fy=".$fy.";";
  echo "window.ly=".$ly.";";
  echo "window.title='".$title."';";
  echo "window.subtitle='".$subtitle."';";


  echo "$( function() {";
    echo "$('#slider').slider({";
      echo "range:true,";
      echo "values:[".$yearfirst.",".$yearlast."],";
      echo "min: ".$fy.",";
      echo "max: ".$ly.",";
      echo "step: 1,";
      echo "create: function() {";
        echo "$('#custom-handle').text(".$yearfirst.");";
        echo "$('#custom-handle2').text(".$yearlast.");";
      echo "},";
      echo "slide: function( event, ui ) {";
        echo "var val1=ui.values[0];";
        echo "var val2=ui.values[1];";
        echo "var p=".$_GET['p'].";";
        echo "$('#custom-handle').text( ui.values[0] );";
        echo "$('#custom-handle2').text( ui.values[1] );";
        
        echo "var sub=window.location.href;";
        echo "sub = sub.substring(0, sub.indexOf('&yf='));";
        echo "sub = sub+'&yf='+val1+'&yl='+val2;";
        echo "window.history.pushState('update','title',sub);";
        //echo "var ytem=1980;";
        //echo "var overall=sample_data+val1;";
        //echo "console.log(overall);";
        //echo "visualization.data(sample_data+val1).draw();";
          echo "$.ajax({";
            echo "url:'inc/getLine.php',";
            echo "crossDomain:true,";
            echo "dataType:'JSONP',";
            echo "data:{val1:val1,val2:val2,p:p},";
            echo "success:function(data){";
              //echo "var sample_data=data[0];";
              //echo "console.log(data[0]);";
              //echo "valt=1979;";
              //echo "window.valt2=1971;";
              //echo "window.sammy=sam1971;";
              echo "window.sam2='sam'+val1;";
              //echo "console.log(eval(sam2));";
              echo "visualization.data(eval(sam2)).draw();";
              echo "visualization.x({range:[val1,val2]}).draw();";
            echo "}";
          echo "});";     
      echo "}";
    echo "});";
  echo "} );";















    /*echo 'window.sample_data1970 = ['; 
    $aes = mysqli_query($conint,"SELECT * FROM $dset WHERE year>=1970");
    while($aow = mysqli_fetch_array($aes)){   
      $year=$aow['year'];
      $country=$aow['country'];
      $value=$aow['value'];
      echo '{"year":'.$year.', "name":"'.$country.'", "value":'.$value.'},';
    }
    echo '];';


  echo 'var sample_data = ['; 
  $aes = mysqli_query($conint,"SELECT * FROM $dset");
  while($aow = mysqli_fetch_array($aes)){   
    $year=$aow['year'];
    $country=$aow['country'];
    $value=$aow['value'];
    echo '{"year":'.$year.', "name":"'.$country.'", "value":'.$value.'},';
  }
  echo '];';*/



  echo 'var attributes = [';
  $aes = mysqli_query($con,"SELECT id,name FROM countries");
  while($aow = mysqli_fetch_array($aes)){   
    $tc=$aow['id'];
    $country=$aow['name'];
    if($_GET[c0]==$tc||$_GET[c1]==$tc||$_GET[c2]==$tc||$_GET[c3]==$tc||$_GET[c4]==$tc||$_GET[c5]==$tc||$_GET[c6]==$tc||$_GET[c7]==$tc||$_GET[c8]==$tc||$_GET[c9]==$tc){
      echo '{"name":"'.$country.'", "hex":"#ff6c00"},'; 
    }
  }  
    //echo '{"name": "Japan", "hex": "#CC0000"},';
    //echo '{"name": "China", "hex": "#00CC00"}';
  echo ']';

  //echo 'var attributes = [{"name": "Japan", "hex": "#CC0000"},{"name": "China", "hex": "#00CC00"}]';

  mysqli_close($con);
  mysqli_close($conint);
  ?>



  var visualization = d3plus.viz()
    .container("#viz")
    .data(<?php echo "sam".$_GET[yf]; ?>)
    .type("line")
    .id("name")
    .y("value")
    .y({"grid": false})
    .x("year")
    .x({"grid": false})
    //.time({"value": "year", "solo": 1994})
    //.x({range:[1975,2000]})
    .attrs(attributes)
    .color("hex")
    .legend(false)
    .draw()  


});</script>
<script src='cjs/srcbtm.js'></script>
</body>
</html>

