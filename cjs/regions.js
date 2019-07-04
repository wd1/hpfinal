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

	$(document).on('click', '.add-region', function(){
		$('.tower').show();
		$('.tower input').focus();
		$('.datasets').hide();
		$('.countries').hide();
	});

	$(document).on('click', '.fa-pencil', function(){
		window.edrid=$(this).attr('data-rid');
		window.edregion=$(this).attr('data-region');
		$('.power').show();
		$('.power input').focus();
		$('.power input').val(edregion);
		$('.datasets').hide();
		$('.countries').hide();
	});

	$(document).on('click', '.edit', function(){
		$('.blocker').show();
		window.regi = $('.power input').val();
		if(regi==''){
			$.ajax({
		      url:'inc/delRegion.php',
		      crossDomain:true,
		      dataType:'JSONP',
		      data:{edrid:edrid},
		      success:function(data){
		        location.href='regions';
		      }
		    });  
		} else{
		    $.ajax({
		      url:'inc/editRegion.php',
		      crossDomain:true,
		      dataType:'JSONP',
		      data:{edrid:edrid,regi:regi},
		      success:function(data){
		        location.href='regions';
		      }
		    }); 			
		}
	});

	$(document).on('click', '.add', function(){
		$('.blocker').show();
		window.region = $('.tower input').val();
		if(region==''){
			alert('Cannot add empty region');
		} else{
		    $.ajax({
		      url:'inc/addRegion.php',
		      crossDomain:true,
		      dataType:'JSONP',
		      data:{region:region},
		      success:function(data){
		      	if(data[0]==1){
		      		$('.blocker').hide();
		      		alert('Region already exists');
		      	} else{
		        	location.href='regions';	
		      	}
		      }
		    }); 			
		}
	});

	$(document).on('click', '.fa-minus', function(){
		$('.blocker').show();
		window.zid = $(this).attr('data-zid');
	    $.ajax({
	      url:'inc/delZalias.php',
	      crossDomain:true,
	      dataType:'JSONP',
	      data:{zid:zid},
	      success:function(data){
	        location.href='regions';
	      }
	    });  
	});

	$(document).on('click', '.fa-plus', function(){
		window.rid = $(this).attr('data-rid');
		$('.shower').show();
		$('.datasets').hide();
		$('.countries').hide();
	});

	$(document).on('click', '.shower ul li', function(){
		$('.blocker').show();
		window.cid=$(this).attr('data-id');
	    $.ajax({
	      url:'inc/addZalias.php',
	      crossDomain:true,
	      dataType:'JSONP',
	      data:{rid:rid,cid:cid},
	      success:function(data){
	        location.href='regions';
	      }
	    });  			
	});

	$(document).on('click', '.fa-times-circle', function(){
		$('.shower').hide();
		$('.tower').hide();
		$('.power').hide();
		$('.datasets').show();
		$('.countries').show();
	});

});