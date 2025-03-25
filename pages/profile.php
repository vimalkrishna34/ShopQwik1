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
            const newUrl = window.location.href.split('?')[0] + `?theme=${newTheme}`;
            window.history.pushState({}, '', newUrl);
            
            // Store in session
            fetch(newUrl, { method: 'HEAD' });
        }
    </script>
</head>
<body class="bg-[#FAF3E0] dark:bg-gray-900 min-h-screen flex flex-col" style="margin-top: 80px;">
    
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
    <div class="container mx-auto flex max-w-5xl bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">

        <!-- Sidebar -->
        <div class="w-1/3 bg-[#F5E1C0] dark:bg-gray-700 p-6">
            <ul class="space-y-4">
                <li class="p-3 bg-white dark:bg-gray-600 rounded-lg text-[#8B4513] dark:text-amber-200 font-semibold">
                    <i class="fas fa-user"></i> Personal Information
                </li>
                <li class="p-3 bg-white dark:bg-gray-600 rounded-lg text-[#8B4513] dark:text-amber-200 font-semibold">
                    <i class="fas fa-shopping-bag"></i> My Orders
                </li>
                <li class="p-3 bg-white dark:bg-gray-600 rounded-lg text-[#8B4513] dark:text-amber-200 font-semibold">
                    <i class="fas fa-map-marker-alt"></i> Manage Address
                </li>
                <li class="p-3 bg-white dark:bg-gray-600 rounded-lg text-[#8B4513] dark:text-amber-200 font-semibold">
                    <i class="fas fa-credit-card"></i> Payment Method
                </li>
                <li class="p-3 bg-white dark:bg-gray-600 rounded-lg text-[#8B4513] dark:text-amber-200 font-semibold">
                    <i class="fas fa-lock"></i> Password Manager
                </li>
                <li class="p-3 bg-yellow-500 dark:bg-amber-600 rounded-lg text-white font-semibold">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </li>
            </ul>
        </div>

        <!-- Profile Content -->
        <div class="w-2/3 p-8">
            <h2 class="text-2xl font-bold text-[#8B4513] dark:text-amber-200">Logout</h2>
            <p class="text-gray-600 dark:text-gray-300 mt-2">Hello, <span class="font-semibold text-[#8B4513] dark:text-amber-300"><?php echo htmlspecialchars($username); ?></span>! Are you sure you want to log out?</p>
            <a href="http://localhost/PROJECTT/Anj/ShopQwik-main/ShopQwik/logout.php" class="mt-4 inline-block px-6 py-2 text-white bg-red-500 hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-700 rounded-full transition">
                Yes, Logout
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-8 py-4 bg-[#FAF3E0] dark:bg-gray-800 text-center text-[#8B4513] dark:text-amber-200 font-semibold">
        <div class="flex justify-center space-x-8">
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