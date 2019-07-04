<?php      

	include 'inc/con.php';
	include 'inc/concooked.php';
    $cte=mysql_real_escape_string("Cote dtest");
    $besult = mysqli_query($concooked,"UPDATE z477 set country='$cte' WHERE country='Cte dIvoire'");  

?>