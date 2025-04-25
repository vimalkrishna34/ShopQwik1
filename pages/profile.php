<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}
$username = $_SESSION['username'];

// Database connection
$servername = "localhost";
$username_db = "root";
$password_db = "";
$database = "shopqwik";

$conn = mysqli_connect($servername, $username_db, $password_db, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get user's orders
$orders = [];
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $result = mysqli_query($conn, "SELECT * FROM orders WHERE user_id = $userId ORDER BY order_date DESC");
    while ($row = mysqli_fetch_assoc($result)) {
        $orders[] = $row;
    }
}

// Check for theme preference
$theme = isset($_GET['theme']) ? $_GET['theme'] : (isset($_SESSION['theme']) ? $_SESSION['theme'] : 'light');
$_SESSION['theme'] = $theme;
?>

<?php include '../includes/header.php'; ?>

<!DOCTYPE html>
<html lang="en" class="<?= $theme === 'dark' ? 'dark' : '' ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script>
      tailwind.config = {
        darkMode: 'class'
      }
    </script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
      /* Smooth theme transition */
      body, .bg-transition {
        transition: background-color 0.3s ease, color 0.3s ease;
      }
      /* Dropdown animation */
      .dropdown-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out;
      }
      .dropdown-content.show {
        max-height: 500px;
        transition: max-height 0.3s ease-in;
      }
      .rotate-180 {
        transform: rotate(180deg);
      }
      .order-item {
          border-bottom: 1px solid #e2e8f0;
          padding: 1rem 0;
      }
      .order-item:last-child {
          border-bottom: none;
      }
    </style>
    <script>
        // Apply theme preference immediately to prevent flash
        document.documentElement.classList.add('<?= $theme === 'dark' ? 'dark' : '' ?>');
        
        // Theme switcher
        function toggleTheme() {
            const html = document.documentElement;
            const isDark = html.classList.contains('dark');
            const newTheme = isDark ? 'light' : 'dark';
            
            // Toggle class
            html.classList.toggle('dark');
            
            // Update button
            const themeBtn = document.getElementById('theme-toggle');
            if (themeBtn) {
                themeBtn.innerHTML = isDark ? '🎬 Theatre mode off' : '🎬 Theatre mode on';
                themeBtn.className = isDark ? 
                    'px-4 py-2 rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300 transition' : 
                    'px-4 py-2 rounded-lg bg-gray-700 text-gray-200 hover:bg-gray-600 transition';
            }
            
            // Update URL without reload
            const newUrl = window.location.href.split('?')[0] + '?theme=' + newTheme;
            window.history.pushState({}, '', newUrl);
            
            // Store in session
            fetch(newUrl, { method: 'HEAD' });
        }
        
        // Toggle dropdown - FIXED THIS FUNCTION
        function toggleDropdown(id) {
            const dropdown = document.getElementById('dropdown-content-' + id);
            const icon = document.getElementById('dropdown-icon-' + id);
            dropdown.classList.toggle('show');
            icon.classList.toggle('rotate-180');
        }
    </script>
