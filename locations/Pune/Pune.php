<?php
session_start();
$theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : 'light';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pune Malls - ShopQwik</title>
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
    <h1 class="display-5 fw-bold" style="margin-top: 50px;">Top Malls in Pune</h1>
</div>

<div class="container py-5">
    <div class="row g-4">
        <?php
        $malls = [
            ["name" => "Phoenix Marketcity", "image" => "https://www.phoenixmarketcity.com/pune/wp-content/uploads/sites/5/2022/03/Pune-Banner-1.jpg", 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Pune/phoenix.php', 'description' => 'Pune\'s largest mall with 1.2 million sq.ft of retail space.'],
            ["name" => "Amanora Mall", "image" => "https://www.amanoratown.com/wp-content/uploads/2021/12/mall-gallery-1.jpg", 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Pune/amanora.php', 'description' => 'Premium shopping destination in Hadapsar.'],
            ["name" => "Kumar Pacific Mall", "image" => "https://content.jdmagicbox.com/comp/pune/h3/020pxx20.xx20.170824140212.i5h3/catalogue/kumar-pacific-mall-shivajinagar-pune-shopping-malls-1zr6zqk.jpg", 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Pune/kumar.php', 'description' => 'Luxury mall in the heart of Pune at Shivajinagar.'],
            ["name" => "Westend Mall", "image" => "https://content.jdmagicbox.com/comp/pune/g5/020pxx20.xx20.170824140212.i5g5/catalogue/westend-mall-avinash-society-pune-shopping-malls-1zr6zqk.jpg", 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Pune/westend.php', 'description' => 'Popular shopping and entertainment hub in Aundh.'],
            ["name" => "SGS Mall", "image" => "https://content.jdmagicbox.com/comp/pune/i1/020pxx20.xx20.170824140212.i5i1/catalogue/sgs-mall-mall-mg-road-pune-shopping-malls-1zr6zqk.jpg", 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Pune/sgs.php', 'description' => 'Historic mall on MG Road with premium brands.'],
            ["name" => "Seasons Mall", "image" => "https://www.seasonsmall.com/wp-content/uploads/2022/03/seasons-mall-pune.jpg", 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Pune/seasons.php', 'description' => 'Modern lifestyle mall in Magarpatta City.'],
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