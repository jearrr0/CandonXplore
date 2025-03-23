<?php
session_start();
require_once '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname = $_POST['username'];
    $pword = $_POST['password'];

    try {
        $stmt = $conn->prepare("SELECT * FROM users WHERE uname = ?");
        $stmt->execute([$uname]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($pword, $user['pword'])) {
            $_SESSION['user_id'] = $user['uname']; 
            $_SESSION['username'] = $user['uname'];
            header("Location: ../index.html");
            exit();
        } else {
            $error = "Invalid username or password";
        }
    } catch(PDOException $e) {
        $error = "Login failed: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CandonXplore</title>
    <link rel="stylesheet" href="auth.css">
</head>
<body>
    <div class="auth-container">
        <form class="auth-form" method="POST">
            <h2>Login</h2>
            <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
            
            <div class="form-group">
                <input type="text" name="username" required>
                <label>Username</label>
            </div>

            <div class="form-group">
                <input type="password" name="password" required>
                <label>Password</label>
            </div>

            <button type="submit">Login</button>
            
            <p class="switch-auth">
                Don't have an account? <a href="signup.php">Sign Up</a>
            </p>
        </form>
    </div>
</body>
</html>
