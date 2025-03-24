<script src="https://cdn.tailwindcss.com"></script>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['theme'])) {
    $_SESSION['theme'] = $_GET['theme'];
}

$theme = $_SESSION['theme'] ?? 'light'; // Default to light theme
$current_page = basename($_SERVER['PHP_SELF']);

$navItems = [
    'Home' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/index.php',
    'Cart' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/pages/cart.php',
    'Profile' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/pages/profile.php',
    'Location' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/pages/location.php'
];
?>

<!-- Navbar -->
<nav class="fixed top-0 left-0 w-full px-8 py-4 flex justify-between items-center 
    <?= $theme === 'dark' ? 'bg-gray-900 bg-opacity-60' : 'bg-white bg-opacity-60' ?> backdrop-blur-md shadow-lg z-50">

    <div class="text-xl font-medium text-yellow-400">
        <a href="/PROJECTT/ShopQwik/index.php">
            <img src="/PROJECTT/ShopQwik/images/ShopQwikog.png" alt="ShopQwik Logo" class="h-12 w-auto object-contain">
        </a>
    </div>

    <div class="hidden md:flex space-x-6 text-lg">
        <?php foreach ($navItems as $label => $link): ?>
            <a href="<?= $link ?>" class="relative group transition hover:text-yellow-700 capitalize <?= $theme === 'dark' ? 'text-gray-300' : 'text-gray-700' ?>">
                <?= $label ?>
                <span class="absolute left-0 bottom-0 w-full h-0.5 bg-yellow-400 scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
            </a>
        <?php endforeach; ?>

        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="logout.php" class="text-red-500 font-medium hover:text-red-600 capitalize">Logout</a>
        <?php else: ?>
            <a href="/PROJECTT/anj/ShopQwik-main/ShopQwik/login.php" class="text-green-500 font-medium hover:text-green-600 capitalize">Login</a>
        <?php endif; ?>
    </div>

    <div class="flex items-center space-x-4">
        <button id="theme-toggle"
           class="px-4 py-2 rounded-lg transition hover:bg-gray-300 dark:hover:bg-gray-600 capitalize
                  <?= $theme === 'dark' ? 'bg-gray-700 text-gray-200' : 'bg-gray-200 text-gray-800' ?>">
            <?= $theme === 'dark' ? '🎬 Theatre mode off' : '🎬 Theatre mode on' ?>
        </button>

        <button id="menu-toggle" class="md:hidden text-gray-700 dark:text-gray-300 text-2xl">☰</button>
    </div>
</nav>

<div id="mobile-menu" class="fixed inset-0 bg-black bg-opacity-50 hidden z-40">
    <div class="absolute top-0 right-0 w-3/4 h-full bg-white dark:bg-gray-900 px-6 py-8 transform translate-x-full transition-transform duration-300 ease-in-out" id="menu-content">
        <button id="close-menu" class="text-2xl text-gray-700 dark:text-gray-300 absolute top-4 right-4">✖</button>

        <div class="mt-12 space-y-4 text-lg">
            <?php foreach ($navItems as $label => $link): ?>
                <a href="<?= $link ?>" class="block text-gray-700 dark:text-gray-300 capitalize"> <?= $label ?> </a>
            <?php endforeach; ?>

            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="logout.php" class="block text-red-500 hover:text-red-600 capitalize">Logout</a>
            <?php else: ?>
                <a href="/PROJECTT/anj/ShopQwik-main/ShopQwik/login.php" class="block text-green-500 hover:text-green-600 capitalize">Login</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const menuToggle = document.getElementById("menu-toggle");
        const closeMenu = document.getElementById("close-menu");
        const mobileMenu = document.getElementById("mobile-menu");
        const menuContent = document.getElementById("menu-content");
        const themeToggle = document.getElementById("theme-toggle");

        // Mobile Menu Toggle
        menuToggle.addEventListener("click", () => {
            mobileMenu.classList.remove('hidden');
            setTimeout(() => menuContent.classList.remove('translate-x-full'), 10);
        });

        closeMenu.addEventListener("click", () => {
            menuContent.classList.add('translate-x-full');
            setTimeout(() => mobileMenu.classList.add('hidden'), 300);
        });

        mobileMenu.addEventListener("click", (event) => {
            if (event.target === mobileMenu) closeMenu.click();
        });

        // Theme Toggle Logic
        const savedTheme = localStorage.getItem("theme") || "<?= $theme ?>";

        const applyTheme = (theme) => {
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
                themeToggle.innerHTML = '🎬 Theatre mode off';
            } else {
                document.documentElement.classList.remove('dark');
                themeToggle.innerHTML = '🎬 Theatre mode on';
            }
        };

        applyTheme(savedTheme);

        themeToggle.addEventListener("click", function () {
            const newTheme = document.documentElement.classList.toggle("dark") ? "dark" : "light";
            localStorage.setItem("theme", newTheme);
            applyTheme(newTheme);

            // Update session via AJAX request
            fetch(`/PROJECTT/anj/ShopQwik-main/ShopQwik/theme-toggle.php?theme=${newTheme}`)
                .then(response => console.log('Theme updated in session.'));
        });
    });
</script>
