<?php
session_start();

// Initialize cart if it doesn't exist
$_SESSION['cart'] = $_SESSION['cart'] ?? [];

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
        .dark-mode .border-gray-200 {
            border-color: #4a5568;
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
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Theme toggle functionality
        function toggleTheme() {
            const currentTheme = $('html').hasClass('dark-mode') ? 'light' : 'dark';
            window.location.href = '?theme=' + currentTheme;
        }
    </script>
</body>
</html>