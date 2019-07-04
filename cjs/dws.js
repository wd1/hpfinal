$( document ).ready(function() {
  <?php 
    if($_GET[c]>0){
      echo "var c=".$_GET[c].";";
    } else{
      echo "var c=0;";
    }
  ?>

  if(c==1){$('.sWorld').addClass('selected');}
  else if(c==2){$('.sScatter').addClass('selected');}
  else if(c==3){$('.sLine').addClass('selected');}
  else if(c==4){$('.sBar').addClass('selected');}
  else if(c==5){$('.sTree').addClass('selected');}
  else if(c==6){$('.sRank').addClass('selected');}
  else if(c==7){$('.sCalc').addClass('selected');}
  else if(c==8){$('.sData').addClass('selected');}

  window.section=1;
  window.runs=1;

  $('.topec input').val('');
  $('.topec input').focus();

  $('.playwithdata').addClass('on');

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
      //var texto = $(this).text();
      
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


});