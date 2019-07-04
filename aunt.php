<?php
include 'inc/conint.php';

$three='NULL';
$besult = mysqli_query($conint,"UPDATE z31 set value=$three WHERE country='Burkina Faso' AND year=1960");

mysqli_close($conint);
?>