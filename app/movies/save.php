<?php
session_start();
require '../config/database.php';
$name = $conn->real_escape_string($_POST['name']);
$description = $conn->real_escape_string($_POST['description']);
$genre = $conn->real_escape_string($_POST['genre']);

$sql = "INSERT INTO movie (name, description, id_genre, date) 
VALUES ('$name', '$description', $genre, NOW())";
if($conn->query($sql)){
    $id= $conn->insert_id;
    $_SESSION['msg'] = "Register Saved";
    if($_FILES['poster']['error'] == UPLOAD_ERR_OK){
        $permited = array("image/jpg", "image/jpeg");
        if(in_array($_FILES['poster']['type'], $permited)){
            $dir = "posters";
            $info_img = pathinfo($_FILES['poster']['name']);
            $info_img['extension'];
            $poster = $dir .'/' . $id . '.jpg';
            if(!file_exists($dir)){
                mkdir($dir, 0777);
            }
            if(!move_uploaded_file($_FILES['poster']['tmp_name'], $poster)){
                $_SESSION['msg'] .= "<br>Error saving image";
            }
        }else {
            $_SESSION['msg'] .= "<br>Format not allowed";
        }
    }
} else {
    $_SESSION['msg'] = "Error saving image";
}

header('Location: index.php');