<?php
require 'db.php';
session_start(); // Needed to check login status
// No login required for viewing recipes
$search_results = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['search'])) {
        $q = $conn->real_escape_string($_POST['search']);
        $sql = "SELECT * FROM recipes WHERE title LIKE '%$q%' OR ingredients LIKE '%$q%'";
        $search_results = $conn->query($sql);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Recipes - CookIt!</title>
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
            background: #fffbe7;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            padding: 18px 0 10px 0;
            text-align: center;
        }
        .logo {
            width: 60px;
            vertical-align: middle;
            margin-right: 10px;
        }
        header h1 {
            display: inline-block;
            color: #f8b500;
            margin: 0 0 0 10px;
            font-size: 2.2em;
            vertical-align: middle;
        }
        nav {
            margin-top: 10px;
        }
        nav a {
            color: #f8b500;
            text-decoration: none;
            margin: 0 18px;
            font-weight: bold;
            font-size: 1.1em;
            transition: color 0.2s;
        }
        nav a:hover {
            color: #e09e00;
            text-decoration: underline;
        }
        main {
            max-width: 650px;
            margin: 40px auto 0 auto;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            padding: 36px 32px 28px 32px;
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
        .no-results {
            color: #d8000c;
            text-align: center;
            margin: 18px 0;
        }
        @media (max-width: 700px) {
            main { padding: 18px 4vw; }
            input[type="text"] { width: 95%; }
        }
    </style>
</head>
<body>
    <header>
        <img src="assets/logo.png" alt="CookIt Logo" class="logo" onerror="this.style.display='none'">
        <h1>Recipes</h1>
        <nav aria-label="Main navigation">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="dashboard.php">Dashboard</a>
                <a href="recipes.php">Recipes</a>
                <a href="diet.php">Diet Planning</a>
                <a href="recipesuggestion.php">Recipe Suggestions</a>
                <a href="create_diet.php">Create Diet Plan</a>
                <a href="profile.php">My Profile</a>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="index.html">Home</a>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
                <a href="diet.php">Diet Planning</a>
                <a href="recipesuggestion.php">Recipe Suggestions</a>
                <a href="create_diet.php">Create Diet Plan</a>
                <a href="profile.php">My Profile</a>
            <?php endif; ?>
        </nav>
    </header>
    <main>
        <div class="welcome">
            Discover, search, and get suggestions for delicious recipes!
            <br>
            <span style="font-size:1em;">
                Want suggestions based on your ingredients?
                <a href="recipesuggestion.php" style="color:#f8b500;font-weight:bold;text-decoration:underline;">Try Recipe Suggestions &rarr;</a>
            </span>
        </div>
        <section>
            <h2>Search Recipes</h2>
            <form method="POST" style="text-align:center;">
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Search by name or ingredient" 
                    list="all-foods" 
                    required
                    style="width:70%;padding:10px;margin:10px 0 0 0;border:1px solid #eee;border-radius:8px;font-size:16px;display:inline-block;"
                >
                <button type="submit" style="background:#f8b500;color:#fff;border:none;padding:10px 28px;border-radius:8px;font-size:16px;cursor:pointer;margin-left:10px;transition:background 0.2s;">Search</button>
                <datalist id="all-foods">
                    <option value="Cookies">
                    <option value="Cake">
                    <option value="Beef">
                    <option value="Spaghetti Bolognese">
                    <option value="Chicken Caesar Salad">
                    <option value="Vegetable Stir Fry">
                    <option value="Avocado Toast">
                    <option value="Chicken Fry">
                    <option value="Fried Rice">
                    <option value="Salad">
                    <option value="French Fries">
                    <option value="Juice">
                    <option value="Milkshake">
                    <option value="Cold Coffee">
                    <option value="Biryani">
                    <option value="Pancakes">
                    <option value="Veg Sandwich">
                    <option value="Egg Curry">
                    <option value="Fruit Salad">
                    <option value="Mango Lassi">
                    <option value="Grilled Cheese">
                    <option value="Tomato Soup">
                    <option value="Chicken Biryani">
                    <option value="Chocolate Milkshake">
                    <option value="French Toast">
                    <option value="Veg Pulao">
                    <option value="Omelette">
                    <option value="Samosa">
                    <option value="Banana Smoothie">
                    <option value="Mutton Curry">
                    <option value="Pasta Alfredo">
                    <option value="Fruit Custard">
                    <option value="Spring Rolls">
                    <option value="Palak Paneer">
                    <option value="Fish Curry">
                    <option value="Gulab Jamun">
                    <option value="Paneer Tikka">
                    <option value="Dosa">
                    <option value="Falooda">
                    <option value="Butter Chicken">
                    <option value="Rajma">
                    <option value="Dal Tadka">
                    <option value="Bhindi Masala">
                    <option value="Paneer Bhurji">
                    <option value="Chicken Curry">
                    <option value="Fish Fry">
                    <option value="Vegetable Soup">
                    <option value="Egg Bhurji">
                    <option value="Masala Dosa">
                    <option value="Pav Bhaji">
                    <option value="Aloo Gobi">
                    <option value="Vegetable Biryani">
                    <option value="Chana Masala">
                    <option value="Kheer">
                    <option value="Gajar Halwa">
                    <option value="Rava Kesari">
                    <option value="Pani Puri">
                    <option value="Dhokla">
                    <option value="Sabudana Khichdi">
                    <option value="Chicken 65">
                    <option value="Veg Hakka Noodles">
                    <option value="Methi Malai Murg">
                    <option value="Baingan Bharta">
                    <option value="Moong Dal Chilla">
                    <option value="Malpua">
                    <option value="Chicken Korma">
                    <option value="Vegetable Cutlet">
                    <option value="Rava Dosa">
                    <option value="Sheer Khurma">
                    <option value="Idli">
                    <option value="Poha">
                    <option value="Chole">
                    <option value="Rasgulla">
                    <option value="Aloo Paratha">
                    <option value="Lemon Rice">
                    <option value="Upma">
                    <option value="Methi Thepla">
                    <option value="Moong Dal Halwa">
                    <option value="Paneer Butter Masala">
                    <option value="Vegetable Korma">
                    <option value="Malai Kofta">
                    <option value="Chicken Tikka">
                    <option value="Carrot Soup">
                    <option value="Spinach Corn Sandwich">
                    <option value="Tamarind Rice">
                    <option value="Moong Dal Soup">
                    <option value="Chocolate Brownie">
                    <option value="Lassi">
                    <option value="Fruit Raita">
                    <option value="Vegetable Stew">
                    <option value="Tomato Chutney">
                    <option value="Corn Pakora">
                    <option value="Cabbage Sabzi">
                    <option value="Peanut Ladoo">
                    <option value="Stuffed Capsicum">
                    <option value="Coconut Rice">
                    <option value="Beetroot Halwa">
                    <option value="Egg Fried Rice">
                    <option value="Paneer Paratha">
                    <option value="Sweet Pongal">
                    <option value="Vegetable Manchurian">
                    <option value="Pumpkin Soup">
                    <option value="Chickpea Salad">
                    <option value="Rice Kheer">
                    <option value="Garlic Naan">
                </datalist>
            </form>
            <?php if ($search_results && $search_results->num_rows > 0): ?>
                <ul>
                <?php while($row = $search_results->fetch_assoc()): ?>
                    <li>
                        <strong><?php echo htmlspecialchars($row['title']); ?></strong><br>
                        <?php echo nl2br(htmlspecialchars($row['description'])); ?>
                        <?php if (!empty($row['ingredients'])): ?>
                            <div><b>Ingredients:</b> <?php echo htmlspecialchars($row['ingredients']); ?></div>
                        <?php endif; ?>
                        <?php if (!empty($row['instructions'])): ?>
                            <div style="margin-top:8px;"><b>How to make:</b><br>
                                <span style="white-space:pre-line;"><?php echo nl2br(htmlspecialchars($row['instructions'])); ?></span>
                            </div>
                        <?php endif; ?>
                    </li>
                <?php endwhile; ?>
                </ul>
            <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])): ?>
                <div class="no-results">No recipes found.</div>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>