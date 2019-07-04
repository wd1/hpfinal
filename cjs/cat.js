$(document).ready(function(){ 	
	$('body').on( 'keydown', function( event ) {
	  if (event.which == 13) {
	  	if ($(".ac").is(":focus")) {
	  		$('.add-cat').trigger('click');	
	  	}
	  	
	  	if ($(".as").is(":focus")) {
	  		$('.add-sub').trigger('click');	
	  	}

	  	if( $('.moddy').css('display')=='flex' && $('.catin').css('display')=='block' ){
	  		window.catText=$('.catin').val();
	  		if(catText==''){
			    if(confirm("Are you sure you want to delete "+catText+"?"))
			    {
				    $.ajax({
				      url:'inc/delCat.php',
				      crossDomain:true,
				      dataType:'JSONP',
				      data:{dataid:dataid},
				      success:function(data){
				      	$('.sub').html('');
				      	$('.cat-div'+dataid+'').slideUp();
				      	$('.moddy').hide();
				      	$('.catin').hide();
				      	var win = window.open('http://hipsterboston.com/article', '_blank');
				      	setTimeout(function() { alert('Success!'); },100);
				      }
				    });    	
			    }
			    else{e.preventDefault();}
	  		} else{
		  		$.ajax({
			      url:'inc/edCat.php',
			      crossDomain:true,
			      dataType:'JSONP',
			      data:{dataid:dataid,catText:catText},
			      success:function(data){
			      	if(data[0]=='fail'){
				      	alert('Category already exists!');
				      	$('.moddy').hide();
					    $('.catin').hide();
				    } else{
				    	var id=data[0];
				      	$('.cat-div'+dataid+'').text(catText);
				      	$('.sub-div'+id+'').text(catText);
					    $('.moddy').hide();
					    $('.catin').hide();	
				      	var win = window.open('http://hipsterboston.com/article', '_blank');
				      	setTimeout(function() { alert('Success!'); },100);
				    } 
			      }
			    });    
		    }		
	  	}

	  	if($('.moddy').css('display')=='flex' && $('.subin').css('display')=='block'){
	  		window.subText=$('.subin').val();
	  		if(subText==''){
				if(confirm("Are you sure you want to delete "+subText+"?"))
			    {
				    $.ajax({
				      url:'inc/delSub.php',
				      crossDomain:true,
				      dataType:'JSONP',
				      data:{subid:subid},
				      success:function(data){
				      	if(data[0]=='fail'){
				      		alert('Cannot delete primary subcategory!');
				      		$('.moddy').hide();
					    	$('.subin').hide();	
				      	} else{
				      		$('.sub-div'+subid+'').slideUp();
				      		$('.moddy').hide();
					    	$('.subin').hide();
					    	var win = window.open('http://hipsterboston.com/article', '_blank');
					    	setTimeout(function() { alert('Success!'); },100);
				      	}
				      }
				    });    	
			    }
			    else{e.preventDefault();}
	  		} else{
		  		$.ajax({
			      url:'inc/edSub.php',
			      crossDomain:true,
			      dataType:'JSONP',
			      data:{subid:subid,subText:subText},
			      success:function(data){
			      	if(data[0]=='failure'){
			      		alert('Subcategory already exists!');
			      		$('.moddy').hide();
				    	$('.subin').hide();
				    } else if(data[0]=='fail'){
			      		alert('Cannot edit primary subcategory!');
			      		$('.moddy').hide();
					    $('.subin').hide();
			      	} else{
				      	$('.sub-div'+subid+'').text(subText);
					    $('.moddy').hide();
					    $('.subin').hide();
				    	var win = window.open('http://hipsterboston.com/article', '_blank');
				    	setTimeout(function() { alert('Success!'); },100);
				    }
			      }
			    });    
		    }	
	  	}
	  }

	  if (event.which == 27) {
	  	if($('.moddy').css('display')=='flex'){
	  		$('.moddy').hide();
	  		$('.catin').hide();
	  		$('.subin').hide();
	  	}
	  }
	});




  	$(document).on('click', '.add-cat', function(){
    	var cat = $('.ac').val();
	    $.ajax({
	      url:'inc/addCat.php',
	      crossDomain:true,
	      dataType:'JSONP',
	      data:{cat:cat},
	      success:function(data){
	      	if(data[0]==0){
	      		$("<div class='cat-div cat-div"+data[1]+"' data-id='"+data[1]+"'>"+cat+"</div>").insertAfter('.tit');
	      		$('.ac').val('');
	      		var win = window.open('http://hipsterboston.com/article', '_blank');
	      		setTimeout(function() { alert('Success!'); },100);
	      	} else if(data[0]==1){
	      		alert('Category already exists!');
	      		$('.ac').val('');
	      	} else{
	      		alert('Category entered is empty!');
	      	}
	      }
	    });
  	});

  	$(document).on('click', '.add-sub', function(){
    	var sub = $('.as').val();
    	var catter = window.currid;
	    $.ajax({
	      url:'inc/addSub.php',
	      crossDomain:true,
	      dataType:'JSONP',
	      data:{sub:sub,catter:catter},
	      success:function(data){
	      	if(data[0]==0){
	      		$('.sub').append("<div class='sub-div sub-div"+data[1]+"' data-id='"+data[1]+"'>"+sub+"</div>");
	      		$('.as').val('');
	      		var win = window.open('http://hipsterboston.com/article', '_blank');
	      		setTimeout(function() { alert('Success!'); },100);
	      	} else if(data[0]==1){
	      		alert('SubCategory already exists!');
	      		$('.as').val('');
	      	} else{
	      		alert('Category entered is empty!');
	      	}
	      }
	    });
  	});

  	$(document).on('dblclick', '.cat-div', function(e){
	    window.dataid = $(this).attr('data-id');
	    window.catText = $(this).text();
	    $('.moddy').css('display','flex');
	    $('.catin').show().val(catText).focus();
  	});

  	$(document).on('dblclick', '.sub-div', function(e){
	    window.subid = $(this).attr('data-id');
	    window.subText = $(this).text();
	    $('.moddy').css('display','flex');
	    $('.subin').show().val(subText).focus();
  	});

  	$(document).on('click', '.cat-div', function(e){ 
    	window.retid = $(this).attr('data-id');
    	window.currid = retid;
    	var thisText = $(this).text();
    	$('.cat-div').css('color','#2099bc');
    	$(this).css('color','#ff6c00');
	    $.ajax({
	      url:'inc/getSub.php',
	      crossDomain:true,
	      dataType:'JSONP',
	      data:{retid:retid},
	      success:function(data){
	      	$('.sub').html('');
	      	$('.sub').append(data[0]);
	      	$('.sub').slideDown();
	      }
	    });
  	});

  	$(document).on('click', '.fa-exchange', function(){
	    window.sid = $(this).attr('data-id');
	    $('.all-cats').show();
  	});

    $(document).on('click', '.all-cats div', function(){
	    window.newid = $(this).attr('data-id');
	    $.ajax({
	      url:'inc/changeCat.php',
	      crossDomain:true,
	      dataType:'JSONP',
	      data:{retid:retid,sid:sid,newid:newid},
	      success:function(data){
	      	if(data[0]==0){
	      		location.reload();	
	      	} else if(data[0]==1){
	      		alert('Cannot move default subcategory');
	      		$('.all-cats').hide();
	      	}
	      }
	    });
  	});


    $(document).on('click', '.fa-close', function(){
	    $('.all-cats').hide();
	    $('.moddy').hide();
  	});

});