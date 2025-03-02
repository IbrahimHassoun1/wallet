<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wallet";
$continue = true;
// Create connection
$continue = $conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully||\n";
?>