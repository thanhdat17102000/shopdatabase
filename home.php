<?php $dataProduct=getAllProduct(); ?>
<?php if(isset($_SESSION['user'])) :?>
<div class="mt-3 ml-3">
    <a href="?action=me" class="btn btn-info"> Đăng sản phẩm</a>
    <?php if($_SESSION['user']['m_role'] === "admin" ) : ?>
    <a href="./admin/index.php" class="btn btn-info">Trang quản trị</a>
    <?php endif ?>

</div>
<?php endif ?>
<div class="row ml-3 mr-3">
    <?php foreach($dataProduct as $item) :?>
    <div class="col-4 mt-3">
        <div class="card">
            <div>
                <img class="card-img-bottom" src="uploads/product/<?=$item['m_image']?>" alt="Card image"
                    style="width: auto; max-width : 100% ; height:300px;display:block;margin-left:auto;margin-right:auto">
            </div>

            <div class="card-body">
                <h4 class="card-title"><?=$item['m_title']?></h4>
                <div class="clearfix mt-3">
                    <p class="card-text float-left h3 text-danger"><?=number_format($item['m_price'],0,'','.')?> VNĐ</p>
                    <a href="" class="btn btn-primary float-right">Xem chi tiết</a>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach ?>
</div>