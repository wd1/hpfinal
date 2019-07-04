$(document).ready(function(){ 
    window.section=0;
    $(window).load(function() {
        var dest=0;    
        if(location.href=='https://hipsterboston.com/about#sec1'||location.href=='https://hipsterboston.com/about'){$('.sec1').trigger('click');$('.sec1').addClass('thick');}
        if(location.href=='https://hipsterboston.com/about#sec2'){$('.sec2').trigger('click');}
        if(location.href=='https://hipsterboston.com/about#sec3'){$('.sec3').trigger('click');}
        if(location.href=='https://hipsterboston.com/about#sec4'){$('.sec4').trigger('click');}
        if(location.href=='https://hipsterboston.com/about#sec5'){$('.sec5').trigger('click');}
        if(location.href=='https://hipsterboston.com/about#sec6'){$('.sec6').trigger('click');}
        if(location.href=='https://hipsterboston.com/about#sec7'){$('.sec7').trigger('click');}
        if(location.href=='https://hipsterboston.com/about#sec8'){$('.sec8').trigger('click');}
        if(location.href=='https://hipsterboston.com/about#sec9'){$('.sec9').trigger('click');}
        if(location.href=='https://hipsterboston.com/about#secteam'){$('.secteam').trigger('click');}
        //$('.sec1').addClass('thick');
    });

    

    var teamorder = $('.teamorder').val();
    $('.sec'+teamorder+'wrap').before($('.secteamwrap'));
    $('.sec'+teamorder+'head').before($('.secteamhead'));



    if($('#sec1').text()==''){$('.sec1head').hide();$('.sec1wrap').hide();} 
    if($('#sec2').text()==''){$('.sec2head').hide();$('.sec2wrap').hide();}
    if($('#sec3').text()==''){$('.sec3head').hide();$('.sec3wrap').hide();}
    if($('#sec4').text()==''){$('.sec4head').hide();$('.sec4wrap').hide();}
    if($('#sec5').text()==''){$('.sec5head').hide();$('.sec5wrap').hide();}
    if($('#sec6').text()==''){$('.sec6head').hide();$('.sec6wrap').hide();}
    if($('#sec7').text()==''){$('.sec7head').hide();$('.sec7wrap').hide();}
    if($('#sec8').text()==''){$('.sec8head').hide();$('.sec8wrap').hide();}    
    if($('#sec9').text()==''){$('.sec9head').hide();$('.sec9wrap').hide();}
    if($('#secteam').text()==''){$('.secteamhead').hide();$('.secteamwrap').hide();}

    $('.right-about').addClass('on');
    $('.scroll').click(function(event){
        //event.preventDefault();//calculate destination place
        var dest=0;
        if($(this.hash).offset().top > $(document).height()-$(window).height()){
             dest=$(document).height()-$(window).height();
        }else{
             dest=$(this.hash).offset().top-80;
        }
        //go to destination
        $('html,body').animate({scrollTop:dest}, 500,'swing');
    });

    $('#sec1').waypoint(function(direction) { 
        $('.scroll').removeClass('thick');
        $('.sec1').addClass('thick');
        }, {
            offset: '40'
        });

    $('#sec2').waypoint(function(direction) { 
        $('.scroll').removeClass('thick');
        $('.sec2').addClass('thick');
        }, {
            offset: '60'
        });

    $('#sec3').waypoint(function(direction) { 
        $('.scroll').removeClass('thick');
        $('.sec3').addClass('thick');
        }, {
            offset: '80'
        });

    $('#sec4').waypoint(function(direction) { 
        $('.scroll').removeClass('thick');
        $('.sec4').addClass('thick');
        }, {
            offset: '80'
        });

    $('#sec5').waypoint(function(direction) { 
        $('.scroll').removeClass('thick');
        $('.sec5').addClass('thick');
        }, {
            offset: '80'
        });

    $('#sec6').waypoint(function(direction) { 
        $('.scroll').removeClass('thick');
        $('.sec6').addClass('thick');
        }, {
            offset: '80'
        });

    $('#sec7').waypoint(function(direction) { 
        $('.scroll').removeClass('thick');
        $('.sec7').addClass('thick');
        }, {
            offset: '80'
        });

    $('#sec8').waypoint(function(direction) { 
        $('.scroll').removeClass('thick');
        $('.sec8').addClass('thick');
        }, {
            offset: '80'
        });

    $('#sec9').waypoint(function(direction) { 
        $('.scroll').removeClass('thick');
        $('.sec9').addClass('thick');
        }, {
            offset: '80'
        });

    $('#secteam').waypoint(function(direction) { 
        $('.scroll').removeClass('thick');
        $('.secteam').addClass('thick');
        }, {
            offset: '80'
        });


    $('.sec2').click(function() { 
        setTimeout(function(){
            $('.scroll').removeClass('thick');
            $('.sec2').addClass('thick');
        }, 1000);
    });

    $('.sec3').click(function() { 
        setTimeout(function(){
            $('.scroll').removeClass('thick');
            $('.sec3').addClass('thick');
        }, 1000);
    });

    $('.sec4').click(function() { 
        setTimeout(function(){
            $('.scroll').removeClass('thick');
            $('.sec4').addClass('thick');
        }, 1000);
    });

    $('.sec5').click(function() { 
        setTimeout(function(){
            $('.scroll').removeClass('thick');
            $('.sec5').addClass('thick');
        }, 1000);
    });

    $('.sec6').click(function() { 
        setTimeout(function(){
            $('.scroll').removeClass('thick');
            $('.sec6').addClass('thick');
        }, 1000);
    });

    $('.sec7').click(function() { 
        setTimeout(function(){
            $('.scroll').removeClass('thick');
            $('.sec7').addClass('thick');
        }, 1000);
    });

    $('.sec8').click(function() { 
        setTimeout(function(){
            $('.scroll').removeClass('thick');
            $('.sec8').addClass('thick');
        }, 1000);
    });    

    $('.sec9').click(function() { 
        setTimeout(function(){
            $('.scroll').removeClass('thick');
            $('.sec9').addClass('thick');
        }, 1000);
    });

    $('.secteam').click(function() { 
        setTimeout(function(){
            $('.scroll').removeClass('thick');
            $('.secteam').addClass('thick');
        }, 1000);
    });

    //src bottom, separated because of the stuff i would have to deal with re youtube
    $('body').on( 'keydown', function( event ) {
      if (event.which == 13) {
        var searchstate = $('.search-bar').css('display');
        var searchval = $('.search-bar-cont input').val();
        if(searchstate=='block'){
          if(searchval==''){
            alert('Please enter a search term');
          }else{
            location.href="search?q="+searchval+""; 
          }
        }
      }
    });
});