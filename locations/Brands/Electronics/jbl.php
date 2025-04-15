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

// Create JBL products table if it doesn't exist
$createTableSql = "CREATE TABLE IF NOT EXISTS `jbl_products` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(200) NOT NULL,
    `price` INT NOT NULL,
    `image` VARCHAR(400) NOT NULL,
    `brand` VARCHAR(50) NOT NULL DEFAULT 'JBL',
    PRIMARY KEY (`id`),
    UNIQUE KEY `product_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

if (!mysqli_query($conn, $createTableSql)) {
    die("Error creating table: " . mysqli_error($conn));
}

// JBL products data
$jblProducts = [
    ["name" => "JBL QuietComfort 45 Wireless Headphones", "price" => 5071, "image" => "https://m.media-amazon.com/images/I/51JNhjr4McL.jpg", "brand" => "JBL"],
    ["name" => "JBL Max Portable Bluetooth Speaker", "price" => 3098, "image" => "https://m.media-amazon.com/images/I/71N8si9jomL.jpg", "brand" => "JBL"],
    ["name" => "JBL SoundLink Flex - Bluetooth Speaker", "price" => 1599, "image" => "https://dailydeals365.in/wp-content/uploads/2024/05/jbl-go-esstinal-red.webp", "brand" => "JBL"],
    ["name" => "JBL Noise Cancelling Earbuds", "price" => 2099, "image" => "https://oxygendigitalshop.com/media/cache/2500x0/catalog/product/1/0/1031154-1_1654597576.webp", "brand" => "JBL"],
    ["name" => "JBL Speaker", "price" => 13567, "image" => "https://kh.jbl.com/dw/image/v2/AAUJ_PRD/on/demandware.static/-/Sites-masterCatalog_Harman/default/dw291f5534/JBL_PARTYBOX_STAGE_320_HERO_2_47988_x3.jpg?sw=299&sh=299&sm=fit&sfrm=png", "brand" => "JBL"],
    ["name" => "JBL Live Beam 3 Closed-Stick Earbuds", "price" => 1299, "image" => "https://computechstore.in/wp-content/uploads/2024/06/JBL-Live-Beam-3-3.jpg", "brand" => "JBL"]
];

// Insert products with duplicate prevention
foreach ($jblProducts as $product) {
    // Ensure all required fields exist
    $product = array_merge([
        'name' => '',
        'price' => 0,
        'image' => '',
        'brand' => 'JBL'
    ], $product);

    // Use INSERT IGNORE to skip duplicates
    $sql = "INSERT IGNORE INTO `jbl_products` (`name`, `price`, `image`, `brand`) VALUES (
        '".mysqli_real_escape_string($conn, $product['name'])."', 
        ".intval($product['price']).", 
        '".mysqli_real_escape_string($conn, $product['image'])."',
        '".mysqli_real_escape_string($conn, $product['brand'])."')";
    
    if (!mysqli_query($conn, $sql)) {
        echo "Error inserting product: " . mysqli_error($conn) . "<br>";
    }
}

// Fetch all products from database for display
$result = mysqli_query($conn, "SELECT * FROM jbl_products");
$dbProducts = [];
while ($row = mysqli_fetch_assoc($result)) {
    // Ensure all fields exist
    $row['brand'] = $row['brand'] ?? 'JBL';
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
    <title>JBL Audio Products</title>
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
            background-color: #ff5500;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }

        .product-card button:hover {
            background-color: #cc4400;
        }

        .brand-badge {
            background-color: #ff5500;
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
            color: #ff5500;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container" style="margin-top: 80px;">
    <h1 class="page-title">JBL Audio Collection</h1>
    <div class="row">
        <?php foreach ($dbProducts as $product): ?>
            <?php 
            // Ensure all product fields exist
            $product['name'] = $product['name'] ?? '';
            $product['price'] = $product['price'] ?? 0;
            $product['image'] = $product['image'] ?? '';
            $product['brand'] = $product['brand'] ?? 'JBL';
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