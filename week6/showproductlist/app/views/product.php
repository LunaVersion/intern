<?php
$products = $data['products'] ?? [];
?>

<!DOCTYPE html>
<html>
<head><title>Product List</title></head>
<body>
    <h1>Danh sách sản phẩm</h1>
    <ul>
        <?php foreach ($products as $product) : ?>
            <li><?= $product['name'] ?> - <?= $product['price'] ?>$</li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
