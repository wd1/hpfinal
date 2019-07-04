<?php
	header('Content-Type: text/csv; charset=utf-8'); // output headers so that the file is downloaded rather than displayed
	header('Content-Disposition: attachment; filename=metadata.csv');
	$output = fopen('php://output', 'w'); // create a file pointer connected to the output stream
	fputcsv($output, array('id','oldid','title','subtitle','type','pinker','sourcedescr','sourceurlone','sourceurltwo','definition','seodescr','updatedate')); // output the column headings MINUS catsubcat
	mysql_connect('localhost', 'root', 'deadbeef88'); // fetch the data
	mysql_select_db('custom');
	$rows = mysql_query("SELECT id,oldid,title,subtitle,type,pinker,sourcedescr,sourceurlone,sourceurltwo,definition,seodescr,updatedate FROM datasets"); //select everything MINUS catsubcat
	while ($row = mysql_fetch_assoc($rows)) fputcsv($output, $row);// loop over the rows, outputting them
?>