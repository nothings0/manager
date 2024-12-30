<?php ob_start(); ?>
    <h1>Xóa người dùng</h1>
    <form action="" method="POST">
        <div class="mb-3">
            <label class="form-label" for="">Họ Tên</label>
            <input disabled readonly type="text" name="customerName" class="form-control" placeholder="Tên..." value="<?= $customer["CustomerName"]; ?>" autofocus>
        </div>
        <div class="mb-3">
            <label class="form-label" for="">Email</label>
            <input disabled readonly type="email" name="email" class="form-control" placeholder="Email..." value="<?= $customer["Email"]; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label" for="">Tỉnh/Thành</label>
            <select name="province" class="form-select" aria-label="-- Chọn tỉnh/thành --">
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label" for="">Địa chỉ</label>
            <input disabled readonly type="text" name="address" class="form-control" placeholder="Mật khẩu..." value="<?= $customer["Address"]; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label" for="">Trạng thái</label>
            <select name="isLocked" class="form-select" disabled readonly>
                <option value="0" <?= $customer['IsLocked'] == 0 ? 'selected' : ''; ?>>Chưa kích hoạt</option>
                <option value="1" <?= $customer['IsLocked'] == 1 ? 'selected' : ''; ?>>Kích hoạt</option>
            </select>
        </div>
        <div class="d-flex gap-2 justify-content-end">
            <a class="btn btn-default" href="/">Quay lại</a>
            <button class="btn btn-danger">Xóa</button>
        </div>
    </form>
    <?php $content = ob_get_clean(); ?>
    <?php include(__DIR__ . '/../layouts/layout.php'); ?>