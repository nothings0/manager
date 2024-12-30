<?php ob_start(); ?>
    <div class="d-flex justify-content-between align-items-center my-2">
        <h1>Quản lý khách hàng</h1>
        <a href="/user/create" class="my-2 btn btn-success">Thêm khách hàng</a>
    </div>
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
        <button class="btn btn-secondary" type="button" id="button-addon2">
            Tìm kiếm
        </button>
    </div>
    <table class="table table-bordered table-hover text-center align-middle">
    <thead class="table-dark">
            <tr>
                <th width="5%">STT</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Tỉnh/Thành</th>
                <th width="12%">Trạng thái</th>
                <th width="15%">Thao tác</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($customers as $index => $customer): ?>
            <tr>
                <td><?= $customer["CustomerID"] ?></td>
                <td><?= htmlspecialchars($customer["CustomerName"], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?= htmlspecialchars($customer["Email"], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?= htmlspecialchars($customer["Province"], ENT_QUOTES, 'UTF-8'); ?></td>
                <td>
                    <?= $customer["IsLocked"] == 1 
                        ? '<span class="badge bg-danger">Đã khóa</span>' 
                        : '<span class="badge bg-success">Hoạt động</span>'; 
                    ?>
                </td>
                <td>
                    <a href="/user/update/<?= $customer["CustomerID"]; ?>" class="btn btn-warning btn-sm">Sửa</a>
                    <a href="/user/delete/<?= $customer["CustomerID"]; ?>" class="btn btn-danger btn-sm">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php
    // Bao gồm chỉ một lần duy nhất
    include_once(__DIR__ . '/../pagination.php');
    ?>
<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ . '/../layouts/layout.php'); ?>
