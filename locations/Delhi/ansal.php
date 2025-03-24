<?php
$brands = [
    "Apparel (Fashion)" => [
        ["name" => "H&M", "image" => "https://i.pinimg.com/736x/57/7e/07/577e0712b26a7f9ab959a9a0f44148c4.jpg", "price" => "Rs 299", "page" => "HnM.php"],
        ["name" => "Levi's", "image" => "https://i.pinimg.com/736x/ee/63/37/ee63379d7c782a0f4484d532b616cb10.jpg", "price" => "Rs 499", "page" => "levis.php"],
        ["name" => "Tommy Hilfiger", "image" => "https://i.pinimg.com/736x/0b/b4/f1/0bb4f1b22c1a87598e69647051d0be26.jpg", "price" => "Rs 899", "page" => "tommy.php"],
        ["name" => "United Colors of Benetton", "image" => "https://i.pinimg.com/736x/39/9b/f5/399bf539f57c11bfe889186cf3e528b7.jpg", "price" => "Rs 1299", "page" => "benetton.php"],
        ["name" => "Calvin Klein Jeans", "image" => "https://i.pinimg.com/736x/95/84/5e/95845e277a65a54cf156615d5c6a499d.jpg", "price" => "Rs 599", "page" => "calvin.php"],
        ["name" => "Vero Moda", "image" => "https://i.pinimg.com/736x/96/6b/2d/966b2dd57c3b5c3d5c315c7a39593afc.jpg", "price" => "Rs 799", "page" => "veromoda.php"]
    ],
    "Beauty & Personal Care" => [
        ["name" => "MAC", "image" => "https://i.pinimg.com/736x/49/b4/9c/49b49c36fd20a850d9b13026cc7f3a7c.jpg", "price" => "Rs 399", "page" => "mac.php"],
        ["name" => "Nykaa Luxe", "image" => "https://i.pinimg.com/736x/b6/81/66/b68166cf475aa56e31abe8bc45fc6bda.jpg", "price" => "Rs 999", "page" => "nykaa.php"],
        ["name" => "The Body Shop", "image" => "https://i.pinimg.com/736x/64/c2/2f/64c22f329538d382e255a3c825b097d2.jpg", "price" => "Rs 499", "page" => "bodyshop.php"],
        ["name" => "Bath & Body Works", "image" => "https://i.pinimg.com/736x/d4/3f/6d/d43f6de5b64cd90092be7fa6b037ce72.jpg", "price" => "Rs 699", "page" => "bathbody.php"],
        ["name" => "Forest Essentials", "image" => "https://i.pinimg.com/736x/8d/6d/10/8d6d10573834f788d279db27adfbebe0.jpg", "price" => "Rs 899", "page" => "forest.php"],
        ["name" => "Victoria's Secret", "image" => "https://i.pinimg.com/736x/ec/db/a9/ecdba95c812c88739085d882f04ed6f5.jpg", "price" => "Rs 1299", "page" => "victoria.php"]
    ],
    "Electronics & Appliances" => [
        ["name" => "Samsung", "image" => "https://i.pinimg.com/736x/2e/4d/a4/2e4da4a6d670b8d59c15f28853e895c3.jpg", "price" => "Rs 29999", "page" => "samsung.php"],
        ["name" => "Reliance Digital", "image" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQUW51UZSXoUPzn_ojuaR5NrCcIO2nuHf8iZA&s", "price" => "Rs 19999", "page" => "reliancedigital.php"],
        ["name" => "Apple (Aptronix)", "image" => "https://i.pinimg.com/736x/60/6b/c0/606bc0717982547e555a514b479365a0.jpg", "price" => "Rs 89999", "page" => "apple.php"],
        ["name" => "Bose", "image" => "https://i.pinimg.com/736x/96/29/ef/9629efc8a4be4fd1600a9bb3940fd89c.jpg", "price" => "Rs 24999", "page" => "bose.php"],
        ["name" => "Dyson", "image" => "https://i.pinimg.com/736x/9d/d4/c3/9dd4c3fc4eee3bd124c787af1552e0b2.jpg", "price" => "Rs 34999", "page" => "dyson.php"],
        ["name" => "Croma", "image" => "https://i.pinimg.com/736x/29/72/92/297292433b1a8929c9fc5ee0be2ae6a1.jpg", "price" => "Rs 14999", "page" => "croma.php"]
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
    <title>Inorbit Mall Brands</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg,rgb(198, 178, 152),rgb(245, 212, 175));
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 50px;
        }
        .card-container {
            height: 100%;
            display: flex;
            flex-direction: column;
            cursor: pointer;
            transition: transform 0.3s;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            background-color: rgb(241, 212, 162);
        }
        .card-container:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }
        .card-img-top {
            height: 250px;
            width: 100%;
            object-fit: contain;
            background-color: #fff8e7;
            padding: 15px;
        }
        .card-body {
            padding: 1.5rem;
            text-align: center;
            background-color: #ffffff;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .card-text {
            font-size: 1.2rem;
            font-weight: 600;
            margin: 0.5rem 0;
            color: #5a4a42;
        }
        .price {
            color: #d4a373;
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        h1 {
            font-size: 3rem;
            margin-bottom: 2rem;
            text-align: center;
            color: #5a4a42;
            font-family: 'Playfair Display', serif;
        }
        h2 {
            font-size: 2.2rem;
            margin-bottom: 1.5rem;
            color: #5a4a42;
            font-family: 'Playfair Display', serif;
        }
        .category-section {
            margin-bottom: 3rem;
            padding: 2rem;
            background-color: rgb(231, 214, 188);
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
        }
        .col-md-3 {
            flex: 0 0 calc(25% - 1.5rem);
            max-width: calc(25% - 1.5rem);
        }
        .brand-link {
            text-decoration: none;
            color: inherit;
            display: block;
            height: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Top Brands in Ansal Mall Delhi</h1>
        <?php foreach ($brands as $category => $items): ?>
            <div class="category-section">
                <h2><?php echo $category; ?></h2>
                <div class="row">
                    <?php foreach ($items as $brand): ?>
                        <div class="col-md-3 mb-4">
                            <a href="<?php echo $brand['page']; ?>" class="brand-link">
                                <div class="card-container">
                                    <img src="<?php echo $brand['image']; ?>" class="card-img-top" alt="<?php echo $brand['name']; ?>" onerror="this.src='images/placeholder.jpg';">
                                    <div class="card-body">
                                        <p class="card-text"><?php echo $brand['name']; ?></p>
                                        <p class="price"><?php echo $brand['price']; ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>