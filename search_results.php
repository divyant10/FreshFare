<?php
session_start();

$products = [
    ["id" => 1, "name" => "Apple", "price" => 120, "weight" => 1, "image" => "image/apple.jpeg", "category" => "fruits"],
    ["id" => 2, "name" => "Banana", "price" => 50, "weight" => 1, "image" => "image/Banana.jpeg", "category" => "fruits"],
    ["id" => 3, "name" => "Mango", "price" => 30, "weight" => 1, "image" => "image/Mango.jpeg", "category" => "fruits"],
    ["id" => 4, "name" => "Orange", "price" => 80, "weight" => 1, "image" => "image/orange.jpeg", "category" => "fruits"],
    ["id" => 5, "name" => "Potato", "price" => 40, "weight" => 1, "image" => "image/Potato.jpeg", "category" => "vegetables"],
    ["id" => 6, "name" => "Onion", "price" => 50, "weight" => 1, "image" => "image/Onion.jpeg", "category" => "vegetables"],
    ["id" => 7, "name" => "Tomato", "price" => 100, "weight" => 1, "image" => "image/Tomato.jpeg", "category" => "vegetables"],
    ["id" => 8, "name" => "Pomegranate", "price" => 70, "weight" => 1, "image" => "image/Pomegranate.jpeg", "category" => "fruits"],
    ["id" => 9, "name" => "Carrot", "price" => 35, "weight" => 1, "image" => "image/Carrot.jpeg", "category" => "vegetables"],
    ["id" => 10, "name" => "LadyFinger", "price" => 30, "weight" => 1, "image" => "image/Ladyfinger.jpeg", "category" => "vegetables"],
    ["id" => 11, "name" => "Cucumber", "price" => 120, "weight" => 1, "image" => "image/Cucumber.jpeg", "category" => "vegetables"],
    ["id" => 12, "name" => "Jamun", "price" => 325, "weight" => 1, "image" => "image/Jamun.jpeg", "category" => "fruits"],
    ["id" => 13, "name" => "Beans", "price" => 60, "weight" => 1, "image" => "image/Beans.jpeg", "category" => "vegetables"],
    ["id" => 14, "name" => "Capsicum", "price" => 20, "weight" => 1, "image" => "image/Capsicum.jpeg", "category" => "vegetables"],
    ["id" => 15, "name" => "Cauliflower", "price" => 80, "weight" => 1, "image" => "image/Cauliflower.jpeg", "category" => "vegetables"],
    ["id" => 16, "name" => "Mushrooms", "price" => 50, "weight" => 1, "image" => "image/Mushrooms.jpeg", "category" => "vegetables"],
    ["id" => 17, "name" => "Lemon", "price" => 25, "weight" => 1, "image" => "image/Lemon.jpeg", "category" => "vegetables"],
    ["id" => 18, "name" => "Ginger", "price" => 10, "weight" => 1, "image" => "image/Ginger.jpeg", "category" => "vegetables"],
    ["id" => 19, "name" => "Palak", "price" => 30, "weight" => 1, "image" => "image/Palak.jpeg", "category" => "vegetables"],
    ["id" => 20, "name" => "Bottle Gourd", "price" => 45, "weight" => 1, "image" => "image/Bottlegourd.jpeg", "category" => "vegetables"],
    ["id" => 21, "name" => "Green Chilli", "price" => 40, "weight" => 1, "image" => "image/Greenchilli.jpeg", "category" => "vegetables"],
    ["id" => 22, "name" => "Broccoli", "price" => 220, "weight" => 1, "image" => "image/Broccoli.jpeg", "category" => "vegetables"],
    ["id" => 23, "name" => "Corn", "price" => 86, "weight" => 1, "image" => "image/Corn.jpeg", "category" => "vegetables"],
    ["id" => 24, "name" => "Grapes", "price" => 90, "weight" => 1, "image" => "image/Grapes.jpeg", "category" => "fruits"],
    ["id" => 25, "name" => "Guava", "price" => 55, "weight" => 1, "image" => "image/Guava.jpeg", "category" => "fruits"],
    ["id" => 26, "name" => "Chicken", "price" => 550, "weight" => 1, "image" => "image/chicken.jpeg", "category" => "Non-veg"],
    ["id" => 27, "name" => "Egg", "price" => 90, "weight" => 1, "image" => "image/Egg.jpeg", "category" => "Non-veg"],
    ["id" => 28, "name" => "Meat", "price" => 450, "weight" => 1, "image" => "image/Meat.jpeg", "category" => "Non-veg"],
    ["id" => 29, "name" => "Fish", "price" => 660, "weight" => 1, "image" => "image/Fish.jpeg", "category" => "Non-veg"],
    ["id" => 30, "name" => "Milk", "price" => 60, "weight" => 1, "image" => "image/Milk.jpeg", "category" => "Dairy"],
    ["id" => 31, "name" => "Curd", "price" => 70, "weight" => 1, "image" => "image/Curd.jpeg", "category" => "Dairy"],
    ["id" => 32, "name" => "Paneer", "price" => 240, "weight" => 1, "image" => "image/Paneer.jpeg", "category" => "Dairy"],
    ["id" => 33, "name" => "Butter", "price" => 200, "weight" => 1, "image" => "image/Butter.jpeg", "category" => "Dairy"],
    ["id" => 34, "name" => "Cheese", "price" => 320, "weight" => 1, "image" => "image/Cheese.jpeg", "category" => "Dairy"],
    ["id" => 35, "name" => "Ghee", "price" => 550, "weight" => 1, "image" => "image/Ghee.jpeg", "category" => "Dairy"]
];

$searchQuery = $_GET['query'] ?? '';
$categoryFilter = $_GET['category'] ?? '';
$searchResults = [];

