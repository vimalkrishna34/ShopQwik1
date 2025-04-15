<?php
// MUST be first - no whitespace before!
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Initialize cart if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Process add to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    // Validate all required fields
    if (isset($_POST['product_id'], $_POST['name'], $_POST['price'], $_POST['image'], $_POST['brand'])) {
        $product = [
            'id' => (int)$_POST['product_id'],
            'name' => $_POST['name'],
            'price' => (float)$_POST['price'],
            'image' => $_POST['image'],
            'brand' => $_POST['brand'],
            'quantity' => 1
        ];
        
        // Check if product already in cart
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
        <h1 class="mb-4">Your Shopping Cart</h1>
        
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
                                    <button type="submit" name="update_quantity" value="decrease" class="quantity-btn btn btn-sm btn-outline-secondary">-</button>
                                    <span class="mx-2"><?= $item['quantity'] ?></span>
                                    <button type="submit" name="update_quantity" value="increase" class="quantity-btn btn btn-sm btn-outline-secondary">+</button>
                                    <input type="hidden" name="action" value="">
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
                                <a href="../products/" class="btn btn-outline-secondary">Continue Shopping</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="empty-cart">
                <h4>Your cart is empty</h4>
                <p class="text-muted">Start shopping to add items to your cart</p>
                <a href="../products/" class="btn btn-primary mt-3">Continue Shopping</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>

<?php include '../includes/footer.php'; ?>