<?php
$stores = $data['stores'] ?? [];
?>

<!DOCTYPE html>
<html>
<head><title>Product List</title></head>
<body>
    <h1>Danh sách cửa hàng</h1>
    <ul>
        <?php foreach ($stores as $store) : ?>
            <li><?= $store['name'] ?> - <?= $store['address'] ?>$</li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
