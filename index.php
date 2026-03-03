<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FreshFare</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: skyblue;
            background-image: url('image/Grocery.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }
        .container {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        .auth-links {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .auth-links a {
            text-decoration: none;
            color: #5cb85c;
            font-weight: bold;
            margin: 5px 0; 
        }
        .auth-links a:hover {
            text-decoration: underline;
        }
        footer {
            margin-top: 20px; 
            text-align: center;
            background-color: #fff;
            padding: 10px 0;
            width: 100%;
            border-top: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>FreshFare</h1>
        <p>Welcome to FreshFare</p>
        <div class="auth-links">
            <a href="login.php" class="btn btn-success">Login</a>
            <span>or</span>
            <a href="signup.php" class="btn btn-primary">Sign Up</a>
        </div>
        <footer>
            <p>© 2024 Grocery Website</p>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
