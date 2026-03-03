<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
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
        .signup-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #5cb85c;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #4cae4c;
        }
        .message {
            text-align: center;
            margin-top: 10px;
        }
        .message.error {
            color: red;
        }
        .message.success {
            color: green;
        }
    </style>
</head>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    echo "Username: $username, Password: $password <br>";

    $stmt = $conn->prepare("SELECT first_name, last_name, phone_number, email, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    
    echo "Number of rows found: " . $stmt->num_rows . "<br>";

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($first_name, $last_name, $phone_number, $email, $hashed_password);
        $stmt->fetch();

        
        echo "Fetched values: $first_name, $last_name, $phone_number, $email <br>";

        if (password_verify($password, $hashed_password)) {
            
            echo "Password matched. Setting session variables...<br>";

            $_SESSION['first_name'] = $first_name;
            $_SESSION['last_name'] = $last_name;
            $_SESSION['phone_number'] = $phone_number;
            $_SESSION['email'] = $email;
            $_SESSION['username'] = $username;

            
            echo "Redirecting to welcome.php...<br>";
            header("Location: welcome.php");
            exit(); 
        } else {
            echo "Invalid password.<br>";
        }
    } else {
        echo "No user found with that username.<br>";
    }

    $stmt->close();
    $conn->close();
}
?>
