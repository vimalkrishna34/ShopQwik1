<?php
session_start();
$theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : 'light';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bangalore Malls - ShopQwik</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="<?= $theme === 'dark' ? 'bg-gray-900 text-gray-100' : 'bg-gray-100 text-gray-900' ?>">

<!-- Include Header -->
<?php include '../includes/header.php'; ?>

<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold text-center mb-6 <?= $theme === 'dark' ? 'text-white' : 'text-gray-800' ?>">Top Malls in Bangalore</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php
        $malls = [
            ["name" => "Orion Mall", "image" => "images/orion-mall.jpg"],
            ["name" => "Phoenix Marketcity", "image" => "images/phoenix-marketcity.jpg"],
            ["name" => "UB City Mall", "image" => "images/ub-city.jpg"],
            ["name" => "Forum Mall", "image" => "images/forum-mall.jpg"],
            ["name" => "Garuda Mall", "image" => "images/garuda-mall.jpg"],
            ["name" => "Mantri Square", "image" => "images/mantri-square.jpg"],
        ];

        foreach ($malls as $mall) {
            echo '<div class="rounded-lg shadow-md overflow-hidden ' . ($theme === 'dark' ? 'bg-gray-800 text-gray-200' : 'bg-white text-gray-900') . '">';
            echo '<img src="' . $mall['image'] . '" alt="' . $mall['name'] . '" class="w-full h-48 object-cover">';
            echo '<div class="p-4">';
            echo '<h3 class="text-xl font-semibold mb-2">' . $mall['name'] . '</h3>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
</div>

<!-- Include Footer -->
<?php include '../includes/footer.php'; ?>

</body>
</html>
