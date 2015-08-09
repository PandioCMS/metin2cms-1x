<?php
if(!isset($_SESSION)){session_start();}
if(isset($_GET['page'])) {
if(isset($_SESSION['user_admin']) && checkInt($_SESSION['user_admin']) && $_SESSION['user_admin']>=0) { ?>
<div class="page-header">
        <h1><?php include("./user/name_sv.php"); ?> - Schimbare parolă</h1>
      </div>
 <?PHP
   
    if(isset($_POST['submit']) && $_POST['submit']=="Schimbă!") {
    
      if(checkAnum($_POST['npass']) && !empty($_POST['opass']) && (!empty($_POST['npass']) && strlen($_POST['npass'])>=8 && strlen($_POST['npass'])<=16) && $_POST['npass']==$_POST['npass2']) {
        
        $oldPass = ((isset($sqlServ) && is_object($sqlServ)) ? mysqli_real_escape_string($sqlServ, $_POST['opass']) : ((trigger_error("[MT2CMS] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
        $newPass = ((isset($sqlServ) && is_object($sqlServ)) ? mysqli_real_escape_string($sqlServ, $_POST['npass']) : ((trigger_error("[MT2CMS] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
        
        $sqlCmd = "SELECT id,login FROM account.account WHERE password=PASSWORD('".$oldPass."') AND id='".$_SESSION['user_id']."' LIMIT 1";
        $sqlQry = mysqli_query($sqlServ, $sqlCmd);
        
        if(mysqli_num_rows($sqlQry)==1) {
        
          $passCmd = "UPDATE account.account SET password=PASSWORD('".$newPass."') WHERE id='".$_SESSION['user_id']."' LIMIT 1;";
          $passUpdate = mysqli_query($sqlServ, $passCmd);
          
          if($passUpdate) {
            echo'
	  <div class="alert alert-success" role="alert">
        Parola a fost schimbat&#259; cu succes.
      </div>';
          }
          else {
            echo'
	  <div class="alert alert-danger" role="alert">
        Schimbarea parolei a e&#351;uat.
      </div>';
          }
          
        }
        else {
          echo'
	  <div class="alert alert-danger" role="alert">
        Parola care a&#355;i introdus-o este incorect&#259;.
      </div>';
        }
        
      }
      else {
        echo'
	  <div class="alert alert-danger" role="alert">
        Nu ai introdus toate informa&#355;iile corect.
      </div>';
      }
      
    }
  ?>

<div class="well">
        <form name="registerForm" id="registerForm" action="index.php?page=password" method="POST">
					         <div>
							<label for="password">Parola veche:*
								</label>
								<input
								type="password"
								class="form-control input-lg validate[required,custom[noSpecialCharacters],length[8,16]]"
								id="password"
								name="opass"
								maxlength="16"
								value=""
								AUTOCOMPLETE="off"
								/>
							</div>
							<div>
							<label for="password">Parola nou&#259;:*
								</label>
								<input
								type="password"
								class="form-control input-lg validate[required,custom[noSpecialCharacters],length[8,16]]"
								id="password"
								name="npass"
								maxlength="16"
								value=""
								AUTOCOMPLETE="off"
								/>
							</div>
							<div>
								<label for="password">Repet&#259; parola nou&#259;:*
								</label>
								<input
								type="password"
								class="form-control input-lg validate[required,custom[noSpecialCharacters],length[8,16]]"
								id="password"
								name="npass2"
								maxlength="16"
								value=""
								AUTOCOMPLETE="off"
								/>
							</div>	
              <br/><input id="submitBtn" type="submit" name="submit" value="Schimbă!" class="btn btn-lg btn-success role="button""/>
        </form>
</div>
  <?PHP
  }
  else {
    echo'
	  <div class="alert alert-danger" role="alert">
        <strong>Trebuie </strong> să fi logat pentru a accesa aceast&#259; zon&#259;.
      </div>
	';
  }
  }
  else {
    echo 'Nu ave&#355;i permisiunea s&#259; accesa&#355;i pagina direct!';
	echo "<meta http-equiv='refresh' content='0; URL=../index.php'>"; }
?>