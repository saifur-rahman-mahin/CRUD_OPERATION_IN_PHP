<?php
require_once 'config.php';

// Validate user input (you can customize this based on your requirements)
$id = $_POST['id'] ?? '';

if (empty($id)) {
    die("ID is required.");
}

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute the SQL statement to delete the record
$stmt = $conn->prepare("DELETE FROM your_table_name WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Record deleted successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
