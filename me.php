<?php
    $dataCategory = getAllCategory(0);
    if (isset($_POST['addProduct'])) {
        if(isset($_FILES)) {
            $idImage = time();
            $target_dir = "./uploads/product/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            if (isset($_POST["addProduct"])) {
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if ($check !== false) {
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            }

            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }

            // Check file size
            if ($_FILES["image"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                $target_file = $target_dir . $idImage . '.' . $imageFileType;
                $nameImage = $idImage . '.' . $imageFileType;
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    
                } else {
                    
                }
            }
        }
    }
    
?>

<div class="container">
    <span class="h3">Đăng sản phẩm</span>
    <form action="" class="mt-3" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="form-group col-4">
                <label for="">Tên sản phẩm :</label>
                <input type="text" class="form-control" placeholder="Tên sản phẩm" id="" name="title">
            </div>
            <div class="form-group col-4">
                <label for="">Giá :</label>
                <input type="number" class="form-control" placeholder="Giá sản phẩm" id="" name="price">
            </div>
            <div class="form-group col-4">
                <label for="">Số lượng :</label>
                <input type="number" class="form-control" placeholder="Số lượng sản phẩm" id="" name="quantity">
            </div>
            <div class="form-group col-12">
                <label for="">Danh mục :</label>
                <select class="form-control" id="" name="idCategory">
                    <?php foreach($dataCategory as $item) : ?>
                    <option value="<?=$item['id']?>"><?=$item['m_title']?></option>
                    <?php foreach ($item['subCategory'] as $itemSub) : ?>
                    <option value="<?=$itemSub['id']?>"> -- <?=$itemSub['m_title']?></option>
                    <?php endforeach?>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group col-12">
                <label for="">Avatar :</label>
                <input type="file" id="" class="form-control" name="image">
            </div>
            <div class="form-group col-12">
                <label for="">Mô tả:</label>
                <textarea class="form-control" rows="5" id="" name="des"></textarea>
            </div>
        </div>

        <button type="submit" class="btn btn-primary" name="addProduct">Thêm sản phẩm</button>
    </form>
</div>