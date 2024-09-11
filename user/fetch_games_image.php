<?php
// Include database configuration
include '../includes/config.php'; // Adjust the path if needed

// Check if the ID is provided in the query string
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Prepare and execute the SQL query to fetch the image data and type
    $stmt = $pdo->prepare("SELECT image, image_type FROM games WHERE id = ?");
    $stmt->execute([$id]);

    // Fetch the image data and type
    $game = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($game && $game['image']) {
        // Set the correct content type for the image
        header('Content-Type: ' . $game['image_type']);
        header('Content-Length: ' . strlen($game['image'])); // Optional: specify the content length

        // Output the image data
        echo $game['image'];
    } else {
        // Image not found
        header("HTTP/1.0 404 Not Found");
        echo "Image not found";
    }
} else {
    // ID not provided
    header("HTTP/1.0 400 Bad Request");
    echo "No image ID provided";
}
?>
