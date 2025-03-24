<?php
session_start();

// Initialize cart if it doesn't exist
$_SESSION['cart'] = $_SESSION['cart'] ?? [];

<<<<<<< HEAD
// Sample Levi's products (usually fetched from the database)
$levisProducts = [
    ["name" => "501 Original Fit Jeans", "price" => 98, "image" => "https://i.pinimg.com/736x/04/69/05/046905c2376ac6ffba78de6b9c9f5142.jpg"],
    ["name" => "Trucker Jacket", "price" => 120, "image" => "https://i.pinimg.com/736x/5f/84/c0/5f84c0f92f050b97e2f60e7301d07949.jpg"],
    ["name" => "T-Shirt", "price" => 35, "image" => "https://i.pinimg.com/736x/1c/d8/ee/1cd8ee46014309c093970e7d32123ae5.jpg"],
    ["name" => "Pants", "price" => 35, "image" => "https://i.pinimg.com/736x/18/31/83/183183d2e3a24de375d3f8f0c792b7ff.jpg"],
    ["name" => "Flared Skirts", "price" => 35, "image" => "https://i.pinimg.com/736x/47/48/76/47487679ee24578aef85feb97cb7b52a.jpg"],
    ["name" => "Graphic T-shirts", "price" => 35, "image" => "https://i.pinimg.com/736x/fc/f4/e4/fcf4e4df59476b1f888a5944fbaf2af2.jpg"]
];

// Add Levi's products to the cart if they are selected
if (isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];
    if (isset($levisProducts[$productId])) {
        $product = $levisProducts[$productId];
        $product['quantity'] = 1; // Ensure quantity starts at 1

        // Check if the product is already in the cart
        $found = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['name'] === $product['name']) {
                $item['quantity'] += 1;
                $found = true;
                break;
=======
// Check for theme preference
$theme = $_GET['theme'] ?? $_SESSION['theme'] ?? 'light';
$_SESSION['theme'] = $theme;

// Sample products (replace with your actual product data)
$products = [
    ["name" => "Product 1", "price" => 29.99, "image" => "img/product1.jpg"],
    ["name" => "Product 2", "price" => 49.99, "image" => "img/product2.jpg"]
];

// Handle cart actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_to_cart'])) {
        $productId = $_POST['product_id'];
        if (isset($products[$productId])) {
            // Add product to cart or increment quantity
            $found = false;
            foreach ($_SESSION['cart'] as &$item) {
                if ($item['name'] === $products[$productId]['name']) {
                    $item['quantity'] += 1;
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $_SESSION['cart'][] = array_merge($products[$productId], ['quantity' => 1]);
>>>>>>> 9258eb017096f64f357046291a05a8dda9b226ca
            }
        }
    } elseif (isset($_POST['clear_cart'])) {
        $_SESSION['cart'] = [];
    }
}

// Calculate total
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="en" class="<?= $theme === 'dark' ? 'dark-mode' : '' ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopOwik - Your Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .dark-mode {
            background-color: #1a202c;
            color: #e2e8f0;
        }
        .dark-mode .bg-white {
            background-color: #2d3748;
        }
        .dark-mode .text-gray-800 {
            color: #e2e8f0;
        }
<<<<<<< HEAD
        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            border-bottom: 1px solid #eee;
        }
        .cart-item img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }
        .cart-item div {
            flex: 1;
            margin: 0 15px;
            text-align: center;
        }
        .cart-item .update-quantity {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .cart-item .update-quantity:hover {
            background-color: #0056b3;
        }
        .order-summary {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }
        .checkout-btn {
            background-color: #28a745;
            color: white;
            padding: 15px 20px;
            text-align: center;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
        }
        .checkout-btn:hover {
            background-color: #218838;
        }
        .clear-cart-btn {
            background-color: #dc3545;
            color: white;
            padding: 15px 20px;
            text-align: center;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
            font-size: 18px;
            font-weight: bold;
        }
        .clear-cart-btn:hover {
            background-color: #c82333;
        }
        .empty-cart {
            text-align: center;
            padding: 50px 0;
            color: #888;
            font-size: 24px;
=======
        .dark-mode .border-gray-200 {
            border-color: #4a5568;
>>>>>>> 9258eb017096f64f357046291a05a8dda9b226ca
        }
    </style>
</head>
<body class="min-h-screen flex flex-col <?= $theme === 'dark' ? 'dark-mode' : 'bg-gray-100' ?>">
    <?php include '../includes/header.php'; ?>

    <div class="container mx-auto px-4 py-8 flex-grow">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md overflow-hidden dark:bg-gray-800">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Your Cart</h1>
                
                <?php if (!empty($_SESSION['cart'])): ?>
                    <div class="space-y-4">
                        <?php foreach ($_SESSION['cart'] as $index => $item): ?>
                            <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
                                <div class="flex items-center space-x-4">
                                    <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="w-20 h-20 object-cover rounded">
                                    <div>
                                        <h3 class="text-lg font-medium text-gray-800 dark:text-white"><?= htmlspecialchars($item['name']) ?></h3>
                                        <p class="text-gray-600 dark:text-gray-300">$<?= number_format($item['price'], 2) ?></p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <div class="flex items-center border rounded">
                                        <button class="px-3 py-1 bg-gray-100 dark:bg-gray-700">-</button>
                                        <span class="px-3"><?= $item['quantity'] ?></span>
                                        <button class="px-3 py-1 bg-gray-100 dark:bg-gray-700">+</button>
                                    </div>
                                    <p class="text-lg font-medium dark:text-white">$<?= number_format($item['price'] * $item['quantity'], 2) ?></p>
                                    <button class="text-red-500 hover:text-red-700">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

<<<<<<< HEAD
    <?php if (!empty($cart)): ?>
        <?php foreach ($cart as $item): ?>
            <div class="cart-item">
                <img src="<?= $item['image'] ?>" alt="<?= $item['name'] ?>">
                <div><?= $item['name'] ?></div>
                <div>$<?= $item['price'] ?></div>
                <div>
                    <button class="update-quantity" data-action="decrease" data-name="<?= $item['name'] ?>">-</button>
                    <?= $item['quantity'] ?>
                    <button class="update-quantity" data-action="increase" data-name="<?= $item['name'] ?>">+</button>
                </div>
                <div>$<?= $item['price'] * $item['quantity'] ?></div>
            </div>
            <?php $total += $item['price'] * $item['quantity']; ?>
        <?php endforeach; ?>

        <div class="order-summary">
            <p>Subtotal: $<?= $total ?></p>
            <p>Shipping: Free</p>
            <p><b>Total: $<?= $total ?></b></p>
=======
                    <div class="mt-6 p-4 bg-gray-50 rounded-lg dark:bg-gray-700">
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600 dark:text-gray-300">Subtotal:</span>
                            <span class="font-medium dark:text-white">$<?= number_format($total, 2) ?></span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600 dark:text-gray-300">Shipping:</span>
                            <span class="font-medium dark:text-white">Free</span>
                        </div>
                        <div class="flex justify-between text-xl font-bold mt-4 pt-4 border-t border-gray-200 dark:border-gray-600">
                            <span class="dark:text-white">Total:</span>
                            <span class="dark:text-white">$<?= number_format($total, 2) ?></span>
                        </div>
                    </div>

                    <div class="mt-6 space-y-3">
                        <button class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">
                            Proceed to Checkout
                        </button>
                        <form method="POST">
                            <button type="submit" name="clear_cart" class="w-full py-3 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition">
                                Clear Cart
                            </button>
                        </form>
                    </div>
                <?php else: ?>
                    <div class="text-center py-12">
                        <i class="fas fa-shopping-cart text-5xl text-gray-400 mb-4"></i>
                        <h3 class="text-xl font-medium text-gray-600 dark:text-gray-300">Your cart is empty</h3>
                        <p class="text-gray-500 dark:text-gray-400 mt-2">Start shopping to add items to your cart</p>
                        <a href="products.php" class="inline-block mt-6 px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">
                            Continue Shopping
                        </a>
                    </div>
                <?php endif; ?>
            </div>
>>>>>>> 9258eb017096f64f357046291a05a8dda9b226ca
        </div>
    </div>

<<<<<<< HEAD
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.update-quantity').on('click', function() {
        var button = $(this);
        var action = button.data('action');
        var productName = button.data('name');

        $.ajax({
            url: 'update_cart.php',
            type: 'POST',
            data: { product_name: productName, action: action },
            success: function() {
                location.reload();
            }
        });
    });
});
</script>
=======
    <?php include '../includes/footer.php'; ?>
>>>>>>> 9258eb017096f64f357046291a05a8dda9b226ca

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Theme toggle functionality
        function toggleTheme() {
            const currentTheme = $('html').hasClass('dark-mode') ? 'light' : 'dark';
            window.location.href = '?theme=' + currentTheme;
        }
    </script>
</body>
<<<<<<< HEAD
</html>
=======
</html>
>>>>>>> 9258eb017096f64f357046291a05a8dda9b226ca
