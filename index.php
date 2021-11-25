<?php
if(isset($_POST['id'])) {
    $fileToDelete = $basePath.$_POST['id'];
    unlink($fileToDelete);
}

?>




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
    include "modal.php";
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
            <td >{$row['name']}</td>
            <td>{$row['description']}</td>
            <td>
                <img src='/images/{$row['image']}'
                 alt='natalisha'                
                  width='100'/>
            </td>
             <td>
                 <a class='btn' style='background-color:#4dff4d'
                  href='editnews.php?id=${row["id"]}'>Редагувати <i class='far fa-edit'></i>
              </td>
               <td>
                 <a href='#' class='btn  btnDelete' style='background-color: #ff0000'
                 id='delete'
                  data-id='{$row['id']}' 
                  data-name='{$row['name']}'
                  data-image='{$row['image']}'
                  value='{$row['image']} '
                  
                  >Видалити</a>
                </button>
            </td>
        </tr>";
        }
        ?>
        </tbody>
    </table>

    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/axios.min.js"></script>
    <script>
        const elemModal = document.querySelector('#modalDelete');
        const modal = new bootstrap.Modal(elemModal, {});
        window.addEventListener('load', function () {
            const list = document.querySelectorAll(".btnDelete");
            let removeId = 0; //id element delete
            let item = '';
            let path ='';
            for (let i = 0; i < list.length; i++) {
                list[i].addEventListener("click", function (e) {
                    e.preventDefault();
                    removeId = e.currentTarget.dataset.id;
                    item = e.currentTarget.dataset.name;
                    path = e.currentTarget.dataset.image;
                    var res ='images/'+path;
                    console.log(res);
                    elemModal.querySelector('.context').innerHTML = '<h1>' + item + '</h1>';
                    modal.show();
                })
            }

            document.querySelector("#btnDeleteNews").addEventListener("click", function() {
                const formData = new FormData();
                formData.append("id", removeId);
                axios.post("/delete.php", formData)
                    .then(resp => {

                        location.reload();
                    });

            });
        });
    </script>

</body>
</html>
