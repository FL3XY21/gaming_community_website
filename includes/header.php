<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="../css/header.css">

</head>
<body>
    
    <header>
        <nav>
            <ul class="nav-links">
                <li><a href="index.php">HOME</a></li>
                <li><a href="about.php">ABOUT</a></li>
                <li><a href="games.php">GAMES</a></li>
                <li><a href="tournaments.php">TOURNAMENTS</a></li>
                <li><a href="store.php">STORE</a></li>
                <li><a href="social_media.php">CONTACT US</a></li>
                
            </ul>
            <div class="nav-right">
                <form action="search.php" method="GET" class="search-form">
                    <input type="text" name="query" placeholder="Search...">
                    <button type="submit" class="search-button">Search</button>
                </form>
                <a href="logout.php" class="logout-button">Logout</a>
            </div>
        </nav>
    </header>
</body>
</html>
