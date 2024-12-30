<?php ob_start(); ?>
    <div class="d-flex justify-content-between align-items-center my-2">
        <h1>Quản lý loại hàng</h1>
        <a href="/category/create" class="my-2 btn btn-success">Thêm loại hàng</a>
    </div>
    <table class="table table-bordered table-hover text-center align-middle">
    <thead class="table-dark">
            <tr>
                <th width="5%">STT</th>
                <th>Tên loại hàng</th>
                <th>Mô tả</th>
                <th width="15%">Thao tác</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($categories as $index => $category): ?>
            <tr>
                <td><?= $index + 1; ?></td>
                <td><?= htmlspecialchars($category["CategoryName"], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?= htmlspecialchars($category["Description"], ENT_QUOTES, 'UTF-8'); ?></td>
                <td>
                    <a href="/category/update/<?= $category["CategoryID"]; ?>" class="btn btn-warning btn-sm">Sửa</a>
                    <a href="/category/delete/<?= $category["CategoryID"]; ?>" class="btn btn-danger btn-sm">Xóa</a>
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
