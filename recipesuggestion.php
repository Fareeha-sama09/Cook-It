<?php
require 'db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
$suggestions = null;
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ingredients = $conn->real_escape_string($_POST['ingredients']);
    if (trim($ingredients) === '') {
        $message = "Please enter at least one ingredient.";
    } else {
        $ingredientArr = array_filter(array_map('trim', explode(',', $ingredients)));
        $likeParts = [];
        foreach ($ingredientArr as $ing) {
            $likeParts[] = "ingredients LIKE '%" . $conn->real_escape_string($ing) . "%'";
        }
        $where = implode(' OR ', $likeParts);
        $sql = "SELECT * FROM recipes WHERE $where";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            $suggestions = $result;
        } else {
            $message = "No recipes found for those ingredients.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Recipe Suggestions - CookIt!</title>
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
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            padding: 36px 32px 28px 32px;
        }
        .logo {
            width: 70px;
            margin-bottom: 16px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        h2 {
            color: #f8b500;
            margin-bottom: 10px;
            text-align: center;
        }
        .welcome {
            color: #555;
            margin-bottom: 24px;
            font-size: 1.1em;
            text-align: center;
        }
        form {
            margin-bottom: 24px;
            text-align: center;
        }
        input[type="text"] {
            width: 70%;
            padding: 10px;
            margin: 10px 0 0 0;
            border: 1px solid #eee;
            border-radius: 8px;
            font-size: 16px;
        }
        button[type="submit"] {
            background: #f8b500;
            color: #fff;
            border: none;
            padding: 10px 28px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            margin-left: 10px;
            transition: background 0.2s;
        }
        button[type="submit"]:hover {
            background: #e09e00;
        }
        ul {
            list-style: none;
            padding: 0;
            margin: 24px 0 0 0;
        }
        ul li {
            margin: 18px 0;
            background: #fffbe7;
            border-radius: 10px;
            padding: 16px 18px;
            box-shadow: 0 2px 8px rgba(248,181,0,0.06);
        }
        ul li strong {
            color: #f8b500;
            font-size: 1.1em;
        }
        .no-results, .message {
            color: #d8000c;
            text-align: center;
            margin: 18px 0;
        }
        a {
            color: #f8b500;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        @media (max-width: 700px) {
            .container { padding: 18px 4vw; }
            input[type="text"] { width: 95%; }
        }
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
    <div class="container">
        <img src="assets/logo.png" alt="CookIt Logo" class="logo" onerror="this.style.display='none'">
        <h2>Recipe Suggestions</h2>
        <div class="welcome">
            Enter ingredients you have, separated by commas, and we'll suggest recipes you can make!
        </div>
        <form method="POST">
            <input type="text" name="ingredients" placeholder="e.g. chicken, rice, tomato" required>
            <button type="submit">Suggest</button>
        </form>
        <?php if ($message): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
        <?php if ($suggestions && $suggestions->num_rows > 0): ?>
            <ul>
            <?php while($row = $suggestions->fetch_assoc()): ?>
                <li>
                    <strong><?php echo htmlspecialchars($row['title']); ?></strong><br>
                    <?php echo nl2br(htmlspecialchars($row['description'])); ?>
                </li>
            <?php endwhile; ?>
            </ul>
        <?php endif; ?>
        <div style="margin-top:22px; text-align:center;">
            <a href="recipes.php">&larr; Back to Recipes</a>
        </div>
    </div>
</body>
</html>