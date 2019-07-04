$(document).ready(function(){ 
	
	$(document).on('click', '.outerli', function(){
		if( $(this).parent().find('ul').hasClass('showing') ){
			$('.inner').removeClass('showing');	
		} else{
			$('.inner').removeClass('showing')
	    	$(this).parent().append( $(this).parent().find('ul') );
	    	$(this).parent().find('ul').addClass('showing');
	    }
	});

	$(document).on('click', '.fa-pencil', function(){
		window.aid = $(this).attr('data-aid');
		window.coun = $(this).parent().text();
		$('.datasets').hide();
		$('.regions').hide();
		$('.editer input').val(coun);
		$('.editer').show();
		$('.editer input').focus();
	});

	$(document).on('click', '.saver', function(){
		window.newcoun=$('.editer input').val();
		if(newcoun==''){
			$.ajax({
		      url:'inc/delAlias.php',
		      crossDomain:true,
		      dataType:'JSONP',
		      data:{aid:aid},
		      success:function(data){
		        location.href='countries';
		      }
		    });  
		} else{
		    $.ajax({
		      url:'inc/editAlias.php',
		      crossDomain:true,
		      dataType:'JSONP',
		      data:{aid:aid,newcoun:newcoun},
		      success:function(data){
		        location.href='countries';
		      }
		    });  			
		}
	});

	$(document).on('click', '.fa-plus', function(){
		window.condid = $(this).attr('data-id');
		$('.datasets').hide();
		$('.regions').hide();
		$('.adder').show();
		$('.adder input').focus();
	});

	$(document).on('click', '.addsave', function(){
		window.alias=$('.adder input').val();
		if(alias==''){
			var donothing=1;  
		} else{
		    $.ajax({
		      url:'inc/addAlias.php',
		      crossDomain:true,
		      dataType:'JSONP',
		      data:{condid:condid,alias:alias},
		      success:function(data){
		        location.href='countries';
		      }
		    });  			
		}
	});

	$(document).on('click', '.fa-times-circle', function(){
		$('.editer input').val('');
		$('.adder input').val('');
		$('.editer').hide();
		$('.adder').hide();
		$('.datasets').show();
		$('.regions').show();
	});

});