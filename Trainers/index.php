<?php
require 'config.php';

$stmt=$pdo->query("SELECT * FROM trainers");
$trainers=$stmt->fetchAll(PDO::FETCH_ASSOC);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Document</title>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">Trainer Dashboard </h1>
            <a href="add.php" class="btn btn-warning">Create New Trainer</a>
        </div>
       <div class="row">
        <?php if (!empty($trainers)): ?>
            <?php foreach ($trainers as $trainer): ?>
                <div class="col-md-4 mb-4">
                    <div class="card text-dark shadow">
                        <img src="<?= htmlspecialchars($trainer['Image_path']) ?>" class="card-img-top" alt="Trainer Image" style="height:250px; object-fit:cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($trainer['Name']) ?></h5>
                            <p class="card-text">
                                <strong>Specialty:</strong> <?= htmlspecialchars($trainer['Speciatly']) ?><br>
                                <strong>Email:</strong> <?= htmlspecialchars($trainer['Email']) ?>
                            </p>
                            <a href="delete.php?id=<?= $trainer['id'] ?>" class="btn btn-danger w-100"
                               onclick="return confirm('Are you sure you want to delete this trainer?')">Delete</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center text-muted">No trainers found. Add one!</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>