<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');

require('creds.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

$stmt = $conn->prepare("INSERT INTO events (uvid, timedate, details, domain) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $uvid, $time, $details, $domain);

$uvid = "001";
$time = date('Y-m-d H:i:s');
$details = "{}";
$domain = "example.com";

if ($stmt->execute() === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $conn->error;
  }

$stmt->close();
$conn->close();

?>