<?php
session_start();
$theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : 'light';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chennai Malls - ShopQwik</title>
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
    <h1 class="display-5 fw-bold" style="margin-top: 50px;">Top Malls in Chennai</h1>
</div>

<div class="container py-5">
    <div class="row g-4">
        <?php
        $malls = [
            [
                "name" => "Phoenix Marketcity", 
                "image" => "https://www.phoenixmarketcity.com/chennai/wp-content/uploads/sites/4/2022/03/Phoenix-Marketcity-Chennai.jpg", 
                'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Chennai/phoenix.php', 
                'description' => "One of Chennai's largest malls with 1.3 million sq.ft retail space in Velachery."
            ],
            [
                "name" => "Express Avenue Mall", 
                "image" => "https://content.jdmagicbox.com/comp/chennai/74/044p1235274/catalogue/express-avenue-mall-royapettah-chennai-shopping-malls-3a2v0v9.jpg", 
                'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Chennai/expressavenue.php', 
                'description' => 'Landmark mall in Royapettah with 300+ brands and entertainment options.'
            ],
            [
                "name" => "Forum Vijaya Mall", 
                "image" => "https://content3.jdmagicbox.com/comp/chennai/10/044p4000210/catalogue/forum-vijaya-mall-vadapalani-chennai-shopping-malls-3a2v0v9.jpg", 
                'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Chennai/forumvijaya.php', 
                'description' => 'Popular shopping destination in Vadapalani with multiplex and food court.'
            ],
            [
                "name" => "VR Chennai", 
                "image" => "https://www.vrchennai.com/wp-content/uploads/2022/03/VR-Chennai-Mall-Exterior.jpg", 
                'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Chennai/vr.php', 
                'description' => 'Premium luxury mall in Anna Nagar with international brands.'
            ],
            [
                "name" => "The Grand Venice Mall", 
                "image" => "https://www.thegrandvenice.com/wp-content/uploads/2021/12/Grand-Venice-Mall-Chennai.jpg", 
                'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Chennai/venice.php', 
                'description' => 'Venetian-themed mall in Porur with unique architecture and brands.'
            ],
            [
                "name" => "Spencer Plaza", 
                "image" => "https://chennai.tourismindia.xyz/wp-content/uploads/2020/05/Spencer-Plaza-Chennai.jpg", 
                'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Chennai/spencer.php', 
                'description' => "Chennai's iconic heritage shopping complex in Mount Road."
            ],
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