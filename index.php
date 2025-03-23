<?php
include 'db_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Fetch data from database
$sql = "SELECT * FROM home ORDER BY id DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="index.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>CandonXplore</title>
</head>
<body>
    <section class="hero">
        <div class="container">
            <h1>CandonXplore</h1>
            <div class="img">
                <img src="Pictures/Home/candon-logo.png" alt="CandonXplore Logo">
            </div>
            <form>
                <input type="text" name="search" placeholder="Search...">
                <button type="submit"><i class="bi bi-search"></i></button>
            </form>
            <nav class="nav">
                <ul class="nav-link">
                    <li class="link"><a href="index.php">Home</a></li>
                    <li class="link" id="attractions"><a href="attractions/attractions.php">Attractions</a>
                        <ul class="dropdown">
                            <li><a href="attractions/pages/experience.php">Experience</a></li>
                            <li><a href="attractions/pages/historical-tourist-sites.php">Historical Tourist Sites</a></li>
                            <li><a href="attractions/pages/historical-landsites.php">Historical Landsites</a></li>
                            <li><a href="attractions/pages/recreational-facilities.php">Recreational Facilities</a></li>
                            <li><a href="attractions/pages/livelihoods.php">Livelihoods</a></li>
                            <li><a href="attractions/pages/ancestral-houses.php">Ancestral Houses</a></li>
                            <li><a href="attractions/pages/experience.php">Experience</a></li>
                        </ul>
                    </li>
                    <li class="link"><a href="Hotels/Hotels.php">Hotels</a></li>
                    <li class="link"><a href="restaurants/resto.php">Restaurants</a></li>
                    <li class="link"><a href="Events/Events.php">Events</a></li>
                </ul>
            </nav>
            <div class="menu-icon">
                <i class="bi bi-list"></i>
            </div>
        </div>
    </section>

    <?php foreach ($entries as $entry): ?>
    <section class="custom-section">
        <h2><?= htmlspecialchars($entry['section_title']) ?></h2>

        <?php if (!empty($entry['image'])): ?>
            <img src="data:image/jpeg;base64,<?= base64_encode($entry['image']) ?>" 
                 alt="Image for <?= htmlspecialchars($entry['title']) ?>" 
                 class="section-image" 
                 style="width:300px; height:auto; display:block;">
        <?php else: ?>
            <p>No image available.</p>
        <?php endif; ?>

        <h3>Title: <?= htmlspecialchars($entry['title']) ?></h3>
        <p>Description: <?= nl2br(htmlspecialchars($entry['description'])) ?></p>
    </section>
<?php endforeach; ?>


    <footer>
        <p>&copy; 2025 CandonXplore. All rights reserved.</p>
    </footer>

    <script>
        document.querySelector('.menu-icon').addEventListener('click', function() {
            document.querySelector('nav').classList.toggle('active');
        });
    </script>
</body>
</html>
