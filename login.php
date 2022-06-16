<?php
    // Check user đăng nhập hay chưa

    if(isset($_SESSION['user'])){
        header("Location: index.php");
    }

    if (isset($_POST['register'])){
        if(isset($_POST['email']) && isset($_POST['password'])  && isset($_POST['fullname'])){
            register($_POST['email'],$_POST['password'],$_POST['fullname']);
            
        }
    }
    // Đăng nhập
    if (isset($_POST['login'])){
        if(isset($_POST['email']) && isset($_POST['password'])){
            $isSave = false;
            if(isset($_POST['remember'])){
                $isSave = true;
            }
            $check = login($_POST['email'],$_POST['password'],$isSave);
            
            if($check === 1){
                header("Location: index.php");
            }
        }
    }
?>
<div class="row ml-2 mr-2">
    <div class="col-6 border-right">
        <h3 class="text-center">--- Đăng ký tài khoản ---</h3>
        <form method="POST" action="">
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" class="form-control" placeholder="Email" name="email">
            </div>
            <div class="form-group">
                <label for="">Mật khẩu</label>
                <input type="password" class="form-control" id="" placeholder="Mật khẩu" name="password">
            </div>
            <div class="form-group">
                <label for="">Họ và tên</label>
                <input type="text" class="form-control" id="" placeholder="Họ và tên" name="fullname">
            </div>
            <button type="reset" class="btn btn-danger">Làm mới</button>
            <button type="submit" class="btn btn-primary" name="register">Đăng ký</button>
        </form>
    </div>
    <div class="col-6">
        <h3 class="text-center">--- Đăng nhập ---</h3>
        <form action="" method="POST">
            <div class="form-group">
                <label for="">Email :</label>
                <input type="email" class="form-control" placeholder="Enter" id="" name="email">
            </div>
            <div class="form-group">
                <label for="pwd">Mật khẩu:</label>
                <input type="password" class="form-control" placeholder="Mật khẩu" id="" name="password">
            </div>
            <div class="form-group form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="remember"> Ghi nhớ đăng nhập
                </label>
            </div>
            <button type="submit" class="btn btn-primary" name="login">Đăng nhập</button>
        </form>
    </div>
</div>