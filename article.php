<?php require_once( 'admin/cms.php' ); ?>
<cms:template title='Articles' order='1' clonable='1' paginate='0'/>
<?php include 'inc/INChead.php';$randal=rand(1,999);
    echo "<link rel='stylesheet' type='text/css' href='css/1.css?version=".$randal."'>";
    echo "<link rel='stylesheet' type='text/css' href='css/article.css?version=".$randal."'>";
?>


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

<div class='top-sec'>
    <div class='date-txt'>
<?php
include 'inc/conCouch.php';
$p=$_GET['p']; 

$aes = mysqli_query($con,"SELECT publish_date FROM couch_pages WHERE id='$p'");
while($aow = mysqli_fetch_array($aes)){ 
    $date = $aow['publish_date'];
}
$year = substr($date,0,4);
$mon = substr($date,5,2);
$day = substr($date,8,2);
if($mon=='01'){$month='jan';}
if($mon=='02'){$month='feb';}
if($mon=='03'){$month='mar';}
if($mon=='04'){$month='apr';}
if($mon=='05'){$month='may';}
if($mon=='06'){$month='jun';}
if($mon=='07'){$month='jul';}
if($mon=='08'){$month='aug';}
if($mon=='09'){$month='sep';}
if($mon=='10'){$month='oct';}
if($mon=='11'){$month='nov';}
if($mon=='12'){$month='dec';}
echo $day.' '.$month.' '.$year;
mysqli_close($con);
?>
    </div>

    <div class='subtitle-txt'><cms:editable order='0' type='textarea' name='subtitle' height='40'/></div>
    <div class='sub-hid'><cms:editable order='1' type='dropdown' name='type' height='40' width='500' opt_values='News|Announcement|Video|Visualization|Life in numbers|Exclusive|Support|Quote|'/></div>
    <div class='ord-hid'><cms:editable order='2' type='dropdown' name='homelocation' height='40' width='500' opt_values='0|1|2|3|4|5|6|7'/></div>
    <div class='bg-hid'><cms:editable order='3' type='dropdown' name='background' height='40' width='500' opt_values='image|background'/></div>
    <div class='url-hid'><cms:editable order='4' type='textarea' name='url' height='40' width='500'/></div>
    <div class='oldtitle-hid'><cms:editable order='4' type='textarea' name='oldtitle' height='40' width='500'/></div>
    <div class='offset-hid'><cms:editable order='5' type='textarea' name='offset' height='40' width='500'>60</cms:editable></div>

    <div class='title-txt'>
        <?php include 'inc/conCouch.php';$p=$_GET['p']; 
        $aes = mysqli_query($con,"SELECT page_title FROM couch_pages WHERE id='$p'");
        while($aow = mysqli_fetch_array($aes)){ echo $aow['page_title'];}mysqli_close($con);?>
    </div>
    <div class='auth-sec'>
        <div class='author-txt'>By <strong><cms:editable order='7' type='textarea' name='author' height='40'/></strong></div>
        <div class='bar-txt'>|</div>
        <div class='twitter-txt'><a target='_blank' href="https://www.twitter.com/<cms:show twitterhandle/>"><cms:editable order='6' type='textarea' name='twitterhandle' height='40' width='500'></cms:editable></a></div>
    </div>

    <div class='art-soc'> 
        <i class='fa fa-facebook'></i>  
        <?php
        $temp = $_SERVER['REQUEST_URI'];
        echo "<a target='_blank' href='https://twitter.com/intent/tweet?&url=http://72.32.118.0".$temp."'><i class='fa fa-twitter'></i></a>";
        echo "<a target='_blank' href='http://www.reddit.com/submit?url=http://72.32.118.0".$temp."'><i class='fa fa-reddit rd1'></i></a>";
        echo "<a href='mailto:?subject=Human%20Progress%20Article&amp;body=http://72.32.118.0".$temp."'><i class='fa fa-envelope'></i></a>";
        ?>
    </div>
