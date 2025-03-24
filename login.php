<?php
session_start();
include 'includes/header.php';

$successMessage = "";

// Handle login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $_SESSION['username'] = $username; // Store username in session
    $successMessage = "Login successful!";
}

// Handle signup
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])) {
    $username = $_POST['username'];
    $_SESSION['username'] = $username; // Store username in session
    $successMessage = "Signup successful!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Signup Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script>
        function toggleForm(showSignup) {
            document.getElementById('loginForm').classList.toggle('hidden', showSignup);
            document.getElementById('signupForm').classList.toggle('hidden', !showSignup);
        }

        // Hide the success message after 3 seconds
        function hideSuccessMessage() {
            setTimeout(() => {
                const msg = document.getElementById('successMessage');
                if (msg) msg.classList.add('opacity-0', 'transition-opacity', 'duration-1000');
            }, 3000);
        }
    </script>
</head>
<body class="h-screen bg-[#FAF3E0] flex items-center justify-center" onload="hideSuccessMessage()">
    <div class="bg-[#F5E1C0] shadow-lg rounded-2xl overflow-hidden max-w-4xl w-full flex relative">

        <!-- Success Message Popup -->
        <?php if (!empty($successMessage)): ?>
            <div id="successMessage"
                class="absolute top-4 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-4 py-2 rounded-lg shadow-md">
                <?php echo $successMessage; ?>
            </div>
        <?php endif; ?>

        <div class="w-1/2 p-8">
            <h2 class="text-3xl font-bold text-center text-[#8B4513] mb-6" id="formTitle">Welcome Back!!</h2>

            <!-- Login Form -->
            <form id="loginForm" method="post" action="">
                <div class="mb-4 relative">
                    <input type="text" name="username" placeholder="Username" required
                        class="w-full px-4 py-3 rounded-full border-2 border-[#E1D1C9] focus:ring-2 focus:ring-[#8B4513]">
                    <span class="absolute left-4 top-3 text-[#8B4513]">
                        <i class="fas fa-user"></i>
                    </span>
                </div>
                <div class="mb-4 relative">
                    <input type="password" name="password" placeholder="Password" required
                        class="w-full px-4 py-3 rounded-full border-2 border-[#E1D1C9] focus:ring-2 focus:ring-[#8B4513]">
                    <span class="absolute left-4 top-3 text-[#8B4513]">
                        <i class="fas fa-lock"></i>
                    </span>
                </div>
                <button type="submit" name="login"
                    class="w-full py-3 rounded-full text-white bg-[#C69C6D] hover:bg-[#A67C52] transition duration-300">
                    Login
                </button>
                <p class="text-center text-gray-600 mt-4">
                    Don't have an account? <a href="#" class="text-[#8B4513] hover:underline" onclick="toggleForm(true)">Sign up</a>
                </p>
            </form>

            <!-- Signup Form -->
            <form id="signupForm" class="hidden" method="post" action="">
                <div class="mb-4 relative">
                    <input type="text" name="username" placeholder="Username" required
                        class="w-full px-4 py-3 rounded-full border-2 border-[#E1D1C9] focus:ring-2 focus:ring-[#8B4513]">
                    <span class="absolute left-4 top-3 text-[#8B4513]">
                        <i class="fas fa-user"></i>
                    </span>
                </div>
                <div class="mb-4 relative">
                    <input type="text" name="email" placeholder="Email" required
                        class="w-full px-4 py-3 rounded-full border-2 border-[#E1D1C9] focus:ring-2 focus:ring-[#8B4513]">
                    <span class="absolute left-4 top-3 text-[#8B4513]">
                        <i class="fas fa-envelope"></i>
                    </span>
                </div>
                <div class="mb-4 relative">
                    <input type="password" name="password" placeholder="Password" required
                        class="w-full px-4 py-3 rounded-full border-2 border-[#E1D1C9] focus:ring-2 focus:ring-[#8B4513]">
                    <span class="absolute left-4 top-3 text-[#8B4513]">
                        <i class="fas fa-lock"></i>
                    </span>
                </div>
                <button type="submit" name="signup"
                    class="w-full py-3 rounded-full text-white bg-[#C69C6D] hover:bg-[#A67C52] transition duration-300">
                    Sign Up
                </button>
                <p class="text-center text-gray-600 mt-4">
                    Already have an account? <a href="#" class="text-[#8B4513] hover:underline" onclick="toggleForm(false)">Login</a>
                </p>
            </form>
        </div>

        <div class="hidden md:flex w-1/2 bg-[#EED3A9] items-center justify-center">
            <img src="images/loginshopp.jpg" alt="Person with Laptop" class="w-48">
        </div>
    </div>
</body>
</html>