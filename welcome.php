<?php
session_start();


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}


$products = [
    ["id" => 1, "name" => "Apple", "price" => 120, "weight" => 1, "image" => "image/apple.jpeg"],
    ["id" => 2, "name" => "Banana", "price" => 50, "weight" => 1, "image" => "image/Banana.jpeg"],
    ["id" => 3, "name" => "Mango", "price" => 30, "weight" => 1, "image" => "image/Mango.jpeg"],
    ["id" => 4, "name" => "Orange", "price" => 80, "weight" => 1, "image" => "image/orange.jpeg"],
];

if (isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]['quantity']++;
    } else {
        foreach ($products as $product) {
            if ($product['id'] == $productId) {
                $_SESSION['cart'][$productId] = $product;
                $_SESSION['cart'][$productId]['quantity'] = 1;
                break;
            }
        }
    }
    header('Location: welcome.php');
    exit();
}

if (isset($_POST['remove_from_cart'])) {
    $productId = $_POST['product_id'];
    if (isset($_SESSION['cart'][$productId])) {
        if ($_SESSION['cart'][$productId]['quantity'] > 1) {
            $_SESSION['cart'][$productId]['quantity']--;
        } else {
            unset($_SESSION['cart'][$productId]);
        }
    }
    header('Location: welcome.php');
    exit();
}

$totalAmount = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $cartItem) {
        $totalAmount += $cartItem['price'] * $cartItem['quantity'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: skyblue;
            background-image: url('image/Grocery.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }
        .container-custom {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        .product img {
            width: 80px; 
            height: auto; 
            border-radius: 8px;
        }
        .quantity-controls button {
            padding: 5px 10px;
            margin: 0 5px;
            font-size: 16px;
            border: none;
            background-color: #5cb85c;
            color: white;
            cursor: pointer;
        }
        .quantity-controls button:hover {
            background-color: #4cae4c;
        }
        .total-amount {
            text-align: right;
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
        }
        .message {
            text-align: center;
            margin-top: 10px;
            font-weight: bold;
        }
        .message.error {
            color: red;
        }
        .message.success {
            color: green;
        }
    </style>
</head>
<body>
    <div class="container container-custom">
        <h1>Welcome <?php echo htmlspecialchars($_SESSION['first_name']) . " " . htmlspecialchars($_SESSION['last_name']); ?>!</h1>
        <p>This is your fresh vegetable and fruit website.</p>
        <p>Your phone number: <?php echo htmlspecialchars($_SESSION['phone_number']); ?></p>
        <p>Your email: <?php echo htmlspecialchars($_SESSION['email']); ?></p>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
    <div class="container container-custom">
        <form action="search_results.php" method="get" class="input-group mb-3">
            <input type="text" name="query" placeholder="Search for products..." required class="form-control">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
    </div>
    <div class="container container-custom">
        <h2>Sample Products</h2>
        <?php foreach ($products as $product): ?>
            <div class="product row mb-3">
                <div class="col-md-3">
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                </div>
                <div class="col-md-6">
                    <h5><?php echo htmlspecialchars($product['name']); ?></h5>
                    <p>₹<?php echo number_format($product['price'], 2); ?> per kg</p>
                    <p>Weight: <?php echo htmlspecialchars($product['weight']); ?> kg</p>
                </div>
                <div class="col-md-3 text-right">
                    <form action="welcome.php" method="post">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <button type="submit" name="add_to_cart" class="btn btn-success">Add to Cart</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="container container-custom">
        <h2>Your Shopping Cart</h2>
        <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
            <?php foreach ($_SESSION['cart'] as $cartItem): ?>
                <div class="product row mb-3">
                    <div class="col-md-3">
                        <img src="<?php echo htmlspecialchars($cartItem['image']); ?>" alt="<?php echo htmlspecialchars($cartItem['name']); ?>">
                    </div>
                    <div class="col-md-6">
                        <h5><?php echo htmlspecialchars($cartItem['name']); ?></h5>
                        <p>₹<?php echo number_format($cartItem['price'], 2); ?> per kg</p>
                        <p>Weight: <?php echo htmlspecialchars($cartItem['weight']); ?> kg</p>
                        <div class="quantity-controls d-inline-flex align-items-center">
                            <form action="welcome.php" method="post" class="mr-2">
                                <input type="hidden" name="product_id" value="<?php echo $cartItem['id']; ?>">
                                <button type="submit" name="remove_from_cart" class="btn btn-danger btn-sm">-</button>
                            </form>
                            <span><?php echo $cartItem['quantity']; ?></span>
                            <form action="welcome.php" method="post" class="ml-2">
                                <input type="hidden" name="product_id" value="<?php echo $cartItem['id']; ?>">
                                <button type="submit" name="add_to_cart" class="btn btn-success btn-sm">+</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-3 text-right">
                        <span>₹<?php echo number_format($cartItem['price'] * $cartItem['quantity'], 2); ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="total-amount">Total: ₹<?php echo number_format($totalAmount, 2); ?></div>
            <div class="text-right">
                <a href="checkout.php" class="btn btn-primary">Proceed to Checkout</a>
            </div>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>