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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #F5F5DC; 
            color: #5A3E36;
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
    <h1 class="display-5 fw-bold" style="margin-top: 50px;"> Top Malls in Hyderabad </h1>
</div>

<div class="container py-5">
    <div class="row g-4">
        <?php
        $malls = [
            ['name' => 'Inorbit Mall', 'image' => 'https://via.placeholder.com/300', 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Hyderabad/Inorbit.php'],
            ['name' => 'GVK One Mall', 'image' => 'https://via.placeholder.com/300', 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Hyderabad/Gvk.php'],
            ['name' => 'Forum Sujana Mall', 'image' => 'https://via.placeholder.com/300', 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Hyderabad/Forum.php'],
            ['name' => 'IKEA Hyderabad', 'image' => 'https://via.placeholder.com/300', 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Hyderabad/Ikea.php'],
            ['name' => 'Manjeera Mall', 'image' => 'https://via.placeholder.com/300', 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Hyderabad/Majeera.php'],
            ['name' => 'Sarath City Capital Mall', 'image' => 'https://via.placeholder.com/300', 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Hyderabad/sarath.php']
        ];

        foreach ($malls as $mall) { ?>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card mall-card shadow-sm">
                    <img src="<?= $mall['image'] ?>" class="card-img-top" alt="<?= $mall['name'] ?>">
                    <div class="card-body text-center">
                        <h3 class="mall-title"> <?= $mall['name'] ?> </h3>
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
