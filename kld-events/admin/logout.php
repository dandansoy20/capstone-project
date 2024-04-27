<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
unset($_SESSION['ajax']);
unset($_SESSION['kld_login_expiration']);
unset($_COOKIE['kld_login_expiration']);
session_destroy();
header('Refresh:0,url=login.php');
?>