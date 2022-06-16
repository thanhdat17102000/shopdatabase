<?php
    $dataCategory = getAllCategory(0);
    $dataUser = getAllUser();
    $nameImage = null;
    $target_dir= "../uploads/product/";

// Filter 
if (isset($_POST['filterByUser']) && $_POST['idUser']!=="") {
    $idUser = $_POST['idUser'];
    $dataProduct = getProductByIdUser($idUser);
}
else{
    $dataProduct=getAllProduct();
}
// Add Product
    if (isset($_POST['addProduct'])) {
        if(isset($_FILES)){
            $nameImage = uploadImage($target_dir);
        }
        if (isset($_POST['title']) && isset($_POST['price']) && isset($_POST['quantity']) && isset($_POST['des']) && isset($_POST['idCategory']) && isset($_SESSION['user']['id'])) {
            $data = [$_POST['title'],$_POST['price'],$nameImage,$_POST['quantity'],$_POST['des'],$_SESSION['user']['id'],$_POST['idCategory']];
            addProduct($data);
            return header("Location: index.php?action=product");
        }
    }
    if (isset($_GET['handle'])) {
        if ($_GET['handle'] == 'delete') {
            $id = $_GET['id'];
            $dataProductById=loadFormProduct($id);
            unlink($target_dir.$dataProductById['m_image']);
            deleteProduct($id);
            return header("Location: index.php?action=product");
        }
    }

    $formEdit = "No";
    if (isset($_GET['handle'])) {
        if ($_GET['handle'] == 'edit') {
            $id = $_GET['id'];
            $productEdit = loadFormProduct($id);
            $formEdit = "Yes";
        }
    }
    if (isset($_POST['updateProduct'])) {
        if (isset($_POST['title']) && isset($_POST['price']) && isset($_POST['quantity']) && isset($_POST['des']) && isset($_POST['idCategory']) && isset($_SESSION['user']['id'])) {
            $nameImage=$_POST['imageCurrent'];
            if ($_FILES['image']['name']!=='') {
                if (file_exists($target_dir.$_POST['imageCurrent'])) {
                    unlink($target_dir.$_POST['imageCurrent']);
                    $nameImage = uploadImage($target_dir);
                }
            }
            $data = [$_POST['title'],$_POST['price'],$nameImage,$_POST['quantity'],$_POST['des'],$_SESSION['user']['id'],$_POST['idCategory']];
            updateProduct($data, $_POST['id']);
            return header("Location: index.php?action=product");
        }
    }
?>

<div class="mt-3 h3">Quản lý sản phẩm của <?=$_SESSION['user']['m_name']?></div>

<button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#exampleModal">
    Thêm sản phẩm
</button>

<form class="form-inline mt-3" action="" method="POST">
    <div class="form-group">
        <label for="" class="mr-sm-2">Lọc theo tài khoản:</label>
        <select name="idUser" id="" class="form-control">
            <option value="">Tất cả sản phẩm</option>
            <?php foreach($dataUser as $item) : ?>
            <option value="<?=$item['id']?>" <?=isset($idUser) && $idUser == $item['id'] ? "selected" : "" ?> ><?=$item['m_name']?></option>
            <?php endforeach ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary ml-3" name="filterByUser">Lọc</button>
</form>

<!-- Modal -->
<!-- Add  -->
<form class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" action="" class="mt-3" method="POST" enctype="multipart/form-data">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-4">
                        <label for="">Tên sản phẩm :</label>
                        <input type="text" class="form-control" placeholder="Tên sản phẩm" id="" name="title" require>
                    </div>
                    <div class="form-group col-4">
                        <label for="">Giá :</label>
                        <input type="number" class="form-control" placeholder="Giá sản phẩm" id="" name="price" require>
                    </div>
                    <div class="form-group col-4">
                        <label for="">Số lượng :</label>
                        <input type="number" class="form-control" placeholder="Số lượng sản phẩm" id="" name="quantity"
                            require>
                    </div>
                    <div class="form-group col-12">
                        <label for="">Danh mục :</label>
                        <select class="form-control" id="" name="idCategory">
                            <?php foreach ($dataCategory as $item) : ?>
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-primary" name="addProduct">Thêm sản phẩm</button>
            </div>
        </div>
    </div>
