<?php
// Set page title
$pageTitle = "Events - CandonXplore";

// Include database connection
include '../db_connect.php'; 

// Fetch event data from the `events` table
$sql = "SELECT * FROM events ORDER BY event_date DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="Events.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <script src="Events.js" defer></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <title><?php echo $pageTitle; ?></title>
</head>

<body>
  <!-- Hero Section -->
  <section class="hero">
    <div class="container">
      <h1>Events</h1>
      <div class="img">
        <img src="../Pictures/Home/candon-logo.png" alt="CandonXplore Logo">
      </div>
      <form>
        <input type="text" name="search" placeholder="Search...">
        <button type="submit"><i class="bi bi-search" aria-hidden="true"></i></button>
      </form>
      <nav class="nav">
        <ul class="nav-link">
          <li class="link"><a href="../index.php">Home</a></li>
          <li class="link"><a href="../attractions/attractions.php">Attractions</a></li>
          <li class="link"><a href="../Hotels/Hotels.php">Hotels</a></li>
          <li class="link"><a href="../restaurants/resto.php">Restaurants</a></li>
          <li class="link"><a href="Events.php">Events</a></li>
        </ul>
      </nav>
      <div class="menu-icon">
        <i class="bi bi-list"></i>
      </div>
    </div>
  </section>

  <!-- Display Events -->
  <section class="events-list">
    <h2>Upcoming Events</h2>
    <?php if (!empty($events)): ?>
      <?php foreach ($events as $event): ?>
        <div class="event-item">
          <h3><?= htmlspecialchars($event['title']) ?></h3>
          <p><strong>Date:</strong> <?= htmlspecialchars($event['event_date']) ?></p>
          <p><strong>Location:</strong> <?= htmlspecialchars($event['location']) ?></p>
          <p><?= htmlspecialchars($event['description']) ?></p>
          
          <?php if (!empty($event['img'])): ?>
            <img src="data:image/jpeg;base64,<?= base64_encode($event['img']) ?>" 
                 alt="Event Image" 
                 class="event-image" 
                 style="width:300px; height:auto; display:block;">
          <?php else: ?>
            <p>No image available.</p>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>No events available at the moment.</p>
    <?php endif; ?>
  </section>

  <footer>
    <p>&copy; <?php echo date("Y"); ?> CandonXplore. All rights reserved.</p>
  </footer>

  <script>
    document.querySelector('.menu-icon').addEventListener('click', function() {
      document.querySelector('nav').classList.toggle('active');
    });
  </script>
</body>

</html>
