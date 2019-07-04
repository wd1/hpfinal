<div class='right'>
  <a href='index' class='right-index'><i class='fa fa-home'></i> Home</a>
  <a href='search' class='right-search'><i class='fa fa-search'></i> Search</a>
  <a href='ylin' class='right-ylin'><i class='fa fa-user'></i> Your Life In Numbers</a>
  <a href='dw' class='right-dw'><i class='fa fa-globe'></i> Data & Visualizations</a>
  <a href='quiz' class='right-quiz'><i class='fa fa-question-circle'></i> Quizzes</a>
  <a href='about' class='right-about'><i class='fa fa-info-circle'></i> About</a>
  <a class='right-contact'><i class='fa fa-envelope'></i> Contact</a>
  <a class='nav-soc' target='_blank' href='https://www.facebook.com/HumanProgress.org'><i class='fa fa-facebook'></i></a>
  <a class='nav-soc' target='_blank' href='https://twitter.com/humanprogress'><i class='fa fa-twitter'></i></a>
  <a class='nav-soc' target='_blank' href='https://www.reddit.com/domain/humanprogress.org/'><i class='fa fa-reddit'></i></a>
  <a class='nav-soc' target='_blank' href='http://www.cato.org/ecommunity/rss'><i class='fa fa-rss'></i></a>
</div>

<script type='text/javascript'>$( document ).ready(function() {
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
    }else{
    	$('.right').show();
   		$('.right').removeClass('animated slideOutRight');
   		$('.right').addClass('animated slideInRight');
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

document.querySelector('.bars-head')
  .addEventListener('click', function() {
    this.classList.toggle('active');
  });
});</script>