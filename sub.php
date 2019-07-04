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
      if($_GET[cid]==$aow[id]){//IF IT IS THIS TOPIC ON THE LIST OF TOPICS ON THE LEFT TURN IT ORANGE AND OPEN IT
        $count=0;
        $bes = mysqli_query($con,"SELECT * FROM subcats WHERE catid=$_GET[cid] ORDER BY subcat ASC");
        while($bow = mysqli_fetch_array($bes)){ 
          $count++;
          $id=$bow['id'];
        } 

        echo "<a href='content?cid=".$aow['id']."' style='color:#ff6c00' class='dl a".$aow['id']."' data-id='".$aow['id']."'>".$aow['cat']."</a>";  
        $ces = mysqli_query($con,"SELECT * FROM subcats WHERE catid=$_GET[cid] ORDER BY subcat ASC");
        while($cow = mysqli_fetch_array($ces)){ 
          if($aow['cat']==$cow['subcat']){
            $donothing=1;
          } else if($cow['id']==$_GET[sid]){
            echo "<a href='sub?sid=".$cow['id']."&cid=".$cow['catid']."' class='dl soody-sub soody-on a".$cow['id']."' data-id='".$cow['id']."'>".$cow['subcat']."</a>";  
          } else{
            echo "<a href='sub?sid=".$cow['id']."&cid=".$cow['catid']."' class='dl soody-sub a".$cow['id']."' data-id='".$cow['id']."'>".$cow['subcat']."</a>";
          }
        }
      
      } else{
        echo "<a href='content?cid=".$aow['id']."' class='dl a".$aow['id']."' data-id='".$aow['id']."'>".$aow['cat']."</a>";      
      }
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

if($_GET[sid]==0){
	$aes = mysqli_query($con,"SELECT * FROM cats WHERE id='$_GET[cid]' ");
	while($aow = mysqli_fetch_array($aes)){ 
		echo "<div class='filta-wrap'><span class='filta'><i class='fa fa-filter'></i> Filter</span></div>";     
    //echo "<h1 data-cid='".$aow['id']."' class='hone'>".$aow['cat']."<span class='filta'><i class='fa fa-filter'></i> Filter</span></h1>";
		echo "<style>.tiptop{margin-top:25px;}</style>";
	} 
} else{
	$aes = mysqli_query($con,"SELECT * FROM subcats INNER JOIN cats ON cats.id=subcats.catid WHERE cats.id='$_GET[cid]' AND subcats.id='$_GET[sid]'");
	while($aow = mysqli_fetch_array($aes)){ 
		echo "<div class='filta-wrap'><span class='filta'><i class='fa fa-filter'></i> Filter</span></div>";
    //echo "<h1 data-cid='".$_GET[cid]."' data-sid='".$_GET[sid]."' class='hone'><a href='content?cid=".$_GET[cid]."'>".$aow['cat']."<a> <span>/</span> ".$aow['subcat']."</h1>";
		echo "<style>.tiptop{margin-top:25px;}</style>";
	}		
}

mysqli_close($con);

include 'inc/conCouch.php';
$conner=mysqli_connect('localhost','root','deadbeef88','custom');

$lord=$_GET[sid];

$pageCount;
$aes = mysqli_query($con,"SELECT id FROM couch_pages WHERE template_id=11 AND publish_date <> '0000-00-00 00:00:00' ORDER BY publish_date DESC");
while($aow = mysqli_fetch_array($aes)){ 
  $id=$aow['id'];
  $bes = mysqli_query($con,"SELECT * FROM couch_data_text WHERE page_id=$id AND field_id=173");
  while($bow = mysqli_fetch_array($bes)){ 
    $tempo = $bow['value'];
    $arr = explode("|", $tempo);
    $rount = count($arr);
    $temp=0;
    for($x=0;$x<$rount;$x++){  
      $test = $arr[$x];
      
      $ces = mysqli_query($conner,"SELECT id FROM subcats WHERE id=$lord");
      while($cow = mysqli_fetch_array($ces)){ 
        if($test==$cow['id']&&$temp==0){
          $pageCount++;
          $temp++;
        }
      }
    }
  } 
}

$runs = ceil($pageCount/6);

$count=0;
$lord=$_GET[sid];
if($runs>1){
  include 'indexSub.php';
  include 'indexSub.php'; 
} else{
  include 'indexSub.php';
}
echo "<input class='sid' type='hidden' value='".$_GET[sid]."'>";
echo "<input class='conte' type='hidden' value='".$count."'>";
echo "<input class='vr' type='hidden' value='".$vr."'>";
echo "<input class='runs' type='hidden' value='".$runs."'>";

mysqli_close($con);
?>
</div>
<div class='moody'>
  <div class='moody-int'>
    <i class='fa fa-times-circle topicFa'></i>
  
    <div class='moody-link'>

    </div>
  </div>
</div>

<div class='youtube-back'>
    <iframe id="video" width="800" height="600" frameborder="0" allowfullscreen></iframe>
  <i class='fa fa-times-circle youtubeFa'></i>
</div>

<script type='text/javascript'>$( document ).ready(function() {
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


$('.right-browse').addClass('on');
$('.browsetopics').addClass('on');
window.conte=$('.conte').val();
window.sixconte=$('.sixconte').val();
window.runs=$('.runs').val();
window.sid=$('.sid').val();
window.vr=$('.vr').val();
window.section=1;


$(document).on('click', '.topicFa', function(){
    $('.moody').css('display','none');
});

});</script>
<?php $randal=rand(1,999);echo "<script type='text/javascript' src='cjs/srcbtm.js?version=".$randal."'>'></script>";?>

</body>
</html>


