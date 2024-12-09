<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Search Page</title>
    </head>
    <body>
        <h1>Search</h1>
        <form action="/search" method="get">
            <input type="text" name="value" placeholder="Search..." required>
            <button type="submit" name="search" value="1">Search</button>
        </form>

        <form action="/search" method="post">
            <button type="submit" name="delete_cache" value="1">Clear Cache</button>
        </form>

        <div id="results">
            <?php if (!empty($message)): ?>
                <p><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p>
            <?php endif; ?>

            <?php if (!empty($results)): ?>
                <h2>Results:</h2>
                <?php foreach ($results as $result): ?>
                    <div>
                        <a href="<?= htmlspecialchars($result['url'], ENT_QUOTES, 'UTF-8') ?>">
                            <?= htmlspecialchars($result['title'], ENT_QUOTES, 'UTF-8') ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </body>
</html>
