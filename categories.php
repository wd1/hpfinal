<?php require_once( 'admin/cms.php' ); ?>
<cms:template title='Categories' order='5'/>
<?php include 'inc/INChead.php';$randal=rand(1,999);
    echo "<link rel='stylesheet' type='text/css' href='css/cat.css?version=".$randal."'>";
    include 'inc/con.php';
    echo "<div class='moddy'><i class='fa fa-close'></i><input class='catin'><input class='subin'></div>";
    $aes = mysqli_query($con,"SELECT * FROM cats ORDER BY cat ASC");
    echo "<section class='seccion cat'>";
    echo "<input type='text' class='add ac'>";
    echo "<span class='but add-cat'>Add Category</span>";  
    echo "<span class='tit'>Categories</span>";  
    while($aow = mysqli_fetch_array($aes)){ 
        echo "<div class='cat-div cat-div".$aow['id']."' data-id='".$aow['id']."'>".$aow['cat']."</div>";
    } 
    echo "</section>";

    $bes = mysqli_query($con,"SELECT * FROM cats ORDER BY cat ASC");
    echo "<div class='all-cats'>";  
    echo "<i class='fa fa-close'></i>";
    while($bow = mysqli_fetch_array($bes)){ 
        echo "<div data-id='".$bow['id']."'>".$bow['cat']."</div>";
    } 
    echo "</div>";



    echo "<section class='seccion sub'></section>";
    mysqli_close($con);
?>
<script src='cjs/cat.js'></script></body></html><?php COUCH::invoke(); ?>