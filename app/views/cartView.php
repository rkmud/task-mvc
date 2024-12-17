<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
</head>
<body>
<h1>Your Cart</h1>
<div>
    <?php if (empty($items)): ?>
        <p>Your cart is empty.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($items as $item): ?>
                <li>
                    <?= htmlspecialchars($item['name']) ?>
                    <?= number_format($item['price'], 2) ?>
                    <form action="/cart" method="POST">
                        <input type="hidden" name="productId" value="<?= htmlspecialchars((string)$item['id']) ?>">
                        <button type="submit" name="removeCart">Remove</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
<a href="/products">Back to Products</a>
</body>
</html>
