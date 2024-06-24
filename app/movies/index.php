<?php
require '../config/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP</title>

    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-3">
        <h2 class="text-center">Movies</h2>

        <div class="row justify-content-end">
            <div class="col-auto">
                <a href="" class="btn btn-primary"data-bs-toggle="modal" data-bs-target="#newModal"><i class="fa-solid fa-circle-plus"></i> New Register</a>
            </div>
        </div>
        <table class="table table-sm table-stripped table-hover mt-4">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Genre</th>
                    <th>Poster</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    <?php
    $sqlGenre = "SELECT id, name FROM genre";
    $genres = $conn->query($sqlGenre);
    ?>
    <?php include 'newModal.php'; ?>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>