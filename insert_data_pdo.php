<?php
require_once 'config.php';

// Validate user input (you can customize this based on your requirements)
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';

if (empty($name) || empty($email)) {
    die("Name and Email are required.");
}

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);

    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute the SQL statement
    $stmt = $pdo->prepare("INSERT INTO your_table_name (name, email) VALUES (:name, :email)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);

    $stmt->execute();

    echo "Data inserted successfully";
} catch (PDOException $e) {
    // Handle errors
    echo "Error: " . $e->getMessage();
} finally {
    // Close connection (not necessary for PDO)
    $pdo = null;
}
