<?php
include '../../includes/header.php';

$brands = [
    "Apparel (Fashion)" => [
<<<<<<< HEAD
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
=======
        ["name" => "H&M", "image" => "https://i.pinimg.com/736x/57/7e/07/577e0712b26a7f9ab959a9a0f44148c4.jpg", "price" => "Rs 299"],
        ["name" => "Levi's", "image" => "https://i.pinimg.com/736x/ee/63/37/ee63379d7c782a0f4484d532b616cb10.jpg", "price" => "Rs 499"],
        ["name" => "Tommy Hilfiger", "image" => "https://i.pinimg.com/736x/0b/b4/f1/0bb4f1b22c1a87598e69647051d0be26.jpg", "price" => "Rs 899"],
        ["name" => "Nike", "image" => "https://i.pinimg.com/736x/70/e7/8c/70e78cf8055014329bd034c8910a18f2.jpg", "price" => "Rs 599"],
        ["name" => "Adidas", "image" => "https://i.pinimg.com/736x/8b/7b/fa/8b7bfa40460a48aff5fa938fe7a553da.jpg", "price" => "Rs 799"],
        ["name" => "Puma", "image" => "https://i.pinimg.com/736x/66/f1/ed/66f1edd300d1f37b10f6922261313014.jpg", "price" => "Rs 399"],
    ],
    "Skincare" => [
        ["name" => "The Body Shop", "image" => "https://i.pinimg.com/736x/64/c2/2f/64c22f329538d382e255a3c825b097d2.jpg", "price" => "Rs 699"],
        ["name" => "Ordinary", "image" => "https://i.pinimg.com/736x/bd/57/fe/bd57fecc2efd21d5a34489034db24f26.jpg", "price" => "Rs 999"],
        ["name" => "Kama Ayurveda", "image" => "https://i.pinimg.com/736x/14/49/d9/1449d9610b87f237515ad706861b1fdf.jpg", "price" => "Rs 899"],
        ["name" => "L'Oreal", "image" => "https://i.pinimg.com/736x/c8/9b/28/c89b283f9f6f516ec6af70277279e930.jpg", "price" => "Rs 499"],
        ["name" => "Neutrogena", "image" => "https://i.pinimg.com/736x/99/ed/a2/99eda2e791bacce18724ffcb374d088e.jpg", "price" => "Rs 799"],
        ["name" => "Clinique", "image" => "https://i.pinimg.com/736x/26/fe/7b/26fe7bcfe8ecc1a578b1e98d5d2f1ba6.jpg", "price" => "Rs 1,099"],
    ],
    "Electronics" => [
        ["name" => "Sony", "image" => "https://i.pinimg.com/736x/f7/e9/11/f7e911d8e69e2c4a0ea8d4e750f5d2b8.jpg", "price" => "Rs 25,999"],
        ["name" => "Samsung", "image" => "https://i.pinimg.com/736x/f8/e3/4a/f8e34a4763987dcab1c15888cb0830d0.jpg", "price" => "Rs 12,999"],
        ["name" => "Bose", "image" => "https://i.pinimg.com/736x/5d/a9/c6/5da9c61c2fcd5b5adf9b45188b3e1092.jpg", "price" => "Rs 19,999"],
        ["name" => "Apple", "image" => "https://i.pinimg.com/736x/60/6b/c0/606bc0717982547e555a514b479365a0.jpg", "price" => "Rs 79,999"],
        ["name" => "Xiaomi", "image" => "https://i.pinimg.com/736x/69/ba/89/69ba89a243918800df9f551dc563d5ab.jpg", "price" => "Rs 9,999"],
        ["name" => "JBL", "image" => "https://i.pinimg.com/736x/d5/35/85/d53585d81a4c56d342b90d1d80589acc.jpg", "price" => "Rs 5,499"],
    ],
>>>>>>> 0121dbcfb33bc520c4ff1aba48f1b1e232d87ecd
];

