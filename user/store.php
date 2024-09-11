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

// Fetch data from the 'items' table
$store_items = fetchData($pdo, 'store_items');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item List</title>
    <link rel="stylesheet" href="../css/tournament.css">
</head>
<body>
    <div class="info">
        <h1>
            <p>Gear up for epic adventures! </p>
            <p>Our gaming store offers the latest in gaming hardware, accessories, and merchandise to elevate your gaming experience..</p>
        </h1>
    </div>
    <div class="content-container">
        <div class="tab-content">
            <h2>ITEMS</h2>
            <table>
                <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($store_items as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['item_name']); ?></td>
                            <td><?php echo htmlspecialchars($item['description']); ?></td>
                            <td><?php echo htmlspecialchars($item['price']); ?></td>
                            <td>
                                <?php if ($item['image']): ?>
                                    <center><img src="display_image.php?id=<?php echo $item['id']; ?>" alt="<?php echo htmlspecialchars($item['item_name']); ?>" style="width: 100px; height: auto;"></center>
                                <?php else: ?>
                                    No Image
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
