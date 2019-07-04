<?php
	$initial = $_GET['z'];
    $init = "z".$initial;
	header('Content-Type: text/csv; charset=utf-8'); // output headers so that the file is downloaded rather than displayed
	header('Content-Disposition: attachment; filename='.$initial.'normalized.csv');
	$output = fopen('php://output', 'w'); // create a file pointer connected to the output stream
	mysql_connect('localhost', 'root', 'deadbeef88'); // fetch the data
	mysql_select_db('custom');
	$rows = mysql_query("SELECT country,year,value FROM ".$init." ORDER BY country,year");
	while ($row = mysql_fetch_assoc($rows)) fputcsv($output, $row);// loop over the rows, outputting them

?>