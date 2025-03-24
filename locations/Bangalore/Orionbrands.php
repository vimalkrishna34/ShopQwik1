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
    <title>Inorbit Mall Brands</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f4f9;
            font-family: 'Arial', sans-serif;
            margin: 50px;
        }
        .card-img-top {
            height: 250px; /* Increased image size */
            width: 100%;
            object-fit: contain; /* Ensure images are not cropped */
            background-color: #f8f9fa; /* Fallback background color */
        }
        .card {
            margin-bottom: 1rem;
            border: none;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-body {
            padding: 1.5rem;
            text-align: center;
            background-color: #ffffff;
        }
        .card-text {
            font-size: 1.1rem;
            font-weight: bold;
            margin: 0.5rem 0;
            color: #333;
        }
        .price {
            color: #007bff;
            font-size: 1.25rem;
            font-weight: bold;
        }
        .btn-add {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            margin-top: 1rem;
        }
        .btn-add:hover {
            background-color: #218838;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        h1 {
            font-size: 2.5rem;
            margin-bottom: 2rem;
            text-align: center;
            color: #343a40;
        }
        h2 {
            font-size: 2rem;
            margin-bottom: 1.5rem;
            color: #495057;
        }
        .category-section {
            margin-bottom: 3rem;
            padding: 1rem;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Top Brands in Orion Mall Bangaluru</h1>
        <?php foreach ($brands as $category => $items): ?>
            <div class="category-section">
                <h2><?php echo $category; ?></h2>
                <div class="row">
                    <?php foreach ($items as $brand): ?>
                        <div class="col-md-3 mb-4">
                            <div class="card">
                                <img src="<?php echo $brand['image']; ?>" class="card-img-top" alt="<?php echo $brand['name']; ?>" onerror="this.src='images/placeholder.jpg';">
                                <div class="card-body">
                                    <p class="card-text"><?php echo $brand['name']; ?></p>
                                    <p class="price"><?php echo $brand['price']; ?></p>
                                    <button class="btn-add">Explore more</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>