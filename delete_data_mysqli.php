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

// Fetch existing data based on ID
$result = $conn->query("SELECT * FROM your_table_name WHERE id = $id");

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("Record not found");
}

// Display confirmation form
echo "Are you sure you want to delete the following record?<br>";
echo "ID: " . $row['id'] . "<br>";
echo "Name: " . $row['name'] . "<br>";
echo "Email: " . $row['email'] . "<br>";
echo "<form action='confirm_delete_mysqli.php' method='post'>";
echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
echo "<input type='submit' value='Yes, delete'>";
echo "</form>";

// Close connection
$conn->close();
