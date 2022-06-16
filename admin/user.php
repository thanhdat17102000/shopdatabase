<?php
    $dataUser=getAllUser();

    $formEdit = "No";
if (isset($_GET['handle'])) {
    if ($_GET['handle'] == 'edit') {
        $id = $_GET['id'];
        $userEdit = getUserById($id);
        $formEdit = "Yes";
    }
}
if (isset($_POST['updateUser'])) {
    if(isset($_POST['roleUser'])&&$_POST['roleUser']!==$userEdit['m_role']){
        updateUser($id,$_POST['roleUser']);
    }
    header("Location: index.php?action=user");
}
?>

<span class="h4 w-100 d-inline-block">Người dùng</span>

<?php if($formEdit === "Yes") :?>
<div>Chỉnh sửa User</div>
<form action="" method="POST" class="form-inline">
    <div class="form-group">

        <label for="">Tên : </label> &ensp;
        <?=$userEdit['m_name']?>
        <div class="form-group ml-3">
            <label for="">Chức vụ :</label>
            <select name="roleUser" class="form-control ml-3 mr-3">
                <option value="admin" <?=$userEdit['m_role']==="admin" ? "selected" : "" ?>>Quản trị viên</option>
                <option value="user" <?=$userEdit['m_role']==="user" ? "selected" : "" ?>>User</option>
            </select>
        </div>

    </div>
    <button class="btn btn-primary" type="submit" name="updateUser">Lưu</button>
    <a href="?action=user" class="btn btn-danger ml-3">Đóng</a>
</form>
<?php endif?>
<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Họ và tên</th>
            <th>Chức vụ </th>
            <th>Ngày tạo</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($dataUser as $item) :?>
        <tr>
            <td><?=$item['id']?></td>
            <td><?=$item['m_email']?></td>
            <td><?=$item['m_name']?></td>
            <td><?=($item['m_role'])==="admin" ? "Quản trị viên" : "Người dùng"?></td>
            <td><?=date("d-m-Y", strtotime($item['created_at']))?></td>
            <td>
                <a href="?action=user&handle=edit&id=<?=$item['id']?>" class="btn btn-primary"><i
                        class="fa-solid fa-pen"></i></a>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>