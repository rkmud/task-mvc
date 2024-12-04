<h2>Создание Cookies</h2>
<form action="/" method="POST">
    Name: <input type="text" name="cookie_name" required><br>
    Value: <input type="text" name="cookie_value" required><br>
    Time (seconds): <input type="number" name="cookie_time" required><br>
    <button type="submit" name="action"  value="create_cookie">Создать cookie</button>

</form>

<h2>Список Cookies</h2>
<?php if (!empty($cookies)): ?>
    <ul>
        <?php foreach ($cookies as $key => $value): ?>
            <li>
                <?= htmlspecialchars($key) ?>: <?= htmlspecialchars($value) ?>
                <a href="?delete_cookie=<?= urlencode($key) ?>">Удалить</a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Нет установленных cookies.</p>
<?php endif; ?>
