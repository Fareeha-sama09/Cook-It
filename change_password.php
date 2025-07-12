<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
require 'db.php';
$user_id = $_SESSION['user_id'];
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current = $_POST['current_password'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];
    $user = $conn->query("SELECT password FROM users WHERE id = $user_id")->fetch_assoc();

    if (password_verify($current, $user['password'])) {
        if ($new === $confirm && strlen($new) >= 6) {
            $hash = password_hash($new, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE users SET password=? WHERE id=?");
            $stmt->bind_param("si", $hash, $user_id);
            if ($stmt->execute()) {
                $message = "Password changed successfully!";
            } else {
                $message = "Error updating password.";
            }
            $stmt->close();
        } else {
            $message = "Passwords do not match or are too short.";
        }
    } else {
        $message = "Current password is incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change Password - CookIt!</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        main { max-width: 400px; margin: 40px auto; background: #fff; border-radius: 16px; box-shadow: 0 4px 24px rgba(0,0,0,0.08); padding: 36px 32px 28px 32px; }
        label { color: #ff7043; font-weight: bold; }
        input[type="password"] { width: 100%; padding: 8px; margin: 8px 0 16px 0; border-radius: 6px; border: 1px solid #ccc; }
        button { background: #ff7043; color: #fff; border: none; padding: 10px 28px; border-radius: 8px; font-size: 16px; cursor: pointer; }
        button:hover { background: #ff5722; }
        .msg { text-align:center; color: #388e3c; margin-bottom: 12px; }
    </style>
</head>
<body>
    <header>
        <h1>CookIt!</h1>
        <nav aria-label="Main navigation">
            <a href="dashboard.php">Dashboard</a>
            <a href="recipes.php">Recipes</a>
            <a href="diet.php">Diet Planning</a>
            <a href="recipesuggestion.php">Recipe Suggestions</a>
            <a href="create_diet.php">Create Diet Plan</a>
            <a href="profile.php">My Profile</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
    <main>
        <h2>Change Password</h2>
        <?php if ($message): ?>
            <div class="msg"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        <form method="POST">
            <label>Current Password:</label>
            <input type="password" name="current_password" required>
            <label>New Password:</label>
            <input type="password" name="new_password" required>
            <label>Confirm New Password:</label>
            <input type="password" name="confirm_password" required>
            <button type="submit">Change Password</button>
        </form>
        <p style="text-align:center;"><a href="profile.php">Back to Profile</a></p>
    </main>
</body>
</html>