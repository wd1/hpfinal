<?php include 'inc/INChead.php';$randal=rand(1,999);
    echo "<link rel='stylesheet' type='text/css' href='css/indexNav.css?version=".$randal."'>";
    echo "<link rel='stylesheet' type='text/css' href='css/iframe.css?version=".$randal."'>";
?>

<iframe src="http://<?php echo $_GET['url']?>" style="top:<?php echo $_GET['o']?>px"></iframe>
<?php $randal=rand(1,999);echo "<script type='text/javascript' src='cjs/srcbtm.js?version=".$randal."'>'></script>";?>
</body>
<script type='text/javascript'>
    window.section=0;runs=0;
</script>
</html>
<?php COUCH::invoke(); ?>


