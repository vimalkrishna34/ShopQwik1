<?php
session_start();
$theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : 'light';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hyderabad Malls - ShopQwik</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="<?= $theme === 'dark' ? 'bg-gray-900 text-gray-100' : 'bg-gray-100 text-gray-900' ?>">

<?php include '../includes/header.php'; ?>

<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold text-center mb-6 <?= $theme === 'dark' ? 'text-white' : 'text-gray-800' ?>">Top Malls in Hyderabad</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <?php
        $malls = [
            ['name' => 'Inorbit Mall', 'image' => 'https://via.placeholder.com/300', 'desc' => 'Popular shopping and entertainment destination.'],
            ['name' => 'GVK One Mall', 'image' => 'https://via.placeholder.com/300', 'desc' => 'Luxury brands and amazing food court.'],
            ['name' => 'Forum Sujana Mall', 'image' => 'https://via.placeholder.com/300', 'desc' => 'Biggest mall with a great variety of stores.'],
            ['name' => 'IKEA Hyderabad', 'image' => 'https://via.placeholder.com/300', 'desc' => 'Famous for home decor and furniture.'],
            ['name' => 'Manjeera Mall', 'image' => 'https://via.placeholder.com/300', 'desc' => 'All-in-one shopping and fun destination.'],
            ['name' => 'Sarath City Capital Mall', 'image' => 'https://via.placeholder.com/300', 'desc' => 'Largest mall in South India with luxury and budget stores.']
        ];

        foreach ($malls as $mall) {
            echo '
            <div class="p-4 bg-white rounded-lg shadow-md '.($theme === 'dark' ? 'bg-gray-800 text-white' : 'bg-white text-gray-900').'">
                <img src="'.$mall['image'].'" alt="'.$mall['name'].'" class="w-full h-48 object-cover rounded-lg mb-4">
                <h2 class="text-xl font-semibold mb-2">'.$mall['name'].'</h2>
                <p>'.$mall['desc'].'</p>
            </div>';
        }
        ?>

    </div>
</div>

<?php include '../includes/footer.php'; ?>

</body>
</html>
