<?php
session_start();
$theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : 'light';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kochi Malls - ShopQwik</title>
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
    <h1 class="display-5 fw-bold" style="margin-top: 50px;">Top Malls in Kochi</h1>
</div>

<div class="container py-5">
    <div class="row g-4">
        <?php
        $malls = [
            ["name" => "Lulu Mall", "image" => "https://www.lulumall.in/kochi/wp-content/uploads/sites/3/2022/05/LuLu-Mall-Kochi.jpg", 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Kochi/lulu.php', 'description' => 'India\'s largest mall with 300+ brands and entertainment options.'],
            ["name" => "Oberon Mall", "image" => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/0f/0b/4b/3e/oberon-mall.jpg?w=1200&h=-1&s=1", 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Kochi/oberon.php', 'description' => 'Premium shopping destination in Maradu with luxury brands.'],
            ["name" => "Centre Square Mall", "image" => "https://kochi-malls.s3.ap-south-1.amazonaws.com/wp-content/uploads/2023/06/centre-square-mall-kochi.jpg", 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Kochi/centresquare.php', 'description' => 'Urban lifestyle mall with fashion, food, and entertainment.'],
            ["name" => "Gold Souk Grande", "image" => "https://www.goldsoukgrande.in/wp-content/uploads/2023/03/Gold-Souk-Grande-Mall-Kochi.jpg", 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Kochi/goldsouk.php', 'description' => 'Luxury mall specializing in jewelry and premium brands.'],
            ["name" => "Abad Nucleus Mall", "image" => "https://content3.jdmagicbox.com/comp/kochi/61/0484p484std461/catalogue/abad-nucleus-mall-nh-47-maradu-kochi-shopping-malls-3a2v0v9.jpg", 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Kochi/nucleus.php', 'description' => 'Compact mall with curated retail and dining options.'],
            ["name" => "Bay Pride Mall", "image" => "https://kochi-malls.s3.ap-south-1.amazonaws.com/wp-content/uploads/2023/06/bay-pride-mall-kochi.jpg", 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Kochi/baypride.php', 'description' => 'Marine Drive landmark with shopping and food courts.'],
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>