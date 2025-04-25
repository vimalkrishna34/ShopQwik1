<?php
session_start();

// Check if user is admin (you should set this in your login logic)
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: login.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "shopqwik";

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get all orders with user information
$orders = [];
$result = mysqli_query($conn, "
    SELECT orders.*, users.username, users.email 
    FROM orders 
    JOIN users ON orders.user_id = users.id 
    ORDER BY orders.order_date DESC
");
while ($row = mysqli_fetch_assoc($result)) {
    $orders[] = $row;
}

// Update order status if requested
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'], $_POST['status'])) {
    $orderId = (int)$_POST['order_id'];
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    
    $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $orderId);
    $stmt->execute();
    
    // Refresh page to show updated status
    header("Location: admin.php");
    exit();
}

// Check for theme preference
$theme = isset($_GET['theme']) ? $_GET['theme'] : (isset($_SESSION['theme']) ? $_SESSION['theme'] : 'light');
$_SESSION['theme'] = $theme;
?>

<!DOCTYPE html>
<html lang="en" class="<?= $theme === 'dark' ? 'dark' : '' ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal - ShopQwik</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script>
      tailwind.config = {
        darkMode: 'class'
      }
    </script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
      body, .bg-transition {
        transition: background-color 0.3s ease, color 0.3s ease;
      }
      .order-item {
          border-bottom: 1px solid #e2e8f0;
          padding: 1rem 0;
      }
      .order-item:last-child {
          border-bottom: none;
      }
      .status-pending { background-color: #fef3c7; color: #92400e; }
      .status-processing { background-color: #bfdbfe; color: #1e40af; }
      .status-shipped { background-color: #bae6fd; color: #0369a1; }
      .status-delivered { background-color: #bbf7d0; color: #166534; }
      .status-cancelled { background-color: #fecaca; color: #991b1b; }
      .dark .status-pending { background-color: #451a03; color: #fef3c7; }
      .dark .status-processing { background-color: #1e3a8a; color: #bfdbfe; }
      .dark .status-shipped { background-color: #0c4a6e; color: #bae6fd; }
      .dark .status-delivered { background-color: #052e16; color: #bbf7d0; }
      .dark .status-cancelled { background-color: #450a0a; color: #fecaca; }
    </style>
</head>
<body class="bg-[#FAF3E0] dark:bg-gray-900 min-h-screen flex flex-col">
    
    <?php include '../includes/header.php'; ?>

    <div class="container mx-auto max-w-7xl p-4 flex-grow">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-[#8B4513] dark:text-amber-200">Admin Portal</h1>
            <a href="logout.php" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                Logout
            </a>
        </div>
        
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
            <div class="p-4 border-b dark:border-gray-700">
                <h2 class="text-xl font-semibold text-[#8B4513] dark:text-amber-200">All Orders</h2>
            </div>
            
            <?php if (!empty($orders)): ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Order ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Customer</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Amount</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            <?php foreach ($orders as $order): 
                                $orderDate = date('F j, Y, g:i a', strtotime($order['order_date']));
                                $orderData = json_decode($order['order_data'], true);
                            ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-200">#<?= $order['id'] ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                        <?= htmlspecialchars($order['username']) ?><br>
                                        <span class="text-xs"><?= htmlspecialchars($order['email']) ?></span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300"><?= $orderDate ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">₹<?= number_format($order['total_amount'], 2) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-2 py-1 rounded-full text-xs font-semibold status-<?= $order['status'] ?>">
                                            <?= ucfirst($order['status']) ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                        <button onclick="document.getElementById('order-details-<?= $order['id'] ?>').classList.toggle('hidden')" 
                                            class="px-2 py-1 bg-[#8B4513] dark:bg-amber-600 text-white rounded hover:bg-[#6B3410] dark:hover:bg-amber-700 transition">
                                            View Details
                                        </button>
                                        <form method="POST" class="inline ml-2">
                                            <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                            <select name="status" onchange="this.form.submit()" 
                                                class="px-2 py-1 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                                                <option value="pending" <?= $order['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                                                <option value="processing" <?= $order['status'] === 'processing' ? 'selected' : '' ?>>Processing</option>
                                                <option value="shipped" <?= $order['status'] === 'shipped' ? 'selected' : '' ?>>Shipped</option>
                                                <option value="delivered" <?= $order['status'] === 'delivered' ? 'selected' : '' ?>>Delivered</option>
                                                <option value="cancelled" <?= $order['status'] === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                                <tr id="order-details-<?= $order['id'] ?>" class="hidden">
                                    <td colspan="6" class="px-6 py-4 bg-gray-50 dark:bg-gray-700">
                                        <h4 class="font-semibold text-[#8B4513] dark:text-amber-200 mb-2">Order Items:</h4>
                                        <div class="space-y-2">
                                            <?php foreach ($orderData as $item): ?>
                                                <div class="flex justify-between">
                                                    <div>
                                                        <span><?= htmlspecialchars($item['name']) ?></span>
                                                        <span class="text-xs text-gray-500 dark:text-gray-400 ml-2">(<?= htmlspecialchars($item['brand']) ?>)</span>
                                                    </div>
                                                    <div>
                                                        <span>₹<?= number_format($item['price'], 2) ?> × <?= $item['quantity'] ?></span>
                                                        <span class="ml-2">₹<?= number_format($item['price'] * $item['quantity'], 2) ?></span>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="p-6 text-center text-gray-500 dark:text-gray-400">
                    No orders found.
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>
</body>
</html>