<?php
	if(!isset($_SESSION)){session_start();} ?>
  <div class="col-sm-3">
    	<div class="panel panel-default">
         	<div class="panel-heading"><?php if(empty($_SESSION['id'])){echo "Logare";} else{echo "Panoul utilizatorului";} ?></div>
         	<div class="panel-body">
         	<?php include("user-panel.php"); ?>
			</div>
        </div>
        <hr>
		
      <?php
      include("ranking.php");
      ?>
  </div>