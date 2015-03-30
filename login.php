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

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

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


<div class="panel panel-default" style="width: 50%; margin: 0 auto;">
  <div class="panel-heading">
    <h3 class="panel-title">Bejelentkezés</h3>
  </div>
  <div class="panel-body">
		<form method="post" action="?action=login">
		  <div class="form-group">
			<label for="username">Felhasználónév</label>
			<input type="text" class="form-control" id="username" placeholder="Írd be a felhasználóneved">
		  </div>
		  <div class="form-group">
			<label for="password">Jelszó</label>
			<input type="password" class="form-control" id="password" placeholder="Jelszó">
		  </div>
		  <button type="submit" class="btn btn-success">Bejelentkezés</button>
		</form>
		<br />
		<p><a href="recover.php">Elfelejtettem a jelszavam / felhasználónevem</a></p>
  </div>
</div>

<!-- /Login -->
</div>
</body>

</html>