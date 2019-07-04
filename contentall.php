<?php include 'inc/INChead.php';$randal=rand(1,999);
  echo "<link rel='stylesheet' type='text/css' href='css/1.css?version=".$randal."'>";
  echo "<link rel='stylesheet' type='text/css' href='css/indexNav.css?version=".$randal."'>";
  echo "<link rel='stylesheet' type='text/css' href='css/content.css?version=".$randal."'>";
?>

<div class='rap'>
  <div class='drawer'>
    
    <div class='soody-link'>
    <?php
    include 'inc/con.php';
    $aes = mysqli_query($con,"SELECT * FROM cats ORDER BY cat ASC");
    while($aow = mysqli_fetch_array($aes)){ 
      echo "<a href='content?cid=".$aow['id']."' class='dl a".$aow['id']."' data-id='".$aow['id']."'>".$aow['cat']."</a>";
    }
    mysqli_close($con);
    ?>
    </div>
  </div>

<!--ADD MAILCHIMP AT START SO YOU GET SAME BEHAVIOR FOR ALL TILES-->
<li style='display:none' class='newsletter' style='background:#2199bc;cursor:auto'><img class='draft' style='visibility:hidden' src='img/draft.png'/><div class='title-sblock'>newsletter</div><div class='lip-sblock'><div class='lip-stit'>Sign up to our email newsletter to have the best of optimistic news delivered direct to your inbox.</div>
<!-- Begin MailChimp Signup Form --><div id='mc_embed_signup'><form action='//intridea.us7.list-manage.com/subscribe/post?u=060e9ce478d4bf4b205da26b9&amp;id=8bc45b6260' method='post' id='mc-embedded-subscribe-form' name='mc-embedded-subscribe-form' class='validate' target='_blank' novalidate><div id='mc_embed_signup_scroll'>
<div class='mc-field-group'>
	<input type='email' placeholder='Your email' value='' name='EMAIL' class='required email' id='mce-EMAIL'>
	<input type='submit' value='Subscribe' name='subscribe' id='mc-embedded-subscribe' class='button subbb'>
</div>
	<div id='mce-responses' class='clear'>
		<div class='response' id='mce-error-response' style='display:none'></div>
		<div class='response' id='mce-success-response' style='display:none'></div>
	</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
    <div style='position: absolute; left: -5000px;' aria-hidden='true'><input type='text' name='b_060e9ce478d4bf4b205da26b9_8bc45b6260' tabindex='-1' value=''></div>
    
    </div>
</form>
</div>
<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';}(jQuery));</script>
<!--End mc_embed_signup--></div></li>
<!--DONE WITH MAILCHIMP AT START-->


<?php
include 'inc/con.php';

echo "<div class='filta-wrap'><span class='filta'><i class='fa fa-filter'></i> Filter</span></div>";
echo "<h1 class='hone' ><a href='#'>All Content</a></h1>";

mysqli_close($con);

include 'inc/conCouch.php';
//Check the number of article pages that are published
$pageCount;
$aes = mysqli_query($con,"SELECT id FROM couch_pages WHERE template_id=11 AND publish_date <> '0000-00-00 00:00:00' ORDER BY publish_date DESC");
while($aow = mysqli_fetch_array($aes)){ 
  $pageCount++;
}

//Number of runs to go through sets of 6 minus the first set of 6
$runs = floor($pageCount/6)-1;
//If number of order 6 or 7 blocks is less than value of runs use that.  Otherwise, you'll get into issues of repeating 6 tiles at the bottom of the page.  
//NOTE: YOUR ALGORITHM FOR NOT REPEATING 6 BLOCKS IS IN PLACE BUT IT SHOULDN'T BE HIT BECAUSE OF YOUR SIXORSEVEN CHECK

include 'indexAll.php';
include 'indexAll.php';//First Twelve

echo "<input class='conte' type='hidden' value='".$count."'>";
echo "<input class='runs' type='hidden' value='".$runs."'>";

/*for($z=0;$z<$runs;$z++){
	if($z % 2 == 0){
		include 'indexB.php';//Odd
	} else{
		include 'indexC.php';//Even
	}
}*/
mysqli_close($con);
?>
</div>

<div class='youtube-back'>
    <iframe id="video" width="800" height="600" frameborder="0" allowfullscreen></iframe>
	<i class='fa fa-times-circle youtubeFa'></i>
</div>


<script type='text/javascript'>
$('.filta').click(function(){
  if($('.drawer').hasClass('slideInLeft')) {
    $('.drawer').removeClass('slideInLeft');
    $('.drawer').addClass('animated slideOutLeft');
    $('.browsetopics').removeClass('on');
    //$('.filta i').removeClass('fa-times').addClass('fa-filter');
    $('.filta').html('Filter <i class="fa fa-filter"></i>');
  }else{
    $('.drawer').show();
    $('.drawer').removeClass('animated slideOutLeft');
    $('.drawer').addClass('animated slideInLeft');
    $('.browsetopics').addClass('on'); 
    //$('.filta i').removeClass('fa-filter').addClass('fa-times');
    $('.filta').html('Close <i class="fa fa-times"></i>');
  }
});

$('.browsetopics').attr('href','#');
$('.browsetopics').addClass('on');
$('.right-browse').addClass('on');

window.conte=$('.conte').val();
window.runs=$('.runs').val();
window.section=1;

/*$(document).on('click', '.hone', function(){
    var tempo = $(this).attr('data-cid');
    var texto = $(this).text();
    $('.moody').css('display','flex');
    texto = texto.substring(0,texto.indexOf("/"));
    $.ajax({
        url:'inc/showBreadcrumb.php',
        crossDomain:true,
        dataType:'JSONP',
        data:{tempo:tempo,texto:texto},
        success:function(data){
          $('.moody-int').html(data[0]);  
        }
      }); 
});*/
</script>
<?php $randal=rand(1,999);echo "<script type='text/javascript' src='cjs/srcbtm.js?version=".$randal."'>'></script>";?>

</body>
</html>


