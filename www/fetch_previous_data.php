<?php
// Database connection settings
$servername = "mysql";
$username = "smartkosh";
$password = "smartkosh_123";
$dbname = "smartkosh_database";

// Create a new connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the latest 10 records (or as many as you need for the chart)
$sql = "SELECT id, voltage FROM battery_voltages ORDER BY id DESC LIMIT 10";
$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    // Fetch all rows and store them in an array
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $data=array_reverse($data)
}

// Return data in reverse order (oldest first) for proper display on the chart
echo json_encode(array_reverse($data));

// Close the database connection
$conn->close();
?>

