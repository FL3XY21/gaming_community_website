<?php
session_start();
require '../includes/config.php'; // Ensure this path is correct

// Check if the admin is logged in
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php'); // Redirect to login page if not logged in
    exit();
}

// Fetch data from the database
function fetchData($pdo, $table) {
    $stmt = $pdo->prepare("SELECT * FROM $table");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fetch data for each section
$users = fetchData($pdo, 'users');
$tournaments = fetchData($pdo, 'tournaments');
$products = fetchData($pdo, 'store_items');
$submissions = fetchData($pdo, 'contact_submissions'); // Fetch contact submissions
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/sidebar.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="../js/scripts.js" defer></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color:#fff;
            background-size: cover;
            background-position: center;
            color: #fff;
        }
        
        h1 {
            text-align: center;
            margin: 20px 0;
            font-size: 60px;
            color:#000;
            font-weight: bold;
            background:blur(10px);
        }

        h2{
            text-align: center;
            margin: 20px 0;
            font-size: 40px;
            color:#000;
            font-weight: bold;
            background:blur(10px);
        }
        
        .tabs {
            display: flex;
            justify-content: space-around; /* Space out the buttons evenly */
            align-items: center; /* Center the items vertically */
            background-color: rgba(0, 0, 0, 0.8);
            border-bottom: 2px solid #555;
            padding: 10px 0;
            margin: 0;
        }
        
        .tabs button {
            background-color: #fff;
            border: none;
            padding: 14px 20px;
            cursor: pointer;
            margin: 0;
            flex: 1; /* Ensure each button takes up equal space */
            text-align: center; /* Center text within buttons */
            transition: background-color 0.3s; /* Smooth transition for hover effect */
        }
        .tabs button.active {
            background-color: #ddd;
        }
        
        .tabs button:hover {
            background-color: #7A288A; /* Slightly darker background on hover */
        }
        
        .tab-content {
            display: none;
            padding: 20px;
        }
        
        .tab-content.active {
            display: block;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: rgba(0, 0, 0, 0.8);
            color: #fff;
        }
        
        table, th, td {
            border: 1px solid #ddd;
        }
        
        th, td {
            border: 1px solid #555; /* Dark gray border */
            padding: 8px;
            text-align: left;
        }
        
        th {
            background-color: #333; /* Darker background for header */
        }
        
        .edit-button, .delete-button {
            padding: 5px 10px;
            margin: 2px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            font-size: 14px;
        }
        
        .edit-button {
            background-color: #4CAF50; /* Green */
            color: white;
        }
        
        .delete-button {
            background-color: #f44336; /* Red */
            color: white;
        }
        
        .logout-button {
            background-color: #f44336; /* Red */
            color: red;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            margin: 10px;
            border-radius: 5px;
            display: block;
            text-align: center;
        }

        .logout-button:hover {
            background-color: red;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.tabs button');
            const tabContents = document.querySelectorAll('.tab-content');

            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    tabs.forEach(t => t.classList.remove('active'));
                    tabContents.forEach(content => content.classList.remove('active'));

                    tab.classList.add('active');
                    document.getElementById(tab.dataset.target).classList.add('active');
                });
            });

            // Activate the first tab by default
            if (tabs.length > 0) {
                tabs[0].click();
            }
        });
    </script>
</head>
<body>
    <h1>ADMIN DASHBOARD</h1>

    <!-- Navigation Tabs -->
    <div class="tabs">
        <button data-target="manageUsers">Manage Users</button>
        <button data-target="manageTournaments">Manage Tournaments</button>
        <button data-target="manageStore">Manage Store</button>
        <button data-target="manageContact">Manage Contact Submissions</button>
        <button class="logout-button" onclick="location.href='admin_logout.php'">LOGOUT</button>
    </div>

    <!-- Tab Contents -->
    <div id="manageUsers" class="tab-content">
        <h2>MANAGE USERS</h2>
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Account Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo htmlspecialchars($user['created_at']); ?></td>
                        <td>
                            <button class="edit-button" onclick="location.href='edit_user.php?id=<?php echo $user['id']; ?>'">Edit</button>
                            <button class="delete-button" onclick="if(confirm('Are you sure?')) location.href='delete_user.php?id=<?php echo $user['id']; ?>'">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div id="manageTournaments" class="tab-content">
        <h2>MANAGE TOURNAMENTS</h2>
        <table>
            <thead>
                <tr>
                    <th>Tournament Name</th>
                    <th>Description</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Prize</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tournaments as $tournament): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($tournament['tournament_name']); ?></td>
                        <td><?php echo htmlspecialchars($tournament['description']); ?></td>
                        <td><?php echo htmlspecialchars($tournament['start_date']); ?></td>
                        <td><?php echo htmlspecialchars($tournament['end_date']); ?></td>
                        <td><?php echo htmlspecialchars($tournament['prizepool']); ?></td>
                        <td><?php echo htmlspecialchars($tournament['created_at']); ?></td>
                        <td>
                            <button class="edit-button" onclick="location.href='edit_tournament.php?id=<?php echo $tournament['tournament_id']; ?>'">Edit</button>
                            <button class="delete-button" onclick="if(confirm('Are you sure?')) location.href='delete_tournament.php?id=<?php echo $tournament['tournament_id']; ?>'">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div id="manageStore" class="tab-content">
        <h2>MANAGE STORE</h2>
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['item_name']); ?></td>
                        <td><?php echo htmlspecialchars($product['description']); ?></td>
                        <td><?php echo htmlspecialchars($product['created_at']); ?></td>
                        <td>
                            <button class="edit-button" onclick="location.href='edit_store_item.php?id=<?php echo $product['id']; ?>'">Edit</button>
                            <button class="delete-button" onclick="if(confirm('Are you sure?')) location.href='delete_store_item.php?id=<?php echo $product['id']; ?>'">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div id="manageContact" class="tab-content">
        <h2>MANAGE CONTACT SUBMISSIONS</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
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
                        <td><?php echo htmlspecialchars($submission['message']); ?></td>
                        <td><?php echo htmlspecialchars($submission['created_at']); ?></td>
                        <td>
                            <button class="delete-button" onclick="if(confirm('Are you sure you want to delete this submission?')) location.href='delete_submission.php?id=<?php echo $submission['id']; ?>'">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
