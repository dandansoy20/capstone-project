<?php
// Start the session if it hasn't been started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Clear specific session variables
unset($_SESSION['ajax']);
unset($_SESSION['kld_login_expiration']);
unset($_SESSION['login_type']); // It's a good idea to unset the user role as well

// Destroy the session
session_destroy();

// Clear the session cookie (if you have a custom cookie name, adjust accordingly)
if (isset($_COOKIE['kld_login_expiration'])) {
    setcookie('kld_login_expiration', '', time() - 3600, '/'); // Expire the cookie
}

// Redirect to the login page
header('Location: ../index.php#login.php');
exit();
