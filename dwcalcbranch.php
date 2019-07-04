<?php 
  include 'inc/INChead.php';
  include 'inc/DWtop.php';
  include 'inc/mailchimp.php';
  include 'inc/DWtopec.php';

  echo "<div class='rap1200'>";   
  include 'inc/DWmeatTop.php';
?>
<!--START RANK VISUALIZATION-->
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

if($_GET[yf]>$_GET[yl]){
  $yearlast=$_GET[yf];
  $yearfirst=$_GET[yl];
} else{
  $yearfirst=$_GET[yf];
  $yearlast=$_GET[yl];  
}


//COUNTRY 0
$c0=$_GET[c0];
$aes = mysqli_query($con,"SELECT name FROM countries WHERE id='$c0'");
while($aow = mysqli_fetch_array($aes)){   
  $coun0=$aow['name'];
}

$cou=0;
$aes = mysqli_query($conint,"SELECT * FROM $dset WHERE year='$yearfirst' AND cid='$c0'");
while($aow = mysqli_fetch_array($aes)){   
  $cou++;
  $val0=$aow['value'];
}

if($cou==0){
  $val0='N/A';
}



//COUNTRY 1
$c1=$_GET[c1];
$aes = mysqli_query($con,"SELECT name FROM countries WHERE id='$c1'");
while($aow = mysqli_fetch_array($aes)){   
  $coun1=$aow['name'];
}

$cou=0;
$aes = mysqli_query($conint,"SELECT * FROM $dset WHERE year='$yearfirst' AND cid='$c1'");
while($aow = mysqli_fetch_array($aes)){   
  $cou++;
  $val1=$aow['value'];
}

if($cou==0){
  $val1='N/A';
}

//CALCULATIONS
if($val0=='N/A'||$val1=='N/A'){
  $val0rel='N/A';
} else{
  $val0rel=round(($val0/$val1)*100,2);
}

if($val1=='N/A'||$val0=='N/A'){
  $val1rel='N/A';
} else{
  $val1rel=round(($val1/$val0)*100,2);
}







//COUNTRY 2
$cou=0;
$aes = mysqli_query($conint,"SELECT * FROM $dset WHERE year='$yearlast' AND cid='$c0'");
while($aow = mysqli_fetch_array($aes)){   
  $cou++;
  $val2=$aow['value'];
}

if($cou==0){
  $val2='N/A';
}



//COUNTRY 3
$c1=$_GET[c1];
$aes = mysqli_query($con,"SELECT name FROM countries WHERE id='$c1'");
while($aow = mysqli_fetch_array($aes)){   
  $coun1=$aow['name'];
}

$cou=0;
$aes = mysqli_query($conint,"SELECT * FROM $dset WHERE year='$yearlast' AND cid='$c1'");
while($aow = mysqli_fetch_array($aes)){   
  $cou++;
  $val3=$aow['value'];
}

if($cou==0){
  $val3='N/A';
}

//CALCULATIONS
if($val2=='N/A'||$val3=='N/A'){
  $val2rel='N/A';
} else{
  $val2rel=round(($val2/$val3)*100,2); 
}

if($val3=='N/A'||$val2=='N/A'){
  $val3rel='N/A';
} else{
  $val3rel=round(($val3/$val2)*100,2);
}



//ABSOLUTE 
if($val2=='N/A'||$val0=='N/A'){
  $c0abs='N/A';
} else{
  $c0abs=$val2-$val0;  
}

if($val3=='N/A'||$val1=='N/A'){
  $c1abs='N/A';
} else{
  $c1abs=$val3-$val1;
}
//PERCENT
if($val2=='N/A'||$val0=='N/A'){
  $c0per='N/A';
} else{
  $c0per=round( (($val2-$val0)/$val0)*100 ,2);
}

if($val3=='N/A'||$val1=='N/A'){
  $c1per='N/A';
} else{
  $c1per=round( (($val3-$val1)/$val1)*100 ,2);
}



