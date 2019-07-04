<?php 
  include 'inc/INChead.php';
  include 'inc/DWtop.php';
  include 'inc/mailchimp.php';
  echo "<link rel='stylesheet' type='text/css' href='css/handson.css'>";
  echo "<script src='js/handson.js'></script>";
  include 'inc/DWtopec.php';

  echo "<div class='rap1200'>";   
  include 'inc/DWmeatTop.php';
?>
<!--START DATA VISUALIZATION-->
<div class='cont hot-container' id='dData'></div>
<!--END DATA VISUALIZATION-->
<?php
  include 'inc/DWmeatBottom.php';
  echo "</div>";

  if($_GET[p]>0){include 'inc/dwrelated.php';
    echo "<div class='art-foot newsletter'>";
  } else{
    echo "<div style='display:none' class='art-foot newsletter'>";
  }

  include 'inc/DWfoot.php';
?>
<script src='js/codejquery191.js'></script>
<script src='js/jqueryui1101.js'></script>  
<script src='cjs/dwglobal.js'></script>
<script type='text/javascript'>$( document ).ready(function() {
$('.sData').addClass('selected');
$('.playwithdata').addClass('on');
$('#dData').show();
$('.dwdown').addClass('downloaddata')

    <?php include "datatable/".$_GET['p'].".js";?>  

    var hotElement = document.querySelector('#dData');
    var hotElementContainer = hotElement.parentNode;
    var hotSettings = {
    data: dataObject,
    columns: [
        {
            data: 'country',
            type: 'text',
            width: 220
        },
        <?php
        include 'inc/con.php'; 
        $dset="z".$_GET[p];
        $aes = mysqli_query($con,"SELECT firstyear,lastyear FROM datasets WHERE id=$_GET[p]");
        while($aow = mysqli_fetch_array($aes)){   
          $fy=$aow['firstyear'];
          $ly=$aow['lastyear'];
        }

        for($x=$fy;$x<=$ly;$x++){
          echo "{data:'a".$x."', type: 'text'},";
        }

        mysqli_close($con);
        ?>
    ],
    stretchH: 'all',
    autoWrapRow: true,
    maxRows: 2000,
    rowHeaders:false,
    colHeaders: [
          'Country/Year',
          <?php
          include 'inc/con.php'; 
          $dset="z".$_GET[p];
          $aes = mysqli_query($con,"SELECT firstyear,lastyear FROM datasets WHERE id=$_GET[p]");
          while($aow = mysqli_fetch_array($aes)){   
            $fy=$aow['firstyear'];
            $ly=$aow['lastyear'];
          }

          for($x=$fy;$x<=$ly;$x++){
            echo "'".$x."',";
          }

          mysqli_close($con);
          ?>
    ],
    fixedRowsTop: 0,
    fixedColumnsLeft: 1
};

var hot = new Handsontable(hotElement, hotSettings);

$(document).on('click', '.downloaddata', function(){
  location.href='downloaddata?z='+<?php echo $_GET[p];?>+'';
}); 

});</script>
<script src='cjs/srcbtm.js'></script>
</body>
</html>

