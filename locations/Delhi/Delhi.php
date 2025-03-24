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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #F5F5DC; /* Beige background */
            color: #5A3E36; /* Brown text */
        }
        .header-bg {
            background-color: #F5F5DC; 
            color: #5A3E36; 
            border-bottom: 4px solid #A28C75;
        }
        .mall-card {
            background-color: #F5F5DC;
            color: #5A3E36;
            border: 3px solid #A28C75;
            border-radius: 12px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .mall-card:hover {
            transform: scale(1.03);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        .mall-card img {
            height: 250px;
            object-fit: cover;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }
        .mall-title {
            color: #8B5E3C;
            font-weight: bold;
        }
        .btn-warning {
            background-color: #8B5E3C;
            border: none;
        }
        .btn-warning:hover {
            background-color: #5A3E36;
        }
    </style>
</head>
<body>

<?php include '../../includes/header.php'; ?>

<div class="text-center py-5 header-bg shadow mb-4">
    <h1 class="display-5 fw-bold" style="margin-top: 50px;"> Top Malls in Delhi </h1>
</div>

<div class="container py-5">
    <div class="row g-4">
        <?php
        $malls = [
            ["name" => "Select Citywalk", "image" => "https://i.pinimg.com/736x/7b/01/d8/7b01d8a41d8650a210a7cd27da25bfa6.jpg", 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Delhi/citywalk.php', 'description' => 'A vibrant destination for fashion, food, and fun.'],
            ["name" => "DLF Promenade", "image" => "https://i.pinimg.com/736x/30/43/ff/3043ff239f95e0881fdc14f30ea80324.jpg", 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Delhi/promenade.php', 'description' => 'An exclusive shopping experience with top international brands.'],
            ["name" => "Ambience Mall", "image" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQcgaRDaZ2FaRAk6q4pfX5kQSmU9YjJhwPdxw&s", 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Delhi/ambience.php', 'description' => 'A premium mall known for luxury shopping and entertainment.'],
            ["name" => "Pacific Mall", "image" => "https://i.pinimg.com/736x/a0/08/01/a00801f1d0056fe888abe5a502ca94b6.jpg", 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Delhi/pacific.php', 'description' => 'A shopping hub featuring fashion, food courts, and events.'],
            ["name" => "Ansal Plaza", "image" => "https://etimg.etb2bimg.com/photo/55368880.cms", 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Delhi/ansal.php', 'description' => 'Delhi’s iconic mall with diverse retail and entertainment spots.'],
            ["name" => "The Chanakya", "image" => "https://sundayguardianlive.com/wp-content/uploads/2023/11/The-Chanakya-1-Large.jpg", 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Delhi/chanakya.php', 'description' => 'A luxurious space for fine dining, fashion, and lifestyle.'],
        ];

        foreach ($malls as $mall) { ?>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card mall-card shadow-sm">
                    <img src="<?= $mall['image'] ?>" class="card-img-top" alt="<?= $mall['name'] ?>">
                    <div class="card-body text-center">
                        <h3 class="mall-title"> <?= $mall['name'] ?> </h3>
                        <p> <?= $mall['description'] ?> </p>
                        <a href="<?= $mall['link'] ?>" class="btn btn-warning text-white">Explore More</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>

</body>
</html>