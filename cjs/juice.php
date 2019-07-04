var chart = $('.bar-chart-1').highcharts();
var a=0; var b=0; var c=0; var d=0; var e=0; var f=0;
var aa=0; var bb=0; var cc=0; var dd=0; var ee=0; var ff=0;
var aaa=0; var bbb=0; var ccc=0; var ddd=0; var eee=0; var fff=0;
var at=0;var bt=0; var ct=0; var dt=0; var et=0; var ft=0;

var y1;var y2;var y3;var y4;var y5;var y6;
var z1;var z2;var z3;var z4;var z5;var z6;

if(result[0]>100){at=105;}else{at=result[0];}
if(result[1]>100){bt=105;}else{bt=result[1];}
if(result[2]>100){ct=105;}else{ct=result[2];}
if(result[3]>100){dt=105;}else{dt=result[3];}
if(result[4]>100){et=105;}else{et=result[4];}
if(result[5]>100){ft=105;}else{ft=result[5];}


if(result[6]==null){a='N/A';}else{a=result[0];}
if(result[7]==null){b='N/A';}else{b=result[1];}
if(result[8]==null){c='N/A';}else{c=result[2];}
if(result[9]==null){d='N/A';}else{d=result[3];}
if(result[10]==null){e='N/A';}else{e=result[4];}
if(result[11]==null){f='N/A';}else{f=result[5];}
//chart.series[0].data[0].update(at);
y1=' ('+result[6]+' - '+result[12]+')';
y2=' ('+result[7]+' - '+result[13]+')';
y3=' ('+result[8]+' - '+result[14]+')';
y4=' ('+result[9]+' - '+result[15]+')';
y5=' ('+result[10]+' - '+result[16]+')';
y6=' ('+result[11]+' - '+result[17]+')';

z1=' ('+result[30]+' - '+result[36]+')';
z2=' ('+result[31]+' - '+result[37]+')';
z3=' ('+result[32]+' - '+result[38]+')';
z4=' ('+result[33]+' - '+result[39]+')';
z5=' ('+result[34]+' - '+result[40]+')';
z6=' ('+result[35]+' - '+result[41]+')';
var data = [{y:at,myData:a,myYear:y1,myDef:window.def1,color:'#2099bc'},
            {y:bt,myData:b,myYear:y2,myDef:window.def2,color:'#ff6c00'},
            {y:ct,myData:c,myYear:y3,myDef:window.def3,color:'#59a118'},
            {y:dt,myData:d,myYear:y4,myDef:window.def4,color:'#ffcc00'},
            {y:et,myData:e,myYear:y5,myDef:window.def5,color:'#0a8b89'},
            {y:ft,myData:f,myYear:y6,myDef:window.def6,color:'#3e4bf2'}];

$('.bar-chart-1').highcharts().series[0].setData(data);

chart.setTitle({text: "This is how much "+firCountry+" has changed since I was born"});           
chart.series[0].update({
  name: firCountry
});

var chart1 = $('.bar-chart-2').highcharts();
var aat=0;var bbt=0; var cct=0; var ddt=0; var eet=0; var fft=0;
var aaat=0;var bbbt=0; var ccct=0; var dddt=0; var eeet=0; var ffft=0;
if(result[66]>100){aat=105;}else{aat=result[66];}
if(result[67]>100){bbt=105;}else{bbt=result[67];}
if(result[68]>100){cct=105;}else{cct=result[68];}
if(result[69]>100){ddt=105;}else{ddt=result[69];}
if(result[70]>100){eet=105;}else{eet=result[70];}
if(result[71]>100){fft=105;}else{fft=result[71];}

if(result[6]==null){aa='N/A';}else{aa=result[66];}
if(result[7]==null){bb='N/A';}else{bb=result[67];}
if(result[8]==null){cc='N/A';}else{cc=result[68];}
if(result[9]==null){dd='N/A';}else{dd=result[69];}
if(result[10]==null){ee='N/A';}else{ee=result[70];}
if(result[11]==null){ff='N/A';}else{ff=result[71];}
var data1 =[{y:aat,myData:aa,myYear:z1,myDef:window.def1,color:'#2099bc'},
            {y:bbt,myData:bb,myYear:z2,myDef:window.def2,color:'#ff6c00'},
            {y:cct,myData:cc,myYear:z3,myDef:window.def3,color:'#59a118'},
            {y:ddt,myData:dd,myYear:z4,myDef:window.def4,color:'#ffcc00'},
            {y:eet,myData:ee,myYear:z5,myDef:window.def5,color:'#0a8b89'},
            {y:fft,myData:ff,myYear:z6,myDef:window.def6,color:'#3e4bf2'}];
$('.bar-chart-2').highcharts().series[0].setData(data1);

if(result[72]>100){aaat=105;}else{aaat=result[72];}
if(result[73]>100){bbbt=105;}else{bbbt=result[73];}
if(result[74]>100){ccct=105;}else{ccct=result[74];}
if(result[75]>100){dddt=105;}else{dddt=result[75];}
if(result[76]>100){eeet=105;}else{eeet=result[76];}
if(result[77]>100){ffft=105;}else{ffft=result[77];}

