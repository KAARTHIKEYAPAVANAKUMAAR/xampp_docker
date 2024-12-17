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

// Check if 'voltage' parameter is passed in the request
if (isset($_GET['voltage'])) {
    $voltage = floatval($_GET['voltage']); // Get the voltage value and convert it to a float

    // Insert the voltage into the battery_voltages table
    $sql_insert = "INSERT INTO battery_voltages (voltage) VALUES ($voltage)";
    if ($conn->query($sql_insert) === TRUE) {
        echo "Voltage recorded successfully in battery_voltages table!<br>";
    } else {
        echo "Error in insertion: " . $sql_insert . "<br>" . $conn->error;
    }

    // Update the voltage in the first row of the volt_update table
    $sql_update = "UPDATE volt_update SET voltage = $voltage WHERE id = 1";
    if ($conn->query($sql_update) === TRUE) {
        echo "Voltage updated successfully in volt_update table!";
    } else {
        echo "Error in updating: " . $sql_update . "<br>" . $conn->error;
    }
} else {
    echo "No voltage value provided.";
}

// Close the database connection
$conn->close();
?>

