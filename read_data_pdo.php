<?php
require_once 'config.php';

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);

    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch and display data
    $stmt = $pdo->query("SELECT * FROM your_table_name");

    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "Name: " . $row['name'] . " - Email: " . $row['email'] . "<br>";
        }
    } else {
        echo "No records found";
    }
} catch (PDOException $e) {
    // Handle errors
    echo "Error: " . $e->getMessage();
} finally {
    // Close connection (not necessary for PDO)
    $pdo = null;
}
