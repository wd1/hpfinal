$(document).ready(function(){ 

	$(document).on('click', '.ida', function(){
		$('.fa-plus').hide();
		$('.gt').hide();
		$('form').show();
	    window.temping = $(this).attr('data-id');
	    var newUrl="datasets?z="+temping+"";
		history.pushState({}, null, newUrl);
	    $('.temping').text(temping);
		$('.oldid').val('');
		$('.title').val('');
		$('.subtitle').val('');
		$('.type').val('dynamic');
		$('.pinker').val('n');
		$('.sourcedescr').val('');
		$('.sourceurlone').val('');
		$('.sourceurltwo').val('');
		$('.definition').val('');
		$('.seodescr').val('');

	    $.ajax({
	      url:'inc/getDataset.php',
	      crossDomain:true,
	      dataType:'JSONP',
	      data:{temping:temping},
	      success:function(data){
			window.darb=data;
			if(darb[0]==0){
			  $('.oldid').val('');	
			} else{
			  $('.oldid').val(darb[0]);	
			}
			$('.title').val(darb[1]);
			$('.subtitle').val(darb[2]);
			$('.type').val(darb[3]);
			$('.pinker').val(darb[4]);
			$('.sourcedescr').val(darb[5]);
			$('.sourceurlone').val(darb[6]);
			$('.sourceurltwo').val(darb[7]);
			$('.definition').val(darb[8]);
			$('.seodescr').val(darb[9]);
			$('.catsubcat').val(darb[10]);
			$('.updatedate').val(darb[11]);
			var csc = darb[10];

			$('section input').each(function() {
  			  var tempish = $(this).attr('data-id');
  			  var tempish = "*"+tempish+"*";
  			  if(csc.includes(tempish)==true){
  			  	$(this).prop('checked', true);
  			  } else{
  			  	$(this).prop('checked', false);
  			  }
			});

			$('.modal').css('display','block');	
			$('.edit').show();
			$('form').show();
			$('.fa-times-circle').show();	
			$('.oldid').focus();
	      
			$('.modal .deletecase').show();

			window.tmp2=$('.type option:selected').text();
			localStorage.setItem('type',tmp2); 
	      }
	    });  
	});

	$('.modal section span').on('click', function() {	
		$(this).prev('.checker').trigger('click');
	});	


	$('body').on( 'keydown', function( event ) {
	 	if(event.which == 32){//SPACEBAR		
		}

	 	if(event.which == 27){//ESC		
		}	

	 	if(event.which == 8){//DELETE		
		}	

	 	if(event.which == 38){//UPLOAD 		
		}	

	 	if(event.which == 40){//DOWNLOAD  		
		}	

	});	
			  
	$('.fa-plus').on('click', function() {
		$('.fa-plus').hide();
		$('.gt').hide();
		$('form').hide();

		$('.modal .deletecase').hide();
		$('section input').prop('checked',false);
		$('.oldid').val('');
		$('.title').val('');
		$('.subtitle').val('');
		$('.type').val('dynamic');
		$('.pinker').val('n');
		$('.sourcedescr').val('');
		$('.sourceurlone').val('');
		$('.sourceurltwo').val('');
		$('.definition').val('');
		$('.seodescr').val('');

		$('.modal').css('display','block');
		$('.save').show();	
		$('.fa-times-circle').show();	
		$('.oldid').focus();	
		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth()+1; //January is 0!

		var yyyy = today.getFullYear();
		if(dd<10){
		    dd='0'+dd;
		} 
		if(mm<10){
		    mm='0'+mm;
		} 
		var today = yyyy+'-'+mm+'-'+dd;
		$('.updatedate').val(today);
	});	

	$('.fa-times-circle').on('click', function() {
		$('.modal').css('display','none');
		$('.fa-times-circle').hide();	
		$('.butter').hide();
		$('form').hide();

		$('.fa-plus').show();
		$('.gt').show();
	});	

	$('.delete').on('click', function() {

	var result = confirm("Are you sure you want to delete this dataset?");
	if (result) {
		$.ajax({
	      url:'inc/delDataset.php',
	      crossDomain:true,
	      dataType:'JSONP',
	      data:{temping:temping},
	      success:function(data){
	      	location.href='datasets';
	      }
	    });   	
	}

	});	


	$('.save').on('click', function() {
		$('.loader').css('display','flex');
		var fail=0;
		var catsubcat='';

		var dateReg = /^\d{4}([./-])\d{2}\1\d{2}$/;

		var oldid = $('.oldid').val();
		var title = $('.title').val();
		var subtitle = $('.subtitle').val();
		var type = $('.type option:selected').text();
		var pinker = $('.pinker option:selected').text();
		var sourcedescr = $('.sourcedescr').val();
		var sourceurlone = $('.sourceurlone').val();
		var sourceurltwo = $('.sourceurltwo').val();
		var definition = $('.definition').val();
		var seodescr = $('.seodescr').val();
		var updatedate = $('.updatedate').val();

		//DO CAT SUBCAT OPERATION RIGHT HERE
		if(title==''){fail=1;$('.val-title').css('visibility','visible');}else{$('.val-title').css('visibility','hidden');}
		if(subtitle==''){fail=1;$('.val-subtitle').css('visibility','visible');}else{$('.val-subtitle').css('visibility','hidden');}
		if(sourcedescr==''){fail=1;$('.val-sourcedescr').css('visibility','visible');}else{$('.val-sourcedescr').css('visibility','hidden');}
		if(sourceurlone==''){fail=1;$('.val-sourceurlone').css('visibility','visible');}else{$('.val-sourceurlone').css('visibility','hidden');}
		if(definition==''){fail=1;$('.val-definition').css('visibility','visible');}else{$('.val-definition').css('visibility','hidden');}
		if(seodescr==''){fail=1;$('.val-seodescr').css('visibility','visible');}else{$('.val-seodescr').css('visibility','hidden');}
		if(!updatedate.match(dateReg)){fail=1;$('.val-updatedate').css('visibility','visible');}else{$('.val-updatedate').css('visibility','hidden');}

		if(fail==0){
			var catsubcat='';
			var tempid='';
			$('.modal .checker').each(function() {
				if($(this).is(':checked')){
					tempid='*'+$(this).attr('data-id')+'*';
					catsubcat=catsubcat+tempid;
				}
			});

		    $.ajax({
		      url:'inc/addDataset.php',
		      crossDomain:true,
		      dataType:'JSONP',
		      data:{oldid:oldid,title:title,subtitle:subtitle,type:type,pinker:pinker,sourcedescr:sourcedescr,sourceurlone:sourceurlone,sourceurltwo:sourceurltwo,definition:definition,seodescr:seodescr,catsubcat:catsubcat,updatedate:updatedate},
		      success:function(data){
		      	location.href='datasets?z='+data[0]+'';
		      }
		    });    	
		} else{
			$('.loader').css('display','none');
		}
	});	

	$('.type').on('change', function() {
			
			var type = $('.type option:selected').text();
		    $.ajax({
		      url:'inc/edType.php',
		      crossDomain:true,
		      dataType:'JSONP',
		      data:{temping:temping,type:type},
		      success:function(data){
		      	location.href='datasets?z='+temping+'';
		      }
		    });    	
	});	


	$('.edit').on('click', function() {

		var fail=0;
		var dateReg = /^\d{4}([./-])\d{2}\1\d{2}$/;


		var oldid = $('.oldid').val();
		var title = $('.title').val();
		var subtitle = $('.subtitle').val();
		var type = $('.type option:selected').text();
		var pinker = $('.pinker option:selected').text();
		var sourcedescr = $('.sourcedescr').val();
		var sourceurlone = $('.sourceurlone').val();
		var sourceurltwo = $('.sourceurltwo').val();
		var definition = $('.definition').val();
		var seodescr = $('.seodescr').val();
		var updatedate = $('.updatedate').val();

		//DO CAT SUBCAT OPERATION RIGHT HERE
		if(title==''){fail=1;$('.val-title').css('visibility','visible');}else{$('.val-title').css('visibility','hidden');}
		if(subtitle==''){fail=1;$('.val-subtitle').css('visibility','visible');}else{$('.val-subtitle').css('visibility','hidden');}
		if(sourcedescr==''){fail=1;$('.val-sourcedescr').css('visibility','visible');}else{$('.val-sourcedescr').css('visibility','hidden');}
		if(sourceurlone==''){fail=1;$('.val-sourceurlone').css('visibility','visible');}else{$('.val-sourceurlone').css('visibility','hidden');}
		if(definition==''){fail=1;$('.val-definition').css('visibility','visible');}else{$('.val-definition').css('visibility','hidden');}
		if(seodescr==''){fail=1;$('.val-seodescr').css('visibility','visible');}else{$('.val-seodescr').css('visibility','hidden');}
		if(!updatedate.match(dateReg)){fail=1;$('.val-updatedate').css('visibility','visible');}else{$('.val-updatedate').css('visibility','hidden');}

		if(fail==0){
			var catsubcat='';
			var tempid='';
			$('.loader').css('display','flex');
			$('.modal .checker').each(function() {
				if($(this).is(':checked')){
					tempid='*'+$(this).attr('data-id')+'*';
					catsubcat=catsubcat+tempid;
				}
			});

		    $.ajax({
		      url:'inc/editDataset.php',
		      crossDomain:true,
		      dataType:'JSONP',
		      data:{temping:temping,oldid:oldid,title:title,subtitle:subtitle,type:type,pinker:pinker,sourcedescr:sourcedescr,sourceurlone:sourceurlone,sourceurltwo:sourceurltwo,definition:definition,seodescr:seodescr,catsubcat:catsubcat,updatedate:updatedate},
		      success:function(data){
		      	location.href='datasets';
		      }
		    });    	
		}	
	});	

	$('.reviewer').on('click', function() {
		var pedic = window.location.href.split('=')[1];
		if($('.type option:selected').text()=='dynamic'){
			location.href='review?z='+pedic+'';
		} else {
			alert('no review function for static single and static double datasets');
		}
	});	
	

	$('.rawrawraw').on('click', function() {
		var dedic = window.location.href.split('=')[1];
		location.href='raw/RAW'+dedic+'.csv';
	});	


	$('.downloader').on('click', function() {
		var dedic = window.location.href.split('=')[1];
		if($('.type option:selected').text()=='dynamic'|| $('.type option:selected').text()=='single'){location.href='download?z='+dedic+'';}
		if($('.type option:selected').text()=='double'){location.href='downloaddouble?z='+dedic+'';}
	});	

	$('.downloadinter').on('click', function() {
		var dedic = window.location.href.split('=')[1];
		if($('.type option:selected').text()=='dynamic'){location.href='downloadinter?z='+dedic+'';}
		if($('.type option:selected').text()=='double'||$('.type option:selected').text()=='single'){
			alert('download for interpolated static datasets not available');
		}

	});	

	$('.downloadexter').on('click', function() {
		var dedic = window.location.href.split('=')[1];
		if( $('.type option:selected').text()=='dynamic'){location.href='downloadexter?z='+dedic+'';}
		if( $('.type option:selected').text()=='double' || $('.type option:selected').text()=='single'){
			alert('download for extrapolated static datasets not available');
		}
	});	


	$('.downloadcooked').on('click', function() {
		var dedic = window.location.href.split('=')[1];
		if( $('.type option:selected').text()=='dynamic'){location.href='downloadcooked?z='+dedic+'';}
		if( $('.type option:selected').text()=='double' || $('.type option:selected').text()=='single'){
			alert('download for cooked static datasets not available');
		}
	});	






	$('.downloadsum').on('click', function() {
		var dedic = window.location.href.split('=')[1];
		if( $('.type option:selected').text()=='dynamic'){location.href='downloadsum?z='+dedic+'';}
		if( $('.type option:selected').text()=='double' || $('.type option:selected').text()=='single'){
			alert('download for dynamic only');
		}
	});	
	
	$('.downloadave').on('click', function() {
		var dedic = window.location.href.split('=')[1];
		if( $('.type option:selected').text()=='dynamic'){location.href='downloadave?z='+dedic+'';}
		if( $('.type option:selected').text()=='double' || $('.type option:selected').text()=='single'){
			alert('download for dynamic only');
		}
	});	

	$('.downloadwav').on('click', function() {
		var dedic = window.location.href.split('=')[1];
		if( $('.type option:selected').text()=='dynamic'){location.href='downloadwav?z='+dedic+'';}
		if( $('.type option:selected').text()=='double' || $('.type option:selected').text()=='single'){
			alert('download for dynamic only');
		}
	});	

	$('.interpolate').on('click', function() {
		$('.coverer').show();
	    window.dataset=$(this).attr('data-id');
	    $.ajax({
	      url:'inc/interpolate.php',
	      crossDomain:true,
	      dataType:'JSONP',
	      data:{dataset:dataset},
	      success:function(data){
	      	$('.coverer').hide();
	      	alert('interpolation completed successfully');
	      }
	    });  
	});	

	$('.extrapolate').on('click', function() {
		$('.coverer').show();
	    window.dataset=$(this).attr('data-id');
	    $.ajax({
	      url:'inc/extrapolate.php',
	      crossDomain:true,
	      dataType:'JSONP',
	      data:{dataset:dataset},
	      success:function(data){
	      	$('.coverer').hide();
	      	alert('extrapolation completed successfully');
	      }
	    });  
	});	

	$('.subclick').on('click', function() {
		$('.coverer').show();
	});	


});