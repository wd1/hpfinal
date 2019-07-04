<?php require_once( 'admin/cms.php' ); ?>
<cms:template title='About' order='2'>

    <cms:editable name='teamheader' height='40' order='1'/>
    <cms:editable name='teamorder' height='40' order='1'/>
    <cms:editable name='teamtext' type='richtext'  order='1'/>

    <cms:repeatable name='aboutteam' order='2'>
        <cms:editable type='image' name='aboutimg' label='aboutimg' height='100' show_preview='1' preview_width='100' input_width='100' />
        <cms:editable type='textarea' name='aboutname' label='aboutname' height='40' />
        <cms:editable type='textarea' name='aboutrole' label='aboutrole' height='40'/>
        <cms:editable type='textarea' name='aboutlink' label='aboutlink' height='40'/>
        <cms:editable type='textarea' name='aboutdesc' label='aboutdesc' height='40'/>
    </cms:repeatable>

    <cms:editable name='sec1name' height='40' order='3'/>
    <cms:editable name='sec1text' type='richtext' order='4'/>
    
    <cms:editable name='sec2name' height='40' order='5'/>
    <cms:editable name='sec2text' type='richtext' order='6'/>
    
    <cms:editable name='sec3name' height='40' order='7'/>
    <cms:editable name='sec3text' type='richtext' order='8'/>

    <cms:editable name='sec4name' height='40' order='9'/>
    <cms:editable name='sec4text' type='richtext' order='10'/>

    <cms:editable name='sec5name' height='40' order='11'/>
    <cms:editable name='sec5text' type='richtext' order='12'/>

    <cms:editable name='sec6name' height='40' order='13'/>
    <cms:editable name='sec6text' type='richtext' order='14'/>

    <cms:editable name='sec7name' height='40' order='15'/>
    <cms:editable name='sec7text' type='richtext' order='16'/>

    <cms:editable name='sec8name' height='40' order='17'/>
    <cms:editable name='sec8text' type='richtext' order='18'/>

    <cms:editable name='sec9name' height='40' order='19'/>
    <cms:editable name='sec9text' type='richtext' order='20'/>
</cms:template>
<?php include 'inc/INChead.php';$randal=rand(1,999);
    echo "<link rel='stylesheet' type='text/css' href='css/about.css?version=".$randal."'>";
    echo "<link rel='stylesheet' type='text/css' href='css/indexNav.css?version=".$randal."'>";
?>
<div class='rap1200'>
    <ul class='about-left'>
        <li class='sec1head'><a class='scroll sec1' href='#sec1'><cms:show sec1name/></a></li>
        <li class='sec2head'><a class='scroll sec2' href='#sec2'><cms:show sec2name/></a></li>
        <li class='sec3head'><a class='scroll sec3' href='#sec3'><cms:show sec3name/></a></li>
        <li class='sec4head'><a class='scroll sec4' href='#sec4'><cms:show sec4name/></a></li>
        <li class='sec5head'><a class='scroll sec5' href='#sec5'><cms:show sec5name/></a></li>
        <li class='sec6head'><a class='scroll sec6' href='#sec6'><cms:show sec6name/></a></li>
        <li class='sec7head'><a class='scroll sec7' href='#sec7'><cms:show sec7name/></a></li>
        <li class='sec8head'><a class='scroll sec8' href='#sec8'><cms:show sec8name/></a></li>
        <li class='sec9head'><a class='scroll sec9' href='#sec9'><cms:show sec9name/></a></li>
        <li class='secteamhead'><a class='scroll secteam' href='#secteam'><cms:show teamheader/></a></li>
    </ul>

    <div class='txt-sec'>
        <div id='sec1' class='secwrap sec1wrap'>
            <div class='about-header'><cms:show sec1name/></div>
            <cms:show sec1text/>
            <!--<br><iframe width="100%" height="400px" src="https://www.youtube.com/embed/NjqVcBcswK8" frameborder="0" allowfullscreen></iframe>-->
        </div>
        <div class='secwrap sec2wrap'>
            <div id='sec2' class='about-header'><cms:show sec2name/></div>
            <cms:show sec2text/>
        </div>
        <div class='secwrap sec3wrap'>
            <div id='sec3' class='about-header'><cms:show sec3name/></div>
            <cms:show sec3text/>
        </div>    
        <div class='secwrap sec4wrap'>
            <div id='sec4' class='about-header'><cms:show sec4name/></div>
            <cms:show sec4text/>
        </div>
        <div class='secwrap sec5wrap'>
            <div id='sec5' class='about-header'><cms:show sec5name/></div>
            <cms:show sec5text/>  
        </div>
        <div class='secwrap sec6wrap'>
            <div id='sec6' class='about-header'><cms:show sec6name/></div>
            <cms:show sec6text/>  
        </div>
        <div class='secwrap sec7wrap'>
            <div id='sec7' class='about-header'><cms:show sec7name/></div>
            <cms:show sec7text/>     
        </div>
        <div class='secwrap sec8wrap'>
            <div id='sec8' class='about-header'><cms:show sec8name/></div>
            <cms:show sec8text/>  
        </div>
        <div class='secwrap sec9wrap'>
            <div id='sec9' class='about-header'><cms:show sec9name/></div>
            <cms:show sec9text/>  
        </div>
        <div class='secwrap secteamwrap'>
            <div id='secteam' class='about-header'><cms:show teamheader/></div>
            <cms:show teamtext/>
            <cms:show_repeatable 'aboutteam'>
                <section>
                    <img src='<cms:show aboutimg />'>
                    <span class='person'><a target='_blank' href='<cms:show aboutlink />'><cms:show aboutname /></a><br>
                        <pre><cms:show aboutrole /></pre>
                        <div><cms:show aboutdesc /></div>
                    </span><br>
                </section>
            </cms:show_repeatable>
        </div>
        <br><br><br><br><br><br><br><br><br>
    </div>
</div>



<div class='drawer' style='display:none'>
  <i class='fa fa-times-circle drawerFa'></i>
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

<input hidden class='teamorder' value='<cms:show teamorder />'/>

<div class='youtube-back'>
    <iframe id="video" width="800" height="600" frameborder="0" allowfullscreen></iframe>
    <i class='fa fa-times-circle youtubeFa'></i>
</div>

<script src='cjs/about.js'></script>
<script src='cjs/srcbtm.js'></script>
<script type='text/javascript'>
    window.section=0;runs=0;

    $('.aboutus').css('color','#ff6c00');
    $('.txt-sec a').each(function() {
        $(this).attr('target','_blank');
    });
</script>
</body>
</html>
<?php COUCH::invoke(); ?>

