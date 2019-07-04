<?php
include 'con.php';

$txtsec='';

$result = mysqli_query($con,"SELECT * FROM datasets ORDER BY title ASC ");
while($row = mysqli_fetch_array($result))
{
    /*$count=0;
    $temptable="z".$row['id'];
    $aesult = mysqli_query($con,"SELECT * FROM $temptable ORDER BY year ASC ");
    while($aow = mysqli_fetch_array($aesult))
    {
        if($count==0){$firstyear=$aow['year'];$count++;}
        $lastyear=$aow['year'];
    }*/


    $txtsec=$txtsec."<a href='dws?p=".$row['id']."'' data-id=".$row['id'].">".$row['title'].", ".$row['subtitle']."</a>";
    //if($count>0){
    //    $txtsec=$txtsec."<a data-id=".$row['id'].">".$row['title'].", ".$row['subtitle'].", ".$firstyear."-".$lastyear."</a>";
    //}
}

$data = array($txtsec);
echo $_GET['callback'] . '('.json_encode($data).')';
mysqli_close($con);  
?>      