</div>
<img class='cover' src="<cms:editable order='8' name='coverimg' desc='coverimg' type='image'/>"></img>
<div class='rap1200'>
    <br><br>
    <cms:editable type='richtext' order='9' name='content'/>
    <div class='final'><cms:editable order='10' type='richtext' name='ultimate' height='40'/></div>
    
    <!-- THIS CODE DISPLAYS THE CATEGORIES AND SUBCATEGORIES ON THE PAGE... IF THE CATEGORY AND SUBCATEGORY ARE THE SAME, ONLY THE CATEGORY IS SHOWN-->
    <div class='categories'>
        <span>Topics</span>
        <?php 
            include 'inc/conCouch.php'; 
            $conn=mysqli_connect('localhost','root','','custom');

            $aes = mysqli_query($con,"SELECT * FROM couch_data_text WHERE page_id=$_GET[p] AND field_id=173");
            while($aow = mysqli_fetch_array($aes)){ 
                $temp = $aow['value'];
                $arr = explode("|", $temp);
                $count = count($arr);
                for($x=0;$x<$count;$x++){
                    $test = $arr[$x];

                    
                    $bes = mysqli_query($conn,"SELECT * FROM subcats WHERE id=$test");
                    while($bow = mysqli_fetch_array($bes)){
                        $catid=$bow['catid'];
                        $sid=$bow['id'];
                        $subcatr=$bow['subcat'];
                    } 

                    $bes = mysqli_query($conn,"SELECT * FROM cats WHERE id=$catid");
                    while($bow = mysqli_fetch_array($bes)){
                        $catr=$bow['cat'];
                    } 

                    $arrTest = explode("*", $test);
                    if($x==($count-1)){
                        echo "<a href='sub?cid=".$catid."&sid=".$sid."' class='cat cat1'>".$subcatr."</a>";   
                    } else{
                        echo "<a href='sub?cid=".$catid."&sid=".$sid."' class='cat cat1'>".$subcatr."</a><span class='fs'>/</span>";   
                    }
                    /*if($catr==$subcatr){
                        echo "<div><section class='cat cat1'>".$catr."</section></div>";
                    } else{
                        echo "<div><section class='cat cat1'>".$catr."<i class='fa fa-chevron-right'></i>".$subcatr."</section></div>";
                    }*/
                }
            } 
            mysqli_close($con);
            mysqli_close($con);
        ?>
    </div>

    <div class='art-soc bot-soc'> 
        <i class='fa fa-facebook'></i>
        
        <?php
        $temp = $_SERVER['REQUEST_URI'];
        echo "<a target='_blank' href='https://twitter.com/intent/tweet?&url=http://72.32.118.0".$temp."'><i class='fa fa-twitter'></i></a>";
        echo "<a target='_blank' href='http://www.reddit.com/submit?url=http://72.32.118.0".$temp."'><i class='fa fa-reddit rd1'></i></a>";
        echo "<a href='mailto:?subject=Human%20Progress%20Article&amp;body=http://72.32.118.0".$temp."'><i class='fa fa-envelope'></i></a>";
        ?>
    </div>
</div>

<!-- THIS CODE IS WHAT PULLS IN ALL CATEGORIES AND SUBCATEGORIES FROM THE admin-cms and displays on backend-->
<div class='sub-hid'><cms:editable order='11' type='checkbox' name='subcategory' height='40' width='500' opt_values='<?php 
    include 'inc/con.php'; 

    $aes = mysqli_query($con,"SELECT * FROM cats ORDER BY cat ASC");
    while($aow = mysqli_fetch_array($aes)){ 
        $id = $aow['id'];
        $cat = $aow['cat'];

        $bes = mysqli_query($con,"SELECT * FROM subcats WHERE catid=$id");
        while($bow = mysqli_fetch_array($bes)){             
            $sid = $bow['id'];
            $subcat = $bow['subcat'];
            $subfinal = $subfinal.$sid."|";
            //$subfinal = $subfinal.$cat."*".$subcat." (".$sid.")|";
            //$subfinal = $subfinal.$cat."*".$subcat." | ";
        } 

    }
    echo $subfinal;
    mysqli_close($con);