foreach ($brands as &$items) {
    shuffle($items);
}
unset($items);
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
<<<<<<< HEAD
            background: linear-gradient(135deg,rgb(198, 178, 152),rgb(245, 212, 175));
=======
            background: linear-gradient(135deg, rgb(245, 239, 227), rgb(248, 242, 235));
>>>>>>> 0121dbcfb33bc520c4ff1aba48f1b1e232d87ecd
            font-family: 'Poppins', sans-serif;
            margin-top: 40px;
            padding: 50px;
        }
<<<<<<< HEAD
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
=======
        .scroll-container-wrapper {
            position: relative;
        }
        .scroll-container {
            display: flex;
            overflow-x: auto;
            scroll-behavior: smooth;
            gap: 20px;
            padding: 15px 0;
            white-space: nowrap;
            scrollbar-width: none;
        }
        .scroll-container::-webkit-scrollbar {
            display: none;
        }
        .card {
            min-width: 250px;
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            padding: 10px;
            text-align: center;
            transition: transform 0.3s;
        }
        .card:hover {
            transform: scale(1.05);
>>>>>>> 0121dbcfb33bc520c4ff1aba48f1b1e232d87ecd
        }
        .card-img-top {
            height: 180px;
            object-fit: contain;
            border-radius: 5px;
        }
        .category-title {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: rgb(85, 83, 83);
            text-align: left;
        }
        .scroll-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.6);
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 24px;
            border-radius: 50%;
            z-index: 10;
            transition: background 0.3s;
        }
<<<<<<< HEAD
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
=======
        .scroll-btn:hover {
            background: rgba(0, 0, 0, 0.8);
        }
        .scroll-left {
            left: -30px;
        }
        .scroll-right {
            right: -30px;
        }
        .custom-btn {
    background-color:rgb(133, 111, 74) !important; /* Change to any color */
    border-color:rgb(146, 117, 64) !important;
    color: white !important;
}
.custom-btn:hover {
    background-color:rgb(61, 52, 29) !important; /* Darker shade on hover */
}

        @media (max-width: 768px) {
            .scroll-btn {
                display: none;
            }
>>>>>>> 0121dbcfb33bc520c4ff1aba48f1b1e232d87ecd
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
        <h1 class="text-center mb-4">Inorbit Mall Brands</h1>

        <?php foreach ($brands as $category => $items): ?>
            <h2 class="category-title"><?= $category ?></h2>
            <div class="scroll-container-wrapper">
                <button class="scroll-btn scroll-left" onclick="scrollLeft('<?= str_replace(' ', '_', $category) ?>')">&#10094;</button>
                <div class="scroll-container" id="<?= str_replace(' ', '_', $category) ?>">
                    <?php foreach ($items as $brand): ?>
<<<<<<< HEAD
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
=======
                        <div class="card">
                            <img src="<?= $brand['image'] ?>" class="card-img-top" alt="<?= $brand['name'] ?>">
                            <h5 class="card-title"><?= $brand['name'] ?></h5>
                            <p class="price"><?= $brand['price'] ?></p>
                            <a href="/Projectt/anj/ShopQwik-main/ShopQwik/locations/delhi/levis.php" class="btn custom-btn">Explore More</a>
>>>>>>> 0121dbcfb33bc520c4ff1aba48f1b1e232d87ecd
                        </div>
                    <?php endforeach; ?>
                </div>
                <button class="scroll-btn scroll-right" onclick="scrollRight('<?= str_replace(' ', '_', $category) ?>')">&#10095;</button>
            </div>
        <?php endforeach; ?>
    </div>

    <script>
        function scrollLeft(containerId) {
            const container = document.getElementById(containerId);
            container.scrollBy({ left: -300, behavior: 'smooth' });
        }

        function scrollRight(containerId) {
            const container = document.getElementById(containerId);
            container.scrollBy({ left: 300, behavior: 'smooth' });
        }
    </script>
</body>
</html>