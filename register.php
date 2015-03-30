<?php

	/**
	  *
	  * @author Iwillkillyo
	  * @version 1.0
	  *
	  */

	  
	// Database csatlakozás
	
	include("inc/class.databaseClass.inc.php");
	$dab = new Database();
	$db = $dab->connectDatabase();
	
	// Regisztráció
	
	if(isset($_GET['action'])) {
		$action = $db->real_escape_string($_GET['action']);
		if($action == "register") {
			if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['password2']) && !empty($_POST['email']) && !empty($_POST['email2']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password2']) && isset($_POST['email']) && isset($_POST['email2'])) {
				$username   = $db->real_escape_string($_POST['username']);
				$password   = $db->real_escape_string($_POST['password']);
				$password2  = $db->real_escape_string($_POST['password2']);
				$email      = $db->real_escape_string($_POST['email']);
				$email2     = $db->real_escape_string($_POST['email2']);
				
				// Változók a felhasználói adatok validálásához
				
				$usernameUseable = 0;
				$usernameCorrect = 1;
				$passwordMatch = 0;
				$passwordUseable = 0;
				$emailMatch = 0;
				$emailUseable = 0;
				
				/****************************************/
				//										//
				//     ADATBÁZIST EL KELL KÉSZÍTENI!    //
				//										//
				/****************************************/
				
				// Felhasználónév check
				
				$query = $db->query("SELECT * FROM users WHERE username='$username'");
				
				if(mysqli_num_rows($query) == 0) {
					$usernameCorrect = 1;
				} else {
					$usernameCorrect = 0;
				}
				
				if(strlen($username) >= 8) {
					if(strlen($username) <= 20) {
						$usernameUseable = 1;
					} else {
						$usernameUseable = 0;
					}
				} else {
					$usernameUseable = 0;
				}
				
				// Jelszó check
				
				if($password == $password2) {
					$passwordMatch = 1;
					
					$uppercase = preg_match('@[A-Z]@', $password);
					$lowercase = preg_match('@[a-z]@', $password);
					$number    = preg_match('@[0-9]@', $password);

					if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
						$passwordUseable = 0;
					} else {
						$passwordUseable = 1;
					}
					
				} else {
					$passwordMatch = 0;
				}
				
				// Email check
				
				if($email == $email2) {
					$emailMatch = 1;
					
					if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
						$emailUseable = 1;
					} else {
						$emailUseable = 0;
					}
				
				} else {
					$emailMatch = 0;
				}
				
				// Regisztrációs folyamat
				
				
				
				$password = password_hash($password, PASSWORD_BCRYPT);
				
				$date = date("Y-m-d");
				
				if($usernameCorrect == 1 && $passwordMatch == 1 && $passwordUseable == 1 && $emailMatch == 1 && $emailUseable == 1) {
					$db->query("INSERT INTO `users`(`username`, `password`, `email`,`registered`) VALUES ('$username', '$password', '$email', '$date')");
				} else {
					$errorString = "";
					if($usernameCorrect == 0) {
						$errorString .= "&usernameCorrect=0";
					}
					if($passwordMatch == 0) {
						$errorString .= "&passwordMatch=0";
					}
					if($passwordUseable == 0) {
						$errorString .= "&passwordUseable=0";
					}
					if($emailMatch == 0) {
						$errorString .= "&emailMatch=0";
					}
					if($emailUseable == 0) {
						$errorString .= "&emailUseable=0";
					}
					if($usernameUseable == 0) {
						$errorString .= "&usernameUseable=0";
					}
					header("Location: register.php?error".$errorString."");
				}
			} else {
				header("Location: register.php?noData");
			}
				
		} else {
			// Nincs ...
		}
	}
	
?>

<!Doctype html>

<html lang="en">

