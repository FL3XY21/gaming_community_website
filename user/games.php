<?php include '../includes/header.php'; ?>
<?php
// Display errors for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database configuration file
include '../includes/config.php'; // Adjust the path if needed

// Function to fetch data from the database
function fetchData($pdo, $table) {
    $stmt = $pdo->prepare("SELECT * FROM $table");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fetch data from the 'games' table
$games = fetchData($pdo, 'games');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game List</title>
    <link rel="stylesheet" href="../css/game.css"> <!-- Ensure this CSS file exists and is correctly linked -->
</head>
<body>
    <div class="info">
        <h1>
        Dive into the action with our diverse game collection,!<br>
             where every click leads to an exciting new adventure
        </h1>
    </div>
    <div class="content-container">
        <div class="tab-content">
            <h2>GAMES</h2>
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Content</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($games as $game): ?>
                        <tr>
                            <td>
                                <?php if (!empty($game['image'])): ?>
                                    <center><img src="fetch_games_image.php?id=<?php echo $game['id']; ?>" alt="<?php echo htmlspecialchars($game['item_name']); ?>"></center>
                                <?php else: ?>
                                    No Image
                                <?php endif; ?>
                            </td>
                            <td>
                                    <p><?php echo htmlspecialchars($game['description']); ?></p>
                                    <a href="<?php echo htmlspecialchars($game['play_url']); ?>" class="btn">Play Now</a>
                            </td>
                            <td>
                                <?php if (!empty($game['video_url'])): ?>
                                    <div class="video-container">
                                        <iframe src="<?php echo htmlspecialchars($game['video_url']); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                <?php else: ?>
                                    No Video
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<?php include '../includes/footer.php'; ?>