echo "<div class='outershell'>";



  echo "<div class='calcy calcol1'>";
    echo "<div class='calin'>";
      echo "<div class='yeary yeary1' >".$yearfirst."</div>";
          echo "<div class='toptop'>";
            echo "<div class='topleft'>";
              echo "<div class='topleftval calcval'>".$val0."</div>";
              echo "<div class='topleftcoun calccoun'>".$coun0."</div>";
              echo "<div class='toplefttitle calctit'>".$title."</div>";
            echo "</div>";
            echo "<div class='topright'>";
              echo "<div class='toprightval calcval'>".$val1."</div>";
              echo "<div class='toprightcoun calccoun'>".$coun1."</div>";
              echo "<div class='toprighttitle calctit'>".$title."</div>";
            echo "</div>";  
          echo "</div>";
          echo "<div class='botbot'>";
            echo "<div class='botleft'>";
              echo "<div class='botleftval calcval'>".$val0rel." %</div>";
              echo "<div class='botleftcoun calccoun'>".$coun0." Relative To ".$coun1."</div>";
              echo "<div class='botlefttitle calctit'>".$title."</div>";
            echo "</div>";
            echo "<div class='botright'>";
              echo "<div class='botrightval calcval'>".$val1rel." %</div>";
              echo "<div class='botrightcoun calccoun'>".$coun1." Relative To ".$coun0."</div>";
              echo "<div class='botrighttitle calctit'>".$title."</div>";
            echo "</div>";  
          echo "</div>";
    echo "</div>";
  echo "</div>";
  echo "<div class='calcy calcol2'>";
    echo "<div class='calin'>";
      echo "<div class='yeary yeary1' >".$yearlast."</div>";
          echo "<div class='toptop'>";
            echo "<div class='topleft'>";
              echo "<div class='topleftval calcval'>".$val2."</div>";
              echo "<div class='topleftcoun calccoun'>".$coun0."</div>";
              echo "<div class='toplefttitle calctit'>".$title."</div>";
            echo "</div>";
            echo "<div class='topright'>";
              echo "<div class='toprightval calcval'>".$val3."</div>";
              echo "<div class='toprightcoun calccoun'>".$coun1."</div>";
              echo "<div class='toprighttitle calctit'>".$title."</div>";
            echo "</div>";  
          echo "</div>";
          echo "<div class='botbot'>";
            echo "<div class='botleft'>";
              echo "<div class='botleftval calcval'>".$val2rel." %</div>";
              echo "<div class='botleftcoun calccoun'>".$coun0." Relative To ".$coun1."</div>";
              echo "<div class='botlefttitle calctit'>".$title."</div>";
            echo "</div>";
            echo "<div class='botright'>";
              echo "<div class='botrightval calcval'>".$val3rel." %</div>";
              echo "<div class='botrightcoun calccoun'>".$coun1." Relative To ".$coun0."</div>";
              echo "<div class='botrighttitle calctit'>".$title."</div>";
            echo "</div>";  
          echo "</div>";
    echo "</div>";
  echo "</div>";
  echo "<div class='calcy calcol3'>";
    echo "<div class='calin'>";
      echo "<div class='yeary yeary1' >".$yearfirst."-".$yearlast." Summary</div>";
          echo "<div class='toptop'>";
            echo "<div class='topleft'>";
              echo "<div class='topleftval calcval'>".$c0abs."</div>";
              echo "<div class='topleftcoun calccoun'>".$coun0." Absolute Change</div>";
              echo "<div class='toplefttitle calctit'>".$title."</div>";
            echo "</div>";
            echo "<div class='topright'>";
              echo "<div class='toprightval calcval'>".$c1abs."</div>";
              echo "<div class='toprightcoun calccoun'>".$coun1." Absolute Change</div>";
              echo "<div class='toprighttitle calctit'>".$title."</div>";
            echo "</div>";  
          echo "</div>";
          echo "<div class='botbot'>";
            echo "<div class='botleft'>";
              echo "<div class='botleftval calcval'>".$c0per." %</div>";
              echo "<div class='botleftcoun calccoun'>% Change in ".$coun0."</div>";
              echo "<div class='botlefttitle calctit'>".$title."</div>";
            echo "</div>";
            echo "<div class='botright'>";
              echo "<div class='botrightval calcval'>".$c1per." %</div>";
              echo "<div class='botrightcoun calccoun'>% Change in ".$coun1."</div>";
              echo "<div class='botrighttitle calctit'>".$title."</div>";
            echo "</div>";  
          echo "</div>";
    echo "</div>";
  echo "</div>";



echo "</div>";



if($_GET[c0]>0&&$_GET[c1]>0){
echo "<div id='bCalc' class='bee'>";
} else{

echo "<div id='bCalc' class='bee' style='display:none'>";
}

  echo "<div id='slider'>";
    echo "<div id='custom-handle' class='ui-slider-handle'></div>";
    echo "<div id='custom-handle2' class='ui-slider-handle'></div>";
  echo "</div>";
echo "</div>";
mysqli_close($con);
mysqli_close($conint);?>
<!--END RANK VISUALIZATION-->
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
<script type='text/javascript' src='js/html2canvas.js'></script> 
<script type='text/javascript' src='js/canvas-getsvg.js'></script>  

<?php $randal=rand(1,999); echo "<script src='cjs/dwglobal.js?version=".$randal."'></script>";?>


<div id='placy' class='placy'></div>

<style type='text/css'>


.placeholderimg{height:auto;}
#svgContainer { 
  position: absolute;   
}

path { 
  fill:   none;
  stroke: #cdcdcd;
  stroke-width: 0.05em;
}

#sliderrank{
  width: 89%;
  left: 96px; 
}

#custom-handlerank {
  width: 3em;
  height: 1.6em;
  top: 50%;
  margin-top: -.8em;
  text-align: center;
  line-height: 1.6em;
}

#slider{left:74px;}

