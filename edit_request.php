<?php
include "connection_database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id =$_POST['id'];
    $name = $_POST['name'];
    $query = "UPDATE `news` SET `name` = :name WHERE `id` = :id";
    $params = [
        ':id' => $id,
        ':name' => $name
    ];
    $stmt = $dbh->prepare($query);
    $stmt->execute($params);

}
