<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "php_admin_panel";

// Create connection using mysqli object
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    header("location: ../error.php");
    die("Connection failed: " . $conn->connect_error);
}
?>
