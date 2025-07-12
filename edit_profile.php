<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
require 'db.php';
$user_id = $_SESSION['user_id'];
$user = $conn->query("SELECT username, email FROM users WHERE id = $user_id")->fetch_assoc();
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    if ($username && $email) {
        $stmt = $conn->prepare("UPDATE users SET username=?, email=? WHERE id=?");
        $stmt->bind_param("ssi", $username, $email, $user_id);
        if ($stmt->execute()) {
            $message = "Profile updated successfully!";
            $user['username'] = $username;
            $user['email'] = $email;
        } else {
            $message = "Error updating profile.";
        }
        $stmt->close();
    } else {
        $message = "All fields are required.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile - CookIt!</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        main { max-width: 400px; margin: 40px auto; background: #fff; border-radius: 16px; box-shadow: 0 4px 24px rgba(0,0,0,0.08); padding: 36px 32px 28px 32px; }
        label { color: #ff7043; font-weight: bold; }
        input[type="text"], input[type="email"] { width: 100%; padding: 8px; margin: 8px 0 16px 0; border-radius: 6px; border: 1px solid #ccc; }
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
        <h2>Edit Profile</h2>
        <?php if ($message): ?>
            <div class="msg"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        <form method="POST">
            <label>Username:</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            <label>Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            <button type="submit">Save Changes</button>
        </form>
        <p style="text-align:center;"><a href="profile.php">Back to Profile</a></p>
    </main>
</body>
</html>