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
        .header-bg {
            background-color: var(--light-bg); 
            color: var(--secondary-color); 
            border-bottom: 4px solid var(--accent-color);
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
        /* Back Button Styles */
        .back-btn-container {
            position: absolute;
            left: 20px;
            top: 20px;
            z-index: 1000;
        }
        .back-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 30px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s ease;
        }
        .back-btn:hover {
            background-color: var(--secondary-color);
            transform: translateX(-3px);
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
            .back-btn-container {
                left: 10px;
                top: 10px;
            }
            .back-btn {
                padding: 6px 12px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>

<?php include '../../includes/header.php'; ?>

<!-- Back Button -->
<div class="back-btn-container">
    <button class="back-btn" onclick="window.history.back()">
        <i class="fas fa-arrow-left"></i> Back
    </button>
</div>

<div class="text-center">
    <h1 class="display-5 fw-bold" style="margin-top: 50px;"></h1>
</div>

<div class="container py-5">
    <!-- Mall Selector Dropdown -->
    <div class="mall-selector">
        <select id="mallSelect" class="form-select" onchange="goToSlide(this.value)">
            <option value="" selected disabled>Select a Mall</option>
            <?php
            $malls = [
                ["name" => "Phoenix Marketcity", "image" => "https://girimun.com/wp-content/uploads/2019/07/01-Market-City-Bangalore-1-e1566973184927.jpg", 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Delhi/citywalk.php', 'description' => 'A vibrant destination for fashion, cinema, food, and fun.', 'features' => ['Fashion', 'Cinema', 'Dining']],
                ["name" => "Orion Mall", "image" => "https://d2w46d36moy248.cloudfront.net/media/homepage_video/omg_1_1_2.jpg", 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Delhi/citywalk.php', 'description' => 'An exclusive shopping experience with top international brands.', 'features' => ['Luxury', 'International Brands']],
                ["name" => "Forum Mall", "image" => "https://cdn.shopify.com/s/files/1/0562/4011/1678/files/SB9.jpg?v=1709534788", 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Delhi/citywalk.php', 'description' => 'A premium mall known for luxury shopping and entertainment.', 'features' => ['Luxury', 'Entertainment', 'Dining']],
                ["name" => "UB City Mall", "image" => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/08/e0/d9/9f/ub-city.jpg?w=1200&h=1200&s=1", 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Delhi/citywalk.php', 'description' => 'A shopping hub featuring fashion, food courts, and events.', 'features' => ['Fashion', 'Food Court', 'Events']],
                ["name" => "Garuda Mall", "image" => "https://i.pinimg.com/736x/85/3d/37/853d37a47a2c591ba62e62021cb75042.jpg", 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Delhi/citywalk.php', 'description' => 'Bangalore\'s iconic mall with diverse retail and entertainment spots.', 'features' => ['Retail', 'Entertainment']],
                ["name" => "Mantri Square", "image" => "https://www.scai.in/wp-content/uploads/2020/11/mantri-square1.jpg", 'link' => '/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Delhi/citywalk.php', 'description' => 'A luxurious space for fine dining, fashion, and lifestyle.', 'features' => ['Luxury', 'Fine Dining', 'Fashion']],
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