<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>HumanProgress</title>
    <meta name='description' content=''>
    <meta name='viewport' content='initial-scale=1.0, user-scalable=no'>  
    <!--<link rel="stylesheet" href='font/jqueryui.css'>
    <link rel='stylesheet' href='font/black-tie.min.css'>-->
    <link rel='stylesheet' href='font/fa.css'>
    <link rel='stylesheet' href='font/animate.css'>
    <?php 
        $randal=rand(1,999);
        echo "<link rel='stylesheet' type='text/css' href='css/style.css?version=".$randal."'>";
    ?>
    <script src='js/jquery.js'></script>
    <script src='js/jqueryui.js'></script>
    <script src='js/jquery.waypoints.min.js'></script>
    <!--<script src='js/jquery.mockjax.js'></script>-->
    <!--<script src='js/jquery.autocomplete.js'></script>
    <script src='js/countries.js'></script>
    <script src='js/datasets.js'></script>
    <script src='js/auto.js'></script>-->
    <!--<script src='js/highcharts1.js'></script>-->
    <!--<script src='js/highcharts-more.js'></script>-->
    <!--<script src='js/broken-axis.js'></script>-->
    <!--TYPEKIT-->
  <!--<script src='https://use.typekit.net/nix7gvu.js'></script>
  <script>try{Typekit.load({ async: true });}catch(e){}</script>-->
  <!--<meta property="og:url"           content="http://72.32.118.0/article.php?p=5" />
  <meta property="og:type"          content="website" />
  <meta property="og:title"         content="Does CRISPR/CAS9 gene editing technology hold key to eternal life?" />
  <meta property="og:description"   content="Phasellus eget nisl ut elit porta ullamcorper" />
  <meta property="og:image"         content="http://72.32.118.0/admin/uploads/image/crispr.jpg" />-->
</head>
<body>

<script>
  /*window.fbAsyncInit = function() {
    FB.init({
      appId      : '141077403041619',
      xfbml      : true,
      version    : 'v2.7'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

  function share() {
    
  FB.ui({
    method: 'share',
    href: window.url,
    title: window.artext,
    description: window.sutext,
    background:'white',
    //picture: 'http://yourlifeinnumbers.org/upl/'+window.uni+'.png',

  }, function(response){});
  }*/


    /*twttr.events.bind('tweet', function (event) {
        alert('something');
    });*/
</script>

<div class='right'>
  <!--<a href='ylin' class='right-ylin'><i class='fa fa-user'></i> Your Life In Numbers</a>-->
  <a href='index' class='right-index'><i class='fa fa-home'></i> Home</a>
  <a class='right-search'><i class='fa fa-search'></i> Search</a>
  <a href='dws' class='right-dw'><i class='fa fa-globe'></i> Find Data</a>
  <a href='contentall' class='right-browse'><i class='fa fa-file'></i> Browse Content</a>
  <a href='about' class='right-about'><i class='fa fa-info-circle'></i> About Us</a>
  <a class='right-contact'><i class='fa fa-envelope'></i> Contact</a>
  <!--<a class='nav-soc facebook1' target='_blank' href='https://www.facebook.com/HumanProgress.org'><i class='fa fa-facebook'></i></a>
  <a class='nav-soc twitter1' target='_blank' href='https://twitter.com/humanprogress'><i class='fa fa-twitter'></i></a>
  <a class='nav-soc reddit1' target='_blank' href='https://www.reddit.com/domain/humanprogress.org/'><i class='fa fa-reddit'></i></a>
  <a class='nav-soc rss1' target='_blank' href='http://www.cato.org/ecommunity/rss'><i class='fa fa-rss'></i></a>-->
</div>

