<?php require_once( 'admin/cms.php' ); ?>
<cms:template title='YLIN' order='4'/>
<?php include 'inc/INChead.php';$randal=rand(1,999);
    $randal=rand(1,999);
    echo "<link rel='stylesheet' type='text/css' href='css/ylin.css?version=".$randal."'>";
    //echo "<link rel='stylesheet' type='text/css' href='css/indexNav.css?version=".$randal."'>";
?>
<div class='rap1200 raptop'>
<ul class='ylin-hid'>
    <a class='scroll ylin-one' href='#one'>one</a>
    <a class='scroll ylin-two' href='#two'>two</a>
    <a class='scroll ylin-three' href='#three'>three</a>
</ul>

<h1 class='ylin-title'><cms:editable name='title' height='40'>Your Life in Numbers</cms:editable></h1>
<div class='ylin-tagline'><cms:editable name='tagline' height='40'>Explore how much the world has changed since you were born</cms:editable></div>
<div class='ylin-content1'><cms:editable name='content1' type='richtext'>Is life getting better or worse? </cms:editable></div>
<div class='ylin-content1'><cms:editable name='contenttest' type='textarea' no_xss_check='1'>Content Test </cms:editable></div>
<div class='block-1'>
    <select class='sel-count'><option>Step 1: Select your country of birth</option><?php include 'sel/SELcount.php'; ?></select>
    <select class='sel-year'><?php include 'sel/SELyears.php'; ?></select>
    <div class='ylin-soc ylin-soc1' id='one'> 
        <i class='fa fa-facebook fb1' onclick="ga('send', 'event', 'button', 'click', 'facebook one country', 4);"></i>
        <i class='fa fa-twitter tw1' onclick="ga('send', 'event', 'button', 'click', 'twitter one country', 4);"></i>
        <?php echo "<a class='twit-click1' target='_blank' href='https://twitter.com/intent/tweet?text=Check out %23YourLifeInNumbers, a project of @humanprogress&url=http://72.32.118.0/?uni=".$_GET['uni']."'><i class='fa fa-twitter twit-click1' style='display:none!important'></i></a>"; ?>
        <a target='_blank' href='http://www.reddit.com/submit?url=http://72.32.103.238/humanprogress&title=Your%20life%20in%20Numbers' onclick="ga('send', 'event', 'button', 'click', 'reddit one country', 4);"><i class='fa fa-reddit rd1'></i></a>
        <i class='fa fa-download dl1' onclick="ga('send', 'event', 'button', 'click', 'download one country', 4);"></i>
    </div>
</div>

<div class='bar-cont-1'>
    <div class='bar-chart-1'></div>
    <div class='note'>Note: Values displayed are based on the nearest match for birth year and current year</div>
    <cms:editable name='content2' type='richtext'>Is life getting better or worse? </cms:editable>
    <!--<div class='click-more'>More</div><div class='click-less'>Less</div>-->  
</div>
<div class='three-block'>
    <select class='sel-count2'><option value='step3'>Step 3: Select a country to compare</option><?php include 'sel/SELcount.php'; ?></select>
    <i class='fa fa-close bt-dismiss'></i>
    <div class='ylin-soc ylin-soc2' id='two'> 
        <i class='fa fa-facebook fb2' onclick="ga('send', 'event', 'button', 'click', 'facebook two countries', 4);"></i>
        <i class='fa fa-twitter tw2' onclick="ga('send', 'event', 'button', 'click', 'twitter two countries', 4);"></i>
        <a target='_blank' href='http://www.reddit.com/submit?url=http://72.32.103.238/humanprogress&title=Your%20life%20in%20Numbers' onclick="ga('send', 'event', 'button', 'click', 'reddit two countries', 4);"><i class='fa fa-reddit rd2'></i></a>
        <i class='fa fa-download dl2' onclick="ga('send', 'event', 'button', 'click', 'download two countries', 4);"></i>
    </div>
</div>

<div class='bar-cont-2'>
    <div class='bar-chart-2'></div>
    <div class='note'>Note: Values displayed are based on the nearest match for birth year and current year</div>
</div>
<div class='four-block'>        
    <cms:editable name='content3' type='richtext'>“Your life in numbers” is brought to you by </cms:editable>
    <!--<div class='view-change'>Step 4: View absolute value over time</div>-->
    <div id='three' class='hide-change'>Hide absolute value over time</div>
</div>
    
