<h2>Создание Sessions</h2>
<form action="/" method="POST">
    Value: <input type="text" name="session_value" required><br>
    <button type="submit" name="action" value="create_session">Создать session</button>
</form>

<h2>Данные текущей Session</h2>
<?php if (!empty($sessions)): ?>
    <ul>
        <?php foreach ($sessions as $key => $value): ?>
            <li>
                <?= htmlspecialchars($key) ?>: <?= htmlspecialchars($value) ?>
                <a href="?delete_session=<?= urlencode($key) ?>">Удалить</a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Нет установленных сессий.</p>
<?php endif; ?>
