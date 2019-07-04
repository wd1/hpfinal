//NEED TO TEST MORE TO SEE IF THIS FIRST PIECE OF CODE ACTUALLY WORKS
var iScrollPos = 0;
var sdCount=0;
var suCount=0;
window.vidon=0;
window.safe=1;
window.done=0;

$(window).scroll(function () {
  if(vidon==1){
    var iCurScrollPos = $(this).scrollTop();
    if (iCurScrollPos > iScrollPos && iCurScrollPos > 50) {
      sdCount++;
      if(sdCount>5){
        $('iframe').addClass('tinify');
        $('.youtube-back').css('background','transparent');
        $('.youtubeFa').css('position','fixed').css('top','auto').css('bottom','237px').css('right','288px');
        sdCount=0;
        suCount=0;
      } 
    } else {
      suCount++;
      if(suCount>5){
        $('iframe').removeClass('tinify');
        $('.youtube-back').css('position','fixed').css('background','rgba(0,0,0,.7)');
        $('.youtubeFa').css('position','relative').css('top','-300px').css('right','15px').css('bottom','auto').fadeIn();
        sdCount=0;
        suCount=0;
      } 
    }
    iScrollPos = iCurScrollPos;
  }
  //alert(window.location.href);

  if( (($(window).scrollTop() + $(window).height() + 500) > $(document).height())&&safe==1&&section<runs&&( (window.location.href.indexOf('index')!==-1 )|| window.location.href=='http://hipsterboston.com/'|| window.location.href=='https://hipsterboston.com/')) {
    
    safe=0;
    if(section%2==0){
      $.ajax({
        url:'inc/getIndexC.php',
        crossDomain:true,
        dataType:'JSONP',
        data:{conte:conte,sixconte:sixconte,section:section},
        success:function(data){
          conte=data[0];
          sixconte=data[1];
          $('.rap').append(data[2]);
          safe=1;
        }
      }); 
      section++;
    } else{
      $.ajax({
        url:'inc/getIndexB.php',
        crossDomain:true,
        dataType:'JSONP',
        data:{conte:conte,sixconte:sixconte},
        success:function(data){
          conte=data[0];
          sixconte=data[1];
          $('.rap').append(data[2]);
          safe=1;
        }
      }); 
      section++;      
    }    
  } else if(section==runs-1 &&done==0){
    done=1;
    //$('.rap').append("<div class='thatsall'>That's All The Content We Have!</div>");
  }


  if( (($(window).scrollTop() + $(window).height() + 500) > $(document).height())&&safe==1&&section<runs&&( (window.location.href.indexOf('index')!==-1 )|| window.location.href=='http://hipsterboston.com/'|| window.location.href=='https://hipsterboston.com/')) {
    
    safe=0;
    if(section%2==0){
      $.ajax({
        url:'inc/getIndexC.php',
        crossDomain:true,
        dataType:'JSONP',
        data:{conte:conte,sixconte:sixconte,section:section},
        success:function(data){
          conte=data[0];
          sixconte=data[1];
          $('.rap').append(data[2]);
          safe=1;
        }
      }); 
      section++;
    } else{
      $.ajax({
        url:'inc/getIndexB.php',
        crossDomain:true,
        dataType:'JSONP',
        data:{conte:conte,sixconte:sixconte},
        success:function(data){
          conte=data[0];
          sixconte=data[1];
          $('.rap').append(data[2]);
          safe=1;
        }
      }); 
      section++;      
    }    
  } else if(section==runs-1 &&done==0){
    done=1;
    //$('.rap').append("<div class='thatsall'>That's All The Content We Have!</div>");
  }



  if( (($(window).scrollTop() + $(window).height() + 500) > $(document).height())&&safe==1&&section<runs&&window.location.href.indexOf('sub')!==-1  ) {    
    safe=0;
    $.ajax({
      url:'inc/getIndexSub.php',
      crossDomain:true,
      dataType:'JSONP',
      data:{section:section,sid:sid,vr:vr},
      success:function(data){
        conte=data[0];
        $('.rap').append(data[1]);
        vr=data[2];
        safe=1;
      }
    }); 
    section++;    
  } else if(section==runs-1 &&done==0){
    done=1;
    //$('.rap').append("<div class='thatsall'>That's All The Content We Have!</div>");
  }





  if( ($(window).scrollTop() + $(window).height() == $(document).height())&&safe==1&&section<runs&&(window.location.href.indexOf('contentall')!==-1 ) ) {
      safe=0;
      if(section==runs && done==0){
        done=1;
        $('.rap').append("<div class='thatsall' style='color:transparent'>That's All The Content We Have!</div>");
      }else if(done==0){  
        $.ajax({
          url:'inc/getIndexAll.php',
          crossDomain:true,
          dataType:'JSONP',
          data:{section:section,conte:conte},
          success:function(data){
            conte=data[0];
            $('.rap').append(data[1]);
            safe=1;
          }
        }); 
        section++; 
      }
    } else if( ($(window).scrollTop() + $(window).height() == $(document).height())&&safe==1&&section<runs&&(window.location.href.indexOf('content')!==-1 ) ) {
      //alert('bottom');
      safe=0;
      if(section==runs&&done==0){
        done=1;
        $('.rap').append("<div class='thatsall' style='color:transparent'>That's All The Content We Have!</div>");
      }else if(done==0){  
        $.ajax({
          url:'inc/getIndexTopic.php',
          crossDomain:true,
          dataType:'JSONP',
          data:{section:section,cid:cid,vr:vr},
          success:function(data){
            conte=data[0];
            $('.rap').append(data[1]);
            vr=data[2];
            safe=1;
          }
        }); 
        section++; 
      }
    } /*else if( ($(window).scrollTop() + $(window).height() == $(document).height())&&safe==1&&section<runs&&(window.location.href.indexOf('sub')!==-1 ) ) {
    safe=0;
    if(section==runs&&done==0){
      done=1;
      $('.rap').append("<div class='thatsall' stle='color:transparent'>That's All The Content We Have!</div>");
    }else if(done==0){  
      $.ajax({
        url:'inc/getIndexSub.php',
        crossDomain:true,
        dataType:'JSONP',
        data:{section:section,sid:sid,vr:vr},
        success:function(data){
          conte=data[0];
          $('.rap').append(data[1]);
          vr=data[2];
          safe=1;
        }
      }); 
      section++; 
    }
  }*/


});//END SCROLL FUNCTION


