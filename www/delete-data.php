<?php
//$servername = "localhost";
//$username = "root";
//$password = "";
//$dbname = "esp_web_test";

$servername = "mysql";        // Use "mysql" if you are using Docker with the given setup
$username = "smartkosh";      // Replace with your MySQL username
$password = "smartkosh_123";  // Replace with your MySQL password
$dbname = "smartkosh_database";    // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to delete all rows
$sql = "DELETE FROM battery_voltages";

if ($conn->query($sql) === TRUE) {
    echo "All records deleted successfully ";


    // Reset AUTO_INCREMENT to 1
    $reset_sql = "ALTER TABLE battery_voltages AUTO_INCREMENT = 1";
    if ($conn->query($reset_sql) === TRUE) {
        echo " ID reset to start from 1.";
    } else {
        echo "Error resetting ID: " . $conn->error;
    }


} else {
    echo "Error deleting records: " . $conn->error;
}

// Close the connection
$conn->close();
?>

