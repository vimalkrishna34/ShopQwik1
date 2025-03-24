<?php
session_start();
$theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : 'light';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mumbai Malls - ShopQwik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="<?= $theme === 'dark' ? 'bg-gray-900 text-gray-100' : 'bg-gray-100 text-gray-900' ?>">

<?php include '../includes/header.php'; ?>

<div class="container mx-auto py-8">
    <h1 class="text-4xl font-bold text-center mb-8 <?= $theme === 'dark' ? 'text-white' : 'text-gray-800' ?>">Top Malls in Mumbai</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 px-4">

        <?php
        $malls = [
            ['name' => 'Phoenix Marketcity', 'image' => 'https://lh3.googleusercontent.com/p/AF1QipN3-vW1Xb4o8Wv8i8-V-wYq0HlVjP0j0P1_Y19q=s1360-w1360-h1020', 'desc' => 'Mumbai’s largest mall with luxury shopping.'],
            ['name' => 'High Street Phoenix', 'image' => 'https://lh3.googleusercontent.com/p/AF1QipP3s8y6Y-LzWq6i0Bq6r_j8c2h4t_9xG_2iP6Xy=s1360-w1360-h1020', 'desc' => 'Premium shopping destination.'],
            ['name' => 'R City Mall', 'image' => 'https://lh3.googleusercontent.com/p/AF1QipM63s5F4YmO0x5D3a5-y5v47zI3h638V801zW7y=s1360-w1360-h1020', 'desc' => 'Great for family outings with multiplex and food.'],
            ['name' => 'Infiniti Mall', 'image' => 'https://lh3.googleusercontent.com/p/AF1QipM1lT3X5r7W8U7zH_2k3b51I5m0K2g5W01Jj69a=s1360-w1360-h1020', 'desc' => 'Great mix of brands and entertainment.'],
            ['name' => 'Oberoi Mall', 'image' => 'https://lh3.googleusercontent.com/p/AF1QipO3q9m9L4sU9iL1f7-R-p9z8Wp1_7k9X29lH2_g=s1360-w1360-h1020', 'desc' => 'Conveniently located with great variety.'],
            ['name' => 'Atria Mall', 'image' => 'https://lh3.googleusercontent.com/p/AF1QipP7t_QyU10jT9l_x2R9sU8G5fX8-G_h85591q6i=s1360-w1360-h1020', 'desc' => 'Modern mall with premium and local stores.']
        ];

        foreach ($malls as $mall) {
            echo '
            <div class="card p-6 rounded-lg shadow-lg '.($theme === 'dark' ? 'bg-gray-800 text-white' : 'bg-white text-gray-900').'">
                <img src="'.$mall['image'].'" alt="'.$mall['name'].'" class="w-full h-56 object-cover rounded-lg mb-4">
                <h2 class="text-2xl font-bold mb-3">'.$mall['name'].'</h2>
                <p class="text-gray-600 '.($theme === 'dark' ? 'text-gray-300' : 'text-gray-600').'">'.$mall['desc'].'</p>
            </div>';
        }
        ?>

    </div>
</div>

<?php include '../includes/footer.php'; ?>

</body>
</html>