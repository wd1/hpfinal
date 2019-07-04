<?php include 'inc/INChead.php';$randal=rand(1,999);
    echo "<link rel='stylesheet' type='text/css' href='css/1.css?version=".$randal."'>";
    echo "<link rel='stylesheet' type='text/css' href='css/article.css?version=".$randal."'>";
    echo "<link rel='stylesheet' type='text/css' href='css/dws.css?version=".$randal."'>";
?>
<?php include 'inc/mailchimp.php'; ?>
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" /> 
<link rel="stylesheet" href="//min.gitcdn.xyz/repo/DoclerLabs/Protip/master/protip.min.css">
      <div class='topec'>
        <div class='finddata'>Find Data</div>
        <div class='topec-wrap'>
          <input type='text' placeholder='Filter Datasets Below'>
          <i class='fa fa-search searcho'></i>
        </div>
        <div class='resres'></div>
        <?php
          if($_GET[p]>0){
            $donothing=1;
          } else{
            //echo "<div class='vad'>View All Datasets</div>";
            //echo "<div class='had'>Hide All Datasets</div>";
          } 
        ?>  
        <div class='rap1200'><div class='partial' id='tries'></div></div>       
    </div>
    
    <?php
      if($_GET[p]>0){
        echo "<div class='holder'>";
      } else{
        echo "<div class='holder' style='display:none'>";
      } 
    ?>       
      <div class='title-holder'>
        <?php
        include 'inc/con.php';
        $p=$_GET['p']; 
        $zes = mysqli_query($con,"SELECT title,subtitle FROM datasets WHERE id='$p'");
        while($zow = mysqli_fetch_array($zes)){ 
            $title = $zow['title'];
            $subtitle = $zow['subtitle'];
        }
        echo "<div class='title-txt'>".$title."</div>";
        
        $rr="<div class='subtitle-txt'><section>".$subtitle."</section>";
        if($_GET[p]>0){
          $rr=$rr. "<div class='soco'><span class='dwdown'><i class='fa fa-download'></i> Download</span><span class='dwshare'><i class='fa fa-share-alt'></i> Share</span></div>";
        } 
        $rr=$rr."</div>";
        echo $rr;
        ?>    
      </div>
      <a class='change-but' href='dws7' style='display:none'>
        <i class='fa fa-exchange'></i>
        Change Dataset
      </a>
      <div class='country-holder' style='display:none'>
        <form action='' method='post'><input type='text' name='country' value='' class='auto' placeholder='Select Country/Region to Visualize'></form>
        <div class='countries'>
          <span>World <i class='fa fa-times-circle-o'></i></span>
          <span>United States <i class='fa fa-times-circle-o'></i></span>
          <span>Argentina <i class='fa fa-times-circle-o'></i></span>
          <span>West Africa <i class='fa fa-times-circle-o'></i></span>
        </div>
      </div>
      <div class='viz-holder'>
        <span class='selected'>
          <i class='fa fa-globe'></i>
          <section>World Map</section>
        </span>
        <span>
          <i class='fa fa-area-chart'></i>
          <section>Scatter Chart</section>
        </span>
        <span>
          <i class='fa fa-line-chart'></i>
          <section>Line Chart</section>
        </span>
        <span>
          <i class='fa fa-bar-chart'></i>
          <section>Bar Chart</section>
        </span>
        <span>
          <i class='fa fa-pie-chart'></i>
          <section>Tree Map</section>
        </span>
        <span>
          <i class='fa fa-list-ol'></i>
          <section>Rank List</section>
        </span>
        <span>
          <i class='fa fa-calculator'></i>
          <section>Calc Table</section>
        </span>
        <span>
          <i class='fa fa-table'></i>
          <section>Data Table</section>
        </span>
      </div>
      <div class='placeholderimg'>
      <?php
        if($_GET[p]>0){
          echo "<div style='display:none' class='share-button shareee'><i class='fa fa-share-alt'></i> Share</div>";
          echo "<div style='display:none' class='share-button downloaddd'><i class='fa fa-download'></i> Download</div>";
        } 
      ?>
      </div>
    </div>


