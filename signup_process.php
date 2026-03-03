<?php
require 'connection.php';


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    
    if ($email === $username) {
        header("Location: signup.php?error=Email and username cannot be the same. Please choose different ones.");
        exit();
    }

    
    $stmt = $conn->prepare("SELECT email, username FROM users WHERE email = ? OR username = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("ss", $email, $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        
        header("Location: signup.php?error=The email or username is already in use. Please choose a different one.");
    } else {
        
        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, phone_number, email, username, password) VALUES (?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("ssssss", $first_name, $last_name, $phone_number, $email, $username, $password);

        if ($stmt->execute()) {
            header("Location: signup.php?success=Sign Up Successful!");
        } else {
            header("Location: signup.php?error=Error: " . $stmt->error);
        }
    }

    $stmt->close();
    $conn->close();
}
?>