if(result[78]==null){aaa='N/A';}else{aaa=result[72];}
if(result[79]==null){bbb='N/A';}else{bbb=result[73];}
if(result[80]==null){ccc='N/A';}else{ccc=result[74];}
if(result[81]==null){ddd='N/A';}else{ddd=result[75];}
if(result[82]==null){eee='N/A';}else{eee=result[76];}
if(result[83]==null){fff='N/A';}else{fff=result[77];}
var data2 =[{y:aaat,myData:aaa,myDef:window.def1,myYear:z1},
            {y:bbbt,myData:bbb,myDef:window.def2,myYear:z2},
            {y:ccct,myData:ccc,myDef:window.def3,myYear:z3},
            {y:dddt,myData:ddd,myDef:window.def4,myYear:z4},
            {y:eeet,myData:eee,myDef:window.def5,myYear:z5},
            {y:ffft,myData:fff,myDef:window.def6,myYear:z6}];
$('.bar-chart-2').highcharts().series[1].setData(data2);
chart1.setTitle({text: "This is how much "+firCountry+" and "+secCountry+" have changed since I was born"});

chart1.series[0].update({
  name: firCountry
});

chart1.series[1].update({
  name: secCountry
});


$('.country1').text(firCountry);
$('.country2').text(secCountry);

for (i = 0; i < 6; i++){
    var j=i+1;var k=i+6;var l=i+12;var m=i+18;var n=i+24;var o=i+30;var p=i+36;
    var q=i+42;var r=i+48;var s=i+54;var t=i+60;var u=i+66;var v=i+72;var w=i+78;

    if(result[i]>=0){
        $('.im'+j+'').text(ac(result[i])+'% Improvement');                        
    } else{
        $('.im'+j+'').text(ac(result[i])+'% Deterioration');
    }

    if(result[u]>=0){
        $('.imUno'+j+'').text(ac(result[u])+'% Improvement');                        
    } else{
        $('.imUno'+j+'').text(ac(result[u])+'% Deterioration');
    }
    if(result[v]>=0){
        $('.imDos'+j+'').text(ac(result[v])+'% Improvement');                        
    } else{
        $('.imDos'+j+'').text(ac(result[v])+'% Deterioration');
    }

    if(result[k]==null){
        $('.yb'+j+'').text('N/A');   
        $('.yc'+j+'').text('');
        $('.by'+j+'').text('');
        $('.cy'+j+'').text('');
        $('.im'+j+'').text('N/A');
        
        $('.ybUno'+j+'').text('N/A');
        $('.ycUno'+j+'').text('');
        $('.byUno'+j+'').text('');
        $('.cyUno'+j+'').text('');
        $('.imUno'+j+'').text('N/A');                   
    } else{
        $('.yb'+j+'').text(result[k]+':');
        $('.yc'+j+'').text(result[l]+':');
        $('.by'+j+'').text(ac(result[m]));
        $('.cy'+j+'').text(ac(result[n]));    
        $('.ybUno'+j+'').text(result[o]+':');
        $('.ycUno'+j+'').text(result[p]+':');   
        $('.byUno'+j+'').text(ac(result[q]));
        $('.cyUno'+j+'').text(ac(result[r]));                 
    }

    if(result[w]==null){
        $('.yb'+j+'').text('N/A');   
        $('.yc'+j+'').text('');
        $('.by'+j+'').text('');
        $('.cy'+j+'').text('');
        $('.im'+j+'').text('N/A');
        
        $('.ybDos'+j+'').text('N/A');
        $('.ycDos'+j+'').text('');
        $('.byDos'+j+'').text('');
        $('.cyDos'+j+'').text('');           
        $('.imDos'+j+'').text('N/A');          
    } else{
        $('.ybDos'+j+'').text(result[o]+':');
        $('.ycDos'+j+'').text(result[p]+':');   
        $('.byDos'+j+'').text(ac(result[s]));
        $('.cyDos'+j+'').text(ac(result[t]));
    }
}

$("section:contains('"+window.dc1+"')").css('cursor','pointer').attr('data-pt-title',window.def1).attr('data-pt-scheme','black').attr('data-pt-position','top').attr('data-pt-size','small').click(function(){window.open('http://humanprogress.org/story/'+window.dn1+'','_blank');});
$("section:contains('"+window.dc2+"')").css('cursor','pointer').attr('data-pt-title',window.def2).attr('data-pt-scheme','black').attr('data-pt-position','top').attr('data-pt-size','small').click(function(){window.open('http://humanprogress.org/story/'+window.dn2+'','_blank');});
$("section:contains('"+window.dc3+"')").css('cursor','pointer').attr('data-pt-title',window.def3).attr('data-pt-scheme','black').attr('data-pt-position','top').attr('data-pt-size','small').click(function(){window.open('http://humanprogress.org/story/'+window.dn3+'','_blank');});
$("section:contains('"+window.dc4+"')").css('cursor','pointer').attr('data-pt-title',window.def4).attr('data-pt-scheme','black').attr('data-pt-position','top').attr('data-pt-size','small').click(function(){window.open('http://humanprogress.org/story/'+window.dn4+'','_blank');});
$("section:contains('"+window.dc5+"')").css('cursor','pointer').attr('data-pt-title',window.def5).attr('data-pt-scheme','black').attr('data-pt-position','top').attr('data-pt-size','small').click(function(){window.open('http://humanprogress.org/story/'+window.dn5+'','_blank');});
$("section:contains('"+window.dc6+"')").css('cursor','pointer').attr('data-pt-title',window.def6).attr('data-pt-scheme','black').attr('data-pt-position','top').attr('data-pt-size','small').click(function(){window.open('http://humanprogress.org/story/'+window.dn6+'','_blank');});