<div class='table-cont-1'>
    <table>
    <thead>
        <tr>
            <th>Country</th>
            <th class='protip th1'><cms:editable name='datamain1' height='40'>Life expectancy at birth,</cms:editable><br><span><cms:editable name='datasub1' height='40'>years</cms:editable></span></th>
            <th class='protip th2'><cms:editable name='datamain2' height='40'>Infant mortality rate</cms:editable><br><span><cms:editable name='datasub2' height='40'>per 1,000 live births</cms:editable></span></th>
            <th class='protip th3'><cms:editable name='datamain3' height='40'>GDP, per person</cms:editable><br><span><cms:editable name='datasub3' height='40'>2014 U.S. dollars, PPP</cms:editable></span></th>
            <th class='protip th4'><cms:editable name='datamain4' height='40'>Food supply, per person</cms:editable><br><span><cms:editable name='datasub4' height='40'>per day, calories</cms:editable></span></th>
            <th class='protip th5'><cms:editable name='datamain5' height='40'>Mean years of schooling,</cms:editable><br><span><cms:editable name='datasub5' height='40'>number</cms:editable></span></th>
            <th class='protip th6'><cms:editable name='datamain6' height='40'>Index of Democracy,</cms:editable><br><span><cms:editable name='datasub6' height='40'>scale -10 to 10</cms:editable></span></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class='table-country country1'></td>
            <td>
                <div class='tab lef-tab'>
                    <div class='lef-up'>
                        <span class='yb1 numbers'>Birth Year:</span> <section class='by1'></section>
                    </div>
                    <div class='lef-down'>
                        <span class='yc1'>Current Year:</span> <section class='cy1'></section>
                    </div>
                </div>
                <div class='tab right-tab'>
                    <span class='im im1'></span>
                </div>
            </td>
            <td>
                <div class='tab lef-tab'>
                    <div class='lef-up'>
                        <span class='yb2'>Birth Year:</span> <section class='by2'></section>
                    </div>
                    <div class='lef-down'>
                        <span class='yc2'>Current Year:</span> <section class='cy2'></section>
                    </div>
                </div>
                <div class='tab right-tab'>
                    <span class='im im2'></span>
                </div>
            </td>
            <td>
                <div class='tab lef-tab'>
                    <div class='lef-up'>
                        <span class='yb3'>Birth Year:</span> <section class='by3'></section>
                    </div>
                    <div class='lef-down'>
                        <span class='yc3'>Current Year:</span> <section class='cy3'></section>
                    </div>
                </div>
                <div class='tab right-tab'>
                    <span class='im im3'></span>
                </div>
            </td>
            <td>
                <div class='tab lef-tab'>
                    <div class='lef-up'>
                        <span class='yb4'>Birth Year:</span> <section class='by4'></section>
                    </div>
                    <div class='lef-down'>
                        <span class='yc4'>Current Year:</span> <section class='cy4'></section>
                    </div>
                </div>
                <div class='tab right-tab'>
                    <span class='im im4'></span>
                </div>
            </td>
            <td>
                <div class='tab lef-tab'>
                    <div class='lef-up'>
                        <span class='yb5'>Birth Year:</span> <section class='by5'></section>
                    </div>
                    <div class='lef-down'>
                        <span class='yc5'>Current Year:</span> <section class='cy5'></section>
                    </div>
                </div>
                <div class='tab right-tab'>
                    <span class='im im5'></span>
                </div>
            </td>
            <td>
                <div class='tab lef-tab'>
                    <div class='lef-up'>
                        <span class='yb6'>Birth Year:</span> <section class='by6'></section>
                    </div>
                    <div class='lef-down'>
                        <span class='yc6'>Current Year:</span> <section class='cy6'></section>
                    </div>
                </div>
                <div class='tab right-tab'>
                    <span class='im im6'></span>
                </div>
            </td>
        </tr>
    </tbody>
    </table>
    <div class='note'>Note: Values displayed are based on the nearest match for birth year and current year</div>
    <!--<img style='width:100%;position:relative;right:5px'src='img/ylin-table-1.png'>-->
</div>
    
