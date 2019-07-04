<?php require_once( 'admin/cms.php' ); ?>
<cms:template title='Countries' order='8'>
</cms:template>
<?php include 'inc/INChead.php';$randal=rand(1,999);
    echo "<link rel='stylesheet' type='text/css' href='css/countries.css?version=".$randal."'>";
?>

<div class='country-list'>
    <?php 
      include 'inc/con.php'; 
      $aes = mysqli_query($con,"SELECT * FROM countries ORDER BY name ASC");
      while($aow = mysqli_fetch_array($aes)){ 
	      $count=0;
	      $id = $aow['id'];
	      $name = $aow['name']; 
	      echo "<ul class='outer'>";
	      	echo "<ul class='inner'>";  
			$bes = mysqli_query($con,"SELECT * FROM aliases WHERE cid=$id ORDER BY nombre ASC");
			while($bow = mysqli_fetch_array($bes)){ 
			  $count++;
			  $aid = $bow['aid'];
			  $nombre = $bow['nombre']; 
			  echo "<li data-aid=".$aid.">".$nombre."<i data-aid=".$aid." class='fa fa-pencil'></i></li>"; 
			}
	      	echo "</ul>";
	      	echo "<li class='outerli' data-id='".$id."'>".$name." (".$count.")</li><i data-id=".$id." class='fa fa-plus'></i>"; 
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

<a class='datasets' href='datasets'>Datasets</a>
<a class='regions' href='regions'>Regions</a>

<script src='cjs/countries.js'></script>
</body>
</html><?php COUCH::invoke(); ?>

