<?php
session_start();
require '../includes/config.php'; // Ensure correct database connection

$query = isset($_GET['query']) ? $_GET['query'] : '';

if (!empty($query)) {
    try {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE username LIKE ?');
        $stmt->execute(['%' . $query . '%']);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $error = 'Database query error: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <style></style>
</head>
<body>
    <header>
        <?php require '../includes/header.php'; ?>
    </header>
    <main>
        <h1>Search Results</h1>
        <?php if (isset($error)): ?>
            <p><?php echo htmlspecialchars($error); ?></p>
        <?php elseif (!empty($results)): ?>
            <ul>
                <?php foreach ($results as $user): ?>
                    <li><?php echo htmlspecialchars($user['username']); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No results found.</p>
        <?php endif; ?>
    </main>
</body>
</html>