<div class='table-cont-2'>
    <table>
    <thead>
        <tr>
            <th>Country</th>
            <th class='protip th-life th1'><a class='life'><cms:editable name='datamain1' height='40'>Life expectancy at birth,</cms:editable><br><span><cms:editable name='datasub1' height='40'>years</cms:editable></span></a></th>
            <th class='protip th-infant th2'><a class='infant'><cms:editable name='datamain2' height='40'>Infant mortality rate</cms:editable><br><span><cms:editable name='datasub2' height='40'>per 1,000 live births</cms:editable></span></a></th>
            <th class='protip th-gdp th3'><a class='gdp'><cms:editable name='datamain3' height='40'>GDP, per person</cms:editable><br><span><cms:editable name='datasub3' height='40'>2014 U.S. dollars, PPP</cms:editable></span></a></th>
            <th class='protip th-food th4'><a class='food'><cms:editable name='datamain4' height='40'>Food supply</cms:editable><br><span><cms:editable name='datasub4' height='40'>per person, per day, calories</cms:editable></span></a></th>
            <th class='protip th-mean th5'><a class='mean'><cms:editable name='datamain5' height='40'>Mean years of schooling,</cms:editable><br><span><cms:editable name='datasub5' height='40'>number</cms:editable></span></a></th>
            <th class='protip th-index th6'><a class='index'><cms:editable name='datamain6' height='40'>Index of Democracy,</cms:editable><br><span><cms:editable name='datasub6' height='40'>scale -10 to 10</cms:editable></span></a></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class='table-country country1 countryFirst'></td>
            <td>
                <div class='tab lef-tab'>
                    <div class='lef-up'>
                        <span class='ybFin1 ybUno1'>Birth Year:</span> <section class='byUno1'></section>
                    </div>
                    <div class='lef-down'>
                        <span class='ycFin1 ycUno1'>Current Year:</span> <section class='cyUno1'></section>
                    </div>
                </div>
                <div class='tab right-tab'>
                    <span class='im imUno1'></span>
                </div>
            </td>
            <td>
                <div class='tab lef-tab'>
                    <div class='lef-up'>
                        <span class='ybFin2 ybUno2'>Birth Year:</span> <section class='byUno2'></section>
                    </div>
                    <div class='lef-down'>
                        <span class='ycFin2 ycUno2'>Current Year:</span> <section class='cyUno2'></section>
                    </div>
                </div>
                <div class='tab right-tab'>
                    <span class='im imUno2'></span>
                </div>
            </td>
            <td>
                <div class='tab lef-tab'>
                    <div class='lef-up'>
                        <span class='ybFin3 ybUno3'>Birth Year:</span> <section class='byUno3'></section>
                    </div>
                    <div class='lef-down'>
                        <span class='ycFin3 ycUno3'>Current Year:</span> <section class='cyUno3'></section>
                    </div>
                </div>
                <div class='tab right-tab'>
                    <span class='im imUno3'></span>
                </div>
            </td>
            <td>
                <div class='tab lef-tab'>
                    <div class='lef-up'>
                        <span class='ybFin4 ybUno4'>Birth Year:</span> <section class='byUno4'></section>
                    </div>
                    <div class='lef-down'>
                        <span class='ycFin4 ycUno4'>Current Year:</span> <section class='cyUno4'></section>
                    </div>
                </div>
                <div class='tab right-tab'>
                    <span class='im imUno4'></span>
                </div>
            </td>
            <td>
                <div class='tab lef-tab'>
                    <div class='lef-up'>
                        <span class='ybFin5 ybUno5'>Birth Year:</span> <section class='byUno5'></section>
                    </div>
                    <div class='lef-down'>
                        <span class='ycFin5 ycUno5'>Current Year:</span> <section class='cyUno5'></section>
                    </div>
                </div>
                <div class='tab right-tab'>
                    <span class='im imUno5'></span>
                </div>
            </td>
            <td>
                <div class='tab lef-tab'>
                    <div class='lef-up'>
                        <span class='ybFin6 ybUno6'>Birth Year:</span> <section class='byUno6'></section>
                    </div>
                    <div class='lef-down'>
                        <span class='ycFin6 ycUno6'>Current Year:</span> <section class='cyUno6'></section>
                    </div>
                </div>
                <div class='tab right-tab'>
                    <span class='im imUno6'></span>
                </div>
            </td>
        </tr>
        <tr class='country2wrap'>
            <td class='table-country country2'></td>
            <td>
                <div class='tab lef-tab'>
                    <div class='lef-up'>
                        <span class='ybFin1 ybDos1'>Birth Year:</span> <section class='byDos1'></section>
                    </div>
                    <div class='lef-down'>
                        <span class='ycFin1 ycDos1'>Current Year:</span> <section class='cyDos1'></section>
                    </div>
                </div>
                <div class='tab right-tab'>
                    <span class='im imDos1'></span>
                </div>
            </td>
            <td>
                <div class='tab lef-tab'>
                    <div class='lef-up'>
                        <span class='ybFin2 ybDos2'>Birth Year:</span> <section class='byDos2'></section>
                    </div>
                    <div class='lef-down'>
                        <span class='ycFin2 ycDos2'>Current Year:</span> <section class='cyDos2'></section>
                    </div>
                </div>
                <div class='tab right-tab'>
                    <span class='im imDos2'></span>
                </div>
            </td>
            <td>
                <div class='tab lef-tab'>
                    <div class='lef-up'>
                        <span class='ybFin3 ybDos3'>Birth Year:</span> <section class='byDos3'></section>
                    </div>
                    <div class='lef-down'>
                        <span class='ycFin3 ycDos3'>Current Year:</span> <section class='cyDos3'></section>
                    </div>
                </div>
                <div class='tab right-tab'>
                    <span class='im imDos3'></span>
                </div>
            </td>
            <td>
                <div class='tab lef-tab'>
                    <div class='lef-up'>
                        <span class='ybFin4 ybDos4'>Birth Year:</span> <section class='byDos4'></section>
                    </div>
                    <div class='lef-down'>
                        <span class='ycFin4 ycDos4'>Current Year:</span> <section class='cyDos4'></section>
                    </div>
                </div>
                <div class='tab right-tab'>
                    <span class='im imDos4'></span>
                </div>
            </td>
            <td>
                <div class='tab lef-tab'>
                    <div class='lef-up'>
                        <span class='ybFin5 ybDos5'>Birth Year:</span> <section class='byDos5'></section>
                    </div>
                    <div class='lef-down'>
                        <span class='ycFin5 ycDos5'>Current Year:</span> <section class='cyDos5'></section>
                    </div>
                </div>
                <div class='tab right-tab'>
                    <span class='im imDos5'></span>
                </div>
            </td>
            <td>
                <div class='tab lef-tab'>
                    <div class='lef-up'>
                        <span class='ybFin6 ybDos6'>Birth Year:</span> <section class='byDos6'></section>
                    </div>
                    <div class='lef-down'>
                        <span class='ycFin6 ycDos6'>Current Year:</span> <section class='cyDos6'></section>
                    </div>
                </div>
                <div class='tab right-tab'>
                    <span class='im imDos6'></span>
                </div>
            </td>
        </tr>
    </tbody>
    </table>
    <div class='note'>Note: Values displayed are based on the nearest match for birth year and current year</div>
