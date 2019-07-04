<?php include 'inc/INChead.php';$randal=rand(1,999);
    echo "<link rel='stylesheet' type='text/css' href='css/1.css?version=".$randal."'>";
    echo "<link rel='stylesheet' type='text/css' href='css/indexNav.css?version=".$randal."'>";
?>
<style type="text/css">
	.title-block{box-shadow:none!important;}
</style>
<div class='rap'>

<input type='text' class='testin' placeholder='Enter title here' style='margin-top:20px;width:300px'>
<div class='testcount'></div>
<?php
include 'inc/conCouch.php';
//Check the number of article pages that are published
$pageCount;
$aes = mysqli_query($con,"SELECT id FROM couch_pages WHERE template_id=11 AND publish_date <> '0000-00-00 00:00:00' ORDER BY publish_date DESC");
while($aow = mysqli_fetch_array($aes)){ 
	$pageCount++;
}
//Check the number of tiles that have order 6 or 7 that are published
$aes = mysqli_query($con,"SELECT couch_data_text.value FROM couch_data_text INNER JOIN couch_pages ON couch_data_text.page_id=couch_pages.id WHERE couch_data_text.field_id=174 AND couch_pages.publish_date <> '0000-00-00 00:00:00' ");
while($aow = mysqli_fetch_array($aes)){ 
  if($aow['value']=='6' || $aow['value']=='7')
  $sixorseven++;
}
//Number of runs to go through sets of 6 minus the first set of 6
$runs = floor($pageCount/6)-1;
//If number of order 6 or 7 blocks is less than value of runs use that.  Otherwise, you'll get into issues of repeating 6 tiles at the bottom of the page.  
//NOTE: YOUR ALGORITHM FOR NOT REPEATING 6 BLOCKS IS IN PLACE BUT IT SHOULDN'T BE HIT BECAUSE OF YOUR SIXORSEVEN CHECK
if($sixorseven<$runs){
  $runs=$sixorseven;
}

include 'indexA.php';//First Six

/*for($z=0;$z<$runs;$z++){
	if($z % 2 == 0){
		include 'indexB.php';//Odd
	} else{
		include 'indexC.php';//Even
	}
}*/
mysqli_close($con);
?>
<br><br><br>
</div>
<!--<div id='play-button' style='position:fixed;z-index:100000000000;display:none'></div><div id='pause-button' style='position:fixed;z-index:100000000000;display:none'></div>-->
<div class='youtube-back'>
    <i class='fa fa-close'></i>
    <iframe id="video" width="800" height="600" frameborder="0" allowfullscreen></iframe>
</div>

<script type='text/javascript'>
$('.right-index').addClass('on');
$('header').hide();
$('.testin').on("change keyup paste", function(){
    var x = $('.testin').val();
    var y = $('.testin').val().length;
    $('.lip-txt').text(x);
    $('.testcount').text(y);
    /*var y = 57-x;
    $('.newtest').text('('+x+'/57, '+y+' characters left)');
    
    if(x>57){
        $('.newtest').css('color','red');
    } else{
        $('.newtest').css('color','#333');
    }*/
});

</script>
<?php $randal=rand(1,999);echo "<script type='text/javascript' src='cjs/srcbtm.js?version=".$randal."'>'></script>";?>




</body>
</html>


