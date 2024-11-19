<?php if (isset($product) && $product): ?>
    <p>
        ID: <?= htmlspecialchars($product->id) ?> <br>
        Name: <?= htmlspecialchars($product->name) ?> <br>
        Price: <?= htmlspecialchars($product->price) ?> $
    </p>
<?php endif; ?>
