<?php
session_start();

// Define database
define('dbhost', 'localhost');
define('dbuser', 'hdang');
define('dbpass', 'Haidang@123456789');
define('dbname', 'Manage');

try {
	$connect = new PDO("mysql:host=".dbhost."; dbname=".dbname, dbuser, dbpass);
	$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
	echo $e->getMessage();
}

?>
