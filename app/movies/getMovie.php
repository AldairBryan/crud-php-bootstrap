<?php
require '../config/database.php';
$id = $conn->real_escape_string($_POST['id']);
$sql = "SELECT id, name, description, id_genre FROM movie WHERE id=$id LIMIT 1";
$result = $conn->query($sql);
$rows = $result->num_rows;

$movie = [];

if($rows > 0 ){
    $movie = $result->fetch_array();
}

echo json_encode($movie, JSON_UNESCAPED_UNICODE);