if ($searchQuery) {
    foreach ($products as $product) {
        if (stripos($product['name'], $searchQuery) !== false && 
            ($categoryFilter == '' || $product['category'] == $categoryFilter)) {
            $searchResults[] = $product;
        }
    }
} elseif ($categoryFilter) {
    foreach ($products as $product) {
        if ($product['category'] == $categoryFilter) {
            $searchResults[] = $product;
        }
    }
}

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
            }
        }
    }
    header('Location: search_results.php?query=' . urlencode($searchQuery) . '&category=' . urlencode($categoryFilter));
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
    header('Location: search_results.php?query=' . urlencode($searchQuery) . '&category=' . urlencode($categoryFilter));
    exit();
}

$totalAmount = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $cartItem) {
        $totalAmount += $cartItem['price'] * $cartItem['quantity'];
    }
}

$categorizedResults = [
    'fruits' => [],
    'vegetables' => [],
    'Non-veg' => [],
    'Dairy' => []
];

foreach ($searchResults as $product) {
    $categorizedResults[$product['category']][] = $product;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: skyblue;
            background-image: url('image/Grocery.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .product img {
            width: 80px;
            height: 80px;
            margin-right: 20px;
            border-radius: 8px;
            object-fit: cover;
        }
        .quantity-controls button {
            padding: 5px 10px;
            margin: 0 5px;
        }
        .total-amount {
            font-size: 18px;
            font-weight: bold;
        }
        .product-details {
            flex: 1;
        }
        .category-title {
            text-align: center;
            margin-top: 20px;
            text-transform: capitalize;
            font-size: 24px;
            font-weight: bold;
        }
        .btn-checkout {
            display: block;
            width: 100%;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">Search Results</h1>
        <form action="search_results.php" method="get">
            <div class="input-group mb-4">
                <input type="text" class="form-control" placeholder="Search for products" name="query" value="<?php echo htmlspecialchars($searchQuery); ?>">
                <select class="form-select" name="category">
                    <option value="">All Categories</option>
                    <option value="fruits" <?php if ($categoryFilter == 'fruits') echo 'selected'; ?>>Fruits</option>
                    <option value="vegetables" <?php if ($categoryFilter == 'vegetables') echo 'selected'; ?>>Vegetables</option>
                    <option value="Non-veg" <?php if ($categoryFilter == 'Non-veg') echo 'selected'; ?>>Non-veg</option>
                    <option value="Dairy" <?php if ($categoryFilter == 'Dairy') echo 'selected'; ?>>Dairy</option>
                </select>
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>

        <?php if ($searchQuery || $categoryFilter): ?>
            <div class="category-title">Results for "<?php echo htmlspecialchars($searchQuery); ?>" in "<?php echo htmlspecialchars($categoryFilter); ?>"</div>
        <?php endif; ?>

        <?php if (($searchQuery || $categoryFilter) && empty($searchResults)): ?>
            <div class="alert alert-warning" role="alert">No results found for "<?php echo htmlspecialchars($searchQuery); ?>" in "<?php echo htmlspecialchars($categoryFilter); ?>"</div>
        <?php endif; ?>

        <?php foreach ($categorizedResults as $category => $products): ?>
            <?php if (!empty($products)): ?>
                <div class="category-title"><?php echo ucfirst($category); ?></div>
                <div class="list-group mb-4">
                    <?php foreach ($products as $product): ?>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="product d-flex align-items-center">
                                <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                                <div class="product-details">
                                    <h5 class="mb-1"><?php echo htmlspecialchars($product['name']); ?></h5>
                                    <p class="mb-1">Price: ₹<?php echo htmlspecialchars($product['price']); ?> per kg</p>
                                    <p class="mb-1">Weight: <?php echo htmlspecialchars($product['weight']); ?> kg</p>
                                </div>
                            </div>
                            <form action="search_results.php?query=<?php echo urlencode($searchQuery); ?>&category=<?php echo urlencode($categoryFilter); ?>" method="post" class="d-flex">
                                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                                <button type="submit" name="add_to_cart" class="btn btn-success btn-sm">Add to Cart</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>

        <div class="mt-5">
            <h4>Shopping Cart</h4>
            <?php if (!empty($_SESSION['cart'])): ?>
                <ul class="list-group mb-3">
                    <?php foreach ($_SESSION['cart'] as $cartItem): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="product d-flex align-items-center">
                                <img src="<?php echo htmlspecialchars($cartItem['image']); ?>" alt="<?php echo htmlspecialchars($cartItem['name']); ?>">
                                <div class="product-details">
                                    <h5 class="mb-1"><?php echo htmlspecialchars($cartItem['name']); ?></h5>
                                    <p class="mb-1">Price: ₹<?php echo htmlspecialchars($cartItem['price']); ?></p>
                                    <div class="quantity-controls d-flex align-items-center">
                                        <form action="search_results.php?query=<?php echo urlencode($searchQuery); ?>&category=<?php echo urlencode($categoryFilter); ?>" method="post" class="d-flex">
                                            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($cartItem['id']); ?>">
                                            <button type="submit" name="remove_from_cart" class="btn btn-secondary btn-sm">-</button>
                                            <span class="mx-2"><?php echo htmlspecialchars($cartItem['quantity']); ?></span>
                                            <button type="submit" name="add_to_cart" class="btn btn-secondary btn-sm">+</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <div class="total-amount mb-3">Total Amount: ₹<?php echo htmlspecialchars($totalAmount); ?></div>
                <a href="checkout.php" class="btn btn-primary btn-checkout">Proceed to Checkout</a>
            <?php else: ?>
                <p class="alert alert-info">Your cart is empty.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
