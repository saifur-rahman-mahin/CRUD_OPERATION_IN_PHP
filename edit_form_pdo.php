<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Data</title>
</head>
<body>
    <?php
    // Fetch existing data based on ID
    $id = $_GET['id'] ?? '';
    try {
        // Create a new PDO instance
        $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);

        // Set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT * FROM your_table_name WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        // Handle errors
        echo "Error: " . $e->getMessage();
    } finally {
        // Close connection (not necessary for PDO)
        $pdo = null;
    }
    ?>

    <h2>Edit Data</h2>
    <form action="update_data_pdo.php" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        Name: <input type="text" name="name" value="<?php echo $row['name']; ?>"><br>
        Email: <input type="text" name="email" value="<?php echo $row['email']; ?>"><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
