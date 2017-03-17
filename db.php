<?php
$dbhost = 'localhost';
$dbuser = 'cybertec_basic';
$dbpass = 'ID961160367';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if (!$conn) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("cybertec_hexis", $conn);


?>