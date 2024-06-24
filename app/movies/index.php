<?php
session_start();
require '../config/database.php';
$sqlMovies = "SELECT m.id, m.name, m.description, g.name AS genre FROM movie AS m 
INNER JOIN genre as g 
ON m.id_genre=g.id";
$movies = $conn->query($sqlMovies);
$dir = 'posters/';
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
        <hr>
        <?php if(isset($_SESSION['msg'])) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $_SESSION['msg']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        unset($_SESSION['msg']);
        } ?>
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
                <?php while($row_movie = $movies->fetch_assoc()){ ?>
                    <tr>
                        <td><?=$row_movie['id']; ?></td>
                        <td><?=$row_movie['name']; ?></td>
                        <td><?=$row_movie['description']; ?></td>
                        <td><?=$row_movie['genre']; ?></td>
                        <td><img src="<?= $dir .$row_movie['id'].'.jpg'; ?>" width="100"></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" data-bs-id="<?= $row_movie['id'] ?>"> <i class="fa-solid fa-pen-to-square"></i> Edit</a>
                            <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-bs-id="<?= $row_movie['id'] ?>"> <i class="fa-solid fa-trash"></i> Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php
    $sqlGenre = "SELECT id, name FROM genre";
    $genres = $conn->query($sqlGenre);
    ?>
    <?php include 'newModal.php'; ?>
    <?php $genres->data_seek(0);?>
    <?php include 'editModal.php'; ?>
    <?php include 'deleteModal.php'; ?>
    <script>
        let editModal = document.getElementById('editModal')
        let deleteModal = document.getElementById('deleteModal')
        editModal.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')

            let inputId = editModal.querySelector('.modal-body #id')
            let inputName = editModal.querySelector('.modal-body #name')
            let inputDescription = editModal.querySelector('.modal-body #description')
            let inputGenre = editModal.querySelector('.modal-body #genre')

            let url="getMovie.php"
            let formData=new FormData()
            formData.append('id', id)
            fetch(url, {
                method: "POST",
                body: formData
            }).then(response => response.json())
            .then(data => {
                inputId.value = data.id
                inputName.value = data.name
                inputDescription.value = data.description
                inputGenre.value = data.id_genre

            }).catch(err => console.log(err))

        })

        deleteModal.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')
            deleteModal.querySelector('.modal-footer #id').value = id
        })
    </script>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>