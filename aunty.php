
<?php 
  include 'inc/INChead.php';
  include 'inc/DWtop.php';
  include 'inc/mailchimp.php';
  include 'inc/DWtopec.php';
  echo "<div class='rap1200'>";   
  include 'inc/DWmeatTop.php';
?>
<!--START LINE VISUALIZATION-->
<div id='chart_div'></div>
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

<?php if($_GET[r0]>0||$_GET[r1]>0||$_GET[r2]>0||$_GET[r3]>0||$_GET[r4]>0||$_GET[r5]>0||$_GET[r6]>0||$_GET[r7]>0||$_GET[r8]>0||$_GET[r9]>0 ){
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

<script type='text/javascript' src='js/gstatic.js'></script>

<script type="text/javascript">
      google.charts.load('current', {'packages':['line', 'corechart']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var chartDiv = document.getElementById('chart_div');

  	var data = google.visualization.arrayToDataTable([
    	['Year', 'France, Temperature', 'France, Daylight'],
        ['2014',  -.5,  5.7],
        ['2015',   .4,  8.7],
        ['2016',   .5,   12],
        ['2017',  2.9, 15.3],
  	]);

	var classicOptions = {
		title: 'Average Temperatures and Daylight in Iceland Throughout the Year',
		height: 600,
		// Gives each series an axis that matches the vAxes number below.
		series: {
	  		0: {targetAxisIndex: 0},
	  		1: {targetAxisIndex: 1,lineDashStyle:[5,1,3]},
		},
		vAxes: {
	  		// Adds titles to each axis.
	  		0: {title: 'Temps (Celsius)'},
	  		1: {title: 'Daylight'}
		},
		vAxis: {
	  		viewWindow: {
	    	//max: 30
	  		}
		}
	};


      function drawClassicChart() {
        var classicChart = new google.visualization.LineChart(chartDiv);
        classicChart.draw(data, classicOptions);
      }

      drawClassicChart();

    }   
</script>