<head>
	<title>WoW BG</title>
	<meta charset="utf-8" />
	<meta name="keywords" content=""  />
	<meta name="description" content="" />
	<meta name="author" content="Iwillkillyo" />
	
	<!-- Jquery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<!-- /Jquery -->
	
	<!-- Bootstrap -->
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

	<!-- /Bootstrap -->	
	
	<!-- CSS -->
	
	<link rel="stylesheet" href="css/style.css" />
	
	<!-- /CSS -->

	<!-- JavaScript -->

	
	
	<!-- /JavaScript -->
	
</head>
<body>
<div id="wrapper">
<!-- Navbar -->

<nav class="navbar navbar-default" >
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a class="navbar-brand" href="#">
        <span class="glyphicon glyphicon-home"></span>
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="#">Link</a></li>
        <li><a href="#">Link</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Felhasználó <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="login.php">Bejelentkezés</a></li>
            <li><a href="register.php">Regisztráció</a></li>
            <li class="divider"></li>
            <li><a href="recover.php">Elfelejtett jelszó</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<!-- /Navbar -->

<!-- Login -->


<div class="panel panel-success" style="width: 50%; margin: 0 auto;">
  <div class="panel-heading">
    <h3 class="panel-title">Regisztráció</h3>
  </div>
  <div class="panel-body">
		<?php
		
			/*
				$usernameUseable = 0;
				$usernameCorrect = 0;
				$passwordMatch = 0;
				$passwordUseable = 0;
				$emailMatch = 0;
				$emailUseable = 0;
			*/
			if(isset($_GET['usernameUseable'])) {
				if($_GET['usernameUseable'] == 0){
					echo '<div class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span> A felhasználóneved nem megfelelő formátumú.</div>';
				}
			}
			
			if(isset($_GET['noData'])) {
				if($_GET['noData'] == 0){
					echo '<div class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span> Nem töltöttél ki minden mezőt.</div>';
				}
			}
			
			if(isset($_GET['usernameCorrect'])) {
				if($_GET['usernameCorrect'] == 0){
					echo '<div class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span> A választott felhasználónév már foglalt.</div>';
				}
			}
			
			if(isset($_GET['passwordMatch'])) {
				if($_GET['passwordMatch'] == 0){
					echo '<div class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span> A két megadott jelszó nem egyezik.</div>';
				}
			}
			
			if(isset($_GET['passwordUseable'])) {
				if($_GET['passwordUseable'] == 0){
					echo '<div class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span> A megadott jelszó nem megfelelő formátumú.</div>';
				}
			}
			
			if(isset($_GET['emailMatch'])) {
				if($_GET['emailMatch'] == 0){
					echo '<div class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span> A két E-mail nem megfelelő formátumú.</div>';
				}
			}
			
			if(isset($_GET['emailUseable'])) {
				if($_GET['emailUseable'] == 0){
					echo '<div class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span> A megadott E-mail nem megfelelő formátumú.</div>';
				}
			}
			
		?>
		
		<form method="post" action="?action=register">
		  <div class="form-group">
			<label for="username">Felhasználónév</label>
			<input type="text" class="form-control" id="username" name="username" placeholder="Írd be a felhasználóneved">
		  </div>
		  <div class="form-group">
			<label for="password">Jelszó</label>
			<input type="password" class="form-control" id="password" name="password" placeholder="Jelszó">
		  </div>
		  <div class="form-group">
			<label for="password2">Jelszó újra</label>
			<input type="password" class="form-control" id="password2" name="password2" placeholder="Jelszó">
		  </div>
		  <div class="form-group">
			<label for="email">Email cím</label>
			<input type="email" class="form-control" id="email" name="email" placeholder="Email">
		  </div>
		  <div class="form-group">
			<label for="email">Email cím újra</label>
			<input type="email" class="form-control" id="email2" name="email2" placeholder="Email">
		  </div>
		  <button type="submit" class="btn btn-success">Regisztráció</button>
		</form>
  </div>
</div>

<!-- /Login -->
</div>
</body>

</html>