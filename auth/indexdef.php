<?php
include 'db_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// ✅ DELETE Function
if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $sql = "DELETE FROM home WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$delete_id]);
    echo "<script>alert('Data deleted successfully!'); window.location.href='indexdef.php';</script>";
    exit;
}

// ✅ UPDATE Function
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_data'])) {
    $edit_id = $_POST['edit_id'];
    $sectionTitle = $_POST['edit_section_title'];
    $title = $_POST['edit_title'];
    $description = $_POST['edit_description'];
    $directionsApi = $_POST['edit_directions_api'];
    $websiteUrl = $_POST['edit_website_url'];

    // ✅ Handle Image Upload if a new image is provided
    $imagePath = $_POST['existing_image'];
    if (!empty($_FILES['edit_image']['tmp_name'])) {
        $uploadDir = "uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $imagePath = $uploadDir . time() . "_" . basename($_FILES['edit_image']['name']);
        move_uploaded_file($_FILES['edit_image']['tmp_name'], $imagePath);
    }

    $sql = "UPDATE home SET section_title=?, title=?, description=?, directions_api=?, website_url=?, image=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$sectionTitle, $title, $description, $directionsApi, $websiteUrl, $imagePath, $edit_id]);

    echo "<script>alert('Data updated successfully!'); window.location.href='indexdef.php';</script>";
    exit;
}

// ✅ ADD New Data with Image Upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_data'])) {
    $sectionTitle = $_POST['section_title'] ?? '';
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $directionsApi = $_POST['directions_api'] ?? '';
    $websiteUrl = $_POST['website_url'] ?? '';

    // ✅ Handle Image Upload
    $imagePath = null;
    if (!empty($_FILES['image']['tmp_name'])) {
        $uploadDir = "uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $imagePath = $uploadDir . time() . "_" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    }

    $sql = "INSERT INTO home (section_title, title, description, directions_api, website_url, image) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$sectionTitle, $title, $description, $directionsApi, $websiteUrl, $imagePath]);

    echo "<script>alert('Data added successfully!'); window.location.href='indexdef.php';</script>";
}

// ✅ FETCH All Data
$sql = "SELECT * FROM home";
$stmt = $conn->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Data Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="container py-5">
    <h2 class="mb-4 text-center">Manage Home Data</h2>

    <!-- ✅ Add New Data Form -->
    <div class="card shadow-lg p-4 mb-4">
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="add_data" value="1">
            <div class="mb-3">
                <label class="form-label">Title of the Section</label>
                <input type="text" name="section_title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Google Maps Directions API</label>
                <input type="text" name="directions_api" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Website / Facebook Page</label>
                <input type="text" name="website_url" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Upload Image</label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
    </div>

    <!-- ✅ Display Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Section Title</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Get Directions</th>
                <th>See More</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $row): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['section_title']) ?></td>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td><?= htmlspecialchars($row['description']) ?></td>
                    <td>
                        <?php if (!empty($row['image']) && file_exists($row['image'])): ?>
                            <img src="<?= $row['image'] ?>" width="100" height="100">
                        <?php else: ?>
                            No Image
                        <?php endif; ?>
                    </td>
                    <td><a href="<?= $row['directions_api'] ?>" class="btn btn-info" target="_blank">Get Directions</a></td>
                    <td><a href="<?= $row['website_url'] ?>" class="btn btn-secondary" target="_blank">See More</a></td>
                    <td>
                        <!-- Edit Button -->
                        <button class="btn btn-warning edit-btn" 
                                data-id="<?= $row['id'] ?>" 
                                data-section="<?= $row['section_title'] ?>" 
                                data-title="<?= $row['title'] ?>" 
                                data-description="<?= $row['description'] ?>" 
                                data-directions="<?= $row['directions_api'] ?>" 
                                data-website="<?= $row['website_url'] ?>" 
                                data-image="<?= $row['image'] ?>">Edit</button>

                        <!-- Delete Button -->
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="delete_id" value="<?= $row['id'] ?>">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
