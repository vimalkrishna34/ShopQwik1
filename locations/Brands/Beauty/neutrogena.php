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

// Create Neutrogena products table if it doesn't exist
$createTableSql = "CREATE TABLE IF NOT EXISTS `neutrogena_products` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(200) NOT NULL,
    `price` INT NOT NULL,
    `image` VARCHAR(400) NOT NULL,
    `brand` VARCHAR(50) NOT NULL DEFAULT 'Neutrogena',
    PRIMARY KEY (`id`),
    UNIQUE KEY `product_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

if (!mysqli_query($conn, $createTableSql)) {
    die("Error creating table: " . mysqli_error($conn));
}

// Neutrogena products data
$neutrogenaProducts = [
    ["name" => "Moisturizing Cream", "price" => 1299, "image" => "https://m.media-amazon.com/images/I/71kq8bqJnFL.jpg", "brand" => "Neutrogena"],
    ["name" => "Oil Free Acne Face Wash", "price" => 899, "image" => "https://images.ctfassets.net/aub2fvcyp2t8/6VC8vvmJIlvWJ0hxWdxDOj/c65c7d4cec0e00e11659a0940f11cfe5/oil_free_acne_wash_175ml-min-en-in", "brand" => "Neutrogena"],
    ["name" => "Neutrogena Sunscreen", "price" => 599, "image" => "https://m.media-amazon.com/images/I/419OyAFefYL.jpg", "brand" => "Neutrogena"],
    ["name" => "Neutrogena Hydro Boost", "price" => 799, "image" => "https://images.ctfassets.net/xvcg1y2kwpfh/5DVHhZ5u2JMbNrjWA42E1q/9fceb49f8f057d63131345cc8ec8c690/Hydro_BoostWater_Gel_Moisturiser-en-ae", "brand" => "Neutrogena"],
    ["name" => "Eye Cream", "price" => 299, "image" => "https://images.ctfassets.net/xvcg1y2kwpfh/5EwaNtkoXQMFUMln3dkWj2/df5acad2be4b746f55149a76a59c0bfe/Hydro_Boost_Eye-Refreshing_Gel_Cream-en-ae", "brand" => "Neutrogena"],
    ["name" => "Face Serum", "price" => 499, "image" => "https://m.media-amazon.com/images/I/51+rZQwPepL.jpg", "brand" => "Neutrogena"]
];

// Insert products with duplicate prevention
foreach ($neutrogenaProducts as $product) {
    // Ensure all required fields exist
    $product = array_merge([
        'name' => '',
        'price' => 0,
        'image' => '',
        'brand' => 'Neutrogena'
    ], $product);

    // Use INSERT IGNORE to skip duplicates
    $sql = "INSERT IGNORE INTO `neutrogena_products` (`name`, `price`, `image`, `brand`) VALUES (
        '".mysqli_real_escape_string($conn, $product['name'])."', 
        ".intval($product['price']).", 
        '".mysqli_real_escape_string($conn, $product['image'])."',
        '".mysqli_real_escape_string($conn, $product['brand'])."')";
    
    if (!mysqli_query($conn, $sql)) {
        echo "Error inserting product: " . mysqli_error($conn) . "<br>";
    }
}

// Fetch all products from database for display
$result = mysqli_query($conn, "SELECT * FROM neutrogena_products");
$dbProducts = [];
while ($row = mysqli_fetch_assoc($result)) {
    // Ensure all fields exist
    $row['brand'] = $row['brand'] ?? 'Neutrogena';
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
    <title>Neutrogena Skincare Products</title>
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
            color: #e53935;
        }

        .product-card button {
            background-color: #0077b6;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }

        .product-card button:hover {
            background-color: #023e8a;
        }

        .brand-badge {
            background-color: #0077b6;
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
            color: #0077b6;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container" style="margin-top: 80px;">
    <h1 class="page-title">Neutrogena Skincare Collection</h1>
    <div class="row">
        <?php foreach ($dbProducts as $product): ?>
            <?php 
            // Ensure all product fields exist
            $product['name'] = $product['name'] ?? '';
            $product['price'] = $product['price'] ?? 0;
            $product['image'] = $product['image'] ?? '';
            $product['brand'] = $product['brand'] ?? 'Neutrogena';
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