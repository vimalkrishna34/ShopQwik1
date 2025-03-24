<?php include '../includes/header.php'; ?>
<?php include '../includes/arrays.php'; ?>

<?php
session_start();

// Initialize the cart if it doesn't exist
$_SESSION['cart'] = $_SESSION['cart'] ?? [];

// Sample Levi's products (usually fetched from the database)
$levisProducts = [
    ["name" => "Levi's 501 Original Fit Jeans", "price" => 98, "quantity" => 1, "image" => "img/levis_501.jpg"],
    ["name" => "Levi's Trucker Jacket", "price" => 120, "quantity" => 1, "image" => "img/levis_jacket.jpg"],
    ["name" => "Levi's Graphic T-Shirt", "price" => 35, "quantity" => 1, "image" => "img/levis_tshirt.jpg"]
];

// Add Levi's products to the cart if they are selected
if (isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];
    if (isset($levisProducts[$productId])) {
        $product = $levisProducts[$productId];
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f8f8;
            color: #333;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 30px;
            color: #333;
        }
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
        .cart-item button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .cart-item button:hover {
            background-color: #0056b3;
        }
        .order-summary {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }
        .order-summary p {
            margin: 10px 0;
            font-size: 18px;
        }
        .order-summary b {
            font-size: 20px;
            color: #333;
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
                <div>$<?= $item['price'] ?></div>
                <div>
                    <button>-</button>
                    <?= $item['quantity'] ?>
                    <button>+</button>
                </div>
                <div>$<?= $item['price'] * $item['quantity'] ?></div>
            </div>
            <?php $total += $item['price'] * $item['quantity']; ?>
        <?php endforeach; ?>

        <div class="order-summary">
            <div>
                <p>Subtotal: $<?= $total ?></p>
                <p>Shipping: Free</p>
                <p><b>Total: $<?= $total ?></b></p>
            </div>
        </div>
        <button class="checkout-btn">CHECKOUT</button>
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
    $('.cart-item button').on('click', function() {
        var button = $(this);
        var cartItem = button.closest('.cart-item');
        var productName = cartItem.find('div:eq(1)').text();
        var action = button.text();

        $.ajax({
            url: 'update_cart.php',
            type: 'POST',
            data: {
                product_name: productName,
                action: action
            },
            success: function(response) {
                location.reload(); // Reload the page to reflect the changes
            }
        });
    });
});
</script>

</body>
</html>

<?php include '../includes/footer.php'; ?>