<?php
// Set headers for CORS and Content-Type
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Database connection parameters
$servername = "database-1.cxzg4akd6dhy.ap-northeast-1.rds.amazonaws.com"; // Replace with your server name or IP
$username = "admin"; // Replace with your database username
$password = "Bk+w%H86"; // Replace with your database password
$dbname = "gasstation"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    // Use HTTP status code 500 for server error
    http_response_code(500);
    echo json_encode(array('error' => 'Connection failed: ' . $conn->connect_error));
    exit(); // Terminate script execution on connection error
}

// SQL query
$sql = "SELECT country_name FROM country"; // Adjust with your table and column names
$result = $conn->query($sql);

// Prepare array to hold cities data
$countries = [];

if ($result->num_rows > 0) {
    // Fetch data of each row and add to countries array
    while($row = $result->fetch_assoc()) {
        $countries[] = $row;
    }
    // Encode countries array as JSON and output
    echo json_encode($countries);
} else {
    // If no results, return an empty array
    echo json_encode(array());
}

// Close connection
$conn->close();
?>