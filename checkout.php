<?php
session_start();

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: index.php');
    exit();
}

$totalAmount = 0;
foreach ($_SESSION['cart'] as $cartItem) {
    $totalAmount += $cartItem['price'] * $cartItem['quantity'];
}

define('GST_RATE', 0.18);
define('DELIVERY_CHARGE', 20);
define('HANDLING_CHARGE', 20);

$gstAmount = $totalAmount * GST_RATE;
$finalAmount = $totalAmount + $gstAmount + DELIVERY_CHARGE + HANDLING_CHARGE;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $paymentMethod = $_POST['payment_method'];
    header('Location: confirm_address.php?payment_method=' . urlencode($paymentMethod) . '&total_amount=' . urlencode($finalAmount));
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: skyblue;
            background-image: url('image/Grocery.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }
        .product img {
            width: 100px; 
            height: 100px; 
            object-fit: cover; 
            margin-right: 20px;
            border-radius: 8px;
        }
        .total-amount {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
        }
        .payment-options img {
            width: 30px; 
            height: auto; 
            vertical-align: middle;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Checkout</h1>
        <div class="card mt-4">
            <div class="card-body">
                <h2>Your Shopping Cart</h2>
                <?php foreach ($_SESSION['cart'] as $cartItem): ?>
                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                        <div class="d-flex align-items-center">
                            <img src="<?php echo htmlspecialchars($cartItem['image']); ?>" alt="<?php echo htmlspecialchars($cartItem['name']); ?>">
                            <div>
                                <span><?php echo htmlspecialchars($cartItem['name']); ?></span>
                                <br>
                                <span>₹<?php echo number_format($cartItem['price'], 2); ?> per kg</span>
                                <br>
                                <span>Weight: <?php echo htmlspecialchars($cartItem['weight']); ?> kg</span>
                                <br>
                                <span>Quantity: <?php echo $cartItem['quantity']; ?></span>
                            </div>
                        </div>
                        <span>₹<?php echo number_format($cartItem['price'] * $cartItem['quantity'], 2); ?></span>
                    </div>
                <?php endforeach; ?>
                <div class="total-amount mt-3">Total: ₹<?php echo number_format($totalAmount, 2); ?></div>
                <div class="total-amount mt-3">GST (18%): ₹<?php echo number_format($gstAmount, 2); ?></div>
                <div class="total-amount mt-3">Delivery Charge: ₹<?php echo number_format(DELIVERY_CHARGE, 2); ?></div>
                <div class="total-amount mt-3">Handling Charge: ₹<?php echo number_format(HANDLING_CHARGE, 2); ?></div>
                <div class="total-amount mt-3">Final Amount: ₹<?php echo number_format($finalAmount, 2); ?></div>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-body">
                <h2>Select Payment Method</h2>
                <form action="checkout.php" method="post">
                    <div class="payment-options mt-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="cod" value="Cash on Delivery" required>
                            <label class="form-check-label" for="cod">
                                <img src="image/cash_on_delivery.png" alt="Cash on Delivery"> Cash on Delivery
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="online" value="Online Banking" required>
                            <label class="form-check-label" for="online">
                                <img src="image/online_banking.png" alt="Online Banking"> Online Banking
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="upi" value="UPI" required>
                            <label class="form-check-label" for="upi">
                                <img src="image/upi.png" alt="UPI"> UPI
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Proceed to Confirm Address</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
