<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'adspace');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch ads
$result = $conn->query("SELECT * FROM ads ORDER BY created_at DESC");

$ads = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ads[] = $row;
    }
}

// Output JSON for front-end use
header('Content-Type: application/json');
echo json_encode($ads);

$conn->close();
?>
