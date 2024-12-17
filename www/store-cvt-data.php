<?php
// Database credentials
$servername = "mysql";        // Use "mysql" if you are using Docker with the given setup
$username = "smartkosh";      // Replace with your MySQL username
$password = "smartkosh_123";  // Replace with your MySQL password
$dbname = "smartkosh_database"; // Replace with your database name

// Create a new connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if all required parameters are passed in the request
if (isset($_GET['voltage']) && isset($_GET['current']) && isset($_GET['temperature'])) {
    $voltage = floatval($_GET['voltage']);       // Get the voltage value
    $current = floatval($_GET['current']);       // Get the current value
    $temperature = floatval($_GET['temperature']); // Get the temperature value

    // Insert the data into the database
    $sql = "INSERT INTO battery_cvt (voltage, current, temperature) VALUES ($voltage, $current, $temperature)";

    if ($conn->query($sql) === TRUE) {
        echo "Data recorded successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Missing parameters: Ensure voltage, current, and temperature are provided.";
}

// Close the database connection
$conn->close();
?>

