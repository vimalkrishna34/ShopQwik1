<?php
session_start();
$theme = isset($_GET['theme']) ? $_GET['theme'] : (isset($_SESSION['theme']) ? $_SESSION['theme'] : 'light');
$_SESSION['theme'] = $theme;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location Selection - ShopQwik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.10.2/dist/cdn.min.js" defer></script>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .container {
            flex: 1;
        }
        footer {
            margin-top: auto;
        }
        .location-image {
            height: 500px; /* Increased image size */
            object-fit: cover;
        }
    </style>
</head>
<body class="<?= $theme === 'dark' ? 'bg-gray-900 text-gray-100' : 'bg-[#F5EDE3] text-gray-900' ?>">

<?php include '../includes/header.php'; ?>

<div class="container mx-auto py-8" x-data="{ search: '', selectedCity: null }">
    <h1 class="text-3xl font-bold text-center mb-6 <?= $theme === 'dark' ? 'text-white' : 'text-gray-800' ?>">Select Your Location</h1>

    <!-- Search Bar -->
    <div class="flex justify-center mb-6">
        <div class="relative w-1/2">
            <input type="text" x-model="search" placeholder="Search city..." class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring focus:ring-gray-300" />
            <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m-2.83-2.83a7 7 0 111.41-1.41l2.83 2.83z" />
            </svg>
        </div>
    </div>

    <div class="flex flex-wrap md:flex-nowrap gap-4 justify-center overflow-x-auto md:overflow-visible">
        <?php 
        $locations = [
            ['name' => 'Delhi', 'img' => '../images/Delhi1.jpeg', 'link' => '../locations/Delhi/Delhi.php'],
            ['name' => 'Hyderabad', 'img' => '../images/Hyderabad1.jpeg', 'link' => '../locations/Hyderabad/Hyderabad.php'],
            ['name' => 'Bangalore', 'img' => '../images/Bangaluru1.jpeg', 'link' => '../locations/Bangalore/Bangalore.php'],
            ['name' => 'Mumbai', 'img' => '../images/Mumbai1.jpeg', 'link' => '../locations/Mumbai/Mumbai.php'],
            ['name' => 'Pune', 'img' => '../images/Pune1.jpeg', 'link' => '../locations/Pune/Pune.php'],
            ['name' => 'Kochi', 'img' => '../images/Kochi1.jpeg', 'link' => '../locations/Kochi/Kochi.php'],
            ['name' => 'Chennai', 'img' => '../images/Chennai1.jpeg', 'link' => '../locations/Chennai/Chennai.php']
        ];
        ?>

        <div class="flex md:space-x-4 space-y-4 md:space-y-0 flex-wrap md:flex-nowrap justify-center">
            <?php foreach ($locations as $index => $location) { ?>
                <div x-show="search === '' || '<?= strtolower($location['name']) ?>'.includes(search.toLowerCase())"
                     x-on:mouseenter="selectedCity = <?= $index ?>"
                     x-on:mouseleave="selectedCity = null"
                     x-on:click="window.location.href='<?= $location['link'] ?>'"
                     x-bind:class="selectedCity === <?= $index ?> ? 'md:w-96 w-full' : 'md:w-32 w-full'"
                     class="relative cursor-pointer rounded-lg overflow-hidden transition-all duration-[1300ms] ease-in-out shadow-lg hover:w-96">
                    <img src="<?= $location['img'] ?>" alt="<?= $location['name'] ?>" class="location-image w-full">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
                    <div class="absolute bottom-4 left-4 text-white">
                        <h2 class="text-xl font-bold"><?= $location['name'] ?></h2>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>

</body>
</html>