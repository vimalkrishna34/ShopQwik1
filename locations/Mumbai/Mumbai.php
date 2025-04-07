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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #8B5E3C;
            --secondary-color: #5A3E36;
            --light-bg: #F5F5DC;
            --accent-color: #A28C75;
        }
        body {
            background-color: var(--light-bg);
            color: var(--secondary-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .mall-card {
            background: white;
            border: none;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 100%;
            max-width: 650px;
            margin: 0 auto;
            border: 1px solid rgba(138, 94, 60, 0.2);
        }
        .mall-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        }
        .mall-card-img {
            height: 240px;
            object-fit: cover;
            width: 100%;
            border-bottom: 3px solid var(--primary-color);
        }
        .card-body {
            padding: 1.5rem;
        }
        .mall-title {
            color: var(--primary-color);
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 0.75rem;
            position: relative;
            padding-bottom: 10px;
        }
        .mall-title:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 3px;
            background: var(--accent-color);
        }
        .mall-description {
            color: #666;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
        }
        .btn-explore {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 30px;
            font-weight: 500;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-explore:hover {
            background-color: var(--secondary-color);
            color: white;
            transform: translateY(-2px);
        }
        .mall-features {
            display: flex;
            gap: 15px;
            margin: 15px 0;
            flex-wrap: wrap;
            justify-content: center;
        }
        .feature-badge {
            background: rgba(138, 94, 60, 0.1);
            color: var(--primary-color);
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .carousel-control-prev, .carousel-control-next {
            width: 40px;
            height: 40px;
            background-color: var(--primary-color);
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
            opacity: 1;
            transition: all 0.3s ease;
        }
        .carousel-control-prev:hover, .carousel-control-next:hover {
            background-color: var(--secondary-color);
        }
        .carousel-control-prev {
            left: 10px;
        }
        .carousel-control-next {
            right: 10px;
        }
        .mall-selector {
            max-width: 300px;
            margin: 20px auto;
        }
        .mall-selector select {
            background-color: white;
            color: var(--secondary-color);
            border: 2px solid var(--accent-color);
            padding: 8px 15px;
            border-radius: 8px;
            width: 100%;
            font-weight: 500;
        }
        .browse-btn {
            background-color: var(--primary-color);
            color: white;
            padding: 10px 25px;
            font-size: 1.1rem;
            border-radius: 30px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        .browse-btn:hover {
            background-color: var(--secondary-color);
            color: white;
            transform: translateY(-2px);
        }
        @media (max-width: 768px) {
            .carousel-control-prev {
                left: 5px;
            }
            .carousel-control-next {
                right: 5px;
            }
            .mall-card {
                max-width: 350px;
            }
        }
    </style>
</head>
<body>

<?php include '../../includes/header.php'; ?>

<div class="container py-5">
    <!-- Mall Selector Dropdown -->
    <div class="mall-selector" style="margin-top: 70px;">
        <select id="mallSelect" class="form-select" onchange="goToSlide(this.value)">
            <option value="" selected disabled>Select a Mall</option>
            <?php
            $malls = [
                ["name" => "Phoenix Marketcity", "image" => "https://www.phoenixoffices.in/wp-content/uploads/2015/12/DeathtoStock_Holiday2-1-1170x530.jpg", 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Mumbai/phoenix.php', 'description' => 'Mumbai\'s largest mall with luxury shopping, entertainment, and dining options.', 'features' => ['Luxury', 'Entertainment', 'Dining']],
                ["name" => "High Street Phoenix", "image" => "https://www.hindustantimes.com/ht-img/img/2024/08/31/550x309/Mumbai--India--Aug-31--2024--Phoenix-Mill-compound_1725131803346.jpg", 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Mumbai/phoenix.php', 'description' => 'Premium shopping destination with international brands and fine dining.', 'features' => ['International Brands', 'Fine Dining']],
                ["name" => "R City Mall", "image" => "https://assets-news.housing.com/news/wp-content/uploads/2023/02/24194631/R-City-Mall-in-Mumbai-Shopping-dining-and-entertainment-options-01.jpg", 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Mumbai/rcity.php', 'description' => 'Great for family outings with multiplex cinema and diverse food options.', 'features' => ['Family', 'Cinema', 'Food Court']],
                ["name" => "Infiniti Mall", "image" => "https://files.lbb.in/media/2019/12/5e05fd7da99fe673cd1d7792_1577450877774.jpg", 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Mumbai/infiniti.php', 'description' => 'Great mix of brands, entertainment, and dining options for all ages.', 'features' => ['Fashion', 'Entertainment', 'Dining']],
                ["name" => "Oberoi Mall", "image" => "https://sceneloc8.com/wp-content/uploads/2024/03/Oberoi-Mall.png", 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Mumbai/oberoi.php', 'description' => 'Conveniently located with great variety of stores and eateries.', 'features' => ['Convenient', 'Variety', 'Dining']],
                ["name" => "Nexus seawoods", "image" => "https://media.assettype.com/freepressjournal/2025-01-22/omzd0o3d/FotoJet-40.jpg?width=1200", 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Mumbai/atria.php', 'description' => 'Modern mall with premium and local stores, plus entertainment options.', 'features' => ['Modern', 'Local Stores', 'Entertainment']]
            ];
            
            foreach ($malls as $index => $mall) {
                echo '<option value="'.$index.'">'.$mall['name'].'</option>';
            }
            ?>
        </select>
    </div>

    <div id="mallCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php
            foreach ($malls as $index => $mall) {
                $activeClass = $index === 0 ? 'active' : '';
                echo '
                <div class="carousel-item '.$activeClass.'">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="card mall-card">
                                <img src="'.$mall['image'].'" class="mall-card-img" alt="'.$mall['name'].'">
                                <div class="card-body text-center">
                                    <h3 class="mall-title">'.$mall['name'].'</h3>
                                    
                                    <div class="mall-features">';
                                    foreach ($mall['features'] as $feature) {
                                        echo '<span class="feature-badge">
                                            <i class="fas fa-check"></i> '.$feature.'
                                        </span>';
                                    }
                                    echo '</div>
                                    
                                    <p class="mall-description">'.$mall['description'].'</p>
                                    
                                    <a href="'.$mall['link'].'" class="btn btn-explore">
                                        Explore More <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
            }
            ?>
        </div>
        
        <button class="carousel-control-prev" type="button" data-bs-target="#mallCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#mallCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
<script>
    // Initialize carousel
    const mallCarousel = new bootstrap.Carousel(document.getElementById('mallCarousel'), {
        interval: 3000,
        wrap: true
    });
    
    // Function to go to specific slide
    function goToSlide(index) {
        mallCarousel.to(index);
    }
    
    // Update dropdown when carousel slides
    document.getElementById('mallCarousel').addEventListener('slid.bs.carousel', function (event) {
        document.getElementById('mallSelect').value = event.to;
    });
    
    // Pause carousel when hovering over it
    document.getElementById('mallCarousel').addEventListener('mouseenter', function() {
        mallCarousel.pause();
    });
    
    document.getElementById('mallCarousel').addEventListener('mouseleave', function() {
        mallCarousel.cycle();
    });
</script>
</body>
</html>