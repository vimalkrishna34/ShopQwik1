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

// Create Sony products table if it doesn't exist
$createTableSql = "CREATE TABLE IF NOT EXISTS `sony_products` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(200) NOT NULL,
    `price` INT NOT NULL,
    `image` VARCHAR(400) NOT NULL,
    `brand` VARCHAR(50) NOT NULL DEFAULT 'Sony',
    PRIMARY KEY (`id`),
    UNIQUE KEY `product_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

if (!mysqli_query($conn, $createTableSql)) {
    die("Error creating table: " . mysqli_error($conn));
}

// Sony products data
$sonyProducts = [
    ["name" => "Sony Noise-Canceling Headphones", "price" => 5071, "image" => "https://m.media-amazon.com/images/I/61oqO1AMbdL.jpg", "brand" => "Sony"],
    ["name" => "Sony A7R V Mirrorless Camera", "price" => 103098, "image" => "https://fotocentreindia.com/wp-content/uploads/Sony-A7R-V-Mirrorless-Camera-Body-Only-Online-Buy-India_1.jpg", "brand" => "Sony"],
    ["name" => "TV 65 BRAVIA 3 | 4K HDR Processor X1", "price" => 160599, "image" => "https://vasanthandco.in/UploadedFiles/productimages/20240911122536-Untitled-1.png", "brand" => "Sony"],
    ["name" => "SONY LED TV 32W830K", "price" => 150099, "image" => "https://www.rajanandco.in/pub/media/catalog/product/cache/b2b3ac1ef1a04b817c00e4f06dc68c15/w/8/w830-02.jpg", "brand" => "Sony"],
    ["name" => "Sony Alpha a7C Mirrorless Camera with 28-60mm Lens", "price" => 171567, "image" => "https://x.imastudent.com/content/0021822_sony-alpha-a7c-mirrorless-camera-with-28-60mm-lens_500.jpeg", "brand" => "Sony"],
    ["name" => "Sony Ultra Portable Bluetooth Speaker", "price" => 7299, "image" => "https://m.media-amazon.com/images/I/71mq+2EjRfL.jpg", "brand" => "Sony"]
];

// Insert products with duplicate prevention
foreach ($sonyProducts as $product) {
    // Ensure all required fields exist
    $product = array_merge([
        'name' => '',
        'price' => 0,
        'image' => '',
        'brand' => 'Sony'
    ], $product);

    // Use INSERT IGNORE to skip duplicates
    $sql = "INSERT IGNORE INTO `sony_products` (`name`, `price`, `image`, `brand`) VALUES (
        '".mysqli_real_escape_string($conn, $product['name'])."', 
        ".intval($product['price']).", 
        '".mysqli_real_escape_string($conn, $product['image'])."',
        '".mysqli_real_escape_string($conn, $product['brand'])."')";
    
    if (!mysqli_query($conn, $sql)) {
        echo "Error inserting product: " . mysqli_error($conn) . "<br>";
    }
}

// Fetch all products from database for display
$result = mysqli_query($conn, "SELECT * FROM sony_products");
$dbProducts = [];
while ($row = mysqli_fetch_assoc($result)) {
    // Ensure all fields exist
    $row['brand'] = $row['brand'] ?? 'Sony';
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
    <title>Sony Electronics</title>
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
            background-color: #0066cc;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }

        .product-card button:hover {
            background-color: #004d99;
        }

        .brand-badge {
            background-color: #0066cc;
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
            color: #0066cc;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container" style="margin-top: 80px;">
    <h1 class="page-title">Sony Electronics Collection</h1>
    <div class="row">
        <?php foreach ($dbProducts as $product): ?>
            <?php 
            // Ensure all product fields exist
            $product['name'] = $product['name'] ?? '';
            $product['price'] = $product['price'] ?? 0;
            $product['image'] = $product['image'] ?? '';
            $product['brand'] = $product['brand'] ?? 'Sony';
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