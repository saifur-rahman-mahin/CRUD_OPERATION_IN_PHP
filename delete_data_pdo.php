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

    // Fetch existing data based on ID
    $stmt = $pdo->prepare("SELECT * FROM your_table_name WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        die("Record not found");
    }

    // Display confirmation form
    echo "Are you sure you want to delete the following record?<br>";
    echo "ID: " . $row['id'] . "<br>";
    echo "Name: " . $row['name'] . "<br>";
    echo "Email: " . $row['email'] . "<br>";
    echo "<form action='confirm_delete_pdo.php' method='post'>";
    echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
    echo "<input type='submit' value='Yes, delete'>";
    echo "</form>";

} catch (PDOException $e) {
    // Handle errors
    echo "Error: " . $e->getMessage();
} finally {
    // Close connection (not necessary for PDO)
    $pdo = null;
}
