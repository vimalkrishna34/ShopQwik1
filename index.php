<?php
session_start();

// Handle theme switch
if (isset($_GET['theme'])) {
    $theme = ($_GET['theme'] === 'dark') ? 'dark' : 'light';
    setcookie('site_theme', $theme, time() + (86400 * 30), "/");
    header('Location: ' . strtok($_SERVER["REQUEST_URI"], '?'));
    exit;
}

// Retrieve theme from cookie, default to 'light'
$theme = isset($_COOKIE['site_theme']) ? $_COOKIE['site_theme'] : 'light';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>ShopQwik - Virtual Mall Shopping Assistant</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .hero-title {
            font-size: 3rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
        }
        .hero-subtitle {
            font-size: 1.2rem;
            font-weight: 400;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body class="<?= $theme === 'dark' ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-900' ?>">
    
    <?php 
    if (!isset($theme)) {
        $theme = 'light';
    }
    include 'includes/header.php'; 
    ?>

    <!-- Hero Section -->
<div class="relative h-screen flex items-end justify-center text-center px-6 pb-12">
    <img src="images/covermotion.gif" loading="lazy" alt="Virtual Shopping" class="absolute inset-0 w-full h-full object-cover opacity-90">
    <div class="relative z-10">
        
    <a href="pages/location.php"
   class="mt-6 inline-block bg-[#D2B48C] hover:bg-[#C2A178] text-gray-900 font-semibold py-3 px-8 rounded-full shadow-lg text-lg">
   Browse Malls
</a>


    </div>
</div>

<!-- Include Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Major+Mono+Display&family=Unbounded:wght@400;700&display=swap" rel="stylesheet">

<!-- About ShopQwik Section -->
<section class="py-16 <?= $theme === 'dark' ? 'bg-gray-800 text-gray-200' : 'bg-gray-50 text-gray-900' ?>">
    <div class="max-w-6xl mx-auto px-6 flex flex-col md:flex-row items-center">
        <!-- Left Content -->
        <div class="md:w-1/2 space-y-6">
            <h3 class="text-lg font-semibold <?= $theme === 'dark' ? 'text-[#D2B48C]' : 'text-[#A68A64]' ?> uppercase">About ShopQwik</h3> 
            <h2 class="text-4xl font-bold">Enhancing Your Mall Shopping Experience</h2>
            <p class="text-lg <?= $theme === 'dark' ? 'text-gray-400' : 'text-gray-600' ?>">
                ShopQwik revolutionizes the way you shop in malls. Instantly compare prices, reserve products, 
                and enjoy a seamless checkout experience—all in one app. No more waiting in lines or missing out on deals!
            </p>

            <!-- Key Statistics -->
            <div class="grid grid-cols-3 gap-4 text-center">
                <div>
                    <h3 class="text-3xl font-bold <?= $theme === 'dark' ? 'text-gray-200' : 'text-gray-900' ?>">50K+</h3>
                    <p class="text-sm <?= $theme === 'dark' ? 'text-gray-400' : 'text-gray-600' ?>">Active Users</p>
                </div>
                <div>
                    <h3 class="text-3xl font-bold <?= $theme === 'dark' ? 'text-gray-200' : 'text-gray-900' ?>">120+</h3>
                    <p class="text-sm <?= $theme === 'dark' ? 'text-gray-400' : 'text-gray-600' ?>">Partnered Stores</p>
                </div>
                <div>
                    <h3 class="text-3xl font-bold <?= $theme === 'dark' ? 'text-gray-200' : 'text-gray-900' ?>">98%</h3>
                    <p class="text-sm <?= $theme === 'dark' ? 'text-gray-400' : 'text-gray-600' ?>">Customer Satisfaction</p>
                </div>
            </div>

            <!-- Button with Dark Beige Color -->
            <a href="#" class="mt-4 inline-block <?= $theme === 'dark' ? 'bg-[#D2B48C] text-gray-900' : 'bg-[#A68A64] text-white' ?> py-3 px-6 rounded-lg shadow-lg font-semibold">
                Learn More
            </a>
        </div>

        <!-- Right Side Images -->
        <div class="md:w-1/2 mt-8 md:mt-0 flex flex-wrap justify-end gap-4">
            <img src="images/preview.jpg" class="w-1/2 rounded-lg shadow-md" alt="ShopQwik App Preview">
            <img src="images/mallshop.jpg" class="w-1/3 rounded-lg shadow-md" alt="Mall Shopping">
            <img src="images/secpay.jpg" class="w-1/3 rounded-lg shadow-md" alt="Secure Payment">
        </div>
    </div>

    <!-- Trusted By (Logos) -->
    <div class="max-w-6xl mx-auto mt-12 px-6 text-center">
        <p class="<?= $theme === 'dark' ? 'text-gray-400' : 'text-gray-500' ?> text-lg">Trusted by leading brands & retailers</p>
        <div class="flex justify-center items-center gap-6 mt-4">
            <img src="images/adidas.jpg" class="h-8 opacity-70" alt="Brand 1">
            <img src="images/sony.jpg" class="h-8 opacity-70" alt="Brand 2">
            <img src="images/loreal.jpg" class="h-8 opacity-70" alt="Brand 3">
            <img src="images/reliance.jpg" class="h-8 opacity-70" alt="Brand 4">
        </div>
    </div>
</section>

<!-- Services Section with Overlapping Slide Effect -->
<div class="py-16 <?= $theme === 'dark' ? 'bg-gray-900' : 'bg-[#A68A64]' ?>">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-4xl font-bold text-center mb-12 tracking-wide text-white">
            Our Exclusive Services
        </h2>

        <div class="relative flex items-center">
            <!-- Left Section (Text) -->
            <div class="w-1/2 p-8">
                <h3 id="service-title" class="text-4xl font-semibold text-white">Service Title</h3>
                <p id="service-description" class="text-lg text-gray-200 mt-4">Service description will appear here.</p>
            </div>

            <!-- Right Section (Sliding Cards) -->
            <div class="w-1/2 relative h-[400px] overflow-hidden">
                <div id="services-slider" class="relative w-full h-full">
                    <?php
                    $services = [
                        ['title' => 'Price Comparison', 'description' => 'Instantly compare prices across multiple online and offline stores to ensure you get the best deal without extra hassle.', 'image' => 'images/price.jpg'],
                        ['title' => 'Theatre Mode', 'description' => 'Enjoy entertainment while shopping! Use our app during movies or events to browse products without leaving your seat.', 'image' => 'images/theatre.jpg'],
                        ['title' => 'Instant Pickup', 'description' => 'Quickly pick up items ordered inside the mall and order online and pick up your items immediately from partnered stores, skipping long queues and delays.', 'image' => 'images/instant.jpg'],
                        ['title' => 'Reserve & Pay Later', 'description' => 'Secure your favorite products in advance and conveniently pay at the store upon pickup—no upfront payment required.', 'image' => 'images/reserve.jpg'],
                        ['title' => 'After-Sales Support', 'description' => 'Enjoy peace of mind with dedicated support, repairs, and maintenance services for your purchases.', 'image' => 'images/support.jpg'],
                    ];
                    
                    foreach ($services as $index => $service) {
                        echo "
                        <div class='absolute w-full h-full transition-transform duration-500 ease-in-out service-card' 
                            data-index='$index' style='transform: translateX(" . ($index * 100) . "%);'>
                            <div class='relative w-full h-full rounded-xl shadow-xl overflow-hidden'>
                                <img src='{$service['image']}' class='w-full h-full object-cover' />
                                <div class='absolute top-0 left-0 w-full h-full bg-gradient-to-t from-black/60 to-transparent'></div>
                            </div>
                        </div>";
                    }
                    ?>
                </div>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex justify-center mt-6">
            <button onclick="prevService()" id="prev-btn" class="px-4 py-2 bg-gray-800 text-white rounded-full mx-2">◀</button>
            <button onclick="nextService()" id="next-btn" class="px-4 py-2 bg-gray-800 text-white rounded-full mx-2">▶</button>
        </div>
    </div>
</div>

<!-- JavaScript for Slider -->
<script>
    let currentService = 0;
    const services = <?= json_encode($services) ?>;
    const serviceCards = document.querySelectorAll('.service-card');

    function updateServiceInfo() {
        document.getElementById('service-title').innerText = services[currentService].title;
        document.getElementById('service-description').innerText = services[currentService].description;
    }

    function updateSlides() {
        serviceCards.forEach((card, index) => {
            let offset = (index - currentService) * 100;
            card.style.transform = `translateX(${offset}%)`;
        });
        updateServiceInfo();
        updateButtons();
    }

    function updateButtons() {
        document.getElementById('prev-btn').disabled = currentService === 0;
        document.getElementById('next-btn').disabled = currentService === services.length - 1;
    }

    function nextService() {
        if (currentService < services.length - 1) {
            currentService++;
            updateSlides();
        }
    }

    function prevService() {
        if (currentService > 0) {
            currentService--;
            updateSlides();
        }
    }

    // Initialize first service
    updateServiceInfo();
    updateButtons();
</script>




<!-- Theme Switcher -->
<div class="text-center py-6">
    <a href="?theme=<?= $theme === 'dark' ? 'light' : 'dark' ?>"
       class="py-3 px-6 rounded-full font-semibold text-lg transition-all
       <?= $theme === 'dark' ? 'bg-gray-700 hover:bg-gray-600 text-gray-300' : 'bg-gray-800 hover:bg-gray-900 text-white' ?>">
        Switch to <?= $theme === 'dark' ? 'Light' : 'Dark' ?> Mode
    </a>
</div>

<?php include 'includes/footer.php'; ?>

</body>
</html>
