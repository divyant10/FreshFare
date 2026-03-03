<?php
session_start();

if (!isset($_GET['payment_method']) || !isset($_GET['address']) || !isset($_GET['total_amount'])) {
    header('Location: index.php');
    exit();
}

$paymentMethod = $_GET['payment_method'];
$address = $_GET['address'];
$totalAmount = $_GET['total_amount'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Successful</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: skyblue;
            background-image: url('image/Grocery.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }
        .container {
            max-width: 600px;
            margin: 100px auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .container h1 {
            color: #28a745; 
        }
        .container p {
            font-size: 18px;
        }
    </style>
    <meta http-equiv="refresh" content="5;url=index.php">
</head>
<body>
    <div class="container">
        <h1>Order Successful</h1>
        <p class="lead">Thank you for your order!</p>
        <p><strong>Payment Method:</strong> <?php echo htmlspecialchars($paymentMethod); ?></p>
        <p><strong>Delivery Address:</strong> <?php echo htmlspecialchars($address); ?></p>
        <p><strong>Total Amount Paid:</strong> ₹<?php echo number_format($totalAmount, 2); ?></p>
        <p class="mt-4">You will be redirected to the home page in a few seconds...</p>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
