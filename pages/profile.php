<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}
$username = $_SESSION['username'];

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
                            Name : <?php echo htmlspecialchars($username); ?>
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
                            <li class="p-2 hover:bg-gray-100 dark:hover:bg-gray-500 rounded"><a href="#">Order History</a></li>
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
            <h2 class="text-2xl font-bold text-[#8B4513] dark:text-amber-200">Logout</h2>
            <p class="text-gray-600 dark:text-gray-300 mt-2">Hello, <span class="font-semibold text-[#8B4513] dark:text-amber-300"><?php echo htmlspecialchars($username); ?></span>! Are you sure you want to log out?</p>
            <a href="/PROJECTT/Anj/ShopQwik-main/ShopQwik/logout.php" class="mt-4 inline-block px-6 py-2 text-white bg-red-500 hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-700 rounded-full transition">
                Yes, Logout
            </a>
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