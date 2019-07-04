<?php 
  include 'inc/INChead.php';
  include 'inc/DWtop.php';
  include 'inc/mailchimp.php';
  include 'inc/DWtopec.php';

  echo "<div class='rap1200'>";   
  include 'inc/DWmeatTop.php';
?>
<!--START TREE VISUALIZATION-->
<div id="container" style='height:600px'></div>

<div id='bTree' class='bee'>
  <div id='slider'>
    <div id='custom-handle' class='ui-slider-handle'></div>
  </div>
  <div class='playfa'>
    <i class='fa fa-play'></i>
  </div>
  <div class='stopfa'>
    <i class='fa fa-stop'></i>
  </div>
  <?php
    //if($_GET['high']==1){echo "<div class='barsortlow butter'>Sort Low to High</div>";} 
    //else{echo "<div class='barsorthigh butter'>Sort High to Low</div>";}
  ?>
</div>
<div class='treereg'>
  <div class='allcountries'>View All Countries</div>
  <div class='unregions treesel'>View UN Regions</div>  
  <div class='wbregions'>View World Bank Regions</div>
  <div class='imfregions'>View IMF Regions</div>
</div>
<!--END TREE VISUALIZATION-->
<?php
  include 'inc/DWmeatBottom.php';
  echo "</div>";

  if($_GET[p]>0){include 'inc/dwrelated.php';
    echo "<div class='art-foot newsletter'>";
  } else{
    echo "<div style='display:none' class='art-foot newsletter'>";
  }

  include 'inc/DWfoot.php';
?>

<script src='js/codejquery191.js'></script>
<script src='js/jqueryui1101.js'></script>  
<script src='js/codehighcharts.js'></script>
<script src='js/codehighchartsmore.js'></script>
<script src='js/heatmap.js'></script>
<script src='js/treemap.js'></script>
<script src='cjs/dwglobal.js'></script>

