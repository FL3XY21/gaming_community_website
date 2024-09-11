<?php
session_start();
require '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['avatar']['tmp_name'];
        $fileName = $_FILES['avatar']['name'];
        $fileSize = $_FILES['avatar']['size'];
        $fileType = $_FILES['avatar']['type'];
        $fileNameCmps = explode('.', $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($fileExtension, $allowedExtensions)) {
            $uploadFileDir = '../uploads/';
            $newFileName = $_SESSION['user_id'] . '.' . $fileExtension;
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                try {
                    $stmt = $pdo->prepare("UPDATE users SET avatar = ? WHERE id = ?");
                    $stmt->execute([$newFileName, $_SESSION['user_id']]);
                    header('Location: profile.php');
                    exit();
                } catch (PDOException $e) {
                    echo 'Database error: ' . $e->getMessage();
                }
            } else {
                echo 'There was an error uploading the file, please try again!';
            }
        } else {
            echo 'Upload failed. Allowed file types: jpg, jpeg, png, gif.';
        }
    } else {
        echo 'No file uploaded or there was an upload error.';
    }
}
?>
