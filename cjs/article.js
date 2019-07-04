$(document).ready(function(){   
  /*$.ajax({
    url: 'inc/getRC.php',
    crossDomain: true,
    data:{pid:tempy},
    dataType: 'JSONP',
    success: function (data) {
      $('.a1 h4').text(data[0][0]);
      $('.a1 h5').text(data[0][1]);
      $('.a1 h6').text(data[0][6]);
      var temp1 = data[0][4].substring(1);
      $('.a1').css("background","url('admin/uploads/image/"+temp1+"') no-repeat center");
      $('.a1').css("background-size","cover");
      $('.a1').prop("href","article?p="+data[0][5]+"");

      $('.a2 h4').text(data[1][0]);
      $('.a2 h5').text(data[1][1]);
      $('.a2 h6').text(data[1][6]);
      var temp2 = data[1][4].substring(1);
      $('.a2').css("background","url('admin/uploads/image/"+temp2+"') no-repeat center");
      $('.a2').css("background-size","cover");
      $('.a2').prop("href","article?p="+data[1][5]+"");

      $('.a3 h4').text(data[2][0]);
      $('.a3 h5').text(data[2][1]);
      $('.a3 h3').text(data[2][2]);
      $('.a3 h6').text(data[2][6]);
      $('.a3').prop("href","article?p="+data[2][5]+"");

      $('.b1 h4').text(data[3][0]);
      $('.b1 h5').text(data[3][1]);
      $('.b1 h6').text(data[3][6]);
      var temp3 = data[3][4].substring(1);
      $('.b1').css("background","url('admin/uploads/image/"+temp3+"') no-repeat center");
      $('.b1').css("background-size","cover");
      $('.b1').prop("href","article?p="+data[3][5]+"");

      $('.b2 h4').text(data[4][0]);
      $('.b2 h5').text(data[4][1]);
      $('.b2 h6').text(data[4][6]);
      var temp4 = data[4][4].substring(1);
      $('.b2').css("background","url('admin/uploads/image/"+temp4+"') no-repeat center");
      $('.b2').css("background-size","cover");
      $('.b2').prop("href","article?p="+data[4][5]+"");
      
      $('.b3 h4').text(data[5][0]);
      $('.b3 h5').text(data[5][1]);
      $('.b3 h3').text(data[5][2]);
      $('.b3 h6').text(data[5][6]);
      $('.b3').prop("href","article?p="+data[5][5]+"");

    }
  });*/
  
  $('.right-art').addClass('on');
    $('.fa-facebook').click(function() { 
      window.artext = $('.title-txt').text();
      window.sutext = $('.subtitle-txt').text();
      window.url = window.location.href;
      share();
    });
});