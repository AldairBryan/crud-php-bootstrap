<?php
require '../config/database.php';
$id = $conn->real_escape_string($_POST['id']);
$name = $conn->real_escape_string($_POST['name']);
$description = $conn->real_escape_string($_POST['description']);
$genre = $conn->real_escape_string($_POST['genre']);

$sql = "UPDATE movie SET name = '$name', description = '$description', id_genre = $genre WHERE id = $id";
if($conn->query($sql)){
}

header('Location: index.php');