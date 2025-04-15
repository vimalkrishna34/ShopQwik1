<?php
session_start();

// Check for theme preference
$theme = isset($_GET['theme']) ? $_GET['theme'] : (isset($_SESSION['theme']) ? $_SESSION['theme'] : 'light');
$_SESSION['theme'] = $theme;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username1 = $_POST["username"];
    $email = $_POST["email"];
    $password1 = $_POST["password"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "newdbs";

    $conn = mysqli_connect($servername, $username, $password, $database);
    if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }
    else{
        $sql = "INSERT INTO `Users` (`username`, `email`, `password`) VALUES ('$username1', '$email', '$password1')";
        $result = mysqli_query($conn, $sql);
        if($result){
            $success = "Account created successfully!";
            // Auto-login after successful signup
            $_SESSION["username"] = $username1;
            $_SESSION["email"] = $email;
            header("Refresh: 2; url=profile.php"); // Redirect after 2 seconds
        }
        else{
            $error = "Error creating account: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en" class="<?= $theme === 'dark' ? 'dark' : '' ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - ShopQwik</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script>
      tailwind.config = {
        darkMode: 'class',
        theme: {
          extend: {
            colors: {
              primary: '#8B4513',
              primaryDark: '#A0522D',
              lightBg: '#FAF3E0',
              darkBg: '#1a202c'
            }
          }
        }
      }
    </script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
      body, .bg-transition {
        transition: background-color 0.3s ease, color 0.3s ease;
      }
      .signup-card {
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
      }
      .input-focus:focus {
        box-shadow: 0 0 0 3px rgba(139, 69, 19, 0.3);
      }
      .dark .input-focus:focus {
        box-shadow: 0 0 0 3px rgba(160, 82, 45, 0.5);
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
<body class="bg-lightBg dark:bg-darkBg min-h-screen flex flex-col items-center justify-center p-4">
    
    <!-- Theme Toggle Button -->
    <div class="absolute top-4 right-4">
        <button id="theme-toggle" onclick="toggleTheme()"
           class="px-4 py-2 rounded-lg transition capitalize
                  <?= $theme === 'dark' ? 'bg-gray-700 text-gray-200 hover:bg-gray-600' : 'bg-gray-200 text-gray-800 hover:bg-gray-300' ?>">
            <?= $theme === 'dark' ? '🎬 Theatre mode off' : '🎬 Theatre mode on' ?>
        </button>
    </div>

    <!-- Signup Container -->
    <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-xl overflow-hidden signup-card">
        <!-- Decorative Header -->
        <div class="bg-primary dark:bg-primaryDark h-2"></div>
        
        <div class="p-8">
            <header class="text-center mb-8">
                <h1 class="text-3xl font-bold text-primary dark:text-amber-200">Join ShopQwik</h1>
                <p class="text-gray-600 dark:text-gray-300 mt-2">Create your account in seconds</p>
            </header>

            <?php if (isset($error)): ?>
                <div class="mb-6 p-3 bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-200 rounded-lg flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <?php if (isset($success)): ?>
                <div class="mb-6 p-3 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-200 rounded-lg flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <?= htmlspecialchars($success) ?>
                    <span class="ml-2">Redirecting...</span>
                </div>
            <?php endif; ?>

            <form action="signup.php" method="post" class="space-y-6">
                <div class="space-y-1">
                    <label for="username" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Username</label>
                    <input type="text" name="username" id="username" required
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg input-focus
                               dark:bg-gray-700 dark:text-white transition"
                        placeholder="Enter your username">
                </div>

                <div class="space-y-1">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                    <input type="email" name="email" id="email" required
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg input-focus
                               dark:bg-gray-700 dark:text-white transition"
                        placeholder="your@email.com">
                </div>

                <div class="space-y-1">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg input-focus
                               dark:bg-gray-700 dark:text-white transition"
                        placeholder="••••••••">
                </div>

                <button type="submit"
                    class="w-full py-3 px-4 bg-primary hover:bg-primaryDark dark:bg-amber-600 dark:hover:bg-amber-700 
                           text-white font-semibold rounded-lg transition transform hover:scale-[1.01]">
                    <i class="fas fa-user-plus mr-2"></i> Create Account
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-gray-600 dark:text-gray-300">Already have an account? 
                    <a href="login.php" class="text-primary dark:text-amber-400 hover:underline font-medium">Sign in</a>
                </p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-8 text-center text-gray-600 dark:text-gray-300">
        <p class="text-sm">&copy; <?= date('Y') ?> ShopQwik. All rights reserved.</p>
        <p class="text-xs mt-1 text-gray-500 dark:text-gray-400">By creating an account, you agree to our Terms of Service</p>
    </footer>
</body>
</html>