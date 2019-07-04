<?php require_once( 'admin/cms.php' ); ?>
<cms:template title='Regions' order='9'>
</cms:template>
<?php include 'inc/INChead.php';$randal=rand(1,999);
    echo "<link rel='stylesheet' type='text/css' href='css/regions.css?version=".$randal."'>";
?>

<div class='add-region'>Add Region</div>
<div class='region-list'>
    <?php 
      include 'inc/con.php'; 
      $aes = mysqli_query($con,"SELECT * FROM regions ORDER BY region ASC");
      while($aow = mysqli_fetch_array($aes)){ 
	      $count=0;
	      $rid = $aow['rid'];
	      $region = $aow['region']; 
	      echo "<ul class='outer'>";
	      	echo "<ul class='inner'>";  
			$bes = mysqli_query($con,"SELECT * FROM zaliases INNER JOIN countries ON zaliases.cid = countries.id WHERE rid=$rid");
			while($bow = mysqli_fetch_array($bes)){ 
			  $count++;
			  $zid = $bow['zid'];
			  $name = $bow['name']; 
			  echo "<li data-zid=".$zid.">".$name."<i data-zid=".$zid." class='fa fa-minus'></i></li>"; 
			}
	      	echo "</ul>";
	      	echo "<li class='outerli' data-rid='".$rid."'>".$region." (".$count.")</li><i data-rid=".$rid." class='fa fa-plus'></i><i data-region='".$region."' data-rid=".$rid." class='fa fa-pencil'></i>"; 
      	  echo "</ul>";
      }

      mysqli_close($con);
    ?>
</div>

<div class='editer'>
	<input type='text'><span class='saver'>Save</span>
	<i class='fa fa-times-circle'></i>
</div>

<div class='adder'>
	<input type='text'><span class='addsave'>Add</span>
	<i class='fa fa-times-circle'></i>
</div>

<div class='shower'>
  <i class='fa fa-times-circle'></i>
  <ul><h1>Choose Country:</h1>
  <?php
  include 'inc/con.php';
  $bes = mysqli_query($con,"SELECT id,name FROM countries ORDER BY name asc");
  while($bow = mysqli_fetch_array($bes)){ 
      $id=$bow['id'];
      $name=$bow['name'];     
      echo "<li data-id=".$id.">".$name."</li>";
  }   
  mysqli_close($con);
  ?>
  </ul>
</div>

<div class='tower'>
  <input type='text'><span class='add'>Add</span>
  <i class='fa fa-times-circle'></i>
</div>

<div class='power'>
  <input type='text'><span class='edit'>Edit</span>
  <i class='fa fa-times-circle'></i>
</div>

<a class='datasets' href='datasets'>Datasets</a>
<a class='countries' href='countries'>Countries</a>
<div class='blocker'></div>

<script src='cjs/regions.js'></script>
</body>
</html><?php COUCH::invoke(); ?>

