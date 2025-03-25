<?php include '../../../includes/header.php'; ?>

<?php
session_start();

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
            text-align: center;
            border-radius: 8px;
            background-color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            height: 100%; /* Ensure all cards have equal height */
        }

        .product-card img {
            max-width: 100%;
            height: 200px; /* Fixed height for uniformity */
            object-fit: cover; /* Ensures the image fills the space properly */
            border-radius: 8px;
        }

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
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        .product-card button:hover {
            background-color: rgb(34, 32, 23);
        }
    </style>
</head>
<body>

<div class="container" style="margin-top: 60px;">
    <div class="row">
        <?php foreach ($levisProducts as $id => $product): ?>
            <div class="col-md-4 d-flex">
                <div class="product-card w-100">
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

<?php include '../../../includes/footer.php'; ?>