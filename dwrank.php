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

if($_GET[yf]>$_GET[yl]){
  $yearlast=$_GET[yf];
  $yearfirst=$_GET[yl];
} else{
  $yearfirst=$_GET[yf];
  $yearlast=$_GET[yl];  
}

echo "<div id='bRank' class='bee'>";
  echo "<div id='slider'>";
    echo "<div id='custom-handle' class='ui-slider-handle'></div>";
    echo "<div id='custom-handle2' class='ui-slider-handle'></div>";
  echo "</div>";
  echo "<div class='playfa'>";
    echo "<i class='fa fa-play'></i>";
  echo "</div>";
  echo "<div class='stopfa'>";
    echo "<i class='fa fa-stop'></i>";
  echo "</div>";
echo "</div>";

echo "<div class='outershell'>";
  echo "<div id='svgContainer'>";
    echo "<svg id='svg' width='0' height='0'>";
      $aes = mysqli_query($con,"SELECT firstyear,lastyear FROM datasets WHERE id=$_GET[p]");
      while($aow = mysqli_fetch_array($aes)){   
        $fy=$aow['firstyear'];
        $ly=$aow['lastyear'];
      }

      $cou=0;
      $aes = mysqli_query($conint,"SELECT * FROM $dset WHERE year='$yearfirst' ORDER BY value DESC");
      while($aow = mysqli_fetch_array($aes)){   
        $oldval=$newval;
        $cid=$aow['cid'];
        $country=$aow['country'];
        $value=$aow['value'];


        if($value!=''){
          echo "<path data-id='".$country."' id='path".$cid."' />";
        }
      }
    echo "</svg>";
  echo "</div>";






  echo "<div class='ranker rank-outer'>";
    echo "<div class='ff first'>";
      echo "<span class='a' >".$yearfirst." Ranking</span>";
        $cou=0;
        $aes = mysqli_query($conint,"SELECT * FROM $dset WHERE year='$yearfirst' ORDER BY value DESC");
        while($aow = mysqli_fetch_array($aes)){   
          $oldval=$newval;
          $cid=$aow['cid'];
          $country=$aow['country'];
          $value=$aow['value'];

          if($value!=''){
            $newval=$value;              
            $cou++;
            if($newval!=$oldval){
              if($value<10){
                echo "<section class='s".$cid."'><div class='bolnum'>".$cou.".</div> <div class='context'>".$country."</div> <div class='a".$cid." secnum'>".round($value,2)."</div></section>"; 
              } else{
                echo "<section class='s".$cid."'><div class='bolnum'>".$cou.".</div> <div class='context'>".$country."</div> <div class='a".$cid." secnum'>".round($value,1)."</div></section>";
              }
            } else{
              if($value<10){
                echo "<section class='s".$cid."'><div class='bolnum' style='visibility:hidden'>".$cou.".</div> <div class='context'>".$country."</div> <div class='a".$cid." secnum'>".round($value,2)."</div></section>"; 
              } else{
                echo "<section class='s".$cid."'><div class='bolnum' style='visibility:hidden'>".$cou.".</div> <div class='context'>".$country."</div> <div class='a".$cid." secnum'>".round($value,1)."</div></section>";  
              }
            }            
          }

        }
    echo "</div>";
  echo "</div>";





  echo "<div class='ranker rank-outer'>";
    echo "<div class='ff last'>";
      echo "<span class='b'>".$yearlast." Ranking</span>";
        $cou=0;
        $aes = mysqli_query($conint,"SELECT * FROM $dset WHERE year='$yearlast' ORDER BY value DESC");
        while($aow = mysqli_fetch_array($aes)){   
          $oldval=$newval;
          $cid=$aow['cid'];
          $country=$aow['country'];
          $value=$aow['value'];

          if($value!=''){
            $newval=$value;
            $cou++;
            if($newval!=$oldval){
              if($value<10){
                echo "<section class='s".$cid."'><div class='b".$cid." bolnum'>".$cou.".</div> <div class='context'>".$country."</div> <div class='secnum'>".round($value,2)."</div></section>";
              } else{
                echo "<section class='s".$cid."'><div class='b".$cid." bolnum'>".$cou.".</div> <div class='context'>".$country."</div> <div class='secnum'>".round($value,1)."</div></section>";              
              }
            } else{
              if($value<10){
                echo "<section class='s".$cid."'><div class='b".$cid." bolnum' style='visibility:hidden'>".$cou.".</div> <div class='context'>".$country."</div> <div class='secnum'>".round($value,2)."</div></section>";
              } else{
                echo "<section class='s".$cid."'><div class='b".$cid." bolnum' style='visibility:hidden'>".$cou.".</div> <div class='context'>".$country."</div> <div class='secnum'>".round($value,1)."</div></section>"; 
              }
            }
          }
        }
    echo "</div>";
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

<script src='cjs/dwglobal.js'></script>

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


