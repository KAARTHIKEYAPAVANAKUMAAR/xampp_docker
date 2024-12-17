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

// Check if this is an initial fetch request
if (isset($_GET['initial']) && $_GET['initial'] === 'true') {
    $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
    $columnName = $_GET['column']; // Column to fetch data for
    $sql = "SELECT id, $columnName FROM battery_cvt ORDER BY id DESC LIMIT $limit";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $records = [];
        while ($row = $result->fetch_assoc()) {
            $records[] = $row;
        }
        // Reverse the order to display from oldest to newest
        echo json_encode(array_reverse($records));
    } else {
        echo json_encode([]);
    }
    $conn->close();
    exit;
}

// Fetch the latest record based on the last fetched ID
if (isset($_GET['last_id'])) {
    $lastFetchedId = intval($_GET['last_id']);
    $columnName = $_GET['column']; // Column to fetch data for
    $sql = "SELECT id, $columnName FROM battery_cvt WHERE id > $lastFetchedId ORDER BY id ASC LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode([]);
    }
    $conn->close();
    exit;
}
?>

