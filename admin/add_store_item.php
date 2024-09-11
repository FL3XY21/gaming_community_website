<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require '../includes/config.php';

    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);
    $quantity = trim($_POST['quantity']);

    // Validate input
    if (empty($name) || empty($description) || empty($price) || empty($quantity)) {
        $error = 'All fields are required.';
    } elseif (!is_numeric($price) || !is_numeric($quantity)) {
        $error = 'Price and quantity must be numeric.';
    } else {
        $stmt = $pdo->prepare('INSERT INTO store_items (item_name, description, price, quantity) VALUES (?, ?, ?, ?)');
        $stmt->execute([$name, $description, $price, $quantity]);

        header('Location: manage_store.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Store Item</title>
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

        }

        .wrapper {
            width: 420px;
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

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
        }

        input[type="text"], input[type="number"], textarea {
            width: 100%;
            background: transparent;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 5px;
            color: #fff;
            padding: 10px;
            margin-top: 5px;
        }

        textarea {
            height: 100px;
            resize: vertical; /* Allows vertical resizing */
        }

        input[type="submit"] {
            width: 100%;
            height: 45px;
            background: #fff;
            border: none;
            border-radius: 40px;
            color: #333;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 20px;
        }

        input[type="submit"]:hover {
            background: #e0e0e0;
        }

        .error-message {
            color: red;
            font-weight: bold;
            margin-top: 20px;
            text-align: center;
        }

        .wrapper a{
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h1>Add Store Item</h1>
        <?php if (isset($error)): ?>
            <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form action="add_store_item.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br>
            <label for="description">Description:</label>
            <textarea id="description" name="description"></textarea><br>
            <label for="price">Price:</label>
            <input type="number" step="0.01" id="price" name="price" required><br>
            <input type="submit" value="Add Store Item">
        </form>
        <a href="manage_store.php"><center>Back to Manage Store</center></a>
    </div>
</body>
</html>
