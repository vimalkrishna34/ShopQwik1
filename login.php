<?php
session_start();
// Check for theme preference
$theme = isset($_GET['theme']) ? $_GET['theme'] : (isset($_SESSION['theme']) ? $_SESSION['theme'] : 'light');
$_SESSION['theme'] = $theme;

$successMessage = "";

// Handle login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $_SESSION['username'] = $username;
    $successMessage = "Login successful!";
}

// Handle signup
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])) {
    $username = $_POST['username'];
    $_SESSION['username'] = $username;
    $successMessage = "Signup successful!";
}

// Include header
include 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="en" class="<?= $theme === 'dark' ? 'dark' : '' ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Signup Page</title>
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
        
        function toggleForm(showSignup) {
            document.getElementById('loginForm').classList.toggle('hidden', showSignup);
            document.getElementById('signupForm').classList.toggle('hidden', !showSignup);
        }

        function hideSuccessMessage() {
            setTimeout(() => {
                const msg = document.getElementById('successMessage');
                if (msg) msg.classList.add('opacity-0', 'transition-opacity', 'duration-1000');
            }, 3000);
        }
        
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
                themeBtn.innerHTML = isDark ? '🌙 Dark Mode' : '☀️ Light Mode';
                themeBtn.className = isDark ? 
                    'px-4 py-2 rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300 transition' : 
                    'px-4 py-2 rounded-lg bg-gray-700 text-gray-200 hover:bg-gray-600 transition';
            }
            
            // Update URL without reload
            const newUrl = window.location.href.split('?')[0] + `?theme=${newTheme}`;
            window.history.pushState({}, '', newUrl);
            
            // Store in session
            fetch(newUrl, { method: 'HEAD' }); // This will trigger PHP to update session
        }
    </script>
</head>
<body class="h-screen bg-[#FAF3E0] dark:bg-gray-900 flex flex-col">
    <!-- Header will be included here from header.php -->
    
    <main class="flex-grow flex items-center justify-center">
        <div class="bg-[#F5E1C0] dark:bg-gray-800 shadow-lg rounded-2xl overflow-hidden max-w-4xl w-full flex relative">

            <!-- Theme Toggle Button -->
            <div class="absolute top-4 right-4">
                <button id="theme-toggle" onclick="toggleTheme()"
                   class="px-4 py-2 rounded-lg transition capitalize
                          <?= $theme === 'dark' ? 'bg-gray-700 text-gray-200 hover:bg-gray-600' : 'bg-gray-200 text-gray-800 hover:bg-gray-300' ?>">
                    <?= $theme === 'dark' ? '☀️ Light Mode' : '🌙 Dark Mode' ?>
                </button>
            </div>

            <!-- Success Message Popup -->
            <?php if (!empty($successMessage)): ?>
                <div id="successMessage"
                    class="absolute top-4 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-4 py-2 rounded-lg shadow-md">
                    <?php echo $successMessage; ?>
                </div>
            <?php endif; ?>

            <div class="w-1/2 p-8">
                <h2 class="text-3xl font-bold text-center text-[#8B4513] dark:text-amber-200 mb-6" id="formTitle">Welcome Back!!</h2>

                <!-- Login Form -->
                <form id="loginForm" method="post" action="">
                    <div class="mb-4 relative">
                        <input type="text" name="username" placeholder="Username" required
                            class="w-full px-4 py-3 rounded-full border-2 border-[#E1D1C9] dark:border-gray-600 focus:ring-2 focus:ring-[#8B4513] dark:focus:ring-amber-200 dark:bg-gray-700 dark:text-white bg-transition">
                        <span class="absolute left-4 top-3 text-[#8B4513] dark:text-amber-200 bg-transition">
                            <i class="fas fa-user"></i>
                        </span>
                    </div>
                    <div class="mb-4 relative">
                        <input type="password" name="password" placeholder="Password" required
                            class="w-full px-4 py-3 rounded-full border-2 border-[#E1D1C9] dark:border-gray-600 focus:ring-2 focus:ring-[#8B4513] dark:focus:ring-amber-200 dark:bg-gray-700 dark:text-white bg-transition">
                        <span class="absolute left-4 top-3 text-[#8B4513] dark:text-amber-200 bg-transition">
                            <i class="fas fa-lock"></i>
                        </span>
                    </div>
                    <button type="submit" name="login"
                        class="w-full py-3 rounded-full text-white bg-[#C69C6D] hover:bg-[#A67C52] dark:bg-amber-700 dark:hover:bg-amber-800 transition duration-300">
                        Login
                    </button>
                    <p class="text-center text-gray-600 dark:text-gray-300 mt-4 bg-transition">
                        Don't have an account? <a href="#" class="text-[#8B4513] dark:text-amber-300 hover:underline bg-transition" onclick="toggleForm(true)">Sign up</a>
                    </p>
                </form>

                <!-- Signup Form -->
                <form id="signupForm" class="hidden" method="post" action="">
                    <div class="mb-4 relative">
                        <input type="text" name="username" placeholder="Username" required
                            class="w-full px-4 py-3 rounded-full border-2 border-[#E1D1C9] dark:border-gray-600 focus:ring-2 focus:ring-[#8B4513] dark:focus:ring-amber-200 dark:bg-gray-700 dark:text-white bg-transition">
                        <span class="absolute left-4 top-3 text-[#8B4513] dark:text-amber-200 bg-transition">
                            <i class="fas fa-user"></i>
                        </span>
                    </div>
                    <div class="mb-4 relative">
                        <input type="text" name="email" placeholder="Email" required
                            class="w-full px-4 py-3 rounded-full border-2 border-[#E1D1C9] dark:border-gray-600 focus:ring-2 focus:ring-[#8B4513] dark:focus:ring-amber-200 dark:bg-gray-700 dark:text-white bg-transition">
                        <span class="absolute left-4 top-3 text-[#8B4513] dark:text-amber-200 bg-transition">
                            <i class="fas fa-envelope"></i>
                        </span>
                    </div>
                    <div class="mb-4 relative">
                        <input type="password" name="password" placeholder="Password" required
                            class="w-full px-4 py-3 rounded-full border-2 border-[#E1D1C9] dark:border-gray-600 focus:ring-2 focus:ring-[#8B4513] dark:focus:ring-amber-200 dark:bg-gray-700 dark:text-white bg-transition">
                        <span class="absolute left-4 top-3 text-[#8B4513] dark:text-amber-200 bg-transition">
                            <i class="fas fa-lock"></i>
                        </span>
                    </div>
                    <a href="signup.php"><button type="submit" name="signup"
                        class="w-full py-3 rounded-full text-white bg-[#C69C6D] hover:bg-[#A67C52] dark:bg-amber-700 dark:hover:bg-amber-800 transition duration-300">
                        Sign Up
                    </button></a>
                    <p class="text-center text-gray-600 dark:text-gray-300 mt-4 bg-transition">
                        Already have an account? <a href="#" class="text-[#8B4513] dark:text-amber-300 hover:underline bg-transition" onclick="toggleForm(false)">Login</a>
                    </p>
                </form>
            </div>

            <div class="hidden md:flex w-1/2 bg-[#EED3A9] dark:bg-gray-700 items-center justify-center bg-transition">
                <img src="images/loginshopp.jpg" alt="Person with Laptop" class="w-48">
            </div>
        </div>
    </main>

    <?php
    // Include footer
    include 'includes/footer.php';
    ?>
</body>
</html>