<?php
// Database credentials

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

// Check if 'voltage' parameter is passed in the request
if (isset($_GET['voltage'])) {
    $voltage = floatval($_GET['voltage']); // Get the voltage value and convert it to a float

    // Insert the voltage into the database
    $sql = "INSERT INTO battery_voltages (voltage) VALUES ($voltage)";

    if ($conn->query($sql) === TRUE) {
        echo "Voltage recorded successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "No voltage value provided.";
}

// Close the database connection
$conn->close();
?>
