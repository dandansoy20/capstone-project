<?php
date_default_timezone_set("Asia/Manila");
$dbhost = 'localhost';
$dbuser = 'u809230708_mark_denzel';
$dbpass = 'P0s@ngall4';
$dbname = 'u809230708_mark_denzel';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

mysqli_set_charset($conn,"binary");
mysqli_select_db($conn,$dbname);


?>
