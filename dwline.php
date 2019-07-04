<?php 
  include 'inc/INChead.php';
  include 'inc/DWtop.php';
  include 'inc/mailchimp.php';
  include 'inc/DWtopec.php';

  echo "<div class='rap1200'>";   
  include 'inc/DWmeatTop.php';
?>
<!--START LINE VISUALIZATION-->
<div id="viz" style="height:600px;width:100%" ></div>
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

  <?php if($_GET[r0]>0||$_GET[r1]>0||$_GET[r2]>0||$_GET[r3]>0||$_GET[r4]>0||$_GET[r5]>0||$_GET[r6]>0||$_GET[r7]>0||$_GET[r8]>0||$_GET[r9]>0 ){//if there is a region selected
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




<style type='text/css'>
.reger{margin:0 auto;text-align:center;background:#f7f7f7;padding-top:20px;padding-bottom:40px;position:relative;bottom:50px;}
.reger div{display:inline-block;border:1px solid #2099bc;padding:10px 0px;width:275px;margin:0px 20px;color:#2099bc;cursor:pointer;}
.reger div:hover{background:#2099bc;color:white;}
.reger div.regsel{background:#ff6c00;border:1px solid#ff6c00;color:white;}

.barhighlow div{width:275px;}
.d3plus_message_text{display:none!important;}  
#sliderrank{
  width: 89%;
  left: 96px; 
}

#slider{left:74px;}
</style>
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




$(document).on('click', '.regave', function(){
  var loc=window.location.href;
  loc = loc.split('&reg=')[0];
  loc = loc+"&reg=1";
  window.history.pushState('update','title',loc);
  location.reload();
});

$(document).on('click', '.regwav', function(){
  var loc=window.location.href;
  loc = loc.split('&reg=')[0];
  loc = loc+"&reg=2";
  window.history.pushState('update','title',loc);
  location.reload();
});

$(document).on('click', '.regsum', function(){
  var loc=window.location.href;
  loc = loc.split('&reg=')[0];
  window.history.pushState('update','title',loc);
  location.reload();
});












<?php
  include 'inc/con.php'; 
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

    echo 'window.sam'.$yearfirst.' = ['; 
    $aes = mysqli_query($conint,"SELECT * FROM $dset WHERE year>=$yearfirst AND year <=$yearlast");
    while($aow = mysqli_fetch_array($aes)){   
      $tc=$aow[cid];
      $year=$aow['year'];
      $country=$aow['country'];
      $value=$aow['value'];
      if($_GET[c0]==$tc||$_GET[c1]==$tc||$_GET[c2]==$tc||$_GET[c3]==$tc||$_GET[c4]==$tc||$_GET[c5]==$tc||$_GET[c6]==$tc||$_GET[c7]==$tc||$_GET[c8]==$tc||$_GET[c9]==$tc ){
        echo '{"year":'.$year.', "name":"'.$country.'", "value":'.$value.'},';
        //echo '{"year":'.$year.', "name":"'.$country.'", "value":'.$value.',"value2":'.rand(10,100).'},';
      }
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
          //echo '{"year":'.$year.', "name":"'.$rname.'", "value":'.$value.',"value2":20},';  
        }
      }    
    }

    echo '];';      
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
        if($_GET[high]>0){
          echo "sub = sub+'&yf='+val1+'&yl='+val2+'&high=1';";
        } else{
          echo "sub = sub+'&yf='+val1+'&yl='+val2;";
        }   
        echo "window.history.pushState('update','title',sub);";
      echo "},";
      echo "change: function( event, ui ) {";
        echo "var val1=ui.values[0];";
        echo "var val2=ui.values[1];";
        echo "var p=".$_GET['p'].";";
        if($_GET[high]>0){echo "var high=1;";}else{echo "var high=0;";}
        if($_GET[c0]>0){echo "var c0=".$_GET[c0].";";}else{echo "var c0=-1;";}
        if($_GET[c1]>0){echo "var c1=".$_GET[c1].";";}else{echo "var c1=-1;";}
        if($_GET[c2]>0){echo "var c2=".$_GET[c2].";";}else{echo "var c2=-1;";}
        if($_GET[c3]>0){echo "var c3=".$_GET[c3].";";}else{echo "var c3=-1;";}
        if($_GET[c4]>0){echo "var c4=".$_GET[c4].";";}else{echo "var c4=-1;";}
        if($_GET[c5]>0){echo "var c5=".$_GET[c5].";";}else{echo "var c5=-1;";}
        if($_GET[c6]>0){echo "var c6=".$_GET[c6].";";}else{echo "var c6=-1;";}
        if($_GET[c7]>0){echo "var c7=".$_GET[c7].";";}else{echo "var c7=-1;";}
        if($_GET[c8]>0){echo "var c8=".$_GET[c8].";";}else{echo "var c8=-1;";}
        if($_GET[c9]>0){echo "var c9=".$_GET[c9].";";}else{echo "var c9=-1;";}
        if($_GET[r0]>0){echo "var r0=".$_GET[r0].";";}else{echo "var r0=-1;";}
        if($_GET[r1]>0){echo "var r1=".$_GET[r1].";";}else{echo "var r1=-1;";}
        if($_GET[r2]>0){echo "var r2=".$_GET[r2].";";}else{echo "var r2=-1;";}
        if($_GET[r3]>0){echo "var r3=".$_GET[r3].";";}else{echo "var r3=-1;";}
        if($_GET[r4]>0){echo "var r4=".$_GET[r4].";";}else{echo "var r4=-1;";}
        if($_GET[r5]>0){echo "var r5=".$_GET[r5].";";}else{echo "var r5=-1;";}
        if($_GET[r6]>0){echo "var r6=".$_GET[r6].";";}else{echo "var r6=-1;";}
        if($_GET[r7]>0){echo "var r7=".$_GET[r7].";";}else{echo "var r7=-1;";}
        if($_GET[r8]>0){echo "var r8=".$_GET[r8].";";}else{echo "var r8=-1;";}
        if($_GET[r9]>0){echo "var r9=".$_GET[r9].";";}else{echo "var r9=-1;";}
        if($_GET[reg]>0){echo "var reg=".$_GET[reg].";";}else{echo "var reg=-1;";}
        echo "$.ajax({";
          echo "url:'inc/getLine.php',";
          echo "crossDomain:true,";
          echo "dataType:'JSONP',";
          echo "data:{val1:val1,val2:val2,p:p,high:high,c0:c0,c1:c1,c2:c2,c3:c3,c4:c4,c5:c5,c6:c6,c7:c7,c8:c8,c9:c9,r0:r0,r1:r1,r2:r2,r3:r3,r4:r4,r5:r5,r6:r6,r7:r7,r8:r8,r9:r9,reg:reg},";
          echo "success:function(data){";
            echo 'visualization';
              echo '.data(eval(data[0]))';
              echo '.draw()';
          echo "}";
        echo "});";     
      echo "}";
    echo "});";
  echo "} );";


  echo 'var attributes = [';
  $aes = mysqli_query($con,"SELECT id,name FROM countries");
  while($aow = mysqli_fetch_array($aes)){   
    $tc=$aow['id'];
    $country=$aow['name'];
    if($_GET[c0]==$tc||$_GET[c1]==$tc||$_GET[c2]==$tc||$_GET[c3]==$tc||$_GET[c4]==$tc||$_GET[c5]==$tc||$_GET[c6]==$tc||$_GET[c7]==$tc||$_GET[c8]==$tc||$_GET[c9]==$tc){
      echo '{"name":"'.$country.'", "hex":"#ff6c00"},'; 
    }
  }  
  $aes = mysqli_query($con,"SELECT rid,region FROM regions");
  while($aow = mysqli_fetch_array($aes)){   
    $tc=$aow['rid'];
    $region=$aow['region'];
    if($_GET[r0]==$tc||$_GET[r1]==$tc||$_GET[r2]==$tc||$_GET[r3]==$tc||$_GET[r4]==$tc||$_GET[r5]==$tc||$_GET[r6]==$tc||$_GET[r7]==$tc||$_GET[r8]==$tc||$_GET[r9]==$tc){
      echo '{"name":"'.$region.'", "hex":"#2099bc"},'; 
    }
  }  
  echo ']';

  mysqli_close($con);
  mysqli_close($conint);
  ?>



  var visualization = d3plus.viz()
    .container("#viz")
    .data(<?php echo "sam".$yearfirst; ?>)
    .type("line")
    .id("name")
    //.y2("value2")
    //.y2({"grid":false})
    //.y2({"label":"new labelio"})
    .y("value")
    .y({"grid":false})
    .y({"label":subtitle})
    .x("year")
    .x({"grid":false})
    .x({"label":false})
    .font({ "family": "ProximaNova-SemiBold" })
    //.time({"value": "year", "solo": 1994})
    //.x({range:[1975,2000]})
    .attrs(attributes)
    <?php if($_GET[high]>0){}else{echo '.color("hex")';}?>
    .legend(false)
    .draw()  


});</script>
<script src='cjs/srcbtm.js'></script>
</body>
</html>

