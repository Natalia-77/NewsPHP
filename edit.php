<?php
include "connection_database.php";
 if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $id = $_GET['id'];
    $sql = "SELECT * FROM `news` WHERE `id` =" . $id;
    $data = $dbh->query($sql);
    $res = $data->fetchAll()[0];
    $imageOld = $res['image'];
    $nameOld = $res['name'];
    $descOld = $res['description'];

}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <title>Редагування</title>
</head>
<body>
<?php include "navbar.php" ?>

<div class="container">
    <div class="row">
        <div class="offset-2 col-md-8 mt-3">
            <h1 class="text-center">Редагувати новину</h1>
            <form enctype="multipart/form-data" method="post">
                <input class="d-none" type="text" id="id" name="id" value=<?= $id ?>/>
                <input class="d-none" type="text" id="oldimage" name="oldimage" value=<?= $imageOld ?>/>
                <div class="form-group mb-3">
                    <label class="form-label" for="name">Заголовок</label>
                    <?php
                    echo " <input type='text ' id='name' value={$nameOld} name='name' class='form-control'/>"
                    ?>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label" for="description">Опис</label>
                    <input type="text" id="description" value=<?= $descOld ?> name="description" class="form-control"/>
                </div>
                <div class="form-group mb-3 d-flex justify-content-center">
                    <label class="form-label" for="image">
                        <img width="120"
                             id="img_pre"
                             src="<?= 'images/' . $imageOld ?>"
                             style="cursor: pointer"
                        />
                    </label>
                    <input type="file" id="image" name="image"
                           class="form-control d-none"/>
                </div>
                <button class="btn btn-success" id="btnSubmit" type="submit">Змінити</button>
            </form>
        </div>
    </div>
</div>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/axios.min.js"></script>
<script type="text/javascript">
    window.addEventListener('load', function () {
        var editId = document.getElementById("id");
        var name = document.getElementById("name");
        var description = document.getElementById("description");
        var image = document.getElementById("image");
        var oldimage = document.getElementById("oldimage");

        const file = document.getElementById('image');
        file.addEventListener('change', function (e) {
            const uploadFile = e.currentTarget.files[0];
            document.getElementById('img_pre').src = URL.createObjectURL(uploadFile);
        });
        var sub = document.getElementById("btnSubmit");
        sub.addEventListener('click', function (e) {
            e.preventDefault();
            const formData = new FormData();
            formData.append('id', editId.value);
            formData.append('name', name.value);
            formData.append('description', description.value);
            formData.append('image', image.files[0]);
            formData.append('oldimage',oldimage.value);
            axios.post("/edit_request.php", formData,{
                headers: {
                    "Content-Type": "multipart/form-data"
                }
            }) .then(resp => {
                  location.replace('/')
                });
        })
    })

</script>
</body>
</html>