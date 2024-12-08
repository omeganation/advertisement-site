<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'adspace');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data
$title = $_POST['title'];
$description = $_POST['description'];
$category = $_POST['category'];
$price = $_POST['price'] ?? null;
$image_path = null;

// Handle file upload
if (!empty($_FILES['image']['name'][0])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"][0]);
    if (move_uploaded_file($_FILES["image"]["tmp_name"][0], $target_file)) {
        $image_path = $target_file;
    }
}

// Insert into database
$stmt = $conn->prepare("INSERT INTO ads (user_id, title, description, category, price, image_path) VALUES (?, ?, ?, ?, ?, ?)");
$user_id = 1; // Placeholder: Replace with logged-in user ID
$stmt->bind_param("isssds", $user_id, $title, $description, $category, $price, $image_path);

if ($stmt->execute()) {
    echo "Ad posted successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$conn->close();
?>
