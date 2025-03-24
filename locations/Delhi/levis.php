<?php include '../../includes/header.php'; ?>

<?php
session_start();

// Sample Levi's products
$levisProducts = [
    ["name" => "Levi's 501 Original Fit Jeans", "price" => 98, "image" => "img/levis_501.jpg"],
    ["name" => "Levi's Trucker Jacket", "price" => 120, "image" => "img/levis_jacket.jpg"],
    ["name" => "Levi's Graphic T-Shirt", "price" => 35, "image" => "img/levis_tshirt.jpg"]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Levi's Products</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .product-card {
            border: 1px solid #ddd;
            padding: 15px;
            margin: 10px;
            text-align: center;
            border-radius: 8px;
        }
        .product-card img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .product-card button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        .product-card button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="text-center my-4">Levi's Products</h1>
    <div class="row">
        <?php foreach ($levisProducts as $id => $product): ?>
            <div class="col-md-4">
                <div class="product-card">
                    <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
                    <h3><?= $product['name'] ?></h3>
                    <p>$<?= $product['price'] ?></p>
                    <form method="POST" action="/PROJECTT/anj/ShopQwik-main/ShopQwik/pages/cart.php">
                        <input type="hidden" name="product_id" value="<?= $id ?>">
                        <button type="submit" name="add_to_cart">Add to Cart</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>

<?php include '../../includes/footer.php'; ?>