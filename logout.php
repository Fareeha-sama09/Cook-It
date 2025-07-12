<?php
session_start();
$loggedOut = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_logout'])) {
    session_unset();
    session_destroy();
    $loggedOut = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logged Out - CookIt!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="icon" type="image/png" href="assets/favicon.png">
    <style>
        body {
            background: linear-gradient(120deg, #f8b500 0%, #fceabb 100%);
            min-height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        header {
            background: #ff7043;
            color: #fff;
            padding: 1.2rem 0 1rem 0;
            text-align: center;
        }
        nav {
            margin-top: 0.5rem;
        }
        nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 1.2rem;
            font-weight: 500;
            font-size: 1.1rem;
            transition: color 0.2s;
        }
        nav a:hover {
            color: #ffe0b2;
        }
        .container {
            max-width: 400px;
            margin: 80px auto;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            padding: 36px 28px 28px 28px;
            text-align: center;
        }
        .logo {
            width: 80px;
            margin-bottom: 16px;
        }
        h2 {
            color: #f8b500;
            margin-bottom: 10px;
        }
        .message {
            color: #555;
            margin-bottom: 24px;
            font-size: 1.1em;
        }
        .confirmation {
            color: #388e3c;
            font-size: 1.1em;
            margin-bottom: 18px;
            font-weight: bold;
        }
        a.button, button.button {
            display: inline-block;
            background: #f8b500;
            color: #fff;
            padding: 12px 32px;
            border-radius: 8px;
            font-size: 1.1em;
            font-weight: bold;
            text-decoration: none;
            margin-top: 10px;
            transition: background 0.2s;
            border: none;
            cursor: pointer;
        }
        a.button:hover, button.button:hover {
            background: #e09e00;
        }
    </style>
</head>
<body>
    <header>
        <h1>CookIt!</h1>
        <nav aria-label="Main navigation">
            <a href="index.html">Home</a>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
            <a href="recipes.php">Recipes</a>
            <a href="diet.php">Diet Planning</a>
            <a href="recipesuggestion.php">Recipe Suggestions</a>
            <a href="create_diet.php">Create Diet Plan</a>
            <a href="profile.php">My Profile</a>
        </nav>
    </header>
    <div class="container">
        <img src="assets/logo.png" alt="CookIt Logo" class="logo" onerror="this.style.display='none'">
        <?php if (!$loggedOut): ?>
            <h2>Log Out</h2>
            <div class="message">Are you sure you want to log out?</div>
            <form method="POST">
                <button type="submit" name="confirm_logout" class="button">Yes, Log Me Out</button>
            </form>
            <br>
            <a href="dashboard.php" class="button" style="background:#bbb;color:#fff;">Cancel</a>
        <?php else: ?>
            <h2>Logged Out</h2>
            <div class="confirmation">You have been successfully logged out.</div>
            <a href="login.php" class="button">Login Again</a>
            <br><br>
            <a href="index.html" style="color:#f8b500;text-decoration:underline;">&larr; Back to Home</a>
        <?php endif; ?>
    </div>
</body>
</html>