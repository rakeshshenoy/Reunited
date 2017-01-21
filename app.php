<?php
$servername = "rakesh-sql.database.windows.net";
$username = "rakeshshenoy";
$password = "Rakesh123";
$db = "rakesh-db";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
?>
