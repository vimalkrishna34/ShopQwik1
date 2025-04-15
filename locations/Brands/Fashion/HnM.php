<?php 
// Start session at the VERY TOP
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database connection
$conn = mysqli_connect("localhost", "root", "", "shopqwik");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create H&M products table if not exists
$createTableSql = "CREATE TABLE IF NOT EXISTS `hm_products` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(200) NOT NULL,
    `price` INT NOT NULL,
    `image` VARCHAR(400) NOT NULL,
    `brand` VARCHAR(50) NOT NULL DEFAULT 'H&M',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

if (!mysqli_query($conn, $createTableSql)) {
    die("Error creating table: " . mysqli_error($conn));
}

// H&M products data
$hmProducts = [
    ["name" => "Short Blue Dress", "price" => 1071, "image" => "https://image.hm.com/assets/hm/60/8a/608a4d5bea0c4fe03030afec129a60ede1386f23.jpg?imwidth=768", "brand" => "H&M"],
    ["name" => "Trucker Jacket", "price" => 3098, "image" => "https://image.hm.com/assets/hm/0a/9a/0a9aaf85deb179479fee2545bcf476d74bc84f6f.jpg?imwidth=768", "brand" => "H&M"],
    ["name" => "T-Shirt", "price" => 599, "image" => "https://image.hm.com/assets/hm/75/8d/758d68c84b5ee59c09f8c001fe9b9807202ad3b3.jpg?imwidth=768", "brand" => "H&M"],
    ["name" => "Pants", "price" => 1099, "image" => "https://i.pinimg.com/736x/18/31/83/183183d2e3a24de375d3f8f0c792b7ff.jpg", "brand" => "H&M"],
    ["name" => "Flared Skirts", "price" => 1567, "image" => "https://i.pinimg.com/736x/47/48/76/47487679ee24578aef85feb97cb7b52a.jpg", "brand" => "H&M"],
    ["name" => "Graphic T-shirts", "price" => 1299, "image" => "https://i.pinimg.com/736x/fc/f4/e4/fcf4e4df59476b1f888a5944fbaf2af2.jpg", "brand" => "H&M"]
];

// Insert products
foreach ($hmProducts as $product) {
    $check_sql = "SELECT * FROM `hm_products` WHERE `name` = '".mysqli_real_escape_string($conn, $product['name'])."'";
    $check_result = mysqli_query($conn, $check_sql);
    
    if (mysqli_num_rows($check_result) == 0) {
        $sql = "INSERT INTO `hm_products` (`name`, `price`, `image`, `brand`) VALUES (
            '".mysqli_real_escape_string($conn, $product['name'])."', 
            ".intval($product['price']).", 
            '".mysqli_real_escape_string($conn, $product['image'])."',
            '".mysqli_real_escape_string($conn, $product['brand'])."')";
        
        if (!mysqli_query($conn, $sql)) {
            echo "Error inserting product: " . mysqli_error($conn) . "<br>";
        }
    }
}

// Fetch products
$result = mysqli_query($conn, "SELECT * FROM hm_products");
$dbProducts = [];
while ($row = mysqli_fetch_assoc($result)) {
    $dbProducts[] = $row;
}

mysqli_close($conn);

// Include header AFTER all processing
include '../../../includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>H&M Products</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .product-card {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: center;
            border-radius: 8px;
            background-color: #fff;
            margin-bottom: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .product-card img {
            max-width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        .product-card h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }
        .product-card .price {
            font-weight: bold;
            margin-bottom: 15px;
        }
        .brand-badge {
            background-color: #5a5441;
            color: white;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container" style="margin-top: 80px;">
        <h1 class="text-center mb-5">H&M Collection</h1>
        <div class="row">
            <?php foreach ($dbProducts as $product): ?>
                <div class="col-md-4 mb-4">
                    <div class="product-card h-100">
                        <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                        <h3><?= htmlspecialchars($product['name']) ?></h3>
                        <span class="brand-badge"><?= htmlspecialchars($product['brand']) ?></span>
                        <p class="price">₹<?= number_format($product['price'], 2) ?></p>
                        <form method="POST" action="/PROJECTT/anj/ShopQwik-main/ShopQwik/pages/cart.php" class="mt-auto">
                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                            <input type="hidden" name="name" value="<?= htmlspecialchars($product['name']) ?>">
                            <input type="hidden" name="price" value="<?= $product['price'] ?>">
                            <input type="hidden" name="image" value="<?= htmlspecialchars($product['image']) ?>">
                            <input type="hidden" name="brand" value="<?= htmlspecialchars($product['brand']) ?>">
                            <button type="submit" name="add_to_cart" class="btn btn-dark w-100">Add to Cart</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>

<?php include '../../../includes/footer.php'; ?>