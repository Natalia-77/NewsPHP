<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Новини Рівного</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>
<body>
<?php include "navbar.php" ?>
<div class="container">
    <h1>Список новин</h1>
    <?php
    include "connection_database.php";
    $sql = "SELECT * FROM news";
    $reader = $dbh->query($sql);
    ?>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Назва</th>
            <th scope="col">Опис</th>
            <th scope="col">Фото</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($reader as $row) {
            echo "
        <tr>
            <th>{$row['id']}</th>
            <td>{$row['name']}</td>
            <td>{$row['description']}</td>
            <td>
                <img src='/images/{$row['image']}' alt='natalisha' width='100'/>
            </td>
             <td>
                 <a class='btn' style='background-color:#4dff4d'
                  href='editnews.php?id=${row["id"]}'>Edit  <i class='far fa-edit'></i>
              </td>
        </tr>";
        }
        ?>
        </tbody>
    </table>

    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/axios.min.js"></script>
</body>
</html>
