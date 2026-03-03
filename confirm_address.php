<?php
session_start();

if (!isset($_GET['payment_method']) || !isset($_GET['total_amount'])) {
    header('Location: checkout.php');
    exit();
}

$paymentMethod = $_GET['payment_method'];
$totalAmount = $_GET['total_amount'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userAddress = $_POST['address'];
    
    $_SESSION['cart'] = [];
    
    header('Location: success.php?payment_method=' . urlencode($paymentMethod) . '&address=' . urlencode($userAddress) . '&total_amount=' . urlencode($totalAmount));
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Address</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: skyblue;
            background-image: url('image/Grocery.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }
        .container {
            max-width: 700px; /* Increase the width */
        }
        .card {
            padding: 20px; /* Add padding to the card */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Confirm Address</h1>
        <div class="card mt-4">
            <div class="card-body">
                <h2>Total Bill: ₹<?php echo number_format($totalAmount, 2); ?></h2>
                <form action="confirm_address.php?payment_method=<?php echo urlencode($paymentMethod); ?>&total_amount=<?php echo urlencode($totalAmount); ?>" method="post">
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <textarea id="address" name="address" class="form-control" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mt-4">Place Order</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
