<?php
    session_start();
    require_once "../Database.php";
    isset($_GET['action']) ? $action = $_GET['action'] : $action ='category';
    $action = (string)$action;
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <style>
            a{
                text-decoration : none;
                color : black;
            }
        </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="<?=$action?>.css">
</head>

<body>

    <header class="clearfix pt-3 pb-3 mb-3 border bg-info text-white mr-3 ml-3 ">
        <div class="logo float-left ml-2">Thành Đạt</div>
        <div class="account float-right mr-2">Đây là trang acount</div>
    </header>
    <main class="ml-3">
        <div class="row">
            <div class="col-2 text center">
                <ul class="list-group">
                    <li class="list-group-item <?=$action==="category" ? "active" : ""?>"><a href="?action=category">Quản lý danh mục</a></li>
                    <li class="list-group-item <?=$action==="product" ? "active" : ""?>"><a href="?action=product">Quản lý sản phẩm</a></li>
                    <li class="list-group-item <?=$action==="user" ? "active" : ""?>"><a href="?action=user">Quản lý người dùng</a></li>
                </ul>
            </div>
            <div class="col-10">
                <?php
                    require_once $action.".php";
                ?>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="<?=$action?>.js"></script>
</body>

</html>