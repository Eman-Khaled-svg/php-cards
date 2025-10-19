<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $specialty = $_POST['specialty'];
    $email = $_POST['email'];

    $img_name = $_FILES['image']['name'];
    $img_tmp = $_FILES['image']['tmp_name'];
    $upload_path = "uploads/" . $img_name;
// file upload
    if (move_uploaded_file($img_tmp, $upload_path)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO trainers (Name, Speciatly, Email, Image_path) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $specialty, $email, $upload_path]);

            header("Location: index.php?success");
            exit();
        } catch (PDOException $e) {
            echo "Database Error: " . $e->getMessage();
        }
    } else {
        echo "Failed to upload image!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Trainer</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark text-white">
<div class="container mt-5">
    <h2 class="text-center mb-4">Add New Trainer</h2>
    <form action="" method="POST" enctype="multipart/form-data" class="w-50 mx-auto border p-4 bg-white shadow rounded text-dark">
        <div class="mb-3">
            <label class="form-label">Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Specialty:</label>
            <input type="text" name="specialty" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Image:</label>
            <input type="file" name="image" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Add Trainer</button>
        <a href="index.php" class="btn btn-secondary w-100 mt-2">Back to List</a>
    </form>
</div>
</body>
</html>
