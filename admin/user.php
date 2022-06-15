<<<<<<< HEAD
User
=======
<?php
    $dataUser=getAllUser();
?>

<span class="h4 w-100 d-inline-block">Người dùng</span>

<table class="table table-bordered">
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
                <a href="?action=user&handle=edit&id=<?=$item['id']?>" class="btn btn-primary"><i class="fa-solid fa-pen"></i></a>
                <a href="?action=user&handle=edit&id=<?=$item['id']?>" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
>>>>>>> c85b69f351e1ec72f98e303f78db67b5d0ccb3e2
