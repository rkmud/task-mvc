<p>
    <?php
        if (isset($product)) {
            printf("Id: %d<br> Name Product: %s<br> Cost: %d", $product['id'], $product['name'], $product['price']);
        }
    ?>
</p>