</div>
</div>

<canvas id='canvas' style='display:none'></canvas>
<canvas id='canvasDOS' style='display:none'></canvas>

<div class='n'>
    <div class='dc1'><cms:editable name='datachart1' height='40'>LIFE EXPECTANCY</cms:editable></div>
    <div class='dc2'><cms:editable name='datachart2' height='40'>INFANT SURVIVAL</cms:editable></div>
    <div class='dc3'><cms:editable name='datachart3' height='40'>INCOME PER PERSON</cms:editable></div>
    <div class='dc4'><cms:editable name='datachart4' height='40'>FOOD SUPPLY PER PERSON</cms:editable></div>
    <div class='dc5'><cms:editable name='datachart5' height='40'>MEAN YEARS OF SCHOOLING</cms:editable></div>
    <div class='dc6'><cms:editable name='datachart6' height='40'>LEVEL OF DEMOCRACY</cms:editable></div>

    <div class='dn1'><cms:editable name='datanum1' height='40'>2314</cms:editable></div>
    <div class='dn2'><cms:editable name='datanum2' height='40'>2386</cms:editable></div>
    <div class='dn3'><cms:editable name='datanum3' height='40'>2249</cms:editable></div>
    <div class='dn4'><cms:editable name='datanum4' height='40'>2126</cms:editable></div>
    <div class='dn5'><cms:editable name='datanum5' height='40'>3246</cms:editable></div>
    <div class='dn6'><cms:editable name='datanum6' height='40'>2560</cms:editable></div>

    <div class='def1'><cms:editable name='definition1' height='40'>This is the first definition</cms:editable></div>
    <div class='def2'><cms:editable name='definition2' height='40'>This is the second definition</cms:editable></div>
    <div class='def3'><cms:editable name='definition3' height='40'>This is the third definition</cms:editable></div>
    <div class='def4'><cms:editable name='definition4' height='40'>This is the fourth definition</cms:editable></div>
    <div class='def5'><cms:editable name='definition5' height='40'>This is the fifth definition</cms:editable></div>
    <div class='def6'><cms:editable name='definition6' height='40'>This is the sixth definition</cms:editable></div>
</div>

<script type="text/javascript">
/*function captureFirstDiv()
{
    html2canvas([document.getElementById('uno')], {   
        onrendered: function(canvas)  
        {
            var img = canvas.toDataURL()
            $.post("save.php", {data: img}, function (file) {
                window.location.href =  "download.php?path=upl/"+ file});   
        }
    });
}

function captureSecondDiv()
{
    html2canvas([document.getElementById('dos')], {   
        onrendered: function(canvas)  
        {
            var img = canvas.toDataURL()
            $.post("save.php", {data: img}, function (file) {
            window.location.href =  "download.php?path=upl/"+ file});   
        }
    });
}*/
</script>
<script src='cjs/ylin.php'></script>
</body>
</html>
<?php COUCH::invoke(); ?>

