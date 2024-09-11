<?php
include '../includes/config.php'; // Adjust the path if needed

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];

    $stmt = $pdo->prepare("SELECT image, image_type FROM store_items WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $image = $row['image'];
        $image_type = $row['image_type']; // Assuming you store image type (e.g., 'image/jpeg')

        // Set the correct Content-Type header based on the image type
        header('Content-Type: ' . $image_type);
        echo $image;
    } else {
        echo 'No image found';
    }
} else {
    echo 'Invalid image id';
}
?>
