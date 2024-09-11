<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit();
}

require '../includes/config.php';

// Initialize $tournament as null
$tournament = null;

// Check if 'id' is set in the URL
if (isset($_GET['id'])) {
    $id = (int) $_GET['id']; // Ensure ID is an integer
    
    // Prepare and execute the SQL query
    $stmt = $pdo->prepare('SELECT * FROM tournaments WHERE tournament_id = ?');
    if ($stmt->execute([$id])) {
        $tournament = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        // Handle SQL error
        $error = "SQL error: " . implode(", ", $stmt->errorInfo());
    }
    
    if (!$tournament) {
        $error = "No tournament found with ID: " . htmlspecialchars($id);
    }
} else {
    $error = "No id parameter in URL.";
}

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['tournament_name'];
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $prizepool = $_POST['prizepool'];
    $description = $_POST['description'];
    
    if ($tournament) {
        $stmt = $pdo->prepare('UPDATE tournaments SET tournament_name = ?, start_date = ?, end_date = ?, prizepool = ?, description = ? WHERE tournament_id = ?');
        $stmt->execute([$name, $startDate, $endDate, $prizepool, $description, $id]);
        
        header('Location: manage_tournaments.php');
        exit();
    } else {
        $error = "Tournament not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tournament</title>
    <style>/* General styles for the entire page */
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
    background: transparent; 
    border: 2px solid rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    border-radius: 10px;
    padding: 30px 40px;
}

.wrapper h1 {
    font-size: 30px;
    text-align: center;
    font-weight:bold;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    font-weight: bold;
    margin-top: 10px;
    font: size 20px;
}

input[type="text"], input[type="date"], input[type="number"], textarea {
    width: 100%;
    height: 40px;
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
    margin-top: 20px;
    display: inline-block;
    text-align: center;
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
    <script src="../js/scripts.js" defer></script>
</head>
<body>
    <div class="wrapper">
        <h1>Edit Tournament</h1>
        <?php if ($tournament): ?>
            <form action="edit_tournament.php?id=<?php echo htmlspecialchars($id); ?>" method="POST">
                <label for="tournament_name">Name:</label>
                <input type="text" id="tournament_name" name="tournament_name" value="<?php echo htmlspecialchars($tournament['tournament_name']); ?>" required><br>
                
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date" value="<?php echo htmlspecialchars($tournament['start_date']); ?>" required><br>
                
                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date" value="<?php echo htmlspecialchars($tournament['end_date']); ?>"><br>
                
                <label for="prizepool">Prizepool:</label>
                <input type="number" id="prizepool" name="prizepool" step="0.01" value="<?php echo htmlspecialchars($tournament['prizepool']); ?>"><br>
                
                <label for="description">Description:</label>
                <textarea id="description" name="description"><?php echo htmlspecialchars($tournament['description']); ?></textarea><br>
                
                <input type="submit" value="Update Tournament">
            </form>
        <?php else: ?>
            <p>Tournament not found. Please check the ID and try again.</p>
        <?php endif; ?>
        <a href="manage_tournaments.php"><center>Back to Manage Tournaments</center></a>
    </div>
</body>
</html>
