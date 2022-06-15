<?php
    $data = getAllCategory($id=0);
?>


<?php
// add category
if (isset($_POST['addCategory'])){
    if(isset($_POST['title']) && isset($_POST['idParent'])){
        addCategory($_POST['idParent'],$_POST['title']);
        return header("Refresh:0");
    }
}
// delete category
if (isset($_GET['handle'])) {
    if ($_GET['handle'] == 'delete') {
        $id = $_GET['id'];
        deleteCategory($id);
        return header("Location: index.php?action=category");
    }
}
// loadFormEdit
$formEdit = "No";
if (isset($_GET['handle'])) {
    if ($_GET['handle'] == 'edit') {
        $id = $_GET['id'];
        $categoryEdit = loadFormCategory($id);
        $formEdit = "Yes";
    }
}
// updateCategory
if (isset($_POST['updateCategory'])){
    if(isset($_POST['index']) && isset($_POST['title']) && isset($_POST['idParent'])){
        updateCategory($_POST['id'],$_POST['idParent'],$_POST['title'],$_POST['index']);
        return header("Refresh:0");
    }
}
?>
<span class="h4 w-100 d-inline-block">Danh Mục</span>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAdd">
    Thêm
</button>

<!-- FormEdit -->
<?php if ($formEdit == 'Yes') :?>
<span class="h4 w-100 d-inline-block mt-3">Chỉnh Sửa Danh Mục</span>
<form action="" method="POST">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Tên danh mục</th>
                <th>Thư mục cha</th>
                <th>Vị trí</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <input type="hidden" class="form-control" placeholder="Tên danh mục" name="id"
                    value="<?=$categoryEdit['id']?>">
                <td>
                    <div class="form-group">
                        <input type="text" class="form-control" value="<?=$categoryEdit['m_title']?>"
                            placeholder="Tên danh mục" name="title">
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <select class="form-control" id="sel1" name="idParent">
                            <option value="0">Thư mục gốc</option>
                            <?php foreach ($data as $item) : ?>
                            <option value="<?=$item['id']?>"
                                <?=$item['id']==$categoryEdit['id_parent'] ? "selected" : ""?>> <?=$item['m_title']?>
                            </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <input type="text" class="form-control" value="<?=$categoryEdit['m_index']?>"
                            placeholder="Vị trí" name="index">
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <button type="submit" class="btn btn-primary" name="updateCategory">Cập nhật</button>
    <a href="?category" type="submit" class="btn btn-danger">Đóng</a>

</form>
<?php endif ?>


<!-- The Modal -->
<form action="" method="POST" class="modal" id="modalAdd">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Thêm danh mục</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-6">
                        <input type="text" class="form-control" placeholder="Tên danh mục" name="title">
                    </div>
                    <div class="form-group col-6">
                        <select class="form-control" id="sel1" name="idParent">
                            <option value="0">Thư mục gốc</option>
                            <?php foreach ($data as $item) : ?>
                            <option value="<?=$item['id']?>"><?=$item['m_title']?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" name="addCategory">Lưu</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
            </div>

        </div>
    </div>
</form>


<?php if($data == []){
    echo "<div class='mt-3'> Chưa có danh mục nào </div>";
}
    else { ?>

<table class="table table-bordered  mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $item) :?>
        <tr>
            <td><?=$item['id']?></td>
            <td><?=$item['m_title']?></td>
            <td>
                <a href="?action=category&handle=edit&id=<?=$item['id']?>" class="btn btn-primary">Sửa</a>
                <a href="?action=category&handle=delete&id=<?=$item['id']?>" class="btn btn-danger">Xóa</a>
            </td>
        </tr>
        <?php if ($item['subCategory'] != []) :?>
        <?php foreach ($item['subCategory'] as $itemSub) :?>
        <tr>

            <td><?=$itemSub['id']?></td>
            <td> -- <?=$itemSub['m_title']?></td>
            <td>
                <a href="?action=category&handle=edit&id=<?=$itemSub['id']?>" class="btn btn-primary">Sửa</a>
                <a href="?action=category&handle=delete&id=<?=$itemSub['id']?>" class="btn btn-danger">Xóa</a>
            </td>
        </tr>
        <?php endforeach ?>
        <?php endif ?>
        <?php endforeach ?>
    </tbody>
</table>

<?php } ?>
