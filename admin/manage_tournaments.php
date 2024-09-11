<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit();
}

require '../includes/config.php';

// Fetch tournaments from database
try {
    $stmt = $pdo->query('SELECT * FROM tournaments');
    $tournaments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Debugging: Check if $tournaments is properly set
    if ($tournaments === false) {
        $error = 'Error fetching tournaments from the database.';
    } else if (empty($tournaments)) {
        $message = 'No tournaments found.';
    }
} catch (PDOException $e) {
    $error = 'Database error: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Tournaments</title>
    <style>/* General reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body styling */
body {
    position: relative;
    display: flex;
    justify-content: center;   
    align-items: center;
    min-height: 100vh;
    margin: 0;
    font-family: Arial, sans-serif;
    color: #fff;
    background: url('mainbg.jpg') no-repeat center center;
    background-size: cover;
}

/* Pseudo-element for background image opacity */
body::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5); /* Overlay to adjust brightness */
    z-index: -1;
}

/* Wrapper for content */
.wrapper {
    width: 80%;
    max-width: 1000px;
    background:transparent; /* Dark semi-transparent background for content */
    border: 2px solid rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(5px);
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    border-radius: 10px;
    padding: 30px 40px;
    text-align: center;
}

/* Heading styles */
.wrapper h1 {
    font-size: 30px;
    font-weight: bold; /* Bold heading */
    margin-bottom: 20px;
}

/* Table styling */
.wrapper table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.wrapper th, .wrapper td {
    border: 1px solid rgba(255, 255, 255, 0.2);
    padding: 10px;
    text-align: left;
    font-weight: bold; /* Bold text */
}

.wrapper th {
    background-color: rgba(255, 255, 255, 0.1);
}

.wrapper tr:nth-child(even) {
    background-color: rgba(255, 255, 255, 0.05);
}

/* Link styling */
.wrapper a {
    color: red; /* Green for links */
    text-decoration: none;
    margin: 0 5px;
    font-weight: bold; /* Bold links */
}

.wrapper a:hover {
    text-decoration: underline;
}

/* Error message styling */
.error-message {
    color: #f44336; /* Red for errors */
    font-size: 14px;
    margin-top: 10px;
}
</style>
    <script src="../js/scripts.js" defer></script>
</head>
<body>
    <div class="wrapper">
        <h1>Manage Tournaments</h1>
        <a href="add_tournament.php">Add New Tournament</a>
        <?php if (isset($error)): ?>
            <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <?php if (isset($message)): ?>
            <p><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Prizepool</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($tournaments) && is_array($tournaments)): ?>
                    <?php foreach ($tournaments as $tournament): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($tournament['tournament_id']); ?></td>
                        <td><?php echo htmlspecialchars($tournament['tournament_name']); ?></td>
                        <td><?php echo htmlspecialchars($tournament['start_date']); ?></td>
                        <td><?php echo htmlspecialchars($tournament['prizepool']); ?></td>
                        <td>
                            <a href="edit_tournament.php?id=<?php echo $tournament['tournament_id']; ?>">Edit</a>
                            <a href="delete_tournament.php?id=<?php echo $tournament['tournament_id']; ?>">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No tournaments available.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
