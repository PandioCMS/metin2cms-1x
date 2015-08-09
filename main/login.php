<?php
if(empty($_SESSION['id'])){

	if(isset($_POST['login']) && $_POST['login'] == 'Logare') {

			((bool)mysqli_query($sqlServ, "USE account"));
			
		$user = ((isset($sqlServ) && is_object($sqlServ)) ? mysqli_real_escape_string($sqlServ, $_POST['user']) : ((trigger_error("[MT2CMS] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
		$pw = ((isset($sqlServ) && is_object($sqlServ)) ? mysqli_real_escape_string($sqlServ, $_POST['pw']) : ((trigger_error("[MT2CMS] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
		
			$check = "SELECT * from account where login = '" . $user . "' and password = PASSWORD('$pw')";
				$query = mysqli_query($sqlServ, $check);
					$num = mysqli_num_rows($query);


						
			if($num > 0) {
			
				$array = mysqli_fetch_array($query);

			// SESSION variable start //
			if($array['status']=='OK') {//daca contul nu este blocat
			$_SESSION['id'] = $array['login'];
			$_SESSION['coins'] = $array['coins'];
			$_SESSION['email'] = $array['email'];
			$_SESSION['real_name'] = $array['real_name'];
			$_SESSION['social_id'] = $array['social_id'];
            $_SESSION['user_admin'] = $array['web_admin']; 
			$_SESSION['user_id'] = $array['id'];
            $_SESSION['user_name'] = $array['login'];
            $_SESSION['user_coins'] = $array['coins'];
            $_SESSION['user_email'] = $array['email'];
			echo "<meta http-equiv='refresh' content='0; URL=index.php?page=home'>"; }
			
			else if($array['status']=='BLOCK') {//daca contul este blocat
			echo'<div class="alert alert-danger" role="alert">
			Ne pare rău, dar contul tău este <strong>BLOCAT</strong>.
			</div>'; }
			} else {
			echo "<meta http-equiv='refresh' content='0; URL=index.php?page=login_error'>";
			}
		}
		
?>
<!-- center column -->
<div class="page-header">
        <h1><?php include("./user/name_sv.php"); ?> - Logare</h1>
      </div>
	  <div class="inner-form-border">
						<strong><a id="topwLost" href="index.php?page=passwordlost" title="Ai uitat parola?">Ai uitat parola?</a></strong>
					</div>
					<div class="well">
						<form name="loginForm" id="loginForm" action="index.php?page=login" method="post">
							<div>
								<label for="username">Nume de utilizator: *</label>
								<input AUTOCOMPLETE="off" type="text" class="form-control input-lg validate[required,custom[noSpecialCharacters],length[3,16]]" id="username" name="user" maxlength="16" value=""/>
							</div>
							<div>
								<label for="password">Parol&#259;: *</label>
								<input AUTOCOMPLETE="off" type="password" class="form-control input-lg validate[required,length[5,16]]" id="password" name="pw" maxlength="16" value=""/>
							</div>
							<div id="checkerror">
                            <p>Scrie numele &#351;i parola din joc apoi apas&#259; butonul Login pentru a vedea meniurile interne ale siteului!</p>
							</div> 
							
							<input id="submitBtn" class="btn-big btn-success btn-lg btn" type="submit" name="login" value="Logare"/>
							<script type="text/javascript">
							</script>
						</form>		
					</div>
						<p id="regLegend">* este necesar</p>
						<div class="well">
							<h3>&#206;nc&#259; nu ai cont?</h3>
							<p>Crearea unui juc&#259;tor (cont) este rapid&#259;, usoar&#259; &#351;i gratis.</p>
							<a role="button" href="index.php?page=register" class="btn btn-lg btn-success">Înregistrează-te!</a>
						</div>
<?php } 
else { echo "<meta http-equiv='refresh' content='0; URL=index.php?page=home'>";}
?>