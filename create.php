<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "connection_database.php";
    $name = $_POST["name"];
    $description = $_POST["description"];

    $image = uniqid() . '.jpg';
    $filesavepath = $_SERVER['DOCUMENT_ROOT'] . '/images/' . $image;
    move_uploaded_file($_FILES['image']['tmp_name'], $filesavepath);

    $sql = "INSERT INTO `news` (`name`, `description`,`image`) VALUES (?, ?, ?);";
    $dbh->prepare($sql)->execute([$name, $description, $image]);
    header("Location: /");
    exit();
}?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <title>Додавання новини</title>
</head>
<body>
<?php include "navbar.php" ?>
<div class="container">
    <h1>Додати новину</h1>

    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Назва</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Заголовок">
        </div>
        <div class="mb-3" class="form-label">
            <label for="description">Опис</label>
            <textarea class="form-control" rows="10" cols="35" id="description" name="description"
                      placeholder="Опис новини"></textarea>
        </div>
        <div class="mb-3 ">
            <label for="image" class="form-label">
                <img src="./images/empty.png"
                     width="150"
                     id="img_preview"
                     style="cursor: pointer"
                />
                Фото
            </label>
            <input type="file" name="image" id="image" class="form-control d-none"/>
        </div>
        <button type="submit" class="btn mt-3" style="background-color: #80b3ff">Зберегти</button>
    </form>
</div>

<script>
    window.addEventListener('load',function() {
        const file = document.getElementById('image');
        file.addEventListener('change', function(e) {
            const uploadFile = e.currentTarget.files[0];
            document.getElementById('img_preview').src=URL.createObjectURL(uploadFile);
        });
    });
</script>
<script src="/js/bootstrap.bundle.min.js"></script>

</body>
</html>


