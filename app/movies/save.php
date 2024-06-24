<?php
require '../config/database.php';
$name = $conn->real_escape_string($_POST['name']);
$description = $conn->real_escape_string($_POST['description']);
$genre = $conn->real_escape_string($_POST['genre']);

$sql = "INSERT INTO movie (name, description, id_genre, date) 
VALUES ('$name', '$description', $genre, NOW())";
if($conn->query($sql)){
    $id= $conn->insert_id;
}

header('Location: index.php');