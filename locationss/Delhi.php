<?php
session_start();
$theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : 'light';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delhi Malls - ShopQwik</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="<?= $theme === 'dark' ? 'bg-gray-900 text-gray-100' : 'bg-gray-100 text-gray-900' ?>">

<!-- Include Header -->
<?php include '../includes/header.php'; ?>

<div class="container mx-auto py-8 px-4">
    <h1 class="text-4xl font-extrabold text-center mb-8 <?= $theme === 'dark' ? 'text-white' : 'text-gray-800' ?>">
        ✨ Top Malls in Delhi ✨
    </h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php
        $malls = [
            ["name" => "Select Citywalk", "image" => "https://i.pinimg.com/736x/7b/01/d8/7b01d8a41d8650a210a7cd27da25bfa6.jpg"],
            ["name" => "DLF Promenade", "image" => "https://i.pinimg.com/736x/30/43/ff/3043ff239f95e0881fdc14f30ea80324.jpg"],
            ["name" => "Ambience Mall", "image" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQcgaRDaZ2FaRAk6q4pfX5kQSmU9YjJhwPdxw&s"],
            ["name" => "Pacific Mall", "image" => "https://i.pinimg.com/736x/a0/08/01/a00801f1d0056fe888abe5a502ca94b6.jpg"],
            ["name" => "Ansal Plaza", "image" => "https://etimg.etb2bimg.com/photo/55368880.cms"],
            ["name" => "The Chanakya", "image" => "https://sundayguardianlive.com/wp-content/uploads/2023/11/The-Chanakya-1-Large.jpg"],
        ];

        foreach ($malls as $mall) {
            ?>
            <div class="relative overflow-hidden rounded-2xl shadow-xl group hover:scale-105 transition-transform duration-300 
                <?= $theme === 'dark' ? 'bg-gray-800 text-gray-200' : 'bg-white text-gray-900' ?>">
                
                <img src="<?= $mall['image'] ?>" alt="<?= $mall['name'] ?>" 
                    class="w-full h-56 object-cover group-hover:brightness-75 transition duration-300">
                
                <!-- Gradient Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                <!-- Mall Name -->
                <div class="absolute bottom-4 left-4 right-4">
                    <h3 class="text-xl font-bold text-white group-hover:translate-y-0 translate-y-4 opacity-0 group-hover:opacity-100 transition-all duration-300">
                        <?= $mall['name'] ?>
                    </h3>
                </div>

                <!-- Optional Description (if needed) -->
                <div class="p-4 hidden group-hover:block">
                    
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<!-- Include Footer -->
<?php include '../includes/footer.php'; ?>

</body>
</html>
