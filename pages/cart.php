<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    if (isset($_POST['product_id'], $_POST['name'], $_POST['price'], $_POST['image'], $_POST['brand'])) {
        $product = [
            'id' => (int)$_POST['product_id'],
            'name' => $_POST['name'],
            'price' => (float)$_POST['price'],
            'image' => $_POST['image'],
            'brand' => $_POST['brand'],
            'quantity' => 1
        ];
        
        $found = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] == $product['id'] && $item['brand'] == $product['brand']) {
                $item['quantity']++;
                $found = true;
                break;
            }
        }
        
        if (!$found) {
            $_SESSION['cart'][] = $product;
        }
    }
    header("Location: cart.php");
    exit();
}

// Process remove item
if (isset($_GET['remove'])) {
    $index = (int)$_GET['remove'];
    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex array
    }
    header("Location: cart.php");
    exit();
}

// Process quantity update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_quantity'])) {
    $index = (int)$_POST['index'];
    if (isset($_SESSION['cart'][$index])) {
        if ($_POST['action'] === 'increase') {
            $_SESSION['cart'][$index]['quantity']++;
        } elseif ($_POST['action'] === 'decrease' && $_SESSION['cart'][$index]['quantity'] > 1) {
            $_SESSION['cart'][$index]['quantity']--;
        }
    }
    header("Location: cart.php");
    exit();
}

// Process clear cart
if (isset($_POST['clear_cart'])) {
    $_SESSION['cart'] = [];
    header("Location: cart.php");
    exit();
}

// Calculate total
$total = array_reduce($_SESSION['cart'], function($sum, $item) {
    return $sum + ($item['price'] * $item['quantity']);
}, 0);

// Include header AFTER all processing
require_once __DIR__ . '/../includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Shopping Cart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .cart-container {
            margin-top: 80px;
        }
        .cart-item {
            transition: all 0.3s ease;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }
        .cart-item:hover {
            background-color: rgba(0,0,0,0.02);
        }
        .quantity-btn {
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }
        .empty-cart {
            padding: 50px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container cart-container">
        <h1 class="mb-4" style="margin-top: 100px;">Your Shopping Cart</h1>
        
        <?php if (!empty($_SESSION['cart'])): ?>
            <div class="row">
                <div class="col-md-8">
                    <?php foreach ($_SESSION['cart'] as $index => $item): ?>
                        <div class="cart-item row align-items-center">
                            <div class="col-2">
                                <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="img-thumbnail">
                            </div>
                            <div class="col-4">
                                <h5><?= htmlspecialchars($item['name']) ?></h5>
                                <span class="badge bg-secondary"><?= htmlspecialchars($item['brand']) ?></span>
                            </div>
                            <div class="col-2">
                                ₹<?= number_format($item['price'], 2) ?>
                            </div>
                            <div class="col-2">
                                <form method="POST" class="d-flex align-items-center">
                                    <input type="hidden" name="index" value="<?= $index ?>">
                                    <input type="hidden" name="action" id="action_<?= $index ?>">
                                    <button type="button" onclick="updateQuantity(<?= $index ?>, 'decrease')" class="quantity-btn btn btn-sm btn-outline-secondary">-</button>
                                    <span class="mx-2"><?= $item['quantity'] ?></span>
                                    <button type="button" onclick="updateQuantity(<?= $index ?>, 'increase')" class="quantity-btn btn btn-sm btn-outline-secondary">+</button>
                                    <button type="submit" name="update_quantity" style="display:none;"></button>
                                </form>
                            </div>
                            <div class="col-2 d-flex align-items-center">
                                ₹<?= number_format($item['price'] * $item['quantity'], 2) ?>
                                <a href="cart.php?remove=<?= $index ?>" class="btn btn-sm btn-danger ms-2">×</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Order Summary</h5>
                            <hr>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal:</span>
                                <span>₹<?= number_format($total, 2) ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Shipping:</span>
                                <span>FREE</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between fw-bold mb-3">
                                <span>Total:</span>
                                <span>₹<?= number_format($total, 2) ?></span>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
                                <form method="POST">
                                    <button type="submit" name="clear_cart" class="btn btn-danger w-100">Clear Cart</button>
                                </form>
                                <a href="../pages/location.php" class="btn btn-outline-secondary">Continue Shopping</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="empty-cart" style="margin-top: 30px;">
                <h4>Your cart is empty</h4>
                <p class="text-muted">Start shopping to add items to your cart</p>
                <a href="../pages/location.php" class="btn btn-primary mt-3">Continue Shopping</a>
            </div>
        <?php endif; ?>
    </div>

    <script>
        function updateQuantity(index, action) {
            document.getElementById('action_' + index).value = action;
            // Find the closest form and submit it
            const form = document.querySelector(`form input[name="index"][value="${index}"]`).closest('form');
            form.querySelector('button[type="submit"]').click();
        }
    </script>
</body>
</html>
<div style="margin-top: 100px;">
<?php include '../includes/footer.php'; ?>
</div>