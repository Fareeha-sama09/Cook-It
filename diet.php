<?php
require 'db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
$user_id = $_SESSION['user_id'];
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $plan_name = $conn->real_escape_string($_POST['plan_name']);
    $details = $conn->real_escape_string($_POST['details']);
    $sql = "INSERT INTO diet_plans (user_id, plan_name, details) VALUES ($user_id, '$plan_name', '$details')";
    if ($conn->query($sql)) {
        $message = 'Diet plan saved!';
    } else {
        $message = 'Error: ' . $conn->error;
    }
}
$plans = $conn->query("SELECT * FROM diet_plans WHERE user_id = $user_id ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Diet Planning - CookIt!</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        body {
            background: linear-gradient(120deg,rgb(240, 128, 23) 0%, #fceabb 100%);
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
            color:rgb(237, 126, 28);
            margin: 0 0 0 10px;
            font-size: 2.2em;
            vertical-align: middle;
        }
        nav {
            margin-top: 10px;
        }
        nav a {
            color:rgb(248, 112, 0);
            text-decoration: none;
            margin: 0 18px;
            font-weight: bold;
            font-size: 1.1em;
            transition: color 0.2s;
        }
        nav a:hover {
            color:rgb(224, 93, 0);
            text-decoration: underline;
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
            color:rgb(248, 145, 0);
            margin-bottom: 10px;
        }
        .welcome {
            color: #555;
            margin-bottom: 24px;
            font-size: 1.1em;
        }
        form {
            margin-bottom: 30px;
        }
        input[type="text"], textarea {
            width: 90%;
            padding: 10px;
            margin: 10px 0 18px 0;
            border: 1px solid #eee;
            border-radius: 8px;
            font-size: 16px;
            resize: vertical;
        }
        textarea {
            min-height: 70px;
            max-height: 200px;
        }
        button[type="submit"] {
            background: #f8b500;
            color: #fff;
            border: none;
            padding: 12px 0;
            width: 100%;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            transition: background 0.2s;
        }
        button[type="submit"]:hover {
            background: #e09e00;
        }
        .message {
            color: #d8000c;
            margin: 10px 0;
            min-height: 20px;
        }
        .plans-container {
            display: flex;
            flex-wrap: wrap;
            gap: 18px;
            justify-content: center;
            margin-top: 24px;
        }
        .plan-box {
            background: #fffbe7;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(248,181,0,0.10);
            padding: 18px 20px 14px 20px;
            min-width: 240px;
            max-width: 320px;
            flex: 1 1 260px;
            text-align: left;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .plan-box strong {
            color: #f8b500;
            font-size: 1.1em;
        }
        .plan-box em {
            color: #888;
            font-size: 0.95em;
            display: block;
            margin-top: 8px;
        }
        @media (max-width: 900px) {
            main { padding: 18px 2vw; }
            .plans-container { flex-direction: column; align-items: center; }
            .plan-box { width: 95%; min-width: unset; max-width: unset; }
        }
    </style>
</head>
<body>
    <header>
        <img src="assets/logo.png" alt="CookIt Logo" class="logo" onerror="this.style.display='none'">
        <h1>Diet Planning</h1>
        <nav>
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
        <h2>Create a Diet Plan</h2>
        <div class="welcome">
            Plan your meals and keep track of your healthy eating journey!<br>
            <span style="color:#888; font-size:0.98em;">
                <b>Tips for a great diet plan:</b>
                <ul style="text-align:left; margin:10px auto 0 auto; max-width:400px;">
                    <li>Include all meals: <b>Breakfast, Lunch, Dinner, Snacks</b></li>
                    <li>Specify <b>calories</b> and <b>macronutrients</b> (carbs, protein, fat) if possible</li>
                    <li>Add <b>special notes</b> (e.g. allergies, preferences, water intake)</li>
                    <li>Set <b>goals</b> (e.g. weight loss, muscle gain, maintenance)</li>
                    <li>Example:<br>
                        <span style="font-size:0.97em;">
                        Breakfast: Oatmeal with banana (300 kcal)<br>
                        Lunch: Grilled chicken salad (400 kcal)<br>
                        Dinner: Salmon, brown rice, broccoli (500 kcal)<br>
                        Snacks: Greek yogurt (150 kcal)<br>
                        Total: 1350 kcal<br>
                        Notes: No sugar after 6pm, drink 2L water
                        </span>
                    </li>
                </ul>
            </span>
        </div>
        <form method="POST">
            <input type="text" name="plan_name" placeholder="Plan Name (e.g. 'Low Carb Week 1')" required><br>
            <textarea name="details" placeholder="Plan Details (meals, calories, macros, notes, goals)" required></textarea><br>
            <button type="submit">Save Plan</button>
        </form>
        <div class="message"><?php echo $message; ?></div>
        <h2>Your Diet Plans</h2>
        <div class="plans-container">
        <?php while($row = $plans->fetch_assoc()): ?>
            <div class="plan-box">
                <strong><?php echo htmlspecialchars($row['plan_name']); ?></strong><br>
                <div style="margin: 10px 0 8px 0;"><?php echo nl2br(htmlspecialchars($row['details'])); ?></div>
                <em><?php echo $row['created_at']; ?></em>
            </div>
        <?php endwhile; ?>
        </div>
    </main>
</body>
</html>