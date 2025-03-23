<?php
require_once '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    // Password length validation
    if (strlen($password) < 8 || strlen($password) > 16) {
        $error = "Password must be between 8-16 characters.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $conn->prepare("INSERT INTO users (uname, pword, name, contact, address) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$username, $hashed_password, $name, $contact, $address]);
            header("Location: login.php");
            exit();
        } catch(PDOException $e) {
            $error = "Registration failed: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - CandonXplore</title>
    <link rel="stylesheet" href="auth.css">
</head>
<body>
    <div class="auth-container">
        <form class="auth-form" method="POST">
            <h2>Sign Up</h2>
            <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
            
            <div class="form-group">
                <input type="text" name="username" required>
                <label>Username</label>
            </div>

            <div class="form-group">
                <input type="password" name="password" required>
                <label>Password (8-16 characters)</label>
            </div>

            <div class="form-group">
                <input type="text" name="name" required>
                <label>Name</label>
            </div>

            <div class="form-group">
                <input type="text" name="contact">
                <label>Contact</label>
            </div>

            <div class="form-group">
                <textarea name="address"></textarea>
                <label>Address</label>
            </div>

            <button type="submit">Sign Up</button>
            
            <p class="switch-auth">
                Already have an account? <a href="login.php">Login</a>
            </p>
        </form>
    </div>
</body>
</html>
