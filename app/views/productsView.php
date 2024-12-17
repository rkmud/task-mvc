<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
</head>
<body>
<h1>Product List</h1>
<div>
    <form action="/products" method="POST" >
        <label>Choose type of sorting</label>
        <select name="action">
            <option value="name">name</option>
            <option value="rating">rating</option>
            <option value="price">price</option>
        </select>
        <button type="submit" name="sort">Sort</button>
    </form>
    <?php if (!empty($products)): ?>
        <?php foreach ($products as $product): ?>
            <div>
                <h2><?= htmlspecialchars($product['name']) ?></h2>
                <p>Price: <?= number_format($product['price'], 2) ?> $</p>
                <p>Rating: <?= htmlspecialchars($product['rating']) ?></p>
                <form action="/cart" method="POST">
                    <input type="hidden" name="productId" value="<?= $product['id'] ?>">
                    <button type="submit" name="addItem">Добавить в корзину</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No products available.</p>
    <?php endif; ?>
</div>
</body>
</html>
