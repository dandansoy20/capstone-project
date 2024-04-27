<?php
date_default_timezone_set("Asia/Manila");
$dbhost = 'localhost';
$dbuser = 'steven';
$dbpass = 'abc12311';
$dbname = 'kld_event';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

mysqli_set_charset($conn,"utf8");
mysqli_select_db($conn,base64_decode($dbname));


?>
