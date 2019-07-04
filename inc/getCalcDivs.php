<?php

$data = file_get_contents($_POST['locker']);
$fir="<div class='holder' id='holder'>";
$sec="<!--END RANK VISUALIZATION-->";

function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

$data = get_string_between($data,$fir,$sec);
//$data=$fir.$data."</div>";
echo $data;
?>