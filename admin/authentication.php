<?php
session_start();
$current_page = basename($_SERVER['PHP_SELF']); // Get the current page name

if (!isset($_SESSION['auth']) && $current_page != 'login.php' && $current_page != 'logincode.php') {
    $_SESSION['auth_status'] = "You need to login first";
    header('Location: login.php'); 
    exit(0);
}


// If accessing admin pages and user is not an admin, redirect them
if (strpos($_SERVER['PHP_SELF'], '/admin/login/') !== false) {
    if ($_SESSION['auth'] != 1) {
        $_SESSION['status'] = "You are not authorized as ADMIN";
        header('Location: ../index.php');  // Redirect to user homepage
        exit(0);
    }
}



?>