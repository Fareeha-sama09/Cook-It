<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - CookIt!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="icon" type="image/png" href="assets/favicon.png">
    <style>
        body {
            background: #f8f8f8;
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background: #ff7043;
            color: #fff;
            padding: 1.5rem 0 1rem 0;
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
        main {
            max-width: 700px;
            margin: 40px auto 0 auto;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            padding: 36px 32px 28px 32px;
            text-align: center;
        }
        h2 {
            color: #ff7043;
            margin-bottom: 10px;
        }
        .welcome {
            color: #555;
            margin-bottom: 24px;
            font-size: 1.1em;
        }
        .dashboard-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            justify-content: center;
            margin: 2.5rem 0 2rem 0;
        }
        .dashboard-card {
            background: #fff3e0;
            border-radius: 10px;
            box-shadow: 0 1px 4px rgba(255,112,67,0.08);
            padding: 1.5rem 1.2rem 1.2rem 1.2rem;
            width: 220px;
            text-align: center;
            transition: box-shadow 0.2s;
        }
        .dashboard-card:hover {
            box-shadow: 0 4px 16px rgba(255,112,67,0.16);
        }
        .dashboard-card img {
            width: 60px;
            margin-bottom: 1rem;
        }
        .dashboard-card h4 {
            margin: 0.5rem 0 0.3rem 0;
            color: #ff7043;
        }
        .dashboard-card a {
            display: inline-block;
            margin-top: 1rem;
            background: #ff7043;
            color: #fff;
            padding: 10px 24px;
            border-radius: 8px;
            font-size: 1.05em;
            text-decoration: none;
            font-weight: 500;
            transition: background 0.2s;
        }
        .dashboard-card a:hover {
            background: #ff5722;
        }
        .sample-recipes {
            margin-top: 3rem;
            text-align: center;
        }
        .recipe-list {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            justify-content: center;
        }
        .recipe-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            padding: 1.2rem;
            width: 180px;
            transition: transform 0.2s;
        }
        .recipe-card:hover {
            transform: translateY(-4px);
        }
        .recipe-card img {
            width: 100%;
            border-radius: 8px;
            margin-bottom: 0.8rem;
        }
        .recipe-card h4 {
            margin: 0.5rem 0 0.3rem 0;
            font-size: 1.1em;
            color: #333;
        }
        .recipe-card p {
            margin: 0;
            color: #666;
            font-size: 0.9em;
        }
        @media (max-width: 900px) {
            .dashboard-actions { flex-direction: column; gap: 1.2rem; }
            .recipe-card { width: calc(50% - 1rem); }
        }
        @media (max-width: 600px) {
            .recipe-card { width: 100%; }
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
    <main>
        <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
        <div class="welcome">Glad to see you back! Here’s what you can do next:</div>
        <section class="dashboard-actions">
            <div class="dashboard-card">
                <img src="https://img.icons8.com/color/96/000000/ingredients.png" alt="Recipe Search">
                <h4>Search Recipes</h4>
                <p>Find recipes by name or ingredient.</p>
                <a href="recipes.php">Go</a>
            </div>
            <div class="dashboard-card">
                <img src="https://img.icons8.com/color/96/000000/cook-male.png" alt="Recipe Suggestions">
                <h4>Recipe Suggestions</h4>
                <p>Get ideas based on your ingredients.</p>
                <a href="recipesuggestion.php">Go</a>
            </div>
            <div class="dashboard-card">
                <img src="https://img.icons8.com/color/96/000000/meal.png" alt="Diet Planning">
                <h4>Diet Planning</h4>
                <p>Plan your meals and track your nutrition.</p>
                <a href="diet.php">Go</a>
            </div>
            <div class="dashboard-card">
                <img src="https://img.icons8.com/color/96/000000/chef-hat.png" alt="Create Diet Plan">
                <h4>Create Diet Plan</h4>
                <p>Let CookIt generate a diet plan for you.</p>
                <a href="create_diet.php">Go</a>
            </div>
        </section>
        <section class="sample-recipes">
            <h2>Popular Recipes</h2>
            <div class="recipe-list">
                <div class="recipe-card">
                    <img src="c:\Users\HP\OneDrive\Pictures\Screenshots\Screenshot 2025-07-05 091151.png" alt="Spaghetti Bolognese">
                    <h4>Spaghetti Bolognese</h4>
                    <p>Classic Italian pasta with rich meat sauce.</p>
                </div>
                <div class="recipe-card">
                    <img src="c:\Users\HP\OneDrive\Pictures\Screenshots\Screenshot 2025-07-05 091021.png" alt="Chicken Caesar Salad">
                    <h4>Chicken Caesar Salad</h4>
                    <p>Crisp romaine, grilled chicken, and creamy Caesar dressing.</p>
                </div>
                <div class="recipe-card">
                    <img src="c:\Users\HP\OneDrive\Pictures\Screenshots\Screenshot 2025-07-05 091443.png" alt="Vegetable Stir Fry">
                    <h4>Vegetable Stir Fry</h4>
                    <p>Colorful veggies sautéed in a savory sauce.</p>
                </div>
                <div class="recipe-card">
                    <img src="c:\Users\HP\OneDrive\Pictures\Screenshots\Screenshot 2025-07-05 091350.png" alt="Avocado Toast">
                    <h4>Avocado Toast</h4>
                    <p>Toasted bread topped with creamy avocado and spices.</p>
                </div>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; 2025 CookIt! All rights reserved. | <a href="privacy.php" style="color:#ff7043;text-decoration:underline;">Privacy Policy</a></p>
    </footer>
</body>
</html>