<?php
session_start();

// Check for theme preference
$theme = isset($_GET['theme']) ? $_GET['theme'] : (isset($_SESSION['theme']) ? $_SESSION['theme'] : 'light');
$_SESSION['theme'] = $theme;

// Sample Levi's products
$levisProducts = [
    ["name" => "501 Original Fit Jeans", "price" => 98, "image" => "https://i.pinimg.com/736x/04/69/05/046905c2376ac6ffba78de6b9c9f5142.jpg"],
    ["name" => "Trucker Jacket", "price" => 120, "image" => "https://i.pinimg.com/736x/5f/84/c0/5f84c0f92f050b97e2f60e7301d07949.jpg"],
    ["name" => "T-Shirt", "price" => 35, "image" => "https://i.pinimg.com/736x/1c/d8/ee/1cd8ee46014309c093970e7d32123ae5.jpg"],
    ["name" => "Pants", "price" => 35, "image" => "https://i.pinimg.com/736x/18/31/83/183183d2e3a24de375d3f8f0c792b7ff.jpg"],
    ["name" => "Flared Skirts", "price" => 35, "image" => "https://i.pinimg.com/736x/47/48/76/47487679ee24578aef85feb97cb7b52a.jpg"],
    ["name" => "Graphic T-shirts", "price" => 35, "image" => "https://i.pinimg.com/736x/fc/f4/e4/fcf4e4df59476b1f888a5944fbaf2af2.jpg"]


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
            text-align: center;
            border-radius: 8px;
<<<<<<< HEAD
            background-color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            height: 100%; /* Ensure all cards have equal height */
=======
            transition: all 0.3s ease;
>>>>>>> 9258eb017096f64f357046291a05a8dda9b226ca
        }

        .product-card img {
            max-width: 100%;
            height: 200px; /* Fixed height for uniformity */
            object-fit: cover; /* Ensures the image fills the space properly */
            border-radius: 8px;
        }

<<<<<<< HEAD
        .product-card h3 {
            font-size: 18px;
            min-height: 50px; /* Ensures text alignment */
        }

        .product-card p {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .product-card button {
            background-color: rgb(90, 84, 65);
=======
        .product-card button {
            background-color: var(--btn-primary);
>>>>>>> 9258eb017096f64f357046291a05a8dda9b226ca
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
<<<<<<< HEAD
            width: 100%;
        }

        .product-card button:hover {
            background-color: rgb(34, 32, 23);
=======
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
>>>>>>> 9258eb017096f64f357046291a05a8dda9b226ca
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
<<<<<<< HEAD
            <div class="col-md-4 d-flex">
                <div class="product-card w-100">
                    <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
                    <h3><?= $product['name'] ?></h3>
                    <p>$<?= $product['price'] ?></p>
=======
            <div class="col-md-4">
                <div class="product-card">
                    <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                    <h3><?= htmlspecialchars($product['name']) ?></h3>
                    <p>$<?= number_format($product['price'], 2) ?></p>
>>>>>>> 9258eb017096f64f357046291a05a8dda9b226ca
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
