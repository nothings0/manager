<?php ob_start(); ?>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Quản lý mặt hàng</h1>
        <a href="/product/create" class="btn btn-success">Thêm mặt hàng</a>
    </div>
    <table class="table table-bordered table-hover text-center align-middle table-hover text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th width="5%">#</th>
                <th width="10%">Ảnh</th>
                <th>Tên mặt hàng</th>
                <th>Mô tả</th>
                <th>Giá (VNĐ)</th>
                <th width="15%">Thao tác</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $index => $product): ?>
                <tr>
                    <td><?= $index + 1; ?></td>
                    <td>
                    <img src="<?= htmlspecialchars($product['Photo'] ? '/public/images/' . htmlspecialchars($product['Photo'], ENT_QUOTES, 'UTF-8') : '/public/images/nophoto.png', ENT_QUOTES, 'UTF-8'); ?>" 
                        alt="<?= htmlspecialchars($product['ProductName'], ENT_QUOTES, 'UTF-8'); ?>" 
                        class="rounded img-thumbnail" 
                        style="width: 60px; height: 60px;">

                    </td>
                    <td><?= htmlspecialchars($product['ProductName'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?= htmlspecialchars($product['ProductDescription'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?= number_format((float)$product['Price'], 2, '.', ','); ?></td>
                    <td>
                        <a href="/product/update/<?= $product['ProductID']; ?>" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i> Sửa
                        </a>
                        <a href="/product/delete/<?= $product['ProductID']; ?>" 
                           class="btn btn-danger btn-sm">
                            <i class="bi bi-trash"></i> Xóa
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="text-muted">Không có mặt hàng nào trong danh sách.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ . '/../layouts/layout.php'); ?>