?>'/></div>

<!-- THIS CODE SETS THE CHECKBOX FOR WHETHER CATEGORY TITLES ARE SHOWN OR NOT -->
<cms:editable order='12' type='checkbox' name='titlehide' height='40' width='500' opt_values='hidetitle'/>
<cms:editable order='13' type='checkbox' name='datehide' height='40' width='500' opt_values='hidedate'/>
<!--<div class='rap1200'>
    <div class='sec seca firstSec'>
        <div class='rc-header'>Related Content</div>
            <div class='row rowa1'>
                <a class='pi pi1 a1'>
                    <h4></h4>
                    <h5></h5>
                    <h6></h6>
                    <div class='bordy'></div>
                    <div class='bordy2'></div>
                </a>
                <a class='pi pi2 a2'>
                    <h4></h4>
                    <h5></h5>
                    <h6></h6>
                    <div class='bordy'></div>
                    <div class='bordy2'></div>
                </a>
                <a class='pi pi3 a3' style='background:#ff6c00!important;'>
                    <h4></h4>
                    <h5></h5>
                    <h3></h3>
                    <h6></h6>
                </a>
            </div>
    </div>
    <div class='sec secb'>
        <div class='row rowb1'>
            <a class='pi pi1 b1'>
                <h4></h4>
                <h5></h5>
                <h6></h6>
                <div class='bordy'></div>
                <div class='bordy2'></div>
            </a>
            <a class='pi pi2 b2'>
                <h4></h4>
                <h5></h5>
                <h6></h6>
                <div class='bordy'></div>
                <div class='bordy2'></div>
            </a>
            <a class='pi pi3 b3'>
                <h4></h4>
                <h5></h5>
                <h3></h3>
                <h6></h6>
            </a>
        </div>
    </div>
</div>-->



<?php if($_GET[p]>0){include 'inc/articlerelated.php';} ?>

<div class='art-foot newsletter'>
        <div class='sign-up-txt'>
            Get optimistic news delivered directly to your inbox.
        </div>
        <div class='input-sec'>
            <!-- Begin MailChimp Signup Form --><div id='mc_embed_signup'><form action='//intridea.us7.list-manage.com/subscribe/post?u=060e9ce478d4bf4b205da26b9&amp;id=8bc45b6260' method='post' id='mc-embedded-subscribe-form' name='mc-embedded-subscribe-form' class='validate' target='_blank' novalidate><div id='mc_embed_signup_scroll'>
            <div class='mc-field-group' style='padding-bottom:50px'>
                <input style='margin-top:2px' type='email' placeholder='Your email' value='' name='EMAIL' class='required email' id='mce-EMAIL'>
                <input style='margin-top:1px' type='submit' value='Subscribe' name='subscribe' id='mc-embedded-subscribe' class='button subbb'>
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
    <!--End mc_embed_signup-->
        </div>
</div>


<script type='text/javascript'><?php echo "var tempy=".$_GET['p'].";";?></script>

<div class='youtube-back'>
    <iframe id="video" width="800" height="600" frameborder="0" allowfullscreen></iframe>
    <i class='fa fa-times-circle youtubeFa'></i>
</div>

<script type='text/javascript'>
    window.section=0;runs=0;
    $('.rap1200 p img').parent().addClass('cent');

    $('.rap1200 a').each(function() {
        $(this).attr('target','_blank');
    });
</script>
<?php $randal=rand(1,999);echo "<script type='text/javascript' src='cjs/srcbtm.js?version=".$randal."'>'></script>";?>

<script src='cjs/article.js'></script>
</body>
</html>
<?php COUCH::invoke(); ?>