<script type='text/javascript'>$( document ).ready(function() {
$('.playwithdata').addClass('on');
$('.sTree').addClass('selected');
$('#dTree').show();
window.stopnow=0;

$('.treereg div').click(function(){
    var metasel=$(this).attr('class');
    
    var sub=window.location.href;
    if(metasel=='imfregions'){
      sub=sub.replace('dwtreeUN', 'dwtreeIMF');
    } else if(metasel=='wbregions'){
      sub=sub.replace('dwtreeUN', 'dwtreeWB');
    } else if(metasel=='allcountries'){
      sub=sub.replace('dwtreeUN', 'dwtree');
    } 
    
    window.history.pushState('update','title',sub);
    location.reload();
});

<?php
  include 'inc/con.php'; 
  include 'inc/conint.php'; 
  include 'inc/conregionave.php'; 
  $dset="z".$_GET[p];
  //$cset="z".$_GET[c];
  
  $aes = mysqli_query($con,"SELECT firstyear,lastyear,title,subtitle FROM datasets WHERE id=$_GET[p]");
  while($aow = mysqli_fetch_array($aes)){   
    $fy=$aow['firstyear'];
    $ly=$aow['lastyear'];
    $title=$aow['title'];
    $subtitle=$aow['subtitle'];
  }


  
  echo "window.fy=".$fy.";";
  echo "window.ly=".$ly.";";
  echo "window.title='".$title."';";
  echo "window.subtitle='".$subtitle."';";


  if($_GET[yf]>0&&$_GET[yl]>0){
    $donothing=1;
  } else{
    echo "var sub=window.location.href;";
    echo "sub = sub+'&yf='+fy+'&yl='+ly;";
    echo "window.history.pushState('update','title',sub);";
  }


  echo "$( function() {";
    echo "var handle = $('#custom-handle');";
    echo "$('#slider').slider({";
      echo "value:".$_GET[yl].",";
      echo "min: ".$fy.",";
      echo "max: ".$ly.",";
      echo "step: 1,";
      echo "create: function() {";
        echo "handle.text( $( this ).slider('value') );";
      echo "},";
      echo "slide: function( event, ui ) {";
        echo "var val=ui.value;";
        echo "var sub=window.location.href;";
        echo "sub = sub.substring(0, sub.indexOf('&yl='));";
        echo "sub = sub+'&yl='+val;";
        echo "window.history.pushState('update','title',sub);";        
        echo "handle.text(val);";
        echo "var ts = ui.value;";
        echo "var tv = 'data'+ts;";
        echo "var tbs = 'cat'+ts;";
        
        echo "$('#container').highcharts().series[0].setData(eval(tv));";
      echo "}";
    echo "});";
    echo "$( '#amount' ).val( 'year: ' + $( '#slider' ).slider( 'value' ) );";
  echo "} );";
  $ogfy=$fy;



  for($x=$ogfy;$x<=$ly;$x++){

    if($x==$_GET[yl]){
      if($x==2009){
        echo "var data = [
{id:'55',name:'Northern Africa (UN)',color:''},
{name:'Egypt',parent:'55',color:'',value:29833049249},
{name:'Morocco',parent:'55',color:'',value:14398108501},
{name:'Sudan',parent:'55',color:'',value:2994251445},
{name:'Tunisia',parent:'55',color:'',value:7314818929},

{id:'56',name:'Sub-Saharan Africa (UN)',color:''},
{name:'Burundi',parent:'56',color:'',value:169067238.3},
{name:'Benin',parent:'56',color:'',value:1024807369},
{name:'Burkina Faso',parent:'56',color:'',value:703292472.3},
{name:'Botswana',parent:'56',color:'',value:651606266.9},
{name:'Central African Republic',parent:'56',color:'',value:125895224},
{name:'Ivory Coast',parent:'56',color:'',value:3249439893},
{name:'Cameroon',parent:'56',color:'',value:3500592880},
{name:'Congo (Kinshasa)',parent:'56',color:'',value:4403016205},
{name:'Congo (Brazzaville)',parent:'56',color:'',value:428954442.1},
{name:'Comoros',parent:'56',color:'',value:26418937.83},
{name:'Eritrea',parent:'56',color:'',value:101983739.8},
{name:'Ethiopia',parent:'56',color:'',value:1258653671},
{name:'Gabon',parent:'56',color:'',value:276661987},
{name:'Ghana',parent:'56',color:'',value:1759243399},
{name:'Guinea',parent:'56',color:'',value:310855977.9},
{name:'Gambia',parent:'56',color:'',value:44852471.81},
{name:'Equatorial Guinea',parent:'56',color:'',value:2855353914},
{name:'Kenya',parent:'56',color:'',value:4428224222},
{name:'Liberia',parent:'56',color:'',value:49649800},
{name:'Lesotho',parent:'56',color:'',value:308457474.3},
{name:'Mozambique',parent:'56',color:'',value:1207589768},
{name:'Mauritania',parent:'56',color:'',value:315604176.4},
{name:'Mauritius',parent:'56',color:'',value:1361022284},
{name:'Malawi',parent:'56',color:'',value:642543741.6},
{name:'Namibia',parent:'56',color:'',value:1156632911},
{name:'Niger',parent:'56',color:'',value:271621603.6},
{name:'Nigeria',parent:'56',color:'',value:4112168565},
{name:'Rwanda',parent:'56',color:'',value:323783309.4},
{name:'Senegal',parent:'56',color:'',value:1578658121},
{name:'Sierra Leone',parent:'56',color:'',value:52220400.81},
{name:'Saint Thomas and Principe',parent:'56',color:'',value:17150902.65},
{name:'Swaziland',parent:'56',color:'',value:1245689904},
{name:'Seychelles',parent:'56',color:'',value:66301699.5},
{name:'Chad',parent:'56',color:'',value:92200444.61},
{name:'Togo',parent:'56',color:'',value:250084739.4},
{name:'Tanzania',parent:'56',color:'',value:1967171503},
{name:'Uganda',parent:'56',color:'',value:1531860599},
{name:'South Africa',parent:'56',color:'',value:40319813069},
{name:'Zambia',parent:'56',color:'',value:1331255465},
{name:'Zimbabwe',parent:'56',color:'',value:1066186600},

{id:'57',name:'Latin America &amp; Caribbean (UN)',color:''},
{name:'Aruba',parent:'57',color:'',value:102234636.9},
{name:'Argentina',parent:'57',color:'',value:51890313731},
{name:'Antigua and Barbuda',parent:'57',color:'',value:25319444.44},
{name:'Bahamas',parent:'57',color:'',value:288282000},
{name:'Belize',parent:'57',color:'',value:152852750},
{name:'Bolivia',parent:'57',color:'',value:2014339316},
{name:'Brazil',parent:'57',color:'',value:218000000000},
{name:'Barbados',parent:'57',color:'',value:268900000},
{name:'Chile',parent:'57',color:'',value:19369081230},
{name:'Colombia',parent:'57',color:'',value:30778555963},
{name:'Costa Rica',parent:'57',color:'',value:4351437293},
{name:'Cuba',parent:'57',color:'',value:9061000000},
{name:'Dominica',parent:'57',color:'',value:11340000},
{name:'Dominican Republic',parent:'57',color:'',value:7436880084},
{name:'Ecuador',parent:'57',color:'',value:8677243000},
{name:'Grenada',parent:'57',color:'',value:25570518.52},
{name:'Guatemala',parent:'57',color:'',value:7036831465},
{name:'Guyana',parent:'57',color:'',value:75797989.7},
{name:'Honduras',parent:'57',color:'',value:2425994041},
{name:'Jamaica',parent:'57',color:'',value:988439371.7},
{name:'Saint Kitts and Nevis',parent:'57',color:'',value:55791888.89},
{name:'Saint Lucia',parent:'57',color:'',value:40048629.63},
{name:'Mexico',parent:'57',color:'',value:143000000000},
{name:'Nicaragua',parent:'57',color:'',value:1129830178},
{name:'Panama',parent:'57',color:'',value:1981247000},
{name:'Peru',parent:'57',color:'',value:18477524733},
{name:'Puerto Rico',parent:'57',color:'',value:43872200000},
{name:'Paraguay',parent:'57',color:'',value:1849709004},
{name:'El Salvador',parent:'57',color:'',value:3924790000},
{name:'Suriname',parent:'57',color:'',value:785428051},
{name:'Trinidad and Tobago',parent:'57',color:'',value:1102610318},
{name:'Uruguay',parent:'57',color:'',value:4691704023},
{name:'Saint Vincent and Grenadines',parent:'57',color:'',value:30096666.67},
{name:'Venezuela',parent:'57',color:'',value:44933130187},

{id:'58',name:'Northern America (UN)',color:''},
{name:'Bermuda',parent:'58',color:'',value:76916000},
{name:'Canada',parent:'58',color:'',value:143000000000},
{name:'Greenland',parent:'58',color:'',value:71517842.15},
{name:'United States',parent:'58',color:'',value:1700000000000},

{id:'59',name:'Central Asia (UN)',color:''},
{name:'Kazakhstan',parent:'59',color:'',value:12536534716},
{name:'Kyrgyzstan',parent:'59',color:'',value:667313846.5},
{name:'Tajikistan',parent:'59',color:'',value:637068337.1},

{id:'60',name:'Eastern Asia (UN)',color:''},
{name:'China',parent:'60',color:'',value:1610000000000},
{name:'Hong Kong',parent:'60',color:'',value:3704171934},
{name:'Japan',parent:'60',color:'',value:1000000000000},
{name:'South Korea',parent:'60',color:'',value:235000000000},
{name:'Macau',parent:'60',color:'',value:212166376.5},
{name:'Mongolia',parent:'60',color:'',value:295591962},

{id:'61',name:'South-Eastern Asia (UN)',color:''},
{name:'Brunei',parent:'61',color:'',value:1499243778},
{name:'Indonesia',parent:'61',color:'',value:142000000000},
{name:'Cambodia',parent:'61',color:'',value:1499653481},
{name:'Laos',parent:'61',color:'',value:470791216.7},
{name:'Burma (Myanmar)',parent:'61',color:'',value:6672103210},
{name:'Malaysia',parent:'61',color:'',value:48137502483},
{name:'Philippines',parent:'61',color:'',value:35788616738},
{name:'Singapore',parent:'61',color:'',value:37840220007},
{name:'Thailand',parent:'61',color:'',value:83421970612},
{name:'Timor Leste',parent:'61',color:'',value:12000000},
{name:'Vietnam',parent:'61',color:'',value:19401780477},

{id:'62',name:'Southern Asia (UN)',color:''},
{name:'Afghanistan',parent:'62',color:'',value:1632965082},
{name:'Bangladesh',parent:'62',color:'',value:16888530705},
{name:'Bhutan',parent:'62',color:'',value:103650335.8},
{name:'India',parent:'62',color:'',value:222000000000},
{name:'Iran',parent:'62',color:'',value:48781799703},
{name:'Sri Lanka',parent:'62',color:'',value:7617238883},
{name:'Maldives',parent:'62',color:'',value:92836156.25},
{name:'Nepal',parent:'62',color:'',value:851304330.9},
{name:'Pakistan',parent:'62',color:'',value:21389915450},

{id:'63',name:'Western Asia (UN)',color:''},
{name:'United Arab Emirates',parent:'63',color:'',value:23314635807},
{name:'Armenia',parent:'63',color:'',value:751786553.4},
{name:'Azerbaijan',parent:'63',color:'',value:2447499378},
{name:'Cyprus',parent:'63',color:'',value:1395387608},
{name:'Georgia',parent:'63',color:'',value:1068961389},
{name:'Iraq',parent:'63',color:'',value:2915634103},
{name:'Jordan',parent:'63',color:'',value:4262394366},
{name:'Lebanon',parent:'63',color:'',value:2673300166},
{name:'Oman',parent:'63',color:'',value:5602600780},
{name:'West Bank and Gaza',parent:'63',color:'',value:871400000},
{name:'Qatar',parent:'63',color:'',value:13328220687},
{name:'Saudi Arabia',parent:'63',color:'',value:46560000000},
{name:'Turkey',parent:'63',color:'',value:97703425895},
{name:'Yemen',parent:'63',color:'',value:2368448686},
{name:'Bahrain',parent:'63',color:'',value:3549898049.6667},

{id:'64',name:'Eastern Europe (UN)',color:''},
{name:'Bulgaria',parent:'64',color:'',value:6615838487},
{name:'Belarus',parent:'64',color:'',value:11745944182},
{name:'Czech Republic',parent:'64',color:'',value:42625190159},
{name:'Hungary',parent:'64',color:'',value:22362622238},
{name:'Moldova',parent:'64',color:'',value:575248253.8},
{name:'Poland',parent:'64',color:'',value:72347040159},
{name:'Romania',parent:'64',color:'',value:32512019152},
{name:'Russia',parent:'64',color:'',value:158000000000},
{name:'Slovakia',parent:'64',color:'',value:14296292026},
{name:'Ukraine',parent:'64',color:'',value:18210031831},

{id:'65',name:'Northern Europe (UN)',color:''},
{name:'Denmark',parent:'65',color:'',value:35674047268},
{name:'Estonia',parent:'65',color:'',value:2410233537},
{name:'Finland',parent:'65',color:'',value:42083912198},
{name:'Faroe Islands',parent:'65',color:'',value:136358548.9},
{name:'United Kingdom',parent:'65',color:'',value:208000000000},
{name:'Ireland',parent:'65',color:'',value:47991719922},
{name:'Iceland',parent:'65',color:'',value:1432233028},
{name:'Lithuania',parent:'65',color:'',value:5651023909},
{name:'Latvia',parent:'65',color:'',value:2573723937},
{name:'Norway',parent:'65',color:'',value:28372056041},
{name:'Sweden',parent:'65',color:'',value:65312524498},

{id:'66',name:'Southern Europe (UN)',color:''},
{name:'Albania',parent:'66',color:'',value:626007024.8},
{name:'Andorra',parent:'66',color:'',value:121311475.4},
{name:'Bosnia and Herzegovina',parent:'66',color:'',value:1843255203},
{name:'Spain',parent:'66',color:'',value:184000000000},
{name:'Greece',parent:'66',color:'',value:25210365518},
{name:'Croatia',parent:'66',color:'',value:7812231760},
{name:'Italy',parent:'66',color:'',value:300000000000},
{name:'Macedonia (F.Y.R.O.M.)',parent:'66',color:'',value:829898005.9},
{name:'Malta',parent:'66',color:'',value:956237843.8},
{name:'Montenegro',parent:'66',color:'',value:202543762.2},
{name:'Portugal',parent:'66',color:'',value:27131706029},
{name:'Serbia',parent:'66',color:'',value:5951033285},
{name:'Slovenia',parent:'66',color:'',value:8597452070},

{id:'67',name:'Western Europe (UN)',color:''},
{name:'Austria',parent:'67',color:'',value:65343803834},
{name:'Belgium',parent:'67',color:'',value:62032509030},
{name:'Switzerland',parent:'67',color:'',value:99261827589},
{name:'Germany',parent:'67',color:'',value:611000000000},
{name:'France',parent:'67',color:'',value:280000000000},
{name:'Luxembourg',parent:'67',color:'',value:2455547374},
{name:'Netherlands',parent:'67',color:'',value:90309808280},

{id:'68',name:'Australia &amp; New Zealand (UN)',color:''},
{name:'Australia',parent:'68',color:'',value:78490649389},
{name:'New Zealand',parent:'68',color:'',value:13070148042},

{id:'69',name:'Melanesia (UN)',color:''},
{name:'Fiji',parent:'69',color:'',value:353170373.8},
{name:'Vanuatu',parent:'69',color:'',value:17434757.84},

{id:'70',name:'Micronesia (UN)',color:''},
{name:'Micronesia',parent:'70',color:'',value:1200000},
{name:'Kiribati',parent:'70',color:'',value:6606925.597},
{name:'Marshall Islands',parent:'70',color:'',value:1064700},

{id:'71',name:'Polynesia (UN)',color:''},
{name:'Tonga',parent:'71',color:'',value:20758402.45},
{name:'Tuvalu',parent:'71',color:'',value:288566.5263},
{name:'Samoa',parent:'71',color:'',value:65205988.45},
];";
      } else{
        echo "var data = [";
        $bes = mysqli_query($con,"SELECT * FROM regions WHERE metaregion='UN'");
        while($bow = mysqli_fetch_array($bes)){   
          $cou=0;
          $rid=$bow['rid'];
          $region=$bow['region'];
          $color=$bow['color'];
          $metaregion=$bow['metaregion'];

          $ces = mysqli_query($conint,"SELECT * FROM interpolate.$dset INNER JOIN custom.zaliases ON $dset.cid=zaliases.cid WHERE year=$x AND rid=$rid");
          while($cow = mysqli_fetch_array($ces)){  
            if($cou==0){
              echo "{id:'".$rid."',name:'".$region."',color:'".$color."'},";
              $cou++;
            }
            $valll=$cow['value'];
            $connn=$cow['country'];   
            echo "{name:'".$connn."',parent:'".$rid."',color:'".$color."',value:".$valll."},";    
          }   

        }
        echo "];";
      }


    }

    echo "window.timer".$x."=1;";
    if($x==2009){
      echo "var data2009 = [
{id:'55',name:'Northern Africa (UN)',color:''},
{name:'Egypt',parent:'55',color:'',value:29833049249},
{name:'Morocco',parent:'55',color:'',value:14398108501},
{name:'Sudan',parent:'55',color:'',value:2994251445},
{name:'Tunisia',parent:'55',color:'',value:7314818929},

{id:'56',name:'Sub-Saharan Africa (UN)',color:''},
{name:'Burundi',parent:'56',color:'',value:169067238.3},
{name:'Benin',parent:'56',color:'',value:1024807369},
{name:'Burkina Faso',parent:'56',color:'',value:703292472.3},
{name:'Botswana',parent:'56',color:'',value:651606266.9},
{name:'Central African Republic',parent:'56',color:'',value:125895224},
{name:'Ivory Coast',parent:'56',color:'',value:3249439893},
{name:'Cameroon',parent:'56',color:'',value:3500592880},
{name:'Congo (Kinshasa)',parent:'56',color:'',value:4403016205},
{name:'Congo (Brazzaville)',parent:'56',color:'',value:428954442.1},
{name:'Comoros',parent:'56',color:'',value:26418937.83},
{name:'Eritrea',parent:'56',color:'',value:101983739.8},
{name:'Ethiopia',parent:'56',color:'',value:1258653671},
{name:'Gabon',parent:'56',color:'',value:276661987},
{name:'Ghana',parent:'56',color:'',value:1759243399},
{name:'Guinea',parent:'56',color:'',value:310855977.9},
{name:'Gambia',parent:'56',color:'',value:44852471.81},
{name:'Equatorial Guinea',parent:'56',color:'',value:2855353914},
{name:'Kenya',parent:'56',color:'',value:4428224222},
{name:'Liberia',parent:'56',color:'',value:49649800},
{name:'Lesotho',parent:'56',color:'',value:308457474.3},
{name:'Mozambique',parent:'56',color:'',value:1207589768},
{name:'Mauritania',parent:'56',color:'',value:315604176.4},
{name:'Mauritius',parent:'56',color:'',value:1361022284},
{name:'Malawi',parent:'56',color:'',value:642543741.6},
{name:'Namibia',parent:'56',color:'',value:1156632911},
{name:'Niger',parent:'56',color:'',value:271621603.6},
{name:'Nigeria',parent:'56',color:'',value:4112168565},
{name:'Rwanda',parent:'56',color:'',value:323783309.4},
{name:'Senegal',parent:'56',color:'',value:1578658121},
{name:'Sierra Leone',parent:'56',color:'',value:52220400.81},
{name:'Saint Thomas and Principe',parent:'56',color:'',value:17150902.65},
{name:'Swaziland',parent:'56',color:'',value:1245689904},
{name:'Seychelles',parent:'56',color:'',value:66301699.5},
{name:'Chad',parent:'56',color:'',value:92200444.61},
{name:'Togo',parent:'56',color:'',value:250084739.4},
{name:'Tanzania',parent:'56',color:'',value:1967171503},
{name:'Uganda',parent:'56',color:'',value:1531860599},
{name:'South Africa',parent:'56',color:'',value:40319813069},
{name:'Zambia',parent:'56',color:'',value:1331255465},
{name:'Zimbabwe',parent:'56',color:'',value:1066186600},

{id:'57',name:'Latin America &amp; Caribbean (UN)',color:''},
{name:'Aruba',parent:'57',color:'',value:102234636.9},
{name:'Argentina',parent:'57',color:'',value:51890313731},
{name:'Antigua and Barbuda',parent:'57',color:'',value:25319444.44},
{name:'Bahamas',parent:'57',color:'',value:288282000},
{name:'Belize',parent:'57',color:'',value:152852750},
{name:'Bolivia',parent:'57',color:'',value:2014339316},
{name:'Brazil',parent:'57',color:'',value:218000000000},
{name:'Barbados',parent:'57',color:'',value:268900000},
{name:'Chile',parent:'57',color:'',value:19369081230},
{name:'Colombia',parent:'57',color:'',value:30778555963},
{name:'Costa Rica',parent:'57',color:'',value:4351437293},
{name:'Cuba',parent:'57',color:'',value:9061000000},
{name:'Dominica',parent:'57',color:'',value:11340000},
{name:'Dominican Republic',parent:'57',color:'',value:7436880084},
{name:'Ecuador',parent:'57',color:'',value:8677243000},
{name:'Grenada',parent:'57',color:'',value:25570518.52},
{name:'Guatemala',parent:'57',color:'',value:7036831465},
{name:'Guyana',parent:'57',color:'',value:75797989.7},
{name:'Honduras',parent:'57',color:'',value:2425994041},
{name:'Jamaica',parent:'57',color:'',value:988439371.7},
{name:'Saint Kitts and Nevis',parent:'57',color:'',value:55791888.89},
{name:'Saint Lucia',parent:'57',color:'',value:40048629.63},
{name:'Mexico',parent:'57',color:'',value:143000000000},
{name:'Nicaragua',parent:'57',color:'',value:1129830178},
{name:'Panama',parent:'57',color:'',value:1981247000},
{name:'Peru',parent:'57',color:'',value:18477524733},
{name:'Puerto Rico',parent:'57',color:'',value:43872200000},
{name:'Paraguay',parent:'57',color:'',value:1849709004},
{name:'El Salvador',parent:'57',color:'',value:3924790000},
{name:'Suriname',parent:'57',color:'',value:785428051},
{name:'Trinidad and Tobago',parent:'57',color:'',value:1102610318},
{name:'Uruguay',parent:'57',color:'',value:4691704023},
{name:'Saint Vincent and Grenadines',parent:'57',color:'',value:30096666.67},
{name:'Venezuela',parent:'57',color:'',value:44933130187},

{id:'58',name:'Northern America (UN)',color:''},
{name:'Bermuda',parent:'58',color:'',value:76916000},
{name:'Canada',parent:'58',color:'',value:143000000000},
{name:'Greenland',parent:'58',color:'',value:71517842.15},
{name:'United States',parent:'58',color:'',value:1700000000000},

{id:'59',name:'Central Asia (UN)',color:''},
{name:'Kazakhstan',parent:'59',color:'',value:12536534716},
{name:'Kyrgyzstan',parent:'59',color:'',value:667313846.5},
{name:'Tajikistan',parent:'59',color:'',value:637068337.1},

{id:'60',name:'Eastern Asia (UN)',color:''},
{name:'China',parent:'60',color:'',value:1610000000000},
{name:'Hong Kong',parent:'60',color:'',value:3704171934},
{name:'Japan',parent:'60',color:'',value:1000000000000},
{name:'South Korea',parent:'60',color:'',value:235000000000},
{name:'Macau',parent:'60',color:'',value:212166376.5},
{name:'Mongolia',parent:'60',color:'',value:295591962},

{id:'61',name:'South-Eastern Asia (UN)',color:''},
{name:'Brunei',parent:'61',color:'',value:1499243778},
{name:'Indonesia',parent:'61',color:'',value:142000000000},
{name:'Cambodia',parent:'61',color:'',value:1499653481},
{name:'Laos',parent:'61',color:'',value:470791216.7},
{name:'Burma (Myanmar)',parent:'61',color:'',value:6672103210},
{name:'Malaysia',parent:'61',color:'',value:48137502483},
{name:'Philippines',parent:'61',color:'',value:35788616738},
{name:'Singapore',parent:'61',color:'',value:37840220007},
{name:'Thailand',parent:'61',color:'',value:83421970612},
{name:'Timor Leste',parent:'61',color:'',value:12000000},
{name:'Vietnam',parent:'61',color:'',value:19401780477},

{id:'62',name:'Southern Asia (UN)',color:''},
{name:'Afghanistan',parent:'62',color:'',value:1632965082},
{name:'Bangladesh',parent:'62',color:'',value:16888530705},
{name:'Bhutan',parent:'62',color:'',value:103650335.8},
{name:'India',parent:'62',color:'',value:222000000000},
{name:'Iran',parent:'62',color:'',value:48781799703},
{name:'Sri Lanka',parent:'62',color:'',value:7617238883},
{name:'Maldives',parent:'62',color:'',value:92836156.25},
{name:'Nepal',parent:'62',color:'',value:851304330.9},
{name:'Pakistan',parent:'62',color:'',value:21389915450},

{id:'63',name:'Western Asia (UN)',color:''},
{name:'United Arab Emirates',parent:'63',color:'',value:23314635807},
{name:'Armenia',parent:'63',color:'',value:751786553.4},
{name:'Azerbaijan',parent:'63',color:'',value:2447499378},
{name:'Cyprus',parent:'63',color:'',value:1395387608},
{name:'Georgia',parent:'63',color:'',value:1068961389},
{name:'Iraq',parent:'63',color:'',value:2915634103},
{name:'Jordan',parent:'63',color:'',value:4262394366},
{name:'Lebanon',parent:'63',color:'',value:2673300166},
{name:'Oman',parent:'63',color:'',value:5602600780},
{name:'West Bank and Gaza',parent:'63',color:'',value:871400000},
{name:'Qatar',parent:'63',color:'',value:13328220687},
{name:'Saudi Arabia',parent:'63',color:'',value:46560000000},
{name:'Turkey',parent:'63',color:'',value:97703425895},
{name:'Yemen',parent:'63',color:'',value:2368448686},
{name:'Bahrain',parent:'63',color:'',value:3549898049.6667},

{id:'64',name:'Eastern Europe (UN)',color:''},
{name:'Bulgaria',parent:'64',color:'',value:6615838487},
{name:'Belarus',parent:'64',color:'',value:11745944182},
{name:'Czech Republic',parent:'64',color:'',value:42625190159},
{name:'Hungary',parent:'64',color:'',value:22362622238},
{name:'Moldova',parent:'64',color:'',value:575248253.8},
{name:'Poland',parent:'64',color:'',value:72347040159},
{name:'Romania',parent:'64',color:'',value:32512019152},
{name:'Russia',parent:'64',color:'',value:158000000000},
{name:'Slovakia',parent:'64',color:'',value:14296292026},
{name:'Ukraine',parent:'64',color:'',value:18210031831},

{id:'65',name:'Northern Europe (UN)',color:''},
{name:'Denmark',parent:'65',color:'',value:35674047268},
{name:'Estonia',parent:'65',color:'',value:2410233537},
{name:'Finland',parent:'65',color:'',value:42083912198},
{name:'Faroe Islands',parent:'65',color:'',value:136358548.9},
{name:'United Kingdom',parent:'65',color:'',value:208000000000},
{name:'Ireland',parent:'65',color:'',value:47991719922},
{name:'Iceland',parent:'65',color:'',value:1432233028},
{name:'Lithuania',parent:'65',color:'',value:5651023909},
{name:'Latvia',parent:'65',color:'',value:2573723937},
{name:'Norway',parent:'65',color:'',value:28372056041},
{name:'Sweden',parent:'65',color:'',value:65312524498},

{id:'66',name:'Southern Europe (UN)',color:''},
{name:'Albania',parent:'66',color:'',value:626007024.8},
{name:'Andorra',parent:'66',color:'',value:121311475.4},
{name:'Bosnia and Herzegovina',parent:'66',color:'',value:1843255203},
{name:'Spain',parent:'66',color:'',value:184000000000},
{name:'Greece',parent:'66',color:'',value:25210365518},
{name:'Croatia',parent:'66',color:'',value:7812231760},
{name:'Italy',parent:'66',color:'',value:300000000000},
{name:'Macedonia (F.Y.R.O.M.)',parent:'66',color:'',value:829898005.9},
{name:'Malta',parent:'66',color:'',value:956237843.8},
{name:'Montenegro',parent:'66',color:'',value:202543762.2},
{name:'Portugal',parent:'66',color:'',value:27131706029},
{name:'Serbia',parent:'66',color:'',value:5951033285},
{name:'Slovenia',parent:'66',color:'',value:8597452070},

{id:'67',name:'Western Europe (UN)',color:''},
{name:'Austria',parent:'67',color:'',value:65343803834},
{name:'Belgium',parent:'67',color:'',value:62032509030},
{name:'Switzerland',parent:'67',color:'',value:99261827589},
{name:'Germany',parent:'67',color:'',value:611000000000},
{name:'France',parent:'67',color:'',value:280000000000},
{name:'Luxembourg',parent:'67',color:'',value:2455547374},
{name:'Netherlands',parent:'67',color:'',value:90309808280},

{id:'68',name:'Australia &amp; New Zealand (UN)',color:''},
{name:'Australia',parent:'68',color:'',value:78490649389},
{name:'New Zealand',parent:'68',color:'',value:13070148042},

{id:'69',name:'Melanesia (UN)',color:''},
{name:'Fiji',parent:'69',color:'',value:353170373.8},
{name:'Vanuatu',parent:'69',color:'',value:17434757.84},

{id:'70',name:'Micronesia (UN)',color:''},
{name:'Micronesia',parent:'70',color:'',value:1200000},
{name:'Kiribati',parent:'70',color:'',value:6606925.597},
{name:'Marshall Islands',parent:'70',color:'',value:1064700},

{id:'71',name:'Polynesia (UN)',color:''},
{name:'Tonga',parent:'71',color:'',value:20758402.45},
{name:'Tuvalu',parent:'71',color:'',value:288566.5263},
{name:'Samoa',parent:'71',color:'',value:65205988.45},
];";
    } else{
      echo "var data".$x." = [";
      $bes = mysqli_query($con,"SELECT * FROM regions WHERE metaregion='UN'");
      while($bow = mysqli_fetch_array($bes)){   
        $cou=0;
        $rid=$bow['rid'];
        $region=$bow['region'];
        $color=$bow['color'];
        $metaregion=$bow['metaregion'];

        $ces = mysqli_query($conint,"SELECT * FROM interpolate.$dset INNER JOIN custom.zaliases ON $dset.cid=zaliases.cid WHERE year=$x AND rid=$rid");
        while($cow = mysqli_fetch_array($ces)){  
          if($cou==0){
            echo "{id:'".$rid."',name:'".$region."',color:'".$color."'},";
            $cou++;
          }
          $valll=$cow['value'];
          $connn=$cow['country'];   
          echo "{name:'".$connn."',parent:'".$rid."',color:'".$color."',value:".$valll."},";    
        }   

      }
      echo "];";      
    }



  }


