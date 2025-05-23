<?php
// MUST be first - no whitespace before!
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Initialize theme if not set
if (!isset($_SESSION['theme'])) {
    $_SESSION['theme'] = 'light';
}

// Handle theme switching
if (isset($_GET['theme'])) {
    $_SESSION['theme'] = ($_GET['theme'] === 'dark') ? 'dark' : 'light';
    // Redirect to avoid theme parameter in URL after setting
    header('Location: ' . strtok($_SERVER['REQUEST_URI'], '?'));
    exit();
}

$theme = $_SESSION['theme'];
$current_page = basename($_SERVER['PHP_SELF']);
?><!DOCTYPE html>
<html lang="en" class="<?= $theme === 'dark' ? 'dark' : '' ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>ShopQwik</title>
    <style>
        .mobile-menu-transition {
            transition: transform 0.3s ease-in-out;
        }
    </style>
</head>
<body class="<?= $theme === 'dark' ? 'bg-gray-900 text-gray-200' : 'bg-gray-50 text-gray-800' ?> min-h-screen">
<!-- Navbar -->
<nav class="fixed top-0 left-0 w-full px-8 py-4 flex justify-between items-center 
    <?= $theme === 'dark' ? 'bg-gray-900 bg-opacity-60' : 'bg-white bg-opacity-60' ?> backdrop-blur-md shadow-lg z-50">
    
    <!-- Logo -->
    <div class="text-xl font-medium text-yellow-400 capitalize">
        <a href="/PROJECTT/Anj/ShopQwik-main/ShopQwik/index.php">
            <img src="/PROJECTT/Anj/ShopQwik-main/ShopQwik/images/ShopQwikog.png" alt="ShopQwik Logo" class="h-12 w-auto max-h-14 object-contain">
        </a>
    </div>

    <!-- Navigation Links (Desktop) -->
    <div class="hidden md:flex space-x-6 text-lg font-normal">
        <a href="/PROJECTT/Anj/ShopQwik-main/ShopQwik/index.php" 
        class="relative group transition hover:text-yellow-700 capitalize <?= $theme === 'dark' ? 'text-gray-300' : 'text-gray-700' ?>">
        Home
        <span class="absolute left-0 bottom-0 w-full h-0.5 bg-yellow-400 scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>       
        </a>

        <a href="/PROJECTT/Anj/ShopQwik-main/ShopQwik/pages/cart.php" 
        class="relative group transition hover:text-yellow-700 capitalize <?= $theme === 'dark' ? 'text-gray-300' : 'text-gray-700' ?>">
        Cart
        <span class="absolute left-0 bottom-0 w-full h-0.5 bg-yellow-400 scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
        </a>

        <a href="/PROJECTT/Anj/ShopQwik-main/ShopQwik/pages/profile.php" 
        class="relative group transition hover:text-yellow-700 capitalize <?= $theme === 'dark' ? 'text-gray-300' : 'text-gray-700' ?>">
        Profile
        <span class="absolute left-0 bottom-0 w-full h-0.5 bg-yellow-400 scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
        </a>

        <a href="/PROJECTT/Anj/ShopQwik-main/ShopQwik/pages/location.php" 
        class="relative group transition hover:text-yellow-700 capitalize <?= $theme === 'dark' ? 'text-gray-300' : 'text-gray-700' ?>">
        Location
        <span class="absolute left-0 bottom-0 w-full h-0.5 bg-yellow-400 scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
        </a>
        
        <a href="/PROJECTT/Anj/ShopQwik-main/ShopQwik/logout.php" class="text-red-500 font-medium hover:text-red-600 capitalize">Logout</a>
    </div>
    
    <!-- Theme Toggle & Mobile Menu Button -->
    <div class="flex items-center space-x-4">
        <a href="?theme=<?= $theme === 'dark' ? 'light' : 'dark' ?>" 
           class="px-4 py-2 rounded-lg transition hover:bg-gray-300 dark:hover:bg-gray-600 capitalize
                  <?= $theme === 'dark' ? 'bg-gray-700 text-gray-200' : 'bg-gray-200 text-gray-800' ?>">
            <?= $theme === 'dark' ? '🎬 Theatre mode off' : '🎬 Theatre mode on' ?>
        </a>

        <!-- Mobile Menu Icon -->
        <button id="menu-toggle" class="md:hidden text-gray-700 dark:text-gray-300 text-2xl">
            ☰
        </button>
    </div>
</nav>

<!-- Mobile Navigation & Overlay -->
<div id="mobile-menu" class="fixed inset-0 bg-black bg-opacity-50 hidden z-40">
    <div class="absolute top-0 right-0 w-3/4 h-full bg-white dark:bg-gray-900 shadow-lg px-6 py-8 mobile-menu-transition transform translate-x-full" id="menu-content">
        <!-- Close Button -->
        <button id="close-menu" class="text-2xl text-gray-700 dark:text-gray-300 absolute top-4 right-4">✖</button>

        <!-- Mobile Links -->
        <div class="mt-12 space-y-4 text-lg">
            <a href="/PROJECTT/Anj/ShopQwik-main/ShopQwik/index.php" class="block text-gray-700 dark:text-gray-300 capitalize">Home</a>
            <a href="/PROJECTT/Anj/ShopQwik-main/ShopQwik/pages/cart.php" class="block text-gray-700 dark:text-gray-300 capitalize">Cart</a>
            <a href="/PROJECTT/Anj/ShopQwik-main/ShopQwik/pages/profile.php" class="block text-gray-700 dark:text-gray-300 capitalize">Profile</a>
            <a href="/PROJECTT/Anj/ShopQwik-main/ShopQwik/pages/location.php" class="block text-gray-700 dark:text-gray-300 capitalize">Location</a>
            <a href="/PROJECTT/Anj/ShopQwik-main/ShopQwik/logout.php" class="block text-red-500 font-medium hover:text-red-600 capitalize">Logout</a>
        </div>
    </div>
</div>

<script>
    // Mobile menu functionality
    document.addEventListener('DOMContentLoaded', () => {
        const menuToggle = document.getElementById('menu-toggle');
        const closeMenu = document.getElementById('close-menu');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuContent = document.getElementById('menu-content');

        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.remove('hidden');
            setTimeout(() => menuContent.classList.remove('translate-x-full'), 10);
        });

        closeMenu.addEventListener('click', () => {
            menuContent.classList.add('translate-x-full');
            setTimeout(() => mobileMenu.classList.add('hidden'), 300);
        });

        mobileMenu.addEventListener('click', (e) => {
            if (e.target === mobileMenu) {
                menuContent.classList.add('translate-x-full');
                setTimeout(() => mobileMenu.classList.add('hidden'), 300);
            }
        });
    });
</script>