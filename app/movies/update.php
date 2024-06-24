<?php
session_start();
require '../config/database.php';
$id = $conn->real_escape_string($_POST['id']);
$name = $conn->real_escape_string($_POST['name']);
$description = $conn->real_escape_string($_POST['description']);
$genre = $conn->real_escape_string($_POST['genre']);

$sql = "UPDATE movie SET name = '$name', description = '$description', id_genre = $genre WHERE id = $id";
if($conn->query($sql)){
    $_SESSION['color'] = "success";
    $_SESSION['msg'] = "Register Updated";
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
                $_SESSION['color'] = "danger";
                $_SESSION['msg'] .= "<br>Error saving image";
            }
        }else {
            $_SESSION['color'] = "danger";
            $_SESSION['msg'] .= "<br>Format not allowed";
        }
    }
} else {
    $_SESSION['color'] = "danger";
    $_SESSION['msg'] = "Error updating register";
}

header('Location: index.php');