$('.youtubeFa').on('click', function(){
  $('.youtube-back').trigger('click');
});


setTimeout(function(){
  $('#video')[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*');    
}, 1000);


$(document).on('click', '.vidclick', function(ev){     
  vidon=1;
  var url = $(this).attr('data-id');
  $('iframe').attr('src',url);
  $('.youtube-back').fadeIn().css('display','flex').css('position','fixed').css('background','rgba(0,0,0,.7)');
  $('.youtubeFa').css('position','relative').css('display','block').css('top','-300px').css('right','15px').css('bottom','auto');
  $('.youtubeFa').fadeIn();
  $("#video")[0].src += "&autoplay=1";
  ev.preventDefault();
  
});

$('.youtube-back').on('click', function(){
  vidon=0;
  $('iframe').removeClass('tinify');
  $('.youtube-back').fadeOut();
  $('.youtubeFa').fadeOut();
  setTimeout(function(){
    $('#video')[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*');    
  }, 500);
  
});
var player;

$('body').on( 'keydown', function( event ) {
  if (event.which == 13) {
    var searchstate = $('.search-bar').css('display');
    var searchval = $('.search-bar-cont input').val();
    if(searchstate=='block'){
      if(searchval==''){
        alert('Please enter a search term');
      }else{
        location.href="search?q="+searchval+"";
        /*window.open(
          "search?q="+searchval+"",
          "_blank" 
        );*/
        setTimeout(function(){
          $('#video')[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*');    
        }, 500);
        searchtab=0;
        $('.search-bar').slideUp();
        $('.fa-close').slideUp();
      }
    } else{
      searchval = $('.searchy').val();
      if(searchval!=''){
        location.href="search?q="+searchval+"";
      }
    }
  }
});






window.calor=0;
$(document).on('mouseenter', 'li', function(){    
      var temp=$(this).find('.title-block').css('background-color');
      if(temp=='rgba(255, 255, 255, 0.8)'){
        console.log('donothing');
      } else{
        calor = $(this).find('.title-block').css('background-color'); 
        //calor = "'"+calor+"'";
      }

      window.er=$(this).css('background-color');
      console.log(er);
      if(er=='rgb(255, 109, 0)'){
        $(this).css('background-color','#d95c00');
      }
      if(er=='rgb(58, 152, 180)'){
        $(this).css('background-color','#31819a');
      }
      if(er=='rgb(92, 164, 26)'){
        $(this).css('background-color','#4d8c17');
      }
      if(er=='rgb(243, 60, 56)'){
        $(this).css('background-color','#ce332f');
      }
      if(er=='rgb(99, 92, 76)'){
        $(this).css('background-color','rgb(85,77,64)');
      }
      if(er=='rgb(68, 94, 178)'){
        $(this).css('background-color','#3a5197');
      }
      if(er=='rgb(198, 0, 51)'){
        $(this).css('background-color','#aa002d');
      }
      if(er=='rgb(162, 188, 187)'){
        $(this).css('background-color','#8aa09e');
      }
      if(er=='rgb(152, 180, 179)'){
        $(this).css('background-color','#7f9694');
      }



      $(this).find('.lip-txt').css('text-decoration','underline');
      if( $(this).find('.title-block').text()=='Video' ) {
        $(this).find('.draft').attr('src','img/drafDark.png'); 
      } else{
        $(this).find('.draft').attr('src','img/draftDark.png');
      }
      $(this).find('.title-block').css('background','rgba(255, 255, 255, 0.8)');
      $(this).find('.title-block').css('color','#4b4b4b');
      $(this).find('.lip-stit').css('text-decoration','underline');

      //$(this).find('.lip-block').css('background-position','left top').css('color','white');
});
$(document).on('mouseleave', 'li', function(){    
      $(this).find('.lip-txt').css('text-decoration','none');
      if( $(this).find('.title-block').text()=='Video' ) {
        $(this).find('.draft').attr('src','img/draf.png'); 
      } else{
        $(this).find('.draft').attr('src','img/draft.png');
      }
      $(this).find('.title-block').css('color','white');
      $(this).find('.title-block').css('background-color',calor);
      $(this).find('.lip-stit').css('text-decoration','none');

      $(this).css('background-color',''+er+'');
});



$(document).on('mouseenter', '.bars-cover', function(){    
  if($('.right').hasClass('slideInRight')) {
    $('.bars-head span').addClass('over');
  }else{
    $('.bars-head span').addClass('over');
    $('.bars-head span').addClass('overafter');
  }
});

$(document).on('mouseleave', '.bars-cover', function(){    
  $('.bars-head span').removeClass('over');
  $('.bars-head span').removeClass('overafter');
});


/*
$('.csel').on("change keyup paste", function(){
    var xr = $('.csel').val();

    $( ".btop li" ).each(function( index ) {
      var tx = $(this).html();
      if ( tx.search(xr)!==-1 ){
        $(this).css('visibility','hidden');
      } else{
        $(this).css('visibility','visible')
      }
    });

});*/















