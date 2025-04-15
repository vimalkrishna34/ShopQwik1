<?php
$brands = [
    "Apparel (Fashion)" => [
        ["name" => "H&M", "image" => "https://i.pinimg.com/736x/57/7e/07/577e0712b26a7f9ab959a9a0f44148c4.jpg", "price" => "Rs 299"],
        ["name" => "Levi's", "image" => "https://i.pinimg.com/736x/ee/63/37/ee63379d7c782a0f4484d532b616cb10.jpg", "price" => "Rs 499"],
        ["name" => "Tommy Hilfiger", "image" => "https://i.pinimg.com/736x/0b/b4/f1/0bb4f1b22c1a87598e69647051d0be26.jpg", "price" => "Rs 899"],
        ["name" => "United Colors of Benetton", "image" => "https://i.pinimg.com/736x/39/9b/f5/399bf539f57c11bfe889186cf3e528b7.jpg", "price" => "Rs 1299"],
        ["name" => "Calvin Klein Jeans", "image" => "https://i.pinimg.com/736x/95/84/5e/95845e277a65a54cf156615d5c6a499d.jpg", "price" => "Rs 599"],
        ["name" => "Vero Moda", "image" => "https://i.pinimg.com/736x/96/6b/2d/966b2dd57c3b5c3d5c315c7a39593afc.jpg", "price" => "Rs 799"]
    ],
    "Beauty & Personal Care" => [
        ["name" => "MAC", "image" => "https://i.pinimg.com/736x/49/b4/9c/49b49c36fd20a850d9b13026cc7f3a7c.jpg", "price" => "Rs 399"],
        ["name" => "Nykaa Luxe", "image" => "https://i.pinimg.com/736x/b6/81/66/b68166cf475aa56e31abe8bc45fcb6da.jpg", "price" => "Rs 999"],
        ["name" => "The Body Shop", "image" => "https://i.pinimg.com/736x/64/c2/2f/64c22f329538d382e255a3c825b097d2.jpg", "price" => "Rs 499"],
        ["name" => "Bath & Body Works", "image" => "https://i.pinimg.com/736x/d4/3f/6d/d43f6de5b64cd90092be7fa6b037ce72.jpg", "price" => "Rs 699"],
        ["name" => "Forest Essentials", "image" => "https://i.pinimg.com/736x/8d/6d/10/8d6d10573834f788d279db27adfbebe0.jpg", "price" => "Rs 899"],
        ["name" => "Victoria's Secret", "image" => "https://i.pinimg.com/736x/ec/db/a9/ecdba95c812c88739085d882f04ed6f5.jpg", "price" => "Rs 1299"]
    ],
    "Electronics & Appliances" => [
        ["name" => "Samsung", "image" => "https://i.pinimg.com/736x/2e/4d/a4/2e4da4a6d670b8d59c15f28853e895c3.jpg", "price" => "Rs 29999"],
        ["name" => "Reliance Digital", "image" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQUW51UZSXoUPzn_ojuaR5NrCcIO2nuHf8iZA&s", "price" => "Rs 19999"],
        ["name" => "Apple (Aptronix)", "image" => "https://i.pinimg.com/736x/60/6b/c0/606bc0717982547e555a514b479365a0.jpg", "price" => "Rs 89999"],
        ["name" => "Bose", "image" => "https://i.pinimg.com/736x/96/29/ef/9629efc8a4be4fd1600a9bb3940fd89c.jpg", "price" => "Rs 24999"],
        ["name" => "Dyson", "image" => "https://i.pinimg.com/736x/9d/d4/c3/9dd4c3fc4eee3bd124c787af1552e0b2.jpg", "price" => "Rs 34999"],
        ["name" => "Croma", "image" => "https://i.pinimg.com/736x/29/72/92/297292433b1a8929c9fc5ee0be2ae6a1.jpg", "price" => "Rs 14999"]
    ]
];

// Shuffle brands within each category
foreach ($brands as &$items) {
    shuffle($items);
}
unset($items); // Unset reference to prevent accidental overwriting
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inorbit Mall Hyderabad - ShopQwik</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #0066CC; /* Inorbit blue */
            --secondary-color: #FF6600; /* Inorbit orange */
            --light-bg: #F8F9FA;
            --dark-text: #333333;
            --light-text: #666666;
        }
        body {
            background-color: var(--light-bg);
            color: var(--dark-text);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px 0;
        }
        .back-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 30px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 30px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .back-btn:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
        .mall-header {
            text-align: center;
            margin-bottom: 40px;
            position: relative;
        }
        .mall-title {
            color: var(--primary-color);
            font-weight: 700;
            font-size: 2.5rem;
            margin-bottom: 15px;
        }
        .mall-subtitle {
            color: var(--light-text);
            font-size: 1.1rem;
            max-width: 700px;
            margin: 0 auto 25px;
        }
        .mall-title:after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: var(--secondary-color);
            margin: 15px auto;
        }
        .category-section {
            margin-bottom: 40px;
            padding: 25px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        .category-title {
            color: var(--primary-color);
            font-weight: 600;
            font-size: 1.8rem;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .category-title i {
            color: var(--secondary-color);
            font-size: 1.5rem;
        }
        .brand-card {
            background: white;
            border: none;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            height: 100%;
            margin-bottom: 20px;
        }
        .brand-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 25px rgba(0, 102, 204, 0.1);
        }
        .brand-img-container {
            background-color: #f8f9fa;
            padding: 15px;
            height: 220px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .brand-img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
        }
        .brand-body {
            padding: 20px;
            text-align: center;
        }
        .brand-name {
            color: var(--dark-text);
            font-weight: 600;
            font-size: 1.2rem;
            margin-bottom: 8px;
        }
        .brand-price {
            color: var(--primary-color);
            font-weight: bold;
            font-size: 1.1rem;
            margin-bottom: 15px;
        }
        .btn-explore {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 30px;
            font-weight: 500;
            transition: all 0.3s ease;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .btn-explore:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }
        @media (max-width: 768px) {
            .mall-title {
                font-size: 2rem;
            }
            .category-title {
                font-size: 1.5rem;
            }
            .brand-img-container {
                height: 180px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <button class="back-btn" onclick="window.history.back()">
            <i class="fas fa-chevron-left"></i> Back to Malls
        </button>
        
        <div class="mall-header">
            <h1 class="mall-title">Inorbit Mall Hyderabad</h1>
            <p class="mall-subtitle">Discover the best shopping experience with top international and national brands</p>
        </div>
        
        <?php foreach ($brands as $category => $items): ?>
            <div class="category-section">
                <h2 class="category-title">
                    <?php 
                    // Add appropriate icon for each category
                    if ($category == "Apparel (Fashion)") {
                        echo '<i class="fas fa-tshirt"></i>';
                    } elseif ($category == "Beauty & Personal Care") {
                        echo '<i class="fas fa-spa"></i>';
                    } else {
                        echo '<i class="fas fa-plug"></i>';
                    }
                    echo $category; 
                    ?>
                </h2>
                <div class="row">
                    <?php foreach ($items as $brand): ?>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="card brand-card h-100">
                                <div class="brand-img-container">
                                    <img src="<?php echo $brand['image']; ?>" class="brand-img" alt="<?php echo $brand['name']; ?>" onerror="this.src='images/placeholder.jpg';">
                                </div>
                                <div class="brand-body">
                                    <h5 class="brand-name"><?php echo $brand['name']; ?></h5>
                                    <p class="brand-price"><?php echo $brand['price']; ?></p>
                                    <button class="btn btn-explore">
                                        Explore <i class="fas fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scroll to top when page loads
        window.addEventListener('load', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>
</body>
</html>