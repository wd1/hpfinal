$( document ).ready(function() {
  window.section=1;
  window.runs=1;
  $('.topec input').on("change keyup paste", function(){
    var p = $('.topec input').val();
    var y = $('.topec input').val().length;
    if(y>1){
      $('.vad').hide();
      $('.had').hide();
      $.ajax({
        url:'inc/getSets.php',
        crossDomain:true,
        dataType:'JSONP',
        data:{p:p},
        success:function(data){
          $('.partial').html(data[0]);
        }
      });     
    }else{
      $('.partial').html('');
      $('.vad').show();
      $('.had').hide();
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

  $(document).on('click', '.country-holder', function(){
      $('.auto').focus();
  });








  $('.auto').autocomplete({
    source: 'inc/search.php',
    minLength: 1,
    select: function (event, ui) {
      var value = ui.item.value;
      var vid = ui.item.id;
        
      if (vid.indexOf('r') > -1){
          vid = vid.replace('r','');
          var spanner='<span data-rid='+vid+'>'+value+' <i class="fa fa-times-circle-o"></i></span>';
          $(".countries span:contains("+value+")").remove();
          $('.countries').append(spanner);
          $('form .auto').val('');
          var sub=window.location.href;
          var yearo = sub.split('&yf=')[1];
          
          if (sub.indexOf("&r0=") >= 0){
            var core = sub.substring(0, sub.indexOf('&r0='));  
          } else{
            var core = sub.substring(0, sub.indexOf('&yf='));  
          }
          var tempc='';
          var tempr='';
          var regcount=0;

          $('.countries span').each(function(index) {
            if($(this).attr('data-rid')>0){
              tempr = tempr+"&r"+regcount+"="+$(this).attr('data-rid');  
              regcount++;
            }
          });

          sub=core+tempr+'&yf='+yearo;
          
          window.history.pushState('update','title',sub);
          location.reload();
          return false;   
      } else{
          var spanner='<span data-cid='+vid+'>'+value+' <i class="fa fa-times-circle-o"></i></span>';
          $(".countries span:contains("+value+")").remove();
          $('.countries').append(spanner);
          $('form .auto').val('');
          
          var sub=window.location.href;
          var yearo = sub.split('&yf=')[1];
          var core = sub.substring(0, sub.indexOf('&c0='));
          var tempc='';
          var tempr='';
          var coucount=0;
          var regcount=0;

          $('.countries span').each(function(index) {
            if($(this).attr('data-cid')>0){
              tempc = tempc+"&c"+coucount+"="+$(this).attr('data-cid');  
              coucount++;
            }
          });

          $('.countries span').each(function(index) {
            if($(this).attr('data-rid')>0){
              tempr = tempr+"&r"+regcount+"="+$(this).attr('data-rid');  
              regcount++;
            }
          });

          sub=core+tempc+tempr+'&yf='+yearo;
          
          window.history.pushState('update','title',sub);
          location.reload();
          return false;      
      }

    }
  });                



  $(document).on('click', '.countries span', function(){
     var testcount=0;
      if($(this).attr('data-rid')>0){
        testcount=3;//just giving it a number to pass and move on
      } else{
        $('.countries span').each(function(index) {
          if($(this).attr('data-cid')>0){  
            testcount++;
          }
        });
      }



    //alert(testcount);
    
    if(testcount>2){
      $(this).remove();
      var sub=window.location.href;
      var yearo = sub.split('&yf=')[1];
      var core = sub.substring(0, sub.indexOf('&c0='));
      var tempc='';
      var tempr='';
      var coucount=0;
      var regcount=0;

      $('.countries span').each(function(index) {
        if($(this).attr('data-cid')>0){
          tempc = tempc+"&c"+coucount+"="+$(this).attr('data-cid');  
          coucount++;
        }
      });

      $('.countries span').each(function(index) {
        if($(this).attr('data-rid')>0){
          tempr = tempr+"&r"+regcount+"="+$(this).attr('data-rid');  
          regcount++;
        }
      });

      sub=core+tempc+tempr+'&yf='+yearo;

      window.history.pushState('update','title',sub);
      location.reload();
      return false;
    } else{
      alert('You must have at least 2 countries present.')
    }
  }); 













  $(document).on('click', '.back-sec', function(){
      $('.browsetopics').trigger('click');
  });


  $(document).on('click', '.sWorld', function(){
    var loc=window.location.href;
    var sub = loc.substring(loc.indexOf('?'));
    location.href='dwworld'+sub;
  });

  $(document).on('click', '.sScatter', function(){
    var loc=window.location.href;
    var sub = loc.substring(loc.indexOf('?'));
    location.href='dwscat'+sub;
  });

  $(document).on('click', '.sLine', function(){
    var loc=window.location.href;
    var sub = loc.substring(loc.indexOf('?'));
    location.href='dwline'+sub;
  });

  $(document).on('click', '.sBar', function(){
    var loc=window.location.href;
    var sub = loc.substring(loc.indexOf('?'));
    location.href='dwbar'+sub;
  });

  $(document).on('click', '.sTree', function(){
    var loc=window.location.href;
    var sub = loc.substring(loc.indexOf('?'));
    location.href='dwtree'+sub;
  });

  $(document).on('click', '.sRank', function(){
    var loc=window.location.href;
    var sub = loc.substring(loc.indexOf('?'));
    location.href='dwrank'+sub;
  });

  $(document).on('click', '.sCalc', function(){
    var loc=window.location.href;
    var sub = loc.substring(loc.indexOf('?'));
    location.href='dwcalc'+sub;
  });

  $(document).on('click', '.sData', function(){
    var loc=window.location.href;
    var sub = loc.substring(loc.indexOf('?'));
    location.href='dwdata'+sub;
  });

  $('.partial').mouseenter(function() {
    $('.topec input').trigger('blur');
  });

  $(document).on('mouseenter', '.sScatter', function(){    
    if($('.sScatter').hasClass('selected')==false){
      $('.scatter-icon').attr('src','img/scatterhover.png');
    }
  });
  $(document).on('mouseleave', '.sScatter', function(){    
    if($('.sScatter').hasClass('selected')==false){
      $('.scatter-icon').attr('src','img/scatter.png');
    }
  });

  $(document).on('mouseenter', '.sLine', function(){    
    if($('.sLine').hasClass('selected')==false){
      $('.line-icon').attr('src','img/linehover.png');
    }
  });
  $(document).on('mouseleave', '.sLine', function(){    
    if($('.sLine').hasClass('selected')==false){
      $('.line-icon').attr('src','img/line.png');
    }
  });


  $(document).on('mouseenter', '.sBar', function(){    
    if($('.sBar').hasClass('selected')==false){
      $('.bar-icon').attr('src','img/barhover.png');
    }
  });
  $(document).on('mouseleave', '.sBar', function(){    
    if($('.sBar').hasClass('selected')==false){
      $('.bar-icon').attr('src','img/bar.png');
    }
  });


});