.ui-slider-range,
.ui-slider .ui-slider-handle{background:#2099bc;border:1px solid #2099bc;}

.ui-slider-range{}

.bee{height:44px;}
</style>

<script type='text/javascript'>$( document ).ready(function() {
$('.playwithdata').addClass('on');
$('.sCalc').addClass('selected');
$('#calc').show();




$(document).on('click', '.dwdown', function(){  
  var loc=window.location.href;

  $('#placy').html($('#holder').html());
  $('#placy').prepend("<img src='img/logoFinal.png' style='position:relative;float:right;width:320px'/>");
  $('#placy').css('padding','25px');
  $('#placy #slider').css('display','none');


  var x = document.getElementById("placy");

  html2canvas(x, {
    onrendered: function (canvas) {
      document.body.appendChild(canvas);
      var img = canvas.toDataURL('image/png');
      var imgorig=img;
      img=img.split('data:image/png;base64,')[1];
      var loc=window.location.href;
      loc=loc.split('dw')[1];
      var urlfinal = imgorig.replace(/^data:image\/[^;]+/, 'data:application/octet-stream');
      window.open(urlfinal);
      /*$.ajax({
        url:'inc/savecharts.php',
        type: 'POST',
        data: {img:img,loc:loc},
      }).done(function(){
        
      });
      return false;*/
    }
  });
});









$(document).on('click', '.dwshare', function(){  
  var loc=window.location.href;
  window.firster=loc.split('&yf=')[0];
  window.starter=loc.split('&yf=')[1];
  starter=starter.split('&yl=')[0];
  window.ender=loc.split('&yl=')[1];

  window.x=[];
  var locker='';
  var lockray=[];
  var counter=0;
  for(var y=starter;y<=ender;y++){
    locker=firster+"&yf="+starter+"&yl="+y;
    $.ajax({
    url:'inc/getCalcDivs.php',
      type: 'POST',
      data: {locker:locker},
      async: false
    }).done(function(data){      
      var daty=data;
      lockray[y]=locker.split('dw')[1];
  
      $('body').append('<div id="placy'+y+'" class="placy"></div>');
      $('#placy'+y+'').html(daty);
      $('#placy'+y+'').prepend("<img src='img/logoFinal.png' style='position:relative;float:right;width:320px'/>");
      $('#placy'+y+'').css('padding','25px');
      $('#placy'+y+' #slider').css('display','none');
      x[y] = document.getElementById("placy"+y+"");
      
      nextstep();
      /*html2canvas(x[y], {
        onrendered: function (canvas) {
          $('#placy'+y+'').html('');
          document.body.appendChild(canvas);
          var img = canvas.toDataURL('image/png');
          img=img.split('data:image/png;base64,')[1];
          /*$.ajax({
            url:'inc/savecharts.php',
            type: 'POST',
            data: {img:img,locker:locker},
            async: false
          }).done(function(data){

          });
        }
      });*/
    });

    //if(y==ender-1){
    //  alert('doneso');
    //}

  }

});

function nextstep(){
  for(y=starter;y<=ender;y++){
    html2canvas(x[y], {
      onrendered: function (canvas) {
        $('#placy'+y+'').html('');
        document.body.appendChild(canvas);
        var img = canvas.toDataURL('image/png');
        img=img.split('data:image/png;base64,')[1];
        /*$.ajax({
          url:'inc/savecharts.php',
          type: 'POST',
          data: {img:img,locker:locker},
          async: false
        }).done(function(data){

        });*/
      }
    });
  }
}









<?php
  include 'inc/con.php'; 
  include 'inc/conint.php'; 
  $dset="z".$_GET[p];
  //$cset="z".$_GET[c];
  
  $aes = mysqli_query($con,"SELECT firstyear,lastyear,title,subtitle FROM datasets WHERE id=$_GET[p]");
  while($aow = mysqli_fetch_array($aes)){   
    $fy=$aow['firstyear'];
    $ly=$aow['lastyear'];
    $title=$aow['title'];
    $subtitle=$aow['subtitle'];
  }

  if($_GET[yf]>$_GET[yl]){
    $yearlast=$_GET[yf];
    $yearfirst=$_GET[yl];
  } else{
    $yearfirst=$_GET[yf];
    $yearlast=$_GET[yl];  
  }

  
  echo "window.fy=".$yearfirst.";";
  echo "window.ly=".$yearlast.";";
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
        echo "var c0=".$_GET['c0'].";";
        echo "var c1=".$_GET['c1'].";";
        echo "$('#custom-handle').text( ui.values[0] );";
        echo "$('#custom-handle2').text( ui.values[1] );";
        
        echo "var sub=window.location.href;";
        echo "sub = sub.substring(0, sub.indexOf('&yf='));";
        echo "sub = sub+'&yf='+val1+'&yl='+val2;";

        echo "window.history.pushState('update','title',sub);";
          echo "$.ajax({";
            echo "url:'inc/getCalc.php',";
            echo "crossDomain:true,";
            echo "dataType:'JSONP',";
            echo "data:{val1:val1,val2:val2,p:p,c0:c0,c1:c1},";
            echo "success:function(data){";
              echo "$('.outershell').html(data[0]);";
            echo "}";
          echo "});";     
      echo "}";
    echo "});";
  echo "} );";

mysqli_close($con);
mysqli_close($conint);
?>


});</script>
<script src='cjs/srcbtm.js'></script>
</body>
</html>

