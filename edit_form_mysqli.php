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
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $result = $conn->query("SELECT * FROM your_table_name WHERE id = $id");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        die("Record not found");
    }

    $conn->close();
    ?>

    <h2>Edit Data</h2>
    <form action="update_data_mysqli.php" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        Name: <input type="text" name="name" value="<?php echo $row['name']; ?>"><br>
        Email: <input type="text" name="email" value="<?php echo $row['email']; ?>"><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
