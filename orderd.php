<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Initialize ordered items session if not set
if (!isset($_SESSION['ordered_items'])) {
    $_SESSION['ordered_items'] = [];
}

// Process moving cart items to ordered items when coming from checkout
if (isset($_GET['from_checkout']) && !empty($_SESSION['cart'])) {
    $order = [
        'order_id' => 'ORD-' . substr(md5(uniqid()), 0, 8), // Simple order ID
        'items' => $_SESSION['cart'],
        'total' => array_reduce($_SESSION['cart'], function($sum, $item) {
            return $sum + ($item['price'] * $item['quantity']);
        }, 0),
        'order_date' => date('F j, Y, g:i a') // More readable date format
    ];
    
    array_unshift($_SESSION['ordered_items'], $order); // Add new order at beginning
    $_SESSION['cart'] = []; // Clear the cart
}

// Include header
require_once __DIR__ . '../includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Orders</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .order-container {
            margin-top: 100px;
        }
        .order-card {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
        }
        .order-header {
            background-color: #f8f9fa;
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }
        .order-item {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }
        .order-item:last-child {
            border-bottom: none;
        }
        .empty-orders {
            padding: 50px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container order-container">
        <h1>Your Orders</h1>
        
        <?php if (!empty($_SESSION['ordered_items'])): ?>
            <?php foreach ($_SESSION['ordered_items'] as $order): ?>
                <div class="order-card">
                    <div class="order-header d-flex justify-content-between">
                        <div>
                            <h5>Order #<?= htmlspecialchars($order['order_id']) ?></h5>
                            <small class="text-muted">Placed on <?= htmlspecialchars($order['order_date']) ?></small>
                        </div>
                        <div>
                            <h5>₹<?= number_format($order['total'], 2) ?></h5>
                        </div>
                    </div>
                    
                    <div class="order-items">
                        <?php foreach ($order['items'] as $item): ?>
                            <div class="order-item row">
                                <div class="col-2">
                                    <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="img-thumbnail" style="max-height: 60px;">
                                </div>
                                <div class="col-6">
                                    <h6><?= htmlspecialchars($item['name']) ?></h6>
                                    <small class="text-muted"><?= htmlspecialchars($item['brand']) ?></small>
                                </div>
                                <div class="col-2 text-center">
                                    <small>Qty: <?= $item['quantity'] ?></small>
                                </div>
                                <div class="col-2 text-end">
                                    ₹<?= number_format($item['price'] * $item['quantity'], 2) ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-orders">
                <h4>You haven't placed any orders yet</h4>
                <p class="text-muted">Your orders will appear here after checkout</p>
                <a href="../pages/location.php" class="btn btn-primary mt-3">Start Shopping</a>
            </div>
        <?php endif; ?>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>