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

// Create Apple products table if it doesn't exist
$createTableSql = "CREATE TABLE IF NOT EXISTS `apple_products` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(200) NOT NULL,
    `price` INT NOT NULL,
    `image` VARCHAR(400) NOT NULL,
    `brand` VARCHAR(50) NOT NULL DEFAULT 'Apple',
    PRIMARY KEY (`id`),
    UNIQUE KEY `product_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

if (!mysqli_query($conn, $createTableSql)) {
    die("Error creating table: " . mysqli_error($conn));
}

// Apple products data
$appleProducts = [
    ["name" => "iPhone 15 Pro", "price" => 75071, "image" => "https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/iphone-card-40-iphone16prohero-202409_FMT_WHH?wid=508&hei=472&fmt=p-jpg&qlt=95&.v=1725567599334", "brand" => "Apple"],
    ["name" => "MacBook Air", "price" => 103098, "image" => "https://www.apple.com/newsroom/images/product/mac/standard/Apple_16-inch-MacBook-Pro_111319_big.jpg.large.jpg", "brand" => "Apple"],
    ["name" => "AirPods", "price" => 60599, "image" => "https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/airpods-4-anc-select-202409_FV1_FMT_WHH?wid=752&hei=636&fmt=jpeg&qlt=90&.v=1725502553451", "brand" => "Apple"],
    ["name" => "iPhone 16", "price" => 150099, "image" => "https://www.imagineonline.store/cdn/shop/files/iPhone_16_Ultramarine_PDP_Image_Position_1__en-IN_be8b658c-2ab8-4796-9a8a-216864e1df03.jpg?v=1727247795", "brand" => "Apple"],
    ["name" => "Apple AirPods Max Wireless Headphones", "price" => 71567, "image" => "https://m.media-amazon.com/images/I/71TwqIMg7YL.jpg", "brand" => "Apple"],
    ["name" => "Apple iPad", "price" => 91299, "image" => "https://m.media-amazon.com/images/I/71z8blSlQQL.jpg", "brand" => "Apple"]
];

// Insert products with duplicate prevention
foreach ($appleProducts as $product) {
    // Ensure all required fields exist
    $product = array_merge([
        'name' => '',
        'price' => 0,
        'image' => '',
        'brand' => 'Apple'
    ], $product);

    // Use INSERT IGNORE to skip duplicates
    $sql = "INSERT IGNORE INTO `apple_products` (`name`, `price`, `image`, `brand`) VALUES (
        '".mysqli_real_escape_string($conn, $product['name'])."', 
        ".intval($product['price']).", 
        '".mysqli_real_escape_string($conn, $product['image'])."',
        '".mysqli_real_escape_string($conn, $product['brand'])."')";
    
    if (!mysqli_query($conn, $sql)) {
        echo "Error inserting product: " . mysqli_error($conn) . "<br>";
    }
}

// Fetch all products from database for display
$result = mysqli_query($conn, "SELECT * FROM apple_products");
$dbProducts = [];
while ($row = mysqli_fetch_assoc($result)) {
    // Ensure all fields exist
    $row['brand'] = $row['brand'] ?? 'Apple';
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
    <title>Apple Products</title>
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
            height: 100%;
            margin-bottom: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .product-card img {
            max-width: 100%;
            height: 200px;
            object-fit: contain;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .product-card h3 {
            font-size: 18px;
            min-height: 50px;
            margin-bottom: 10px;
            color: #333;
        }

        .product-card .price {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #333;
        }

        .product-card button {
            background-color: #000;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }

        .product-card button:hover {
            background-color: #333;
        }

        .brand-badge {
            background-color: #000;
            color: white;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 12px;
            margin-top: 5px;
            display: inline-block;
        }
        
        .page-title {
            text-align: center;
            margin-bottom: 40px;
            color: #000;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container" style="margin-top: 80px;">
    <h1 class="page-title">Apple Products Collection</h1>
    <div class="row">
        <?php foreach ($dbProducts as $product): ?>
            <?php 
            // Ensure all product fields exist
            $product['name'] = $product['name'] ?? '';
            $product['price'] = $product['price'] ?? 0;
            $product['image'] = $product['image'] ?? '';
            $product['brand'] = $product['brand'] ?? 'Apple';
            $product['id'] = $product['id'] ?? 0;
            ?>
            <div class="col-md-4">
                <div class="product-card">
                    <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                    <h3><?= htmlspecialchars($product['name']) ?></h3>
                    <span class="brand-badge"><?= htmlspecialchars($product['brand']) ?></span>
                    <p class="price">₹<?= number_format($product['price'], 2) ?></p>
                    <form method="POST" action="/PROJECTT/anj/ShopQwik-main/ShopQwik/pages/cart.php">
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                        <input type="hidden" name="name" value="<?= htmlspecialchars($product['name']) ?>">
                        <input type="hidden" name="price" value="<?= $product['price'] ?>">
                        <input type="hidden" name="image" value="<?= htmlspecialchars($product['image']) ?>">
                        <input type="hidden" name="brand" value="<?= htmlspecialchars($product['brand']) ?>">
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