<?php
require 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Get image path to delete file
    $stmt = $pdo->prepare("SELECT image_path FROM trainers WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $trainer = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($trainer && file_exists($trainer['image_path'])) {
        unlink($trainer['image_path']); // Delete image from folder
    }

    // Delete record from DB
    $stmt = $pdo->prepare("DELETE FROM trainers WHERE id = :id");
    $stmt->execute([':id' => $id]);
}

header("Location: index.php");
exit();
?>