</form>
<!-- Edit  -->
<?php if ($formEdit==="Yes") : ?>
<form class="" id="" action="" class="mt-5" method="POST" enctype="multipart/form-data">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa sản phẩm <span
                    class="text-info h3"><?=$productEdit['m_title'] ?></span> </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <input type="hidden" class="form-control" placeholder="Tên danh mục" name="id"
                    value="<?=$productEdit['id']?>">
                <div class="form-group col-4">
                    <label for="">Tên sản phẩm :</label>
                    <input type="text" class="form-control" placeholder="Tên sản phẩm" id="" name="title"
                        value="<?=$productEdit['m_title'] ?>" require>
                </div>
                <div class="form-group col-4">
                    <label for="">Giá :</label>
                    <input type="number" class="form-control" placeholder="Giá sản phẩm" id="" name="price"
                        value="<?=$productEdit['m_price'] ?>" require>
                </div>
                <div class="form-group col-4">
                    <label for="">Số lượng :</label>
                    <input type="number" class="form-control" placeholder="Số lượng sản phẩm" id="" name="quantity"
                        value="<?=$productEdit['m_quantity'] ?>" require>
                </div>
                <div class="form-group col-12">
                    <label for="">Danh mục :</label>
                    <select class="form-control" id="" name="idCategory">
                        <?php foreach ($dataCategory as $item) : ?>
                        <option value="<?=$item['id']?>"
                            <?=$item['id']!==$productEdit['idCategory'] ? "" : "selected" ?>>
                            <?=$item['m_title']?></option>
                        <?php foreach ($item['subCategory'] as $itemSub) : ?>
                        <option value="<?=$itemSub['id']?>"
                            <?=$itemSub['id']!==$productEdit['idCategory'] ? "" : "selected" ?>> --
                            <?=$itemSub['m_title']?></option>
                        <?php endforeach?>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group col-12">
                    <label for="">Avatar hiện tại :</label>
                    <input type="hidden" class="form-control" placeholder="Tên danh mục" name="imageCurrent"
                        value="<?=$productEdit['m_image']?>">
                    <img src="../uploads/product/<?=$productEdit['m_image']?>" alt="" witdh="100px" height="100px"
                        class="border ml-3">
                </div>
                <div class="form-group col-12">
                    <label for="">Update avatar :</label>
                    <input type="file" id="" class="form-control" name="image">
                </div>
                <div class="form-group col-12">
                    <label for="">Mô tả:</label>
                    <textarea class="form-control" rows="5" id=""
                        name="des"><?=$productEdit['m_description'] ?></textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="?action=product" type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</a>
            <button type="submit" class="btn btn-primary" name="updateProduct">Lưu</button>
        </div>
    </div>
    </div>
</form>
<?php endif ?>
<!-- Show danh sách sản phẩm -->
<?php if ($dataProduct !== []) :?>
<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>Danh mục</th>
            <th>Tên / Hình ảnh</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Mô tả</th>
            <th>Chức vụ / Người đăng</th>
            <th>Tác vụ</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dataProduct as $item) {?>
        <tr>

            <td><?=$item['id']?></td>
            <td><?=getNameCategory($item['idCategory'])?></td>
            <td>
                <div class="clearfix">
                    <span class="float-left"><?=$item['m_title']?></span>
                    <img src="../uploads/product/<?=$item['m_image']?>" alt="" witdh="75px" height="75px"
                        class="float-right">
                </div>
            </td>
            <td><?=$item['m_price']?></td>
            <td><?=$item['m_quantity']?></td>
            <td><?=$item['m_description']?></td>
            <td><?=getRoleUser($item['idUser'])?> / <?=getNameUser($item['idUser'])?></td>
            <td> 
                <?php if(getRoleUser($item['idUser'])==="admin" && $_SESSION['user']['id']!==$item['idUser']) :?>
                <button class="btn btn-secondary" disable>Sửa</button>
                <?php else :?>
                <a href="?action=product&handle=edit&id=<?=$item['id']?>" class="btn btn-primary">Sửa</a>
                <?php endif ?>     
                <a href="?action=product&handle=delete&id=<?=$item['id']?>" class="btn btn-danger">Xóa</a>
            </td>

        </tr>
        <?php } ?>
    </tbody>
</table>
<?php else : ?>
<div class="mt-3">Chưa có sản phẩm nào</div>
<?php endif ?>