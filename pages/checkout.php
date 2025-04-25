<?php
// checkout.php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "shopqwik";

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create tables if they don't exist
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

mysqli_query($conn, "CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    username VARCHAR(50) NOT NULL,
    order_data TEXT NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
)");

// Redirect if cart is empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}

// Calculate totals
$subtotal = 0;
foreach ($_SESSION['cart'] as $item) {
    $subtotal += ($item['price'] * $item['quantity']);
}
$total = $subtotal;

if (isset($_POST['place_order'])) {
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
        $username = $_SESSION['username'];
        $orderData = json_encode($_SESSION['cart']);
        
        $stmt = mysqli_prepare($conn, "INSERT INTO orders (user_id, username, order_data, total_amount) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "issd", $userId, $username, $orderData, $total);
        mysqli_stmt_execute($stmt);
        
        // Update the user's Ordered column
        $updateStmt = mysqli_prepare($conn, "UPDATE users SET Ordered = ? WHERE id = ?");
        $orderedValue = "Ordered: " . date('Y-m-d H:i:s');
        mysqli_stmt_bind_param($updateStmt, "si", $orderedValue, $userId);
        mysqli_stmt_execute($updateStmt);
    }
    
    unset($_SESSION['cart']);
    
    echo "<script>
            alert('✅ Your order has been placed successfully! Collect it from our store in Mall');
            window.location.href = '../index.php';
          </script>";
    exit();
}

include '../includes/header.php';
?>


<div class="max-w-6xl mx-auto p-6 bg-white rounded-lg shadow-lg" style="margin-top: 80px;">
    <h2 class="text-3xl font-semibold mb-6">Checkout</h2>
    
    <form method="post">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-6">
                <div class="p-4 border rounded-lg">
                    <h3 class="text-xl font-semibold mb-3">Contact Information</h3>
                    <input type="text" placeholder="First Name" class="w-full border p-2 rounded-md mb-2" required>
                    <input type="text" placeholder="Last Name" class="w-full border p-2 rounded-md mb-2" required>
                    <input type="email" placeholder="Email Address" class="w-full border p-2 rounded-md mb-2" required>
                    <input type="text" placeholder="Phone Number" class="w-full border p-2 rounded-md" required>
                </div>

                <div class="p-4 border rounded-lg">
                    <h3 class="text-xl font-semibold mb-3">Delivery Method</h3>
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="delivery" value="standard" checked>
                        <span>Store number 1011 in respective mall</span>
                    </label>
                </div>

                <div class="p-4 border rounded-lg">
                    <h3 class="text-xl font-semibold mb-3">Shipping Information</h3>
                    <input type="text" placeholder="Street Address" class="w-full border p-2 rounded-md mb-2" required>
                    <input type="text" placeholder="City" class="w-full border p-2 rounded-md mb-2" required>
                    <input type="text" placeholder="Postal Code" class="w-full border p-2 rounded-md" required>
                </div>

                <div class="p-4 border rounded-lg">
                    <h3 class="text-xl font-semibold mb-3">Payment Method</h3>
                    <label class="flex items-center space-x-2 mt-3">
                        <input type="radio" name="payment" value="cod" checked>
                        <span>Cash on Delivery</span>
                    </label>
                </div>
            </div>

            <div class="p-4 border rounded-lg">
                <h3 class="text-xl font-semibold mb-4">Order Summary</h3>
                <div class="space-y-4">
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                        <div class="flex justify-between">
                            <span>
                                <?= htmlspecialchars($item['name']) ?> 
                                <?php if ($item['quantity'] > 1): ?>
                                    <span class="text-sm text-gray-500">×<?= $item['quantity'] ?></span>
                                <?php endif; ?>
                            </span>
                            <span>₹<?= number_format($item['price'] * $item['quantity'], 2) ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
                <hr class="my-4">
                <div class="flex justify-between font-semibold">
                    <span>Subtotal</span>
                    <span>₹<?= number_format($subtotal, 2) ?></span>
                </div>
                <div class="flex justify-between">
                    <span>Delivery</span>
                    <span>₹0 (Free)</span>
                </div>
                <hr class="my-4">
                <div class="flex justify-between text-lg font-bold">
                    <span>Total</span>
                    <span>₹<?= number_format($total, 2) ?></span>
                </div>
                <button type="submit" name="place_order" class="w-full bg-yellow-500 text-white py-2 rounded-lg mt-4 hover:bg-yellow-600 transition">
                    Place Now
                </button>
            </div>
        </div>
    </form>
</div>

<?php include '../includes/footer.php'; ?>