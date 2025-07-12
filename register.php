<?php
require 'db.php';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($conn->real_escape_string($_POST['username']));
    $email = trim($conn->real_escape_string($_POST['email']));
    $password_raw = $_POST['password'];
    // Basic validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Please enter a valid email address!';
    } elseif (strlen($username) < 3) {
        $message = 'Username must be at least 3 characters!';
    } elseif (strlen($password_raw) < 6) {
        $message = 'Password must be at least 6 characters!';
    } else {
        $password = password_hash($password_raw, PASSWORD_DEFAULT);
        $check = $conn->query("SELECT id FROM users WHERE email='$email' OR username='$username'");
        if ($check && $check->num_rows > 0) {
            $message = 'Username or email already exists!';
        } else {
            $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
            if ($conn->query($sql)) {
                $message = 'Registration successful! <a href="login.php">Login here</a>.';
            } else {
                $message = 'Error: ' . $conn->error;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - CookIt!</title>
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
            margin-bottom: 8px;
            color: #f8b500;
        }
        .welcome {
            color: #555;
            margin-bottom: 24px;
        }
        input[type="text"], input[type="email"], input[type="password"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0 18px 0;
            border: 1px solid #eee;
            border-radius: 8px;
            font-size: 16px;
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
        .message a {
            color: #f8b500;
            text-decoration: underline;
        }
        .login-link {
            margin-top: 18px;
            color: #333;
        }
        .login-link a {
            color: #f8b500;
            text-decoration: none;
            font-weight: bold;
        }
        .login-link a:hover {
            text-decoration: underline;
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
        </nav>
    </header>
    <div class="container">
        <img src="assets/logo.png" alt="CookIt Logo" class="logo" onerror="this.style.display='none'">
        <h2>Register for CookIt!</h2>
        <div class="welcome">Create your account to start sharing and discovering recipes.</div>
        <form method="POST" autocomplete="off">
            <input type="text" name="username" placeholder="Username" required minlength="3"><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required minlength="6"><br>
            <button type="submit">Register</button>
        </form>
        <div class="message"><?php echo $message; ?></div>
        <div class="login-link">
            Already have an account? <a href="login.php">Login</a>
        </div>
    </div>
</body>
</html>