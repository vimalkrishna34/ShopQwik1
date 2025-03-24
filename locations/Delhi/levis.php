<?php
session_start();

// Check for theme preference
$theme = isset($_GET['theme']) ? $_GET['theme'] : (isset($_SESSION['theme']) ? $_SESSION['theme'] : 'light');
$_SESSION['theme'] = $theme;

// Sample Levi's products
$levisProducts = [
    ["name" => "Levi's 501 Original Fit Jeans", "price" => 98, "image" => "img/levis_501.jpg"],
    ["name" => "Levi's Trucker Jacket", "price" => 120, "image" => "img/levis_jacket.jpg"],
    ["name" => "Levi's Graphic T-Shirt", "price" => 35, "image" => "img/levis_tshirt.jpg"]
];
?>

<?php include '../../includes/header.php'; ?>

<!DOCTYPE html>
<html lang="en" class="<?= $theme === 'dark' ? 'dark-mode' : '' ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Levi's Products</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        :root {
            --bg-color: #f8f9fa;
            --text-color: #212529;
            --card-bg: #ffffff;
            --card-border: #dee2e6;
            --btn-primary: #007bff;
            --btn-primary-hover: #0056b3;
        }

        .dark-mode {
            --bg-color: #1a1a1a;
            --text-color: #f8f9fa;
            --card-bg: #2d2d2d;
            --card-border: #444;
            --btn-primary: #0d6efd;
            --btn-primary-hover: #0b5ed7;
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
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<!-- Theme Toggle Button -->
<button class="theme-toggle" onclick="toggleTheme()">
    <i class="fas <?= $theme === 'dark' ? 'fa-sun' : 'fa-moon' ?>"></i>
</button>

<div class="container">
    <h1 class="text-center my-4">Levi's Products</h1>
    <div class="row">
        <?php foreach ($levisProducts as $id => $product): ?>
            <div class="col-md-4">
                <div class="product-card">
                    <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                    <h3><?= htmlspecialchars($product['name']) ?></h3>
                    <p>$<?= number_format($product['price'], 2) ?></p>
                    <form method="POST" action="/PROJECTT/anj/ShopQwik-main/ShopQwik/pages/cart.php">
                        <input type="hidden" name="product_id" value="<?= $id ?>">
                        <button type="submit" name="add_to_cart">Add to Cart</button>
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