.ui-slider-range,
.ui-slider .ui-slider-handle{background:#2099bc;border:1px solid #2099bc;}

.ui-slider-range{}

.bee{height:44px;}
</style>

<script type='text/javascript'>$( document ).ready(function() {
$('.playwithdata').addClass('on');
$('.sRank').addClass('selected');
$('#rank').show();
window.stopnow=0;



//helper functions, it turned out chrome doesn't support Math.sgn() 
function signum(x) {
    return (x < 0) ? -1 : 1;
}
function absolute(x) {
    return (x < 0) ? -x : x;
}

function drawPath(svg, path, startX, startY, endX, endY) {
    var stroke =  parseFloat(path.css("stroke-width"));
    if (svg.attr("height") <  endY)                 svg.attr("height", endY+2000);
    if (svg.attr("width" ) < (startX + stroke) )    svg.attr("width", (startX + stroke));
    if (svg.attr("width" ) < (endX   + stroke) )    svg.attr("width", (endX   + stroke));
    
    var deltaX = (endX - startX) * 0.15;
    var deltaY = (endY - startY) * 0.15;
    var delta  =  deltaY < absolute(deltaX) ? deltaY : absolute(deltaX);
    var arc1 = 0; var arc2 = 1;
    if (startX > endX) {
        arc1 = 1;
        arc2 = 0;
    }
    
    path.attr("d",  "M"  + startX + " " + startY +
              "L" + endX + " " + endY);
}

function connectElements(svg, path, startElem, endElem) {
    var svgContainer= $("#svgContainer");   
    var svgTop  = svgContainer.offset().top;
    var svgLeft = svgContainer.offset().left;
    var startCoord = startElem.offset();
    var endCoord   = endElem.offset();
    var startX = startCoord.left + startElem.outerWidth() - svgLeft;
    var startY = startCoord.top  + startElem.outerHeight()/2 - svgTop;
    var endX = endCoord.left - svgLeft;
    var endY = endCoord.top  + startElem.outerHeight()/2 - svgTop;
    drawPath(svg, path, startX, startY, endX, endY);
}

function resetSVGsize(){
  $("#svg").attr("height", "0");
  $("#svg").attr("width", "0"); 
}


<?php
  include 'inc/con.php'; 
  include 'inc/conint.php'; 
  $dset="z".$_GET[p];

  if($_GET[yf]>$_GET[yl]){
    $yearlast=$_GET[yf];
    $yearfirst=$_GET[yl];
  } else{
    $yearfirst=$_GET[yf];
    $yearlast=$_GET[yl];  
  }

  
  $aes = mysqli_query($con,"SELECT firstyear,lastyear,title,subtitle FROM datasets WHERE id=$_GET[p]");
  while($aow = mysqli_fetch_array($aes)){   
    $fy=$aow['firstyear'];
    $ly=$aow['lastyear'];
    $title=$aow['title'];
    $subtitle=$aow['subtitle'];
  }

  for($x=$fy;$x<=$ly;$x++){
    echo "window.timer".$x."=1;";
  }
  
  echo "window.pee=".$_GET[p].";"; 
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
          for($x=$fy;$x<=$ly;$x++){
            echo "$('.playfa').removeClass('playa".$x."');";
          }
          //echo "var plp='playfa'+val1;";
          echo "$('.playfa').addClass('playa'+val1+'');";
          
          echo "var sub=window.location.href;";
          echo "sub = sub.substring(0, sub.indexOf('&yf='));";
          echo "sub = sub+'&yf='+val1+'&yl='+val2;";

          echo "window.history.pushState('update','title',sub);";
     
          echo "$.ajax({";
            echo "url:'inc/getRank.php',";
            echo "crossDomain:true,";
            echo "dataType:'JSONP',";
            echo "data:{val1:val1,val2:val2,p:p},";
            echo "success:function(data){";
              echo "$('.outershell').html(data[0]);";
                for($x=0;$x<=9;$x++){
                  $ctemp='c'.$x;
                  if($_GET[$ctemp]>0){
                    echo "$('#path".$_GET[$ctemp]."').css('stroke','#ff6c00');";
                    echo "$('.s".$_GET[$ctemp]."').css('color','#ff6c00');";
                    echo "$('.s".$_GET[$ctemp]."').addClass('nt');";  
                  }
                }             
              echo "for(var x=0;x<=data[2];x++){";
                echo "var temp=data[1][x];";
                echo "connectElements($('#svg'),$('#path'+temp+''),$('.a'+temp+''),$('.b'+temp+''));";
              echo "}";
              $cou=0;

            echo "}";
          echo "});";     
      echo "}";
    echo "});";
  echo "} );";


echo "function connectAll() {";

$cou=0;
$aes = mysqli_query($conint,"SELECT * FROM $dset WHERE year='$yearfirst' ORDER BY value DESC");
while($aow = mysqli_fetch_array($aes)){   
  $oldval=$newval;
  $country=$aow['country'];
  $value=$aow['value'];
  $cid=$aow['cid'];

  $vount=0;
  $res = mysqli_query($conint,"SELECT * FROM $dset WHERE year='$yearlast' AND country='$country'");
  while($row = mysqli_fetch_array($res)){   
    $vount++;
  }

  if($value!=''&&$vount==1){
    $newval=$value;
    echo "connectElements($('#svg'),$('#path".$cid."'),$('.a".$cid."'),$('.b".$cid."'));";  
  } 
}

echo "}";

for($x=0;$x<=9;$x++){
  $ctemp='c'.$x;
  if($_GET[$ctemp]>0){
    echo "$('#path".$_GET[$ctemp]."').css('stroke','#ff6c00');";
    echo "$('.s".$_GET[$ctemp]."').css('color','#ff6c00');";
    echo "$('.s".$_GET[$ctemp]."').addClass('nt');";  
  }
}

echo "var time=0;";
echo "var start=0;";

include 'inc/con.php';   
$aes = mysqli_query($con,"SELECT firstyear,lastyear FROM datasets WHERE id=$_GET[p]");
while($aow = mysqli_fetch_array($aes)){   
  $fy=$aow['firstyear'];
  $ffy=$fy;
  $ly=$aow['lastyear'];
}


for($yarn=$fy;$yarn<$ly;$yarn++){//MIGHT NEED TO MAKE THIS LESS THAN OR EQUAL TO... TEST OUT
  echo "$(document).on('click', '.playa".$yarn."', function(){";
  echo "stopnow=0;";
  echo "$('.playfa').css('display','none');";
  echo "$('.stopfa').css('display','block');";
  echo "var tempfy=fy;";

  $tempval=0;

  $increment = 15000/($ly-$fy);

  $fys=$yarn;
  $ffys=$fys;

  while($fys<=$ly){
    echo "window.timer".$fys." = setTimeout(function(){";  
      echo "if(stopnow==0){";

        echo "var val1=".$ffys.";";
        echo "var val2=".$fys.";";
        echo "var sub=window.location.href;";
        echo "sub = sub.substring(0, sub.indexOf('&yf='));";
        echo "sub = sub+'&yf='+val1+'&yl='+val2;";
        echo "window.history.pushState('update','title',sub);";
        echo "var p=".$_GET['p'].";";
        echo "$('#custom-handle').text(val1);";
        echo "$('#custom-handle2').text(val2);";
        echo "$('#slider').slider('values',0,val1);";
        echo "$('#slider').slider('values',1,val2);";
        
          echo "$.ajax({";
            echo "url:'inc/getRank.php',";
            echo "crossDomain:true,";
            echo "dataType:'JSONP',";
            echo "data:{val1:val1,val2:val2,p:p},";
            echo "success:function(data){";
              echo "$('.outershell').html(data[0]);";
                for($x=0;$x<=9;$x++){
                  $ctemp='c'.$x;
                  if($_GET[$ctemp]>0){
                    echo "$('#path".$_GET[$ctemp]."').css('stroke','#ff6c00');";
                    echo "$('.s".$_GET[$ctemp]."').css('color','#ff6c00');";
                    echo "$('.s".$_GET[$ctemp]."').addClass('nt');";  
                  }
                }             
              echo "for(var x=0;x<=data[2];x++){";
                echo "var temp=data[1][x];";
                echo "connectElements($('#svg'),$('#path'+temp+''),$('.a'+temp+''),$('.b'+temp+''));";
              echo "}";

            echo "}";
          echo "});";
        echo "tempfy++;";
        if($fys==$ly){
          echo "$('.playfa').css('display','block');";
          echo "$('.stopfa').css('display','none');";
        }
      echo "}";
    echo "}, ".$tempval.");";

    $tempval=$tempval+$increment;
    $fys++;
  }

  echo "});";
}


echo "$(document).on('click', '.stopfa', function(){";
  echo "stopnow=1;";
  while($fy<=$ly){
    echo "clearTimeout(timer".$fy.");";
    $fy++;
  }

  echo "$('.playfa').css('display','block');";
  echo "$('.stopfa').css('display','none');";
echo "});";

mysqli_close($con);
mysqli_close($conint);
?>




















var i = -15;
function quick_demo(){
  i += 0.2;
  var outerW  = parseInt($(".placeholderimg").css('width'));
  $(".placeholderimg").css({'width': outerW+i});
  resetSVGsize();
  connectAll();
 
  if (i<14.7) requestAnimationFrame(quick_demo);
  else        $(".placeholderimg").css({'width': ''});
}

$(document).ready(function() {
    // reset svg each time 
    resetSVGsize();
    connectAll();
    // resize simulation demo, comment it out to make it stop
    quick_demo();
 
});

$(window).resize(function () {
    // reset svg each time 
    resetSVGsize();
    connectAll();
});


$(document).on('mouseenter', '.ff section', function(){    
  window.classer = $(this).attr('class');
  if(classer!='nt'){  
    $('.'+classer+'').css('color','#ff6c00');
    classer = classer.replace('s','path');
    $('#'+classer+'').css('stroke','#ff6c00');
  }
});
$(document).on('mouseleave', '.ff section', function(){    
  window.classer = $(this).attr('class');
  if(classer!='nt'){
    $('.'+classer+'').css('color','#333');
    classer = classer.replace('s','path');
    $('#'+classer+'').css('stroke','#cdcdcd');
  }
});


});</script>
<script src='cjs/srcbtm.js'></script>
</body>
</html>

