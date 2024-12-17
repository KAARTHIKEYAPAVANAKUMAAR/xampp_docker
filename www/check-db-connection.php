<?php
// Database configuration
$servername = "mysql";        // Use "mysql" if you are using Docker with the given setup
$username = "smartkosh";      // Replace with your MySQL username
$password = "smartkosh_123";  // Replace with your MySQL password
$dbname = "smartkosh_database"; // Replace with your database name

// Check database connection
try {
    // Create a new MySQLi connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check for connection errors
    if ($conn->connect_error) {
        echo "disconnected"; // Output if the connection fails
    } else {
        echo "connected"; // Output if the connection is successful
    }
} catch (Exception $e) {
    // Catch any other exceptions and output "disconnected"
    echo "disconnected";
} finally {
    // Close the connection if it was established
    if (isset($conn) && $conn->ping()) {
        $conn->close();
    }
}
?>

