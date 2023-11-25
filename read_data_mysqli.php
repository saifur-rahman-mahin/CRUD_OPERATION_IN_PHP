<?php
require_once 'config.php';

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch and display data
$sql = "SELECT * FROM your_table_name";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Name: " . $row['name'] . " - Email: " . $row['email'] . "<br>";
    }
} else {
    echo "No records found";
}

// Close connection
$conn->close();
