<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'Login');

// Create MySQLi database connection
$mysql_db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if ($mysql_db->connect_error) {
    die("Connection failed: " . $mysql_db->connect_error);
}
?>
