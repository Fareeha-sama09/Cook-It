<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
// Example: Fetch user info from database
require 'db.php';
$user_id = $_SESSION['user_id'];
$user = $conn->query("SELECT username, email, created_at FROM users WHERE id = $user_id")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Profile - CookIt!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="icon" type="image/png" href="assets/favicon.png">
    <style>
        body { background: #fff8f0; font-family: 'Segoe UI', Arial, sans-serif; margin: 0; }
        main { max-width: 500px; margin: 40px auto; background: #fff; border-radius: 16px; box-shadow: 0 4px 24px rgba(0,0,0,0.08); padding: 36px 32px 28px 32px; }
        h2 { color: #ff7043; text-align: center; margin-bottom: 24px; }
        .profile-info { margin-bottom: 24px; }
        .profile-info label { color: #ff7043; font-weight: bold; display: inline-block; width: 120px; }
        .profile-info span { color: #333; }
        .profile-actions { text-align: center; }
        .profile-actions a { display: inline-block; margin: 0 10px; color: #fff; background: #ff7043; padding: 8px 22px; border-radius: 8px; text-decoration: none; font-weight: bold; transition: background 0.2s; }
        .profile-actions a:hover { background: #ff5722; }
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
        <h2>My Profile</h2>
        <div class="profile-info">
            <p><label>Username:</label> <span><?php echo htmlspecialchars($user['username']); ?></span></p>
            <p><label>Email:</label> <span><?php echo htmlspecialchars($user['email']); ?></span></p>
            <p><label>Member Since:</label> <span><?php echo date('F j, Y', strtotime($user['created_at'])); ?></span></p>
        </div>
        <p style="text-align:center;color:#555;">Edit your profile or change your password below:</p>
        <div class="profile-actions">
            <a href="edit_profile.php">Edit Profile</a>
            <a href="change_password.php">Change Password</a>
        </div>
    </main>
    <footer>
        <p>&copy; 2025 CookIt! All rights reserved.</p>
    </footer>
</body>
</html>