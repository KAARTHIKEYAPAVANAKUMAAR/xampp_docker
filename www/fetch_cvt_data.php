<?php
// Database credentials
//$host = 'localhost';  // Your database host
//$dbname = 'esp_web_test'; // Your database name
//$user = 'root'; // Your database username
//$password = ''; // Your database password

$servername = "mysql";        // Use "mysql" if you are using Docker with the given setup
$username = "smartkosh";      // Replace with your MySQL username
$password = "smartkosh_123";  // Replace with your MySQL password
$dbname = "smartkosh_database";    // Replace with your database name

// Create a new connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the last fetched ID from the request
$lastFetchedId = isset($_GET['last_id']) ? intval($_GET['last_id']) : 0;

// Fetch the latest record with id greater than the last fetched id
$sql = "SELECT id, voltage, current, temperature, time_stamp FROM battery_cvt WHERE id > $lastFetchedId ORDER BY id ASC LIMIT 1";
$result = $conn->query($sql);

// Check if any result is returned
if ($result->num_rows > 0) {
    // Fetch the latest record as an associative array
    $latestRecord = $result->fetch_assoc();
    echo json_encode($latestRecord); // Return data as JSON
} else {
    echo json_encode([]); // Return an empty array if no record is found
}

// Close the database connection
$conn->close();
?>

