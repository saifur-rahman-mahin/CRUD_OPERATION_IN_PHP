<?php
require_once 'config.php';

// Validate user input (you can customize this based on your requirements)
$id = $_POST['id'] ?? '';
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';

if (empty($id) || empty($name) || empty($email)) {
    die("ID, Name, and Email are required.");
}

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);

    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute the SQL statement
    $stmt = $pdo->prepare("UPDATE your_table_name SET name = :name, email = :email WHERE id = :id");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':id', $id);

    $stmt->execute();

    echo "Data updated successfully";
} catch (PDOException $e) {
    // Handle errors
    echo "Error: " . $e->getMessage();
} finally {
    // Close connection (not necessary for PDO)
    $pdo = null;
}
