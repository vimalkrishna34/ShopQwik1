<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php"); // Redirect to the login page or appropriate page
    exit();
}
$username = $_SESSION['username']; // Fetch the logged-in username
?>
<?php include '../includes/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body class="bg-[#FAF3E0] min-h-screen flex flex-col">
    
    <!-- Header -->
    <header class="py-6 text-center text-3xl font-bold text-[#8B4513]">
        My Account
    </header>

    <!-- Main Content -->
    <div class="container mx-auto flex max-w-5xl bg-white shadow-lg rounded-lg overflow-hidden">

        <!-- Sidebar -->
        <div class="w-1/3 bg-[#F5E1C0] p-6">
            <ul class="space-y-4">
                <li class="p-3 bg-white rounded-lg text-[#8B4513] font-semibold"><i class="fas fa-user"></i> Personal Information</li>
                <li class="p-3 bg-white rounded-lg text-[#8B4513] font-semibold"><i class="fas fa-shopping-bag"></i> My Orders</li>
                <li class="p-3 bg-white rounded-lg text-[#8B4513] font-semibold"><i class="fas fa-map-marker-alt"></i> Manage Address</li>
                <li class="p-3 bg-white rounded-lg text-[#8B4513] font-semibold"><i class="fas fa-credit-card"></i> Payment Method</li>
                <li class="p-3 bg-white rounded-lg text-[#8B4513] font-semibold"><i class="fas fa-lock"></i> Password Manager</li>
                <li class="p-3 bg-yellow-500 rounded-lg text-white font-semibold"><i class="fas fa-sign-out-alt"></i> Logout</li>
            </ul>
        </div>

        <!-- Profile Content -->
        <div class="w-2/3 p-8">
            <h2 class="text-2xl font-bold text-[#8B4513]">Logout</h2>
            <p class="text-gray-600 mt-2">Hello, <span class="font-semibold text-[#8B4513]"><?php echo htmlspecialchars($username); ?></span>! Are you sure you want to log out?</p>
            <a href="logout.php" class="mt-4 inline-block px-6 py-2 text-white bg-red-500 rounded-full">Yes, Logout</a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-8 py-4 bg-[#FAF3E0] text-center text-[#8B4513] font-semibold">
        <div class="flex justify-center space-x-8">
            <div>
                <i class="fas fa-truck text-xl"></i>
                <p>Free Shipping</p>
                <p class="text-sm">For orders above $50</p>
            </div>
            <div>
                <i class="fas fa-credit-card text-xl"></i>
                <p>Flexible Payment</p>
                <p class="text-sm">Multiple secure options</p>
            </div>
            <div>
                <i class="fas fa-headset text-xl"></i>
                <p>24x7 Support</p>
                <p class="text-sm">We’re here to help</p>
            </div>
        </div>
    </footer>

</body>
</html>