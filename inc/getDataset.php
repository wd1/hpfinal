<?php
  include 'con.php';
  $temping = $_GET['temping'];

  $result = mysqli_query($con,"SELECT * FROM datasets WHERE id='$temping'");
  while($row = mysqli_fetch_array($result))
  {
	$data[0] = $row['oldid'];
	$data[1] = $row['title'];
	$data[2] = $row['subtitle'];
	$data[3] = $row['type'];
	$data[4] = $row['pinker'];
	$data[5] = $row['sourcedescr'];
	$data[6] = $row['sourceurlone'];
	$data[7] = $row['sourceurltwo'];
	$data[8] = $row['definition'];
	$data[9] = $row['seodescr']; 
	$data[10] = $row['catsubcat']; 
	$data[11] = $row['updatedate']; 
  }

  echo $_GET['callback'] . '('.json_encode($data).')';
  mysqli_close($con);
?>