<?php
session_start(); // Start the session

// Unset all of the session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Clear cookies (example: adjust names accordingly)
if (isset($_COOKIE['loggedin'])) {
    setcookie('loggedin', '', time() - 3600, '/'); // Set cookie expiration to the past
}

if (isset($_COOKIE['user'])) {
    setcookie('user', '', time() - 3600, '/'); // Set cookie expiration to the past
}

if (isset($_COOKIE['firstVisit'])) {
    setcookie('firstVisit', '', time() - 3600, '/'); // Set cookie expiration to the past
}

// Redirect to login page or home page
header('Location: index.php');
exit();
?>
