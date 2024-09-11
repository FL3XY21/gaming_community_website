<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit();
}

require '../includes/config.php';

// Fetch submissions from the database
$stmt = $pdo->query('SELECT * FROM contact_submissions ORDER BY created_at DESC');
$submissions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Submissions</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Contact Form Submissions</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Problem</th>
                <th>Message</th>
                <th>Date Submitted</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($submissions as $submission): ?>
                <tr>
                    <td><?php echo htmlspecialchars($submission['id']); ?></td>
                    <td><?php echo htmlspecialchars($submission['name']); ?></td>
                    <td><?php echo htmlspecialchars($submission['email']); ?></td>
                    <td><?php echo htmlspecialchars($submission['problem']); ?></td>
                    <td><?php echo htmlspecialchars($submission['message']); ?></td>
                    <td><?php echo htmlspecialchars($submission['created_at']); ?></td>
                    <td>
                        <a href="delete_submission.php?id=<?php echo htmlspecialchars($submission['id']); ?>" onclick="return confirm('Are you sure you want to delete this submission?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
