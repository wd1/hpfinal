<?php
	$initial = $_GET['z'];
    $init = "z".$initial;
    $filenombre = $initial."regionave";
	header('Content-Type: text/csv; charset=utf-8'); // output headers so that the file is downloaded rather than displayed
	header('Content-Disposition: attachment; filename='.$filenombre.'.csv');
	$output = fopen('php://output', 'w'); // create a file pointer connected to the output stream
	mysql_connect('localhost', 'root', 'deadbeef88'); // fetch the data
	mysql_select_db('regionave');
	$rows = mysql_query("SELECT rname,year,value FROM ".$init." order by rname,year");
	while ($row = mysql_fetch_assoc($rows)) fputcsv($output, $row);// loop over the rows, outputting them

?>