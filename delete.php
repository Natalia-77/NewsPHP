<?php

if($_SERVER["REQUEST_METHOD"]=="POST") {
    include "connection_database.php";
    $id = $_POST['id'];
    $sql = "SELECT `image` FROM `news` WHERE `Id` =" .$id;
    $data = $dbh->query($sql);
    $fileImage = $data->fetchAll()[0]["image"];
    $path= $_SERVER['DOCUMENT_ROOT']. '/images/'.$fileImage;
    if(unlink($path)) {
        $sql = "DELETE FROM `news` WHERE `Id` =" .$id;
        $dbh->query($sql);
    }

}

