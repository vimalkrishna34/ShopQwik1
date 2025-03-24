<?php
session_start();

// Check for theme preference
$theme = isset($_GET['theme']) ? $_GET['theme'] : (isset($_SESSION['theme']) ? $_SESSION['theme'] : 'light');
$_SESSION['theme'] = $theme;

// Vero Moda products
$veroModaProducts = [
    ["name" => "Vero Moda Floral Summer Dress", "price" => 59.99, "image" => "img/vero_dress1.jpg"],
    ["name" => "Vero Moda Skinny Jeans", "price" => 49.99, "image" => "img/vero_jeans.jpg"],
    ["name" => "Vero Moda Oversized Blazer", "price" => 89.99, "image" => "img/vero_blazer.jpg"],
    ["name" => "Vero Moda Knit Sweater", "price" => 45.99, "image" => "img/vero_sweater.jpg"],
    ["name" => "Vero Moda High-Waisted Skirt", "price" => 39.99, "image" => "img/vero_skirt.jpg"],
    ["name" => "Vero Moda Striped T-Shirt", "price" => 29.99, "image" => "img/vero_tshirt.jpg"],
    ["name" => "Vero Moda Leather Look Jacket", "price" => 79.99, "image" => "img/vero_jacket.jpg"],
    ["name" => "Vero Moda Wide Leg Pants", "price" => 54.99, "image" => "img/vero_pants.jpg"],
    ["name" => "Vero Moda Wrap Blouse", "price" => 42.99, "image" => "img/vero_blouse.jpg"],
    ["name" => "Vero Moda Denim Shorts", "price" => 35.99, "image" => "img/vero_shorts.jpg"]
];
?>

<?php include '../../includes/header.php'; ?>

<!DOCTYPE html>
<html lang="en" class="<?= $theme === 'dark' ? 'dark-mode' : '' ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vero Moda Collection</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        :root {
            --bg-color: #f8f9fa;
            --text-color: #212529;
            --card-bg: #ffffff;
            --card-border: #dee2e6;
            --btn-primary: #e83e8c;
            --btn-primary-hover: #d63384;
        }

        .dark-mode {
            --bg-color: #1a1a1a;
            --text-color: #f8f9fa;
            --card-bg: #2d2d2d;
            --card-border: #444;
            --btn-primary: #e83e8c;
            --btn-primary-hover: #d63384;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            transition: all 0.3s ease;
        }

        .product-card {
            border: 1px solid var(--card-border);
            background-color: var(--card-bg);
            padding: 15px;
            margin: 10px;
            text-align: center;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .product-card img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .product-card button {
            background-color: var(--btn-primary);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .product-card button:hover {
            background-color: var(--btn-primary-hover);
        }

        .theme-toggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            background-color: var(--btn-primary);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
        }

        .theme-toggle:hover {
            background-color: var(--btn-primary-hover);
            transform: scale(1.1);
        }
        
        .brand-header {
            color: var(--btn-primary);
            margin-bottom: 30px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<!-- Theme Toggle Button -->
<button class="theme-toggle" onclick="toggleTheme()">
    <i class="fas <?= $theme === 'dark' ? 'fa-sun' : 'fa-moon' ?>"></i>
</button>

<div class="container">
    <h1 class="text-center my-4 brand-header">Vero Moda Collection</h1>
    <div class="row">
        <?php foreach ($veroModaProducts as $id => $product): ?>
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="product-card h-100 d-flex flex-column">
                    <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="mb-3">
                    <h3 class="h5 flex-grow-1"><?= htmlspecialchars($product['name']) ?></h3>
                    <p class="fw-bold">$<?= number_format($product['price'], 2) ?></p>
                    <form method="POST" action="/PROJECTT/anj/ShopQwik-main/ShopQwik/pages/cart.php">
                        <input type="hidden" name="product_id" value="<?= $id ?>">
                        <button type="submit" name="add_to_cart" class="mt-auto">Add to Cart</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    function toggleTheme() {
        const currentTheme = document.documentElement.classList.contains('dark-mode') ? 'light' : 'dark';
        window.location.href = '?theme=' + currentTheme;
    }
</script>

</body>
</html>

<?php include '../../includes/footer.php'; ?>