<span class="h4 w-100 d-inline-block">Danh Mục</span>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAdd">
    Thêm
</button>

<!-- The Modal -->
<div class="modal" id="modalAdd">
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
                        <input type="text" class="form-control" id="usr" placeholder="Tên danh mục">
                    </div>
                    <div class="form-group col-6">
                        <select class="form-control" id="sel1">
                            <option>Thư mục cha</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Lưu</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
            </div>

        </div>
    </div>
</div>
<ul class="list-group mt-3 mr-4">
    <li class="list-group-item">First item</li>
    <li class="list-group-item">Second item</li>
    <li class="list-group-item">Third item</li>
</ul>