<script type='text/javascript'>$(document).ready(function() {


$('.bars-cover').click(function(){
    $('.bars-head span').trigger('click');
});

$('.menu-txt').click(function(){
    $('.bars-head span').trigger('click');
});

$('.bars-head').click(function(){
    if($('.right').hasClass('slideInRight')) {
        $('.right').removeClass('slideInRight');
        $('.right').addClass('slideOutRight');
        $('.bars-head span').addClass('overafter');
    }else{
        $('.right').show();
        $('.right').removeClass('animated slideOutRight');
        $('.right').addClass('animated slideInRight');
        $('.bars-head span').removeClass('overafter');
    }
});
/*$('.search-head').click(function(){
    if($('.search-head-in').hasClass('fadeInRight')) {

    }else{
      $('.search-head-in').css('display','block');
      $('.search-head-in').removeClass('animated fadeOutRight');
      $('.search-head-in').addClass('animated fadeInRight');
    }
});*/
$('.search-head').click(function(){
  $('.search-head').hide();
  $('.close-head').show();
  $('.search-head-in').css('display','block');
  $('.search-head-in').removeClass('animated fadeOutUp');
  $('.search-head-in').addClass('animated fadeInUp');
  $('.search-head-in').focus();
});

$('.close-head').click(function(){
  $('.search-head').show();
  $('.close-head').hide();
  $('.search-head-in').removeClass('fadeInUp');
  $('.search-head-in').addClass('fadeOutUp');
});

$('.right-search').click(function(){
  $('.bars-head span').trigger('click');
  $('.search-bar').slideDown();
  $('.fa-close').slideDown();
  $('.search-bar input').focus();
  $('.bars-head span').removeClass('overafter');
});

window.searchtab=0;
$('.right-search').click(function(){
    if(searchtab==0){   
      searchtab=1;
      $('.search-bar').slideDown();
      $('.fa-close').slideDown();
      $('.search-bar input').focus(); 
    }else if(searchtab==1){
      searchtab=0;
      $('.search-bar').slideUp();
      $('.fa-close').slideUp();       
    }
});

$('.fa-close').click(function(){
    searchtab=0;
    $('.search-bar').slideUp();
    $('.fa-close').slideUp();
});

$(document).on('click', '.back-sec', function(){
    $('.browsetopics').trigger('click');
});

/*$('.browsetopics').click(function(){
    if($('.drawer').hasClass('slideInLeft')) {
        $('.drawer').removeClass('slideInLeft');
        $('.drawer').addClass('animated slideOutLeft');
        $('.browsetopics').removeClass('on');
    }else{
        $('.drawer').show();
        $('.drawer').removeClass('animated slideOutLeft');
        $('.drawer').addClass('animated slideInLeft');
       $('.browsetopics').addClass('on');
    }
});*/


$('.drawerFa,.hone section').click(function(){
  $('.browsetopics').trigger('click');
  $('.playwithdata').trigger('click');
});

$(document).on('click', '.topicFa', function(){
  
});

$(window).resize(function(){
  if( ($(window).width() > 950) && ($('.right').hasClass('slideInRight')) ){
    $('.right').removeClass('slideInRight');
    $('.right').addClass('slideOutRight');
  }

  if( ($(window).width() > 1270) ){
    $('.drawer').removeClass('slideInLeft').removeClass('slideOutLeft').removeClass('animated');
  } else{
    $('.filta i').removeClass('fa-times').addClass('fa-filter');
    $('.drawer').removeClass('slideInLeft').addClass('slideOutLeft animated');
  }
});


/*document.querySelector('.bars-head')
  .addEventListener('click', function() {
    this.classList.toggle('active');
  });
});*/
//IF YOU CHANGE BACK HAMBURGER YOU HAVE TO ADD BACK EVENT LISTENER

$('#mce-success-response').text('Almost finished... please click the link in the email we just sent you.');

document.querySelector('.bars-head')
  .addEventListener('click', function() {
    this.classList.toggle('active');
  });
});</script>
<header>
    <nav>
        <a href='index'><img src='img/logoFinal.png'></a>
        <a class='bars-head'><span></span></a>
        <a class='bars-cover'></a>
        <!--<a class='menu-txt'>MENU</a>        
        <a class='soc-nav rss' target='_blank' href='http://www.cato.org/ecommunity/rss'><i class='fa fa-rss'></i></a>
        <a class='soc-nav reddit' target='_blank' href='https://www.reddit.com/domain/humanprogress.org/'><i class='fa fa-reddit'></i></a>
        <a class='soc-nav twitter' target='_blank' href='https://twitter.com/humanprogress'><i class='fa fa-twitter'></i></a>
        <a class='soc-nav facebook' target='_blank' href='https://www.facebook.com/HumanProgress.org'><i class='fa fa-facebook'></i></a>-->
        <input type='text' placeholder='Search Human Progress' class='searchy'><i class='fa fa-search searche'></i>
        <!--<a class='navlink aboutus' href='about'>About Us</a>
        <a href='contentall' class='navlink browsetopics'>Browse Content</a>
        <a href='dws5' class='navlink playwithdata'>View Data</a>-->
        <a class='navlink aboutus' href='about'>About Us</a>
        <a href='contentall' class='navlink browsetopics'>Browse Content</a>
        <a href='dws' class='navlink playwithdata'>Find Data</a>
    </nav>
</header>

<div class='search-bar'>
  <div class='search-bar-cont'>
    <input type='text' placeholder='Search datasets, articles, and content'/>
    <i class='fa fa-close'></i>
  </div>
</div>