mysqli_close($con);
mysqli_close($conint);
?>

    
var time=0;
var start=0;
$(document).on('click', '.playfa', function(){
  stopnow=0;
  $('.playfa').css('display','none')
  $('.stopfa').css('display','block');
  var tempfy=fy;

  <?php 
  include 'inc/con.php';   
  $aes = mysqli_query($con,"SELECT firstyear,lastyear FROM datasets WHERE id=$_GET[p]");
  while($aow = mysqli_fetch_array($aes)){   
    $fy=$aow['firstyear'];
    $ffy=$fy;
    $ly=$aow['lastyear'];
  }

  $tempval=0;

  $increment = 15000/($ly-$fy);

  while($fy<=$ly){
    echo "window.timer".$fy." = setTimeout(function(){";  
      echo "if(stopnow==0){";
        echo "var val=".$fy.";";
        echo "var sub=window.location.href;";
        echo "sub = sub.substring(0, sub.indexOf('&yl='));";
        echo "sub = sub+'&yl='+val;";
        echo "window.history.pushState('update','title',sub);";

        echo "$('#slider').slider('value',tempfy);";
        echo "$('#custom-handle').text(tempfy);";
        echo "var tempoo = 'data'+tempfy;";
        echo "$('#container').highcharts().series[0].setData(eval(tempoo));";
        echo "tempfy++;";
        if($fy==$ly){
          echo "$('.playfa').css('display','block');";
          echo "$('.stopfa').css('display','none');";
        }
      echo "} else{return false;}";
    echo "}, ".$tempval.");";

    $tempval=$tempval+$increment;
    $fy++;
  }

echo "});";

echo "$(document).on('click', '.stopfa', function(){";
  echo "stopnow=1;";
  while($ffy<=$ly){
    echo "clearTimeout(timer".$ffy.");";
    $ffy++;
  }

  echo "$('.playfa').css('display','block');";
  echo "$('.stopfa').css('display','none');";
echo "});";

mysqli_close($con);
?>

    


Highcharts.chart('container', {
    credits: {enabled:false},
    series: [{
      type: 'treemap',
      layoutAlgorithm: 'squarified',
      allowDrillToNode: true,
      alternateStartingDirection: true,
      dataLabels: {
              enabled: false
          },
      levels: [{
          level: 1,
          layoutAlgorithm: 'squarified',
          dataLabels: {
              enabled: true,
              align: 'left',
              verticalAlign: 'top',
              style: {
                  fontWeight: 'bold',
                  fontSize: '22px'
              }
          }
      }, {
          level: 2,
          layoutAlgorithm: 'squarified',
          dataLabels: {
              enabled: true
          }
      }],
      //data:imfdata2016
      data: data
    }],
    title: {
        text: ''
    },
    chart:{
        animation:false,
        type:'treemap',
        backgroundColor:'#f7f7f7',
        style:{
          fontFamily:'ProximaNova-Regular',
          fontColor:'#333',
          spacingBottom:700,
        }
    }
});


});</script>
<script src='cjs/srcbtm.js'></script>
</body>
</html>

