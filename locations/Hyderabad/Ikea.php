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
    <title>IKEA Mall Hyderabad - ShopQwik</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #0058AB; /* IKEA blue */
            --secondary-color: #FFDA1A; /* IKEA yellow */
            --light-bg: #F5F5F5;
            --accent-color: #333333;
        }
        body {
            background-color: var(--light-bg);
            color: var(--accent-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 20px;
        }
        .back-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 30px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        .back-btn:hover {
            background-color: var(--accent-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .mall-title {
            color: var(--primary-color);
            font-weight: 700;
            font-size: 2.2rem;
            margin-bottom: 1.5rem;
            text-align: center;
            position: relative;
            padding-bottom: 15px;
        }
        .mall-title:after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: 0;
            width: 80px;
            height: 4px;
            background: var(--secondary-color);
            transform: translateX(-50%);
        }
        .category-section {
            margin-bottom: 3rem;
            padding: 1.5rem;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 88, 171, 0.1);
        }
        .category-title {
            color: var(--primary-color);
            font-weight: 600;
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            border-bottom: 2px solid var(--secondary-color);
            padding-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .category-title i {
            color: var(--secondary-color);
        }
        .brand-card {
            background: white;
            border: none;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            height: 100%;
            border: 1px solid rgba(0, 88, 171, 0.1);
        }
        .brand-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 88, 171, 0.1);
        }
        .brand-img {
            height: 200px;
            object-fit: contain;
            width: 100%;
            padding: 15px;
            background-color: #f8f9fa;
        }
        .brand-name {
            color: var(--accent-color);
            font-weight: 600;
            font-size: 1.1rem;
            margin: 0.5rem 0;
        }
        .brand-price {
            color: var(--primary-color);
            font-weight: bold;
            font-size: 1.1rem;
        }
        .btn-explore {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 30px;
            font-weight: 500;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .btn-explore:hover {
            background-color: var(--accent-color);
            transform: translateY(-2px);
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }
        .ikea-banner {
            background-color: var(--primary-color);
            color: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .ikea-banner i {
            font-size: 2rem;
            color: var(--secondary-color);
        }
        @media (max-width: 768px) {
            .mall-title {
                font-size: 1.8rem;
            }
            .category-title {
                font-size: 1.5rem;
            }
            .brand-img {
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
        
        <div class="ikea-banner">
            <i class="fas fa-store-alt"></i>
            <div>
                <h2 style="margin: 0; color: white;">IKEA Hyderabad</h2>
                <p style="margin: 5px 0 0; opacity: 0.9;">Swedish home furnishings and more</p>
            </div>
        </div>
        
        <h1 class="mall-title">Featured Brands at IKEA</h1>
        
        <?php foreach ($brands as $category => $items): ?>
            <div class="category-section">
                <h2 class="category-title">
                    <?php 
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
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="card brand-card h-100">
                                <img src="<?php echo $brand['image']; ?>" class="card-img-top brand-img" alt="<?php echo $brand['name']; ?>" onerror="this.src='images/placeholder.jpg';">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="brand-name"><?php echo $brand['name']; ?></h5>
                                    <p class="brand-price"><?php echo $brand['price']; ?></p>
                                    <button class="btn btn-explore mt-auto">
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