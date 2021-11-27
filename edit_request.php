<?php
include "connection_database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id =$_POST['id'];
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $path =$_POST['oldimage'];
    $del =$_POST['delimage'];
    $image=$_POST['image'];
    if(!empty($_FILES["image"])) {
        $target_dir = "/images/";
        $ext = pathinfo(basename($_FILES["image"]["name"]), PATHINFO_EXTENSION);
        $path= uniqid() . ".{$ext}";
        move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] .  $target_dir . $path);
        if(!empty($del))
        {
            unlink($_SERVER['DOCUMENT_ROOT'] . $target_dir . $del);
        }
    }

    $query = "UPDATE `news` SET `name` = :name, `description` = :description , `image` = :image WHERE `id` = :id";
    $params = [
        ':id' => $id,
        ':name' => $name,
        ':description'=>$desc,
        ':image'=>$path
    ];
    $stmt = $dbh->prepare($query);
    $stmt->execute($params);

}
