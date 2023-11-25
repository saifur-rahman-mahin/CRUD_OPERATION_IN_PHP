<?php
require_once 'config.php';

// Validate user input (you can customize this based on your requirements)
$id = $_POST['id'] ?? '';

if (empty($id)) {
    die("ID is required.");
}

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);

    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute the SQL statement to delete the record
    $stmt = $pdo->prepare("DELETE FROM your_table_name WHERE id = :id");
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo "Record deleted successfully";
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }

} catch (PDOException $e) {
    // Handle errors
    echo "Error: " . $e->getMessage();
} finally {
    // Close connection (not necessary for PDO)
    $pdo = null;
}
