<div style="padding:12px">
<?php 
if(isset($_SESSION['message'])) {
  echo "<div class='alert alert-".$_SESSION['message'][0]."'>".$_SESSION['message'][1]."</div>";
  unset($_SESSION['message']); }
 ?>
 </div>