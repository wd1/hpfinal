<?php


$var = " 1973 . 32 32 13 ";
$var = trim($var);
$var = preg_replace("/[^0-9.]/", "", $var);
echo $var;

?>