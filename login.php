<?php
session_start();

// Check for theme preference
$theme = isset($_GET['theme']) ? $_GET['theme'] : (isset($_SESSION['theme']) ? $_SESSION['theme'] : 'light');
$_SESSION['theme'] = $theme;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $servername = "localhost";
    $username = "root";
    $dbpassword = "";
    $database = "newdbs";

    $conn = mysqli_connect($servername, $username, $dbpassword, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        $sql = "SELECT * FROM Users WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION["email"] = $email;
            $_SESSION["username"] = $row['username'] ?? $email; // Use username if available, otherwise email
            header("Location: http://localhost/PROJECTT/anj/ShopQwik-main/ShopQwik/");
            exit();
        } else {
            $error = "Invalid email or password!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en" class="<?= $theme === 'dark' ? 'dark' : '' ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ShopQwik</title>
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
    </style>
    <script>
        // Apply theme preference immediately to prevent flash
        document.documentElement.classList.add('<?= $theme === 'dark' ? 'dark' : '' ?>');
        
        // Theme switcher
        function toggleTheme() {
            const html = document.documentElement;
            const isDark = html.classList.contains('dark');
            const newTheme = isDark ? 'light' : 'dark';
            
            html.classList.toggle('dark');
            
            const themeBtn = document.getElementById('theme-toggle');
            if (themeBtn) {
                themeBtn.innerHTML = isDark ? '🎬 Theatre mode off' : '🎬 Theatre mode on';
                themeBtn.className = isDark ? 
                    'px-4 py-2 rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300 transition' : 
                    'px-4 py-2 rounded-lg bg-gray-700 text-gray-200 hover:bg-gray-600 transition';
            }
            
            const newUrl = window.location.href.split('?')[0] + '?theme=' + newTheme;
            window.history.pushState({}, '', newUrl);
            
            fetch(newUrl, { method: 'HEAD' });
        }
    </script>
</head>
<body class="bg-[#FAF3E0] dark:bg-gray-900 min-h-screen flex flex-col items-center justify-center p-4">
    
    <!-- Theme Toggle Button -->
    <div class="absolute top-4 right-4">
        <button id="theme-toggle" onclick="toggleTheme()"
           class="px-4 py-2 rounded-lg transition capitalize
                  <?= $theme === 'dark' ? 'bg-gray-700 text-gray-200 hover:bg-gray-600' : 'bg-gray-200 text-gray-800 hover:bg-gray-300' ?>">
            <?= $theme === 'dark' ? '🎬 Theatre mode off' : '🎬 Theatre mode on' ?>
        </button>
    </div>

    <!-- Login Container -->
    <div class="w-full max-w-md bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden p-8">
        <header class="text-center mb-8">
            <h1 class="text-3xl font-bold text-[#8B4513] dark:text-amber-200">Welcome Back</h1>
            <p class="text-gray-600 dark:text-gray-300 mt-2">Sign in to your account</p>
        </header>

        <?php if (isset($error)): ?>
            <div class="mb-4 p-3 bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-200 rounded-lg">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form action="login.php" method="post" class="space-y-4">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                <input type="email" name="email" id="email" required
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 dark:bg-gray-700 dark:text-white"
                    placeholder="your@email.com">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 dark:bg-gray-700 dark:text-white"
                    placeholder="••••••••">
            </div>

            <button type="submit"
                class="w-full py-2 px-4 bg-[#8B4513] hover:bg-[#A0522D] dark:bg-amber-600 dark:hover:bg-amber-700 text-white font-semibold rounded-lg transition">
                Login
            </button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-gray-600 dark:text-gray-300">Don't have an account? 
                <a href="signup.php" class="text-[#8B4513] dark:text-amber-400 hover:underline">Sign up</a>
            </p>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-8 py-4 text-center text-[#8B4513] dark:text-amber-200 font-semibold">
        <p>&copy; <?= date('Y') ?> ShopQwik. All rights reserved.</p>
    </footer>
</body>
</html>