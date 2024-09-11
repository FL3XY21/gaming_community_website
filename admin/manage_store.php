<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit();
}

require '../includes/config.php';

// Fetch store items from database
$stmt = $pdo->query('SELECT * FROM store_items');
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Store</title>
    <style>
        /* General styles for the entire page */
        body {
            display: flex;
            justify-content: center;   
            align-items: center;
            min-height: 100vh;
            background: url('mainbg.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            font-family: Arial, sans-serif;
        }

        .wrapper {
            width: 90%;
            max-width: 1200px;
            background: transparent; /* Semi-transparent background */
            border: 2px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            padding: 30px 40px;
        }

        .wrapper h1 {
            font-size: 30px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background: rgba(255, 255, 255, 0.2);
        }

        tr:nth-child(even) {
            background: rgba(255, 255, 255, 0.1);
        }

        a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            margin-top: 10px;
            display: inline-block;
            margin-right: 10px;
            text-align: center;
        }

        a:hover {
            text-decoration: underline;
            text-align: center;
        }

        .action-buttons a {
            margin-right: 10px;
            color:red;
        }
    </style>
    <script src="../js/scripts.js" defer></script>
</head>
<body>
    <div class="wrapper">
        <h1>Manage Store</h1>
        <a href="add_store_item.php">Add New Store Item</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['id']); ?></td>
                    <td><?php echo htmlspecialchars($item['item_name']); ?></td>
                    <td><?php echo htmlspecialchars($item['description']); ?></td>
                    <td><?php echo htmlspecialchars($item['price']); ?></td>
                    <td class="action-buttons">
                        <a href="edit_store_item.php?id=<?php echo $item['id']; ?>">Edit</a>
                        <a href="delete_store_item.php?id=<?php echo $item['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
