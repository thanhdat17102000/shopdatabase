<?php
    session_start();


    //auto login if has data
    if (!isset($_SESSION['user'])){
        if(isset($_COOKIE['user'])){
            $_SESSION['user'] = json_decode($_COOKIE['user'], true);
        }
    }

    require_once "Database.php";
    isset($_GET['action']) ? $action = $_GET['action'] : $action ='home';
    $action = (string)$action;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
    a {
        text-decoration: none;
        color: black;
    }
    </style>
    <link rel="stylesheet" href="<?=$action?>.css">
</head>

<body>
    <header class="clearfix text-white bg-info pt-3 pb-3">
        <div class="float-left ml-3"></div>
        <div class="float-right mr-3">
            <a href="?action=login">Đăng ký/Đăng nhập</a>
        </div>
    </header>
    <main> 
            <?php
                    require_once $action.".php";
            ?>
    </main>
    <footer></footer>
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