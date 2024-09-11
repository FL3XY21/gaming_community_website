<?php include '../includes/header.php'; ?>
<?php
// Display errors for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database configuration file
include '../includes/config.php'; // Adjust the path if needed

// Check if the connection was successful
function fetchData($pdo, $table) {
    $stmt = $pdo->prepare("SELECT * FROM $table");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
$tournaments = fetchData($pdo, 'tournaments');
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tournament List</title>
    <link rel="stylesheet" href="../css/tournament.css">
</head>
<body>
    <div class="info">
        <h1><p>Join the action and prove your skills in our ultimate gaming tournament!</p><p> Compete for glory, epic prizes, and the chance to become the top gamer in our community.</p></h1>
                
    </div>
    <div class="content-container">
        <div class="tab-content">
            <h2>TOURNAMENTS</h2>
            <table>
                <thead>
                    <tr>
                        <th>Tournament Name</th>
                        <th>Description</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Prize</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tournaments as $tournament): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($tournament['tournament_name']); ?></td>
                            <td><?php echo htmlspecialchars($tournament['description']); ?></td>
                            <td><?php echo htmlspecialchars($tournament['start_date']); ?></td>
                            <td><?php echo htmlspecialchars($tournament['end_date']); ?></td>
                            <td><?php echo htmlspecialchars($tournament['prizepool']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="image-gallery">
            <h2>GALLERY</h2>
            <div class="image-container">
            <!-- Example images, replace with actual tournament images -->
            <img src="i1.jpg" alt="Tournament 1">
            <img src="i4.jpeg" alt="Tournament 2">
            <img src="i5.jpg" alt="Tournament 3"></div>
        </div></div>
    </div>
</body>
</html>
<?php include '../includes/footer.php'; ?>
