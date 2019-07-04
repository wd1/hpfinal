<?php include 'inc/INChead.php';$randal=rand(1,999);  
    echo "<script src='js/jquery.dataTables.js' type='text/javascript'></script>";
    echo "<script src='js/jquery.dataTables.columnFilter.js' type='text/javascript'></script>";
    echo "<link rel='stylesheet' type='text/css' href='css/datasets.css?version=".$randal."'>";
?>
<script type="text/javascript">
$(document).ready(function(){
  var tempur=localStorage.getItem('type');
  if(tempur=='single'||tempur=='double'){
    location.href='datasets';
  }

  $(document).on('click', '.roddy span', function(){
    $(this).addClass('hida');
    window.alias=$(this).text();
    $('.shower').show();
  });

  $(document).on('click', '.shower .fa-times-circle', function(){
    $('.roddy span').removeClass('hida');
    $('.shower').hide();
  });


  $(document).on('click', '.shower ul li', function(){
    var condid = $(this).attr('data-id');
    $.ajax({
      url:'inc/addAlias.php',
      crossDomain:true,
      dataType:'JSONP',
      data:{alias:alias,condid:condid},
      success:function(data){
        $('.shower').hide();
        $('.hida').hide(); 
      }
    });  
  });

});
</script>
<div class='roddy'><h1>Below are unknown aliases</h1>
  <?php
  include 'inc/con.php';
  $initial = $_GET['z'];
  $init = "z".$initial;
  $ces = mysqli_query($con,"SELECT distinct country FROM $init ORDER BY country asc");
  while($cow = mysqli_fetch_array($ces)){ 
      $pass=0;
      $cy=strtolower($cow['country']);
      
      $aes = mysqli_query($con,"SELECT nombre FROM aliases ORDER BY nombre asc");
      while($aow = mysqli_fetch_array($aes)){ 
          $al=strtolower($aow['nombre']);
          if($cy==$al){
              $pass=1;
          }
      }

      $bes = mysqli_query($con,"SELECT name FROM countries ORDER BY name asc");
      while($bow = mysqli_fetch_array($bes)){ 
          $nm=strtolower($bow['name']);
          if($cy==$nm){
              $pass=1;
          }
      }   
      
      if($pass==0){
          echo "<span>".$cy."</span>";
      }

}   
    mysqli_close($con);
  ?>
  <a href='datasets' class='goto'>Back to Datasets</a>
</div>

<div class='shower'>
  <i class='fa fa-times-circle'></i>
  <ul><h1>Choose Country:</h1>
  <?php
  include 'inc/con.php';
  $bes = mysqli_query($con,"SELECT id,name FROM countries ORDER BY name asc");
  while($bow = mysqli_fetch_array($bes)){ 
      $id=$bow['id'];
      $name=$bow['name'];     
      echo "<li data-id=".$id.">".$name."</li>";
  }   
  mysqli_close($con);
  ?>
  </ul>
</div>

</body></html>