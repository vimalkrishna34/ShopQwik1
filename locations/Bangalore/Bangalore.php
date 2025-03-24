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
    <h1 class="display-5 fw-bold" style="margin-top: 50px;">Top Malls in Bangalore</h1>
</div>

<div class="container py-5">
    <div class="row g-4">
        <?php
        $malls = [
            ["name" => "Orion Mall", "image" => "https://i.pinimg.com/736x/d5/9c/49/d59c4948d74a4486ac37e326267546a6.jpg", 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Bangalore/orion.php', 'description' => 'A premium shopping and entertainment destination in Rajajinagar.'],
            ["name" => "Phoenix Marketcity", "image" => "https://i.pinimg.com/736x/f5/01/88/f501881c2fd9d6eb403ddd72f94580cc.jpg", 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Bangalore/phoenix.php', 'description' => 'One of the largest malls in Bangalore with 1.2 million sq.ft retail space.'],
            ["name" => "UB City Mall", "image" => "https://d2rdhxfof4qmbb.cloudfront.net/wp-content/uploads/2024/03/The-Collection.jpg", 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Bangalore/ubcity.php', 'description' => 'Luxury shopping and fine dining experience in Bangalore CBD.'],
            ["name" => "Forum Mall", "image" => "https://cdn.shopify.com/s/files/1/0562/4011/1678/files/SB3.jpg?v=1709534517", 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Bangalore/forum.php', 'description' => 'A popular shopping and hangout spot in Koramangala.'],
            ["name" => "Garuda Mall", "image" => "https://content3.jdmagicbox.com/comp/bangalore/z5/080pxx80.xx80.170123140555.i4z5/catalogue/garuda-mall-magrath-road-bangalore-shopping-malls-3v8v9w3.jpg", 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Bangalore/garuda.php', 'description' => 'Popular for fashion and lifestyle stores on Magrath Road.'],
            ["name" => "Mantri Square", "image" => "https://www.mantriweb.in/wp-content/uploads/2023/04/mantri-square-mall.jpg", 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Bangalore/mantri.php', 'description' => 'One of the largest malls in South India near Malleswaram.'],
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