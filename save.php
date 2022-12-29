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

$stmt = $conn->prepare("INSERT INTO events (uvid, timedate, details, domain, url, selector, x, y, type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssiis", $uvid, $time, $details, $domain, $url, $selector, $x, $y, $type);

$uvid = "001";
// $time = date('Y-m-d H:i:s');
$details = "{}";
$domain = $_SERVER['SERVER_NAME'];

$request = file_get_contents('php://input');
$data = json_decode($request);
//$data  = filter_input_array($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$url = $_SERVER['HTTP_REFERER'];

foreach ($data as $event) {

    $type = $event->type;
    $time = $event->time;
    $selector = $event->selector;
    $x = $event->x;
    $y = $event->y;
    
    if ($stmt->execute() === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $conn->error;
    }
}
die();




$stmt->close();
$conn->close();

?>