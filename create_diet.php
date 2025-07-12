<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$suggestion = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $goal = $_POST['goal'];
    $calories = intval($_POST['calories']);
    $diet_type = $_POST['diet_type'];
    $allergies = $_POST['allergies'];
    $meals = [];

    // Simple meal suggestions based on goal and diet type
    if ($diet_type === 'balanced') {
        if ($goal === 'Weight Loss') {
            $meals = [
                'Breakfast' => 'Oatmeal with berries and almonds',
                'Lunch' => 'Grilled chicken salad with olive oil dressing',
                'Dinner' => 'Baked salmon, brown rice, steamed broccoli',
                'Snacks' => 'Greek yogurt, apple, carrot sticks, handful of walnuts'
            ];
        } elseif ($goal === 'Muscle Gain') {
            $meals = [
                'Breakfast' => 'Egg omelette with whole grain toast and avocado',
                'Lunch' => 'Chicken breast, quinoa, roasted vegetables',
                'Dinner' => 'Lean beef stir-fry with brown rice and veggies',
                'Snacks' => 'Cottage cheese, banana, protein shake, peanut butter sandwich'
            ];
        } else { // Maintenance
            $meals = [
                'Breakfast' => 'Whole grain toast with peanut butter and banana',
                'Lunch' => 'Turkey sandwich with mixed greens',
                'Dinner' => 'Grilled fish, sweet potato, green beans',
                'Snacks' => 'Mixed nuts, orange, yogurt parfait'
            ];
        }
    } elseif ($diet_type === 'lowcarb') {
        if ($goal === 'Weight Loss') {
            $meals = [
                'Breakfast' => 'Scrambled eggs with spinach and mushrooms',
                'Lunch' => 'Grilled chicken Caesar salad (no croutons)',
                'Dinner' => 'Baked cod, sautéed zucchini, side salad',
                'Snacks' => 'Celery sticks with peanut butter, boiled egg, cheese cubes'
            ];
        } elseif ($goal === 'Muscle Gain') {
            $meals = [
                'Breakfast' => 'Egg muffins with cheese and veggies',
                'Lunch' => 'Beef steak, sautéed green beans, avocado',
                'Dinner' => 'Chicken thighs, roasted cauliflower, salad',
                'Snacks' => 'Greek yogurt, almonds, turkey roll-ups'
            ];
        } else { // Maintenance
            $meals = [
                'Breakfast' => 'Omelette with cheese and tomatoes',
                'Lunch' => 'Tuna salad with olive oil and greens',
                'Dinner' => 'Grilled shrimp, asparagus, mixed salad',
                'Snacks' => 'Walnuts, cucumber slices, cottage cheese'
            ];
        }
    } elseif ($diet_type === 'vegetarian') {
        if ($goal === 'Weight Loss') {
            $meals = [
                'Breakfast' => 'Greek yogurt with granola and fruit',
                'Lunch' => 'Chickpea salad with veggies',
                'Dinner' => 'Lentil curry with brown rice',
                'Snacks' => 'Carrot sticks, hummus, apple slices'
            ];
        } elseif ($goal === 'Muscle Gain') {
            $meals = [
                'Breakfast' => 'Paneer and spinach sandwich on whole grain bread',
                'Lunch' => 'Quinoa salad with beans, corn, and avocado',
                'Dinner' => 'Tofu stir-fry with mixed vegetables and rice',
                'Snacks' => 'Protein smoothie, trail mix, boiled edamame'
            ];
        } else { // Maintenance
            $meals = [
                'Breakfast' => 'Oats porridge with nuts and raisins',
                'Lunch' => 'Vegetable pulao with raita',
                'Dinner' => 'Chickpea stew with whole wheat roti',
                'Snacks' => 'Fruit salad, roasted chickpeas, yogurt'
            ];
        }
    }

    // --- MORE SUGGESTIONS BELOW ---

    // Add more variety by randomly picking from extra options
    $extra_meals = [
        'balanced' => [
            'Weight Loss' => [
                'Breakfast' => [
                    'Low-fat cottage cheese with pineapple',
                    'Smoothie with spinach, banana, and almond milk'
                ],
                'Lunch' => [
                    'Vegetable soup with whole grain crackers',
                    'Turkey lettuce wraps with tomato and cucumber'
                ],
                'Dinner' => [
                    'Grilled shrimp with quinoa and asparagus',
                    'Stuffed bell peppers with lean ground turkey'
                ],
                'Snacks' => [
                    'Sliced bell peppers with hummus',
                    'Rice cakes with almond butter'
                ]
            ],
            'Muscle Gain' => [
                'Breakfast' => [
                    'Peanut butter banana protein smoothie',
                    'Greek yogurt parfait with granola and berries'
                ],
                'Lunch' => [
                    'Salmon bowl with brown rice and avocado',
                    'Chicken burrito bowl with beans and veggies'
                ],
                'Dinner' => [
                    'Pasta with turkey meatballs and spinach',
                    'Stir-fried tofu with broccoli and brown rice'
                ],
                'Snacks' => [
                    'Boiled eggs and trail mix',
                    'Protein bar and orange'
                ]
            ],
            'Maintenance' => [
                'Breakfast' => [
                    'Avocado toast with poached egg',
                    'Berry smoothie bowl with chia seeds'
                ],
                'Lunch' => [
                    'Chicken wrap with veggies',
                    'Quinoa salad with feta and olives'
                ],
                'Dinner' => [
                    'Vegetable stir-fry with tofu',
                    'Grilled chicken with roasted potatoes'
                ],
                'Snacks' => [
                    'Apple slices with peanut butter',
                    'Yogurt with honey and walnuts'
                ]
            ]
        ],
        'lowcarb' => [
            'Weight Loss' => [
                'Breakfast' => [
                    'Greek yogurt with chia seeds',
                    'Egg white omelette with tomatoes'
                ],
                'Lunch' => [
                    'Zucchini noodles with pesto and chicken',
                    'Egg salad lettuce wraps'
                ],
                'Dinner' => [
                    'Grilled turkey burger (no bun) with salad',
                    'Baked chicken with roasted Brussels sprouts'
                ],
                'Snacks' => [
                    'Olives and cheese',
                    'Cucumber slices with guacamole'
                ]
            ],
            'Muscle Gain' => [
                'Breakfast' => [
                    'Protein pancakes (almond flour)',
                    'Scrambled eggs with smoked salmon'
                ],
                'Lunch' => [
                    'Chicken and broccoli stir-fry',
                    'Tuna salad stuffed avocados'
                ],
                'Dinner' => [
                    'Pork chops with sautéed spinach',
                    'Grilled steak with green beans'
                ],
                'Snacks' => [
                    'Cottage cheese with walnuts',
                    'Beef jerky and almonds'
                ]
            ],
            'Maintenance' => [
                'Breakfast' => [
                    'Veggie frittata',
                    'Cottage cheese with berries'
                ],
                'Lunch' => [
                    'Chicken Caesar lettuce wraps',
                    'Eggplant lasagna'
                ],
                'Dinner' => [
                    'Grilled fish with ratatouille',
                    'Stuffed zucchini boats'
                ],
                'Snacks' => [
                    'Mixed nuts',
                    'Celery with almond butter'
                ]
            ]
        ],
        'vegetarian' => [
            'Weight Loss' => [
                'Breakfast' => [
                    'Chia pudding with berries',
                    'Banana oat pancakes'
                ],
                'Lunch' => [
                    'Lentil soup with whole wheat toast',
                    'Stuffed tomatoes with quinoa and herbs'
                ],
                'Dinner' => [
                    'Grilled vegetable skewers with tofu',
                    'Cauliflower rice stir-fry'
                ],
                'Snacks' => [
                    'Sliced cucumber with tzatziki',
                    'Roasted chickpeas'
                ]
            ],
            'Muscle Gain' => [
                'Breakfast' => [
                    'Almond butter toast with banana',
                    'Protein oats with flaxseed'
                ],
                'Lunch' => [
                    'Black bean burrito bowl',
                    'Paneer tikka with brown rice'
                ],
                'Dinner' => [
                    'Soy curry with whole wheat roti',
                    'Vegetable lasagna'
                ],
                'Snacks' => [
                    'Granola bar and milk',
                    'Boiled soybeans'
                ]
            ],
            'Maintenance' => [
                'Breakfast' => [
                    'Fruit smoothie with oats',
                    'Vegetable upma'
                ],
                'Lunch' => [
                    'Chickpea and spinach salad',
                    'Vegetable biryani with raita'
                ],
                'Dinner' => [
                    'Dal tadka with brown rice',
                    'Stuffed bell peppers'
                ],
                'Snacks' => [
                    'Fruit chaat',
                    'Peanut chikki'
                ]
            ]
        ]
    ];

    // If you want to show a random extra suggestion, you can add this after your main $meals:
    if (isset($extra_meals[$diet_type][$goal])) {
        foreach ($meals as $meal => $desc) {
            $options = $extra_meals[$diet_type][$goal][$meal];
            if (!empty($options)) {
                $random = $options[array_rand($options)];
                $meals[$meal] .= " <br><span style='color:#888;font-size:0.95em;'>(Try also: $random)</span>";
            }
        }
    }

    // Compose the suggestion
    $suggestion = "<b>Goal:</b> $goal<br>";
    $suggestion .= "<b>Daily Calories:</b> $calories kcal<br>";
    $suggestion .= "<b>Diet Type:</b> " . ucfirst($diet_type) . "<br>";
    if (!empty($allergies)) {
        $suggestion .= "<b>Allergies/Restrictions:</b> $allergies<br>";
    }
    $suggestion .= "<b>Sample Plan:</b><br><ul>";
    foreach ($meals as $meal => $desc) {
        $suggestion .= "<li><b>$meal:</b> $desc</li>";
    }
    $suggestion .= "</ul>";
    $suggestion .= "<b>Notes:</b> Adjust portions to meet your calorie goal. Drink at least 2L water daily.";
    if (!empty($allergies)) {
        $suggestion .= " Avoid: $allergies.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create My Diet Plan - CookIt!</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="icon" type="image/png" href="assets/favicon.png">
    <style>
        body {
            background: linear-gradient(120deg,rgb(248, 165, 0) 0%, #fceabb 100%);
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
            max-width: 480px;
            margin: 60px auto;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            padding: 32px 28px 24px 28px;
            text-align: center;
        }
        .logo {
            width: 80px;
            margin-bottom: 16px;
        }
        h2 {
            color:rgb(248, 157, 0);
            margin-bottom: 8px;
        }
        .welcome {
            color: #555;
            margin-bottom: 24px;
        }
        label {
            display: block;
            margin: 14px 0 6px 0;
            text-align: left;
            color: #444;
            font-weight: 500;
        }
        input[type="text"], input[type="number"], select {
            width: 95%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #eee;
            border-radius: 8px;
            font-size: 16px;
        }
        button[type="submit"] {
            background:rgb(248, 108, 0);
            color: #fff;
            border: none;
            padding: 12px 0;
            width: 100%;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 10px;
        }
        button[type="submit"]:hover {
            background:rgb(224, 123, 0);
        }
        .plan-result {
            margin-top: 28px;
            background: #fffbe7;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(248,181,0,0.10);
            padding: 18px 20px 14px 20px;
            text-align: left;
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
        <h2>Create My Diet Plan</h2>
        <div class="welcome">
            Fill in your preferences and let CookIt suggest a diet plan for you!
        </div>
        <form method="POST">
            <label for="goal">Your Goal</label>
            <select name="goal" id="goal" required>
                <option value="Weight Loss">Weight Loss</option>
                <option value="Muscle Gain">Muscle Gain</option>
                <option value="Maintenance">Maintenance</option>
            </select>
            <label for="calories">Daily Calorie Target</label>
            <input type="number" name="calories" id="calories" min="1000" max="4000" step="50" placeholder="e.g. 1800" required>
            <label for="diet_type">Diet Type</label>
            <select name="diet_type" id="diet_type" required>
                <option value="balanced">Balanced</option>
                <option value="lowcarb">Low Carb</option>
                <option value="vegetarian">Vegetarian</option>
            </select>
            <label for="allergies">Allergies / Restrictions <span style="color:#888;font-weight:400;">(optional)</span></label>
            <input type="text" name="allergies" id="allergies" placeholder="e.g. nuts, dairy">
            <button type="submit">Generate Plan</button>
        </form>
        <?php if ($suggestion): ?>
            <div class="plan-result">
                <?php echo $suggestion; ?>
            </div>
        <?php endif; ?>
        <div style="margin-top:22px;">
            <a href="diet.php" style="color:#f8b500;text-decoration:none;font-weight:bold;">&larr; Back to My Diet Plans</a>
        </div>
    </div>
</body>
</html>