<h2>Создание Sessions</h2>
<form action="/" method="POST">
    Key: <input type="text" name="session_key" required><br>
    Value: <input type="text" name="session_value" required><br>
    <button type="submit" name="action" value="create_session">Создать session</button>
</form>

<h2>Данные текущей Session</h2>
<?php if (!empty($sessions)): ?>
    <ul>
        <?php foreach ($sessions as $key => $value): ?>
            <li>
                <?= htmlspecialchars($key) ?>: <?= htmlspecialchars($value) ?>
                <a href="?delete_session_key=<?= urlencode($key) ?>">Удалить</a>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="?destroy_session=true">Удалить всю сессию</a>
<?php else: ?>
    <p>Нет установленных сессий.</p>
<?php endif; ?>

