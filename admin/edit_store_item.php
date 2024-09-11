<?php
session_start();
require '../includes/config.php'; // Ensure this path is correct

// Check if the admin is logged in
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php'); // Redirect to login page if not logged in
    exit();
}

// Get the product ID from the URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo 'Invalid product ID.';
    exit();
}

$product_id = $_GET['id'];

// Fetch the product details from the database
$stmt = $pdo->prepare('SELECT * FROM store_items WHERE id = ?');
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo 'Product not found.';
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);

    if (empty($name) || empty($description) || empty($price)) {
        $error = 'All fields are required.';
    } elseif (!is_numeric($price)) {
        $error = 'Price must be a number.';
    } else {
        // Update product in the database
        $stmt = $pdo->prepare('UPDATE store_items SET item_name = ?, description = ?, price = ? WHERE id = ?');
        $stmt->execute([$name, $description, $price, $product_id]);
        header('Location: manage_store.php'); // Redirect back to the manage store page
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Store Item</title>
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

        input[type="text"], textarea {
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

        a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
            margin-top: 20px;
        }

        a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: red;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h1>Edit Store Item</h1>
        <form action="edit_store_item.php?id=<?php echo htmlspecialchars($product_id); ?>" method="POST">
            <?php if (isset($error)): ?>
                <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
            
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['item_name']); ?>" required><br>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea><br>

            <label for="price">Price:</label>
            <input type="text" id="price" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required><br>

            <input type="submit" value="Update Item">
        </form>
        <a href="manage_store.php">Back to Manage Store</a>
    </div>
</body>
</html>
