<?php ob_start(); ?>
    <div class="d-flex justify-content-between align-items-center my-2">
        <h1>Quản lý khách hàng</h1>
        <a href="/employee/create" class="my-2 btn btn-success">Thêm nhân viên</a>
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
        <?php foreach ($employees as $index => $employee): ?>
            <tr>
                <td><?= $index + 1; ?></td>
                <td><?= htmlspecialchars($employee["EmployeeName"], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?= htmlspecialchars($employee["Email"], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?= htmlspecialchars($employee["Province"], ENT_QUOTES, 'UTF-8'); ?></td>
                <td>
                    <?= $employee["IsWorking"] == 1 
                        ? '<span class="badge bg-danger">Đã khóa</span>' 
                        : '<span class="badge bg-success">Hoạt động</span>'; 
                    ?>
                </td>
                <td>
                    <a href="/employee/update/<?= $employee["EmployeeID"]; ?>" class="btn btn-warning btn-sm">Sửa</a>
                    <a href="/employee/delete/<?= $employee["EmployeeID"]; ?>" class="btn btn-danger btn-sm">Xóa</a>
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
