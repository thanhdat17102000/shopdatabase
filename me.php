<?php
    $dataCategory = getAllCategory(0);
    $dataProduct=getProductByIdUser($_SESSION['user']['id']);
    $nameImage = null;
    $target_dir= "./uploads/product/";
    // Add Product
    if (isset($_POST['addProduct'])) {
        if (isset($_POST['title']) && isset($_POST['price']) && isset($_POST['quantity']) && isset($_POST['des']) && isset($_POST['idCategory']) && isset($_SESSION['user']['id'])) {
            if(isset($_FILES)){
                $nameImage = uploadImage($target_dir);
            }
            $data = [$_POST['title'],$_POST['price'],$nameImage,$_POST['quantity'],$_POST['des'],$_SESSION['user']['id'],$_POST['idCategory']];
            addProduct($data);
            return header("Location: index.php?action=me");
        }
    }
    // Delete 
    if (isset($_GET['handle'])) {
        if ($_GET['handle'] == 'delete') {
            $id = $_GET['id'];
            $dataProductById=loadFormProduct($id);
            unlink($target_dir.$dataProductById['m_image']);
            deleteProduct($id);
            return header("Location: index.php?action=me");
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
            updateProduct($data,$_POST['id']);
            return header("Location: index.php?action=me");
        }
    }
?>

<div class="mt-3 h3">Qu???n l?? s???n ph???m c???a <?=$_SESSION['user']['m_name']?></div>

<button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#exampleModal">
    Th??m s???n ph???m
</button>

<!-- Modal -->
<!-- Add  -->
<form class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" action="" class="mt-3" method="POST" enctype="multipart/form-data">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Th??m s???n ph???m</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-4">
                        <label for="">T??n s???n ph???m :</label>
                        <input type="text" class="form-control" placeholder="T??n s???n ph???m" id="" name="title" require>
                    </div>
                    <div class="form-group col-4">
                        <label for="">Gi?? :</label>
                        <input type="number" class="form-control" placeholder="Gi?? s???n ph???m" id="" name="price" require>
                    </div>
                    <div class="form-group col-4">
                        <label for="">S??? l?????ng :</label>
                        <input type="number" class="form-control" placeholder="S??? l?????ng s???n ph???m" id="" name="quantity"
                            require>
                    </div>
                    <div class="form-group col-12">
                        <label for="">Danh m???c :</label>
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
                        <label for="">M?? t???:</label>
                        <textarea class="form-control" rows="5" id="" name="des"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">????ng</button>
                <button type="submit" class="btn btn-primary" name="addProduct">Th??m s???n ph???m</button>
            </div>
        </div>
    </div>
</form>
<!-- Edit  -->
<?php if ($formEdit==="Yes") : ?>
<form class="" id="" action="" class="mt-5" method="POST" enctype="multipart/form-data">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ch???nh s???a s???n ph???m <span
                    class="text-info h3"><?=$productEdit['m_title'] ?></span> </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
            <input type="hidden" class="form-control" placeholder="T??n danh m???c" name="id"
                    value="<?=$productEdit['id']?>">
                <div class="form-group col-4">
                    <label for="">T??n s???n ph???m :</label>
                    <input type="text" class="form-control" placeholder="T??n s???n ph???m" id="" name="title"
                        value="<?=$productEdit['m_title'] ?>" require>
                </div>
                <div class="form-group col-4">
                    <label for="">Gi?? :</label>
                    <input type="number" class="form-control" placeholder="Gi?? s???n ph???m" id="" name="price"
                        value="<?=$productEdit['m_price'] ?>" require>
                </div>
                <div class="form-group col-4">
                    <label for="">S??? l?????ng :</label>
                    <input type="number" class="form-control" placeholder="S??? l?????ng s???n ph???m" id="" name="quantity"
                        value="<?=$productEdit['m_quantity'] ?>" require>
                </div>
                <div class="form-group col-12">
                    <label for="">Danh m???c :</label>
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
                    <label for="">Avatar hi???n t???i :</label>
                    <input type="hidden" class="form-control" placeholder="T??n danh m???c" name="imageCurrent"
                        value="<?=$productEdit['m_image']?>">
                    <img src="uploads/product/<?=$productEdit['m_image']?>" alt="" witdh="100px" height="100px"
                        class="border ml-3">
                </div>
                <div class="form-group col-12">
                    <label for="">Update avatar :</label>
                    <input type="file" id="" class="form-control" name="image">
                </div>
                <div class="form-group col-12">
                    <label for="">M?? t???:</label>
                    <textarea class="form-control" rows="5" id=""
                        name="des"><?=$productEdit['m_description'] ?></textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="?action=me" type="button" class="btn btn-secondary" data-dismiss="modal">????ng</a>
            <button type="submit" class="btn btn-primary" name="updateProduct">L??u</button>
        </div>
    </div>
    </div>
</form>
<?php endif ?>
<!-- Show danh s??ch s???n ph???m -->
<?php if ($dataProduct !== []) {?>
<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>Danh m???c</th>
            <th>T??n / H??nh ???nh</th>
            <th>Gi??</th>
            <th>S??? l?????ng</th>
            <th>M?? t???</th>
            <th>T??c v???</th>
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
                    <img src="uploads/product/<?=$item['m_image']?>" alt="" witdh="75px" height="75px"
                        class="float-right">
                </div>
            </td>
            <td><?=$item['m_price']?></td>
            <td><?=$item['m_quantity']?></td>
            <td><?=$item['m_description']?></td>
            <td> <a href="?action=me&handle=edit&id=<?=$item['id']?>" class="btn btn-primary">S???a</a>
                <a href="?action=me&handle=delete&id=<?=$item['id']?>" class="btn btn-danger">X??a</a>
            </td>

        </tr>
        <?php } ?>
    </tbody>
</table>
<?php } else { ?>
<div class="mt-3">B???n ch??a c?? s???n ph???m n??o</div>
<?php } ?>