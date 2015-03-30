<?php
	/**
	  *@author Iwillkillyo
	  *@version 1.0
	  */
	  
	class Database {
		function connectDatabase() {
			$db = new mysqli('localhost', 'root', '', 'wow');
			$db->set_charset("utf8");
			return $db;
		}
		function __construct() {
			$db = new mysqli('localhost', 'root', '', 'wow');
			if(!$db->connect_errno) {
				$db->close();
			} else {
				include("class.loggingClass.inc.php");
				$log = new Logging();
				$error = $db->connect_errno;
				$log->logToTextDatabase($error);
				header("Location: databaseerror.html");
			}
		}
	}
?>