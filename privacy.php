<?php
session_start();
$logged_in = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Privacy Policy - CookIt!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="icon" type="image/png" href="assets/favicon.png">
    <style>
        body { background: #fffbe7; font-family: 'Segoe UI', Arial, sans-serif; margin: 0; padding: 0; }
        .container { max-width: 700px; margin: 40px auto; background: #fff; border-radius: 16px; box-shadow: 0 4px 24px rgba(0,0,0,0.08); padding: 36px 32px 28px 32px; }
        h1 { color: #ff7043; margin-bottom: 1.2rem; text-align: center; }
        p, li { color: #444; font-size: 1.05em; }
        .back-link { display: inline-block; margin-top: 18px; color: #ff7043; font-weight: bold; text-decoration: none; }
        .back-link:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <header>
        <h1>CookIt!</h1>
        <nav aria-label="Main navigation">
            <a href="index.html">Home</a>
            <?php if (!$logged_in): ?>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
            <?php endif; ?>
            <a href="recipes.php">Recipes</a>
            <a href="diet.php">Diet Planning</a>
            <a href="recipesuggestion.php">Recipe Suggestions</a>
            <a href="create_diet.php">Create Diet Plan</a>
            <?php if ($logged_in): ?>
                <a href="profile.php">My Profile</a>
                <a href="logout.php">Logout</a>
            <?php endif; ?>
        </nav>
    </header>
    <main>
        <div class="container">
            <h1>Privacy Policy</h1>
            <p>
                <b>CookIt!</b> respects your privacy. We do not share your personal information with third parties.
            </p>
            <ul>
                <li>We only collect information necessary for your account and personalized experience.</li>
                <li>Your data is stored securely and is not sold or shared.</li>
                <li>You can request deletion of your account and data at any time.</li>
                <li>We use cookies and sessions to keep you logged in and improve your experience.</li>
            </ul>
            <p>
                For questions, contact us at <a href="mailto:support@cookit.com">support@cookit.com</a>.
            </p>
            <?php if ($logged_in): ?>
                <a href="dashboard.php" class="back-link">&larr; Back to Dashboard</a>
            <?php else: ?>
                <a href="index.html" class="back-link">&larr; Back to Home</a>
            <?php endif; ?>
        </div>
    </main>
    <footer>
        <p>&copy; 2025 CookIt! All rights reserved.</p>
    </footer>
</body>
</html>