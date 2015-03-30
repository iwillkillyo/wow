<?php
	/**
	  *@author Iwillkillyo
	  *@version 1.0
	  */
	  
	class Logging {
		function logToTextDatabase($err) {
			$file = fopen("log/databaseErrorLog.txt", "a");
			$date = date("H:i:s Y-m-d");
			$text = "[ERROR] - ".$date." - Adatbázis kapcsolódási hiba!\n Hiba: ".$err."\n";
			fwrite($file, $text);
			fclose($file);
		}
	}
?>