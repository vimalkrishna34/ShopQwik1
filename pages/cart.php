<?php include '../includes/header.php'; ?>
<?php include '../includes/arrays.php'; ?>

<?php
session_start();

// Initialize the cart if it doesn't exist
$_SESSION['cart'] = $_SESSION['cart'] ?? [];

// Sample Levi's products (usually fetched from the database)
$levisProducts = [
    ["name" => "501 Original Fit Jeans", "price" => 2071, "image" => "https://i.pinimg.com/736x/04/69/05/046905c2376ac6ffba78de6b9c9f5142.jpg"],
    ["name" => "Trucker Jacket", "price" => 3098, "image" => "https://i.pinimg.com/736x/5f/84/c0/5f84c0f92f050b97e2f60e7301d07949.jpg"],
    ["name" => "T-Shirt", "price" => 599, "image" => "https://i.pinimg.com/736x/1c/d8/ee/1cd8ee46014309c093970e7d32123ae5.jpg"],
    ["name" => "Pants", "price" => 1099, "image" => "https://i.pinimg.com/736x/18/31/83/183183d2e3a24de375d3f8f0c792b7ff.jpg"],
    ["name" => "Flared Skirts", "price" => 1567, "image" => "https://i.pinimg.com/736x/47/48/76/47487679ee24578aef85feb97cb7b52a.jpg"],
    ["name" => "Graphic T-shirts", "price" => 1299, "image" => "https://i.pinimg.com/736x/fc/f4/e4/fcf4e4df59476b1f888a5944fbaf2af2.jpg"]
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
            }
        }
        if (!$found) {
            $_SESSION['cart'][] = $product;
        }
    }
}

// Clear the cart if the clear_cart action is triggered
if (isset($_POST['clear_cart'])) {
    $_SESSION['cart'] = [];
}

$cart = $_SESSION['cart'];
$total = 0;
?>

<!DOCTYPE html>
<html lang="en" class="<?= $theme === 'dark' ? 'dark' : '' ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        :root {
            --bg-color: #f8f8f8;
            --text-color: #333;
            --container-bg: #fff;
            --shadow-color: rgba(0, 0, 0, 0.1);
            --border-color: #eee;
            --summary-bg: #f9f9f9;
            --header-color: #333;
        }

        .dark {
            --bg-color: #121212;
            --text-color: #e0e0e0;
            --container-bg: #1e1e1e;
            --shadow-color: rgba(0, 0, 0, 0.3);
            --border-color: #333;
            --summary-bg: #2d2d2d;
            --header-color: #ffffff;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            margin-top: 50px;
            transition: background-color 0.3s, color 0.3s;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 50px auto;
            background: var(--container-bg);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px var(--shadow-color);
            transition: background-color 0.3s, box-shadow 0.3s;
        }
        .header {
            text-align: center;
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 30px;
            color: var(--header-color);
            transition: color 0.3s;
        }
        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            border-bottom: 1px solid var(--border-color);
            transition: border-color 0.3s;
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
            transition: background-color 0.3s;
        }
        .cart-item .update-quantity:hover {
            background-color: #0056b3;
        }
        .order-summary {
            background: var(--summary-bg);
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
            transition: background-color 0.3s;
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
            transition: background-color 0.3s;
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
            transition: background-color 0.3s;
        }
        .clear-cart-btn:hover {
            background-color: #c82333;
        }
        .empty-cart {
            text-align: center;
            padding: 50px 0;
            color: var(--text-color);
            font-size: 24px;
            opacity: 0.7;
            transition: color 0.3s;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">Your Cart</div>

    <?php if (!empty($cart)): ?>
        <?php foreach ($cart as $item): ?>
            <div class="cart-item">
                <img src="<?= $item['image'] ?>" alt="<?= $item['name'] ?>">
                <div><?= $item['name'] ?></div>
                <div>₹<?= $item['price'] ?></div>
                <div>
                    <button class="update-quantity" data-action="decrease" data-name="<?= $item['name'] ?>">-</button>
                    <?= $item['quantity'] ?>
                    <button class="update-quantity" data-action="increase" data-name="<?= $item['name'] ?>">+</button>
                </div>
                <div>₹<?= $item['price'] * $item['quantity'] ?></div>
            </div>
            <?php $total += $item['price'] * $item['quantity']; ?>
        <?php endforeach; ?>

        <div class="order-summary">
            <p>Subtotal: ₹<?= $total ?></p>
            <p>Shipping: Free</p>
            <p><b>Total: ₹<?= $total ?></b></p>
        </div>
        <a href="checkout.php"><button class="checkout-btn">CHECKOUT</button></a>
        <form method="POST" action="">
            <button type="submit" name="clear_cart" class="clear-cart-btn">CLEAR CART</button>
        </form>
    <?php else: ?>
        <div class="empty-cart">Your cart is empty.</div>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Update quantity functionality
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

</body>
</html>