<?php if($_GET[p]>0){echo "<div class='categories' style='display:none'>";}else{echo "<div style='display:none' class='categories'>";}?>
        <span>Topics</span>
        <?php 
            include 'inc/con.php'; 
            $aes = mysqli_query($con,"SELECT catsubcat FROM datasets WHERE id=$_GET[p]");
            while($aow = mysqli_fetch_array($aes)){ 
                $temp = $aow['catsubcat'];
                $arr = explode("*", $temp);
                $arr=array_filter($arr);
                $arr=array_values($arr);
                $count = count($arr);
                for($x=0;$x<$count;$x++){
                    $test = $arr[$x];
                  
                    $bes = mysqli_query($con,"SELECT * FROM subcats WHERE id=$test");
                    while($bow = mysqli_fetch_array($bes)){
                        $catid=$bow['catid'];
                        $sid=$bow['id'];
                        $subcatr=$bow['subcat'];
                    } 
                    $arrTest = explode("*", $test);
                    if($x==($count-1)){
                        echo "<a href='index?cid=".$catid."&sid=".$sid."' class='cat cat1'>".$subcatr."</a>";   
                    } else{
                        echo "<a href='index?cid=".$catid."&sid=".$sid."' class='cat cat1'>".$subcatr."</a><span class='fs'>/</span>";   
                    }
                }
            } 
            mysqli_close($con);
        ?>
    </div>

    <div class='relist'>
            <?php 
                include 'inc/con.php'; 
                $aes = mysqli_query($con,"SELECT catsubcat FROM datasets WHERE id=$_GET[p]");
                while($aow = mysqli_fetch_array($aes)){ 
                    $temp = $aow['catsubcat'];
                }

                $count=0;
                $bes = mysqli_query($con,"SELECT id,subcat FROM subcats");
                while($bow = mysqli_fetch_array($bes)){ 
                  if (strpos($temp, $bow['id']) !== false) {
                    $arro[$count][0]=$bow['id'];
                    $arro[$count][1]=$bow['subcat'];
                    $count++;
                  }
                } 

                for($x=0;$x<$count;$x++){
                  $idr=$arro[$x][0];
                  $ttr=$arro[$x][1];
                  echo "<section class='relist-header'>Related <span style='color:#ff6c00'>".$ttr."</span> Datasets</section>";
                  $ces = mysqli_query($con,"SELECT id,title,subtitle,catsubcat FROM datasets");
                  while($cow = mysqli_fetch_array($ces)){ 
                    if (strpos($cow['catsubcat'],$idr) !== false) {
                      echo "<a class='relink' href='dws7?p=".$cow['id']."'>".$cow['title'].", ".$cow['subtitle']."</a>";
                    }
                  }
                  echo "<br>";
                }

                mysqli_close($con);
            ?>
    </div>




<?php if($_GET[p]>0){include 'inc/dwrelated.php';} ?>

<?php 
if($_GET[p]>0){
  echo "<div class='art-foot newsletter'>";
} else{
  echo "<div style='display:none' class='art-foot newsletter'>";
}

?>
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

<div class='moody'>
  <div class='moody-int'>
    <i class='fa fa-times-circle topicFa'></i>
    <span>Choose a Topic</span>
    <div class='moody-link'>

    </div>
  </div>
</div>

<div class='youtube-back'>
    <iframe id="video" width="800" height="600" frameborder="0" allowfullscreen></iframe>
    <i class='fa fa-times-circle youtubeFa'></i>
</div>
<script src='cjs/srcbtm.js'></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>  
<script type="text/javascript" src="js/protip.min.js"></script>  
<script type='text/javascript'>$( document ).ready(function() {
  window.section=1;
  window.runs=1;

  $.ajax({
      url:'inc/getSetsAll.php',
      crossDomain:true,
      dataType:'JSONP',
      data:{},
      success:function(data){
        $('.partial').html(data[0]);
        $('.resres').html('All Datasets');
      }
    }); 

  $('.topec input').val('');
  $('.topec input').focus();

  $('.playwithdata').addClass('on');

  $('.topec input').on("change keyup paste", function(){
      var p = $('.topec input').val();
      var y = $('.topec input').val().length;
      if(y>0){
        $('.vad').hide();
        $('.had').hide();
        $.ajax({
          url:'inc/getSets.php',
          crossDomain:true,
          dataType:'JSONP',
          data:{p:p},
          success:function(data){
            $('.partial').html(data[0]);
            $('.resres').html(data[1]+' Results');
          }
        });     
      }else{
        $.ajax({
            url:'inc/getSetsAll.php',
            crossDomain:true,
            dataType:'JSONP',
            data:{},
            success:function(data){
              $('.partial').html(data[0]);
              $('.resres').html('All Datasets');
              //$('.resres').html(data[1]+' Results (All Datasets)');
            }
          }); 
        //$('.partial').html('');
        //$('.vad').show();
        //$('.had').hide();
      }
  });

  $(document).on('click', '.vad', function(){
      $('.vad').hide();
      $('.had').show();
      $.ajax({
          url:'inc/getSetsAll.php',
          crossDomain:true,
          dataType:'JSONP',
          data:{},
          success:function(data){
            $('.partial').html(data[0]);
          }
        }); 
  });

  $(document).on('click', '.had', function(){
      $('.vad').show();
      $('.had').hide();
      $('.partial').html(''); 
  });


  //$.protip({position:'bottom',scheme:'black',trigger:'sticky'});

  $('.auto').autocomplete({
    source: 'inc/search.php',
    minLength: 1,
    select: function (event, ui) {
        var value = ui.item.value;
        var spanner='<span>'+value+' <i class="fa fa-times-circle-o"></i></span>';
        $(".countries span:contains("+value+")").remove();
        $('.countries').append('<span>'+value+' <i class="fa fa-times-circle-o"></i></span>');
        $('form .auto').val('');return false;
    }
  });                

  $('.csl').autocomplete({
    source: 'inc/csel.php',
    minLength: 1,
    select: function (event, ui) {
        
        var str = ui.item.value;
        var royer=str.substring(str.lastIndexOf("(")+1,str.lastIndexOf(")"));
        location.href='dws7?p='+royer+'';
        $('form .auto').val('');
        return false;
    }
  });      

  window.section=0;runs=0;

  $('.topic').on('change', function() {
    var topic = $('.topic option:selected').text();
    var tid = $('.topic option:selected').attr('data-id');
    
    $.ajax({
      url:'inc/getTopic.php',
      crossDomain:true,
      dataType:'JSONP',
      data:{tid:tid,topic:topic},
      success:function(data){
        $('.txt-sec').html(data[0]);
      }
    });     
  }); 

  var x=0;
<?php 
if($_GET[p]>0){
  echo "var x=1;";
}
?>


  $(document).on('click', '.countries span', function(){
    $(this).remove();
  }); 

  $('.right-dw').css('color','#ff6c00');    



  $(document).on('click', '.topicFa', function(){
      $('.moody').css('display','none');
  });


  $(document).on('click', '.moody-link a.tl', function(){
      var tempo = $(this).attr('data-id');
      var texto = $(this).text();
      
      $.ajax({
          url:'inc/showSubsDWS.php',
          crossDomain:true,
          dataType:'JSONP',
          data:{tempo:tempo,texto:texto},
          success:function(data){
            if(data[0]==0){
              location.href='index?cid='+data[1]+'&sid=0';
            } else{
              $('.moody-int').html(data[0]);  
            }
          }
        }); 
  });

  $(document).on('click', '.back-sec', function(){
      $('.browsetopics').trigger('click');
  });



  $(document).on('click', '.moody-link a.subtoplink', function(){
      var tempo = $(this).attr('data-id');
      
      $.ajax({
          url:'inc/showDataDWS.php',
          crossDomain:true,
          dataType:'JSONP',
          data:{tempo:tempo},
          success:function(data){
            $('.moody-int').html(data[0]);
          }
        }); 
  });



  $(document).on('click', '.back-sec', function(){
      $('.browsetopics').trigger('click');
  });


  $(document).on('click', '.hone', function(){
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
  });



  $(document).on('click', '.topo', function(){
    var sid = $(this).attr('data-sid');
    var texto = $(this).text();
    $('.dubby').slideUp();
    $('.topo').removeClass('ropener');
    $(this).addClass('ropener');
    $.ajax({
      url:'inc/dws7set.php',
      crossDomain:true,
      dataType:'JSONP',
      data:{sid:sid},
      success:function(data){
        $('.ropener').after(data[0]);
      }
    }); 
  });

  $('.partial').mouseenter(function() {
    $('.topec input').trigger('blur');
  });


});</script>
</body>
</html>