</head>
<body class="bg-[#FAF3E0] dark:bg-gray-900 min-h-screen flex flex-col">
    
    <!-- Theme Toggle Button -->
    <div class="absolute top-4 right-4">
        <button id="theme-toggle" onclick="toggleTheme()"
           class="px-4 py-2 rounded-lg transition capitalize
                  <?= $theme === 'dark' ? 'bg-gray-700 text-gray-200 hover:bg-gray-600' : 'bg-gray-200 text-gray-800 hover:bg-gray-300' ?>">
            <?= $theme === 'dark' ? '🎬 Theatre mode off' : '🎬 Theatre mode on' ?>
        </button>
    </div>

    <!-- Header -->
    <header class="py-6 text-center text-3xl font-bold text-[#8B4513] dark:text-amber-200">
        My Account
    </header>

    <!-- Main Content -->
    <div class="container mx-auto flex flex-col md:flex-row max-w-5xl bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">

        <!-- Sidebar -->
        <div class="w-full md:w-1/3 bg-[#F5E1C0] dark:bg-gray-700 p-6">
            <ul class="space-y-2">
                <!-- Personal Information Dropdown -->
                <li>
                    <button onclick="toggleDropdown('personal')" class="w-full p-3 flex justify-between items-center bg-white dark:bg-gray-600 rounded-lg text-[#8B4513] dark:text-amber-200 font-semibold">
                        <span><i class="fas fa-user mr-2"></i> Personal Information</span>
                        <i id="dropdown-icon-personal" class="fas fa-chevron-down transition-transform"></i>
                    </button>
                    <div id="dropdown-content-personal" class="dropdown-content bg-white dark:bg-gray-600 rounded-lg mt-1 ml-4">
                        <ul class="p-2 space-y-1">
                            Name : <?php echo htmlspecialchars($_SESSION['username']); ?>
                        </ul>
                    </div>
                </li>
                
                <!-- My Orders Dropdown -->
                <li>
                    <button onclick="toggleDropdown('orders')" class="w-full p-3 flex justify-between items-center bg-white dark:bg-gray-600 rounded-lg text-[#8B4513] dark:text-amber-200 font-semibold">
                        <span><i class="fas fa-shopping-bag mr-2"></i> My Orders</span>
                        <i id="dropdown-icon-orders" class="fas fa-chevron-down transition-transform"></i>
                    </button>
                    <div id="dropdown-content-orders" class="dropdown-content bg-white dark:bg-gray-600 rounded-lg mt-1 ml-4">
                        <ul class="p-2 space-y-1">
                            <li class="p-2 hover:bg-gray-100 dark:hover:bg-gray-500 rounded"><a href="#orders">Order History</a></li>
                            <li class="p-2 hover:bg-gray-100 dark:hover:bg-gray-500 rounded"><a href="#">Returns</a></li>
                            <li class="p-2 hover:bg-gray-100 dark:hover:bg-gray-500 rounded"><a href="#">Track Order</a></li>
                        </ul>
                    </div>
                </li>
                
                <!-- Payment Method Dropdown -->
                <li>
                    <button onclick="toggleDropdown('payment')" class="w-full p-3 flex justify-between items-center bg-white dark:bg-gray-600 rounded-lg text-[#8B4513] dark:text-amber-200 font-semibold">
                        <span><i class="fas fa-credit-card mr-2"></i> Payment Method</span>
                        <i id="dropdown-icon-payment" class="fas fa-chevron-down transition-transform"></i>
                    </button>
                    <div id="dropdown-content-payment" class="dropdown-content bg-white dark:bg-gray-600 rounded-lg mt-1 ml-4">
                        <ul class="p-2 space-y-1">
                            <li class="p-2 hover:bg-gray-100 dark:hover:bg-gray-500 rounded"><a href="#">Cash on Delivery</a></li>
                            <li class="p-2 hover:bg-gray-100 dark:hover:bg-gray-500 rounded"><a href="#">Payment History</a></li>
                        </ul>
                    </div>
                </li>
                
                <!-- Password Manager Dropdown -->
                <li>
                    <button onclick="toggleDropdown('password')" class="w-full p-3 flex justify-between items-center bg-white dark:bg-gray-600 rounded-lg text-[#8B4513] dark:text-amber-200 font-semibold">
                        <span><i class="fas fa-lock mr-2"></i> Password Manager</span>
                        <i id="dropdown-icon-password" class="fas fa-chevron-down transition-transform"></i>
                    </button>
                    <div id="dropdown-content-password" class="dropdown-content bg-white dark:bg-gray-600 rounded-lg mt-1 ml-4">
                        <ul class="p-2 space-y-1">
                            <li class="p-2 hover:bg-gray-100 dark:hover:bg-gray-500 rounded"><a href="#">Change Password</a></li>
                            <li class="p-2 hover:bg-gray-100 dark:hover:bg-gray-500 rounded"><a href="#">Security Questions</a></li>
                        </ul>
                    </div>
                </li>
                
                <!-- Logout Button -->
                <li>
                    <a href="/PROJECTT/Anj/ShopQwik-main/ShopQwik/logout.php" class="w-full block p-3 text-center bg-yellow-500 dark:bg-amber-600 rounded-lg text-white font-semibold">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </a>
                </li>
            </ul>
        </div>

        <!-- Profile Content -->
        <div class="w-full md:w-2/3 p-8">
            <h2 class="text-2xl font-bold text-[#8B4513] dark:text-amber-200 mb-6">Order History</h2>
            
            <?php if (!empty($orders)): ?>
                <div class="space-y-4" id="orders">
                    <?php foreach ($orders as $order): 
                        $orderData = json_decode($order['order_data'], true);
                        $orderDate = date('F j, Y, g:i a', strtotime($order['order_date']));
                    ?>
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                            <div class="flex justify-between items-center mb-2">
                                <h3 class="font-semibold text-[#8B4513] dark:text-amber-200">Order #<?= $order['id'] ?></h3>
                                <span class="text-sm text-gray-500 dark:text-gray-400"><?= $orderDate ?></span>
                            </div>
                            <div class="mb-2">
                                <span class="font-medium">Total: </span>
                                <span class="text-[#8B4513] dark:text-amber-300">₹<?= number_format($order['total_amount'], 2) ?></span>
                            </div>
                            
                            <div class="mt-3">
                                <h4 class="font-medium mb-1">Items:</h4>
                                <ul class="space-y-2">
                                    <?php foreach ($orderData as $item): ?>
                                        <li class="order-item">
                                            <div class="flex justify-between">
                                                <span><?= htmlspecialchars($item['name']) ?></span>
                                                <span>₹<?= number_format($item['price'] * $item['quantity'], 2) ?></span>
                                            </div>
                                            <div class="flex justify-between text-sm text-gray-500 dark:text-gray-400">
                                                <span>Qty: <?= $item['quantity'] ?></span>
                                                <span>₹<?= number_format($item['price'], 2) ?> each</span>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow text-center">
                    <i class="fas fa-shopping-bag text-4xl text-gray-400 mb-3"></i>
                    <h3 class="text-lg font-medium text-gray-600 dark:text-gray-300">No orders yet</h3>
                    <p class="text-gray-500 dark:text-gray-400 mt-1">Your order history will appear here</p>
                    <a href="../pages/location.php" class="inline-block mt-4 px-4 py-2 bg-[#8B4513] dark:bg-amber-600 text-white rounded-lg hover:bg-[#6B3410] dark:hover:bg-amber-700 transition">
                        Start Shopping
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-8 py-4 bg-[#FAF3E0] dark:bg-gray-800 text-center text-[#8B4513] dark:text-amber-200 font-semibold">
        <div class="flex flex-col md:flex-row justify-center space-y-4 md:space-y-0 md:space-x-8">
            <div>
                <i class="fas fa-truck text-xl"></i>
                <p>Free Shipping</p>
                <p class="text-sm dark:text-gray-400">For orders above $50</p>
            </div>
            <div>
                <i class="fas fa-credit-card text-xl"></i>
                <p>Flexible Payment</p>
                <p class="text-sm dark:text-gray-400">Multiple secure options</p>
            </div>
            <div>
                <i class="fas fa-headset text-xl"></i>
                <p>24x7 Support</p>
                <p class="text-sm dark:text-gray-400">We're here to help</p>
            </div>
        </div>
    </footer>

</body>
</html>