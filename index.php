<?php
declare(strict_types=1);

require __DIR__ . '/src/greeting.php';

// Practice page - try it with ?name=Ilham in the URL.
$name = $_GET['name'] ?? 'world';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CI/CD practice page</title>
</head>
<body>
    <h1><?= htmlspecialchars(greeting($name), ENT_QUOTES, 'UTF-8') ?></h1>
    <p>This tiny page exists so I can practice linting, testing and
       deploying PHP with GitHub Actions. That's the whole app.</p>
</body>
</html>
