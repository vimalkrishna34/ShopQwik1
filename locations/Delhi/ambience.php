<?php
include '../../includes/header.php';

$brands = [
    "Apparel (Fashion)" => [
        ["name" => "H&M", "image" => "https://i.pinimg.com/736x/57/7e/07/577e0712b26a7f9ab959a9a0f44148c4.jpg", "price" => "Rs 299", "page" => "/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Brands/HnM.php"],
        ["name" => "Levi's", "image" => "https://i.pinimg.com/736x/ee/63/37/ee63379d7c782a0f4484d532b616cb10.jpg", "price" => "Rs 499", "page" => "/PROJECTT/anj/ShopQwik-main/ShopQwik/locations/Brands/Fashion/Levis.php"],
        ["name" => "Tommy Hilfiger", "image" => "https://i.pinimg.com/736x/0b/b4/f1/0bb4f1b22c1a87598e69647051d0be26.jpg", "price" => "Rs 899", "page" => "tommy_hilfiger.php"],
        ["name" => "Nike", "image" => "https://i.pinimg.com/736x/70/e7/8c/70e78cf8055014329bd034c8910a18f2.jpg", "price" => "Rs 599", "page" => "nike.php"],
        ["name" => "Adidas", "image" => "https://i.pinimg.com/736x/8b/7b/fa/8b7bfa40460a48aff5fa938fe7a553da.jpg", "price" => "Rs 799", "page" => "adidas.php"],
        ["name" => "Puma", "image" => "https://i.pinimg.com/736x/66/f1/ed/66f1edd300d1f37b10f6922261313014.jpg", "price" => "Rs 399", "page" => "puma.php"],
    ],
    "Skincare" => [
        ["name" => "The Body Shop", "image" => "https://i.pinimg.com/736x/64/c2/2f/64c22f329538d382e255a3c825b097d2.jpg", "price" => "Rs 699", "page" => "body_shop.php"],
        ["name" => "Ordinary", "image" => "https://i.pinimg.com/736x/bd/57/fe/bd57fecc2efd21d5a34489034db24f26.jpg", "price" => "Rs 999", "page" => "ordinary.php"],
        ["name" => "Kama Ayurveda", "image" => "https://i.pinimg.com/736x/14/49/d9/1449d9610b87f237515ad706861b1fdf.jpg", "price" => "Rs 899", "page" => "kama_ayurveda.php"],
        ["name" => "L'Oreal", "image" => "https://i.pinimg.com/736x/c8/9b/28/c89b283f9f6f516ec6af70277279e930.jpg", "price" => "Rs 499", "page" => "loreal.php"],
        ["name" => "Neutrogena", "image" => "https://i.pinimg.com/736x/99/ed/a2/99eda2e791bacce18724ffcb374d088e.jpg", "price" => "Rs 799", "page" => "neutrogena.php"],
        ["name" => "Clinique", "image" => "https://i.pinimg.com/736x/26/fe/7b/26fe7bcfe8ecc1a578b1e98d5d2f1ba6.jpg", "price" => "Rs 1,099", "page" => "clinique.php"],
    ],
    "Electronics" => [
        ["name" => "Sony", "image" => "https://i.pinimg.com/736x/f7/e9/11/f7e911d8e69e2c4a0ea8d4e750f5d2b8.jpg", "price" => "Rs 25,999", "page" => "sony.php"],
        ["name" => "Samsung", "image" => "https://i.pinimg.com/736x/f8/e3/4a/f8e34a4763987dcab1c15888cb0830d0.jpg", "price" => "Rs 12,999", "page" => "samsung.php"],
        ["name" => "Bose", "image" => "https://i.pinimg.com/736x/5d/a9/c6/5da9c61c2fcd5b5adf9b45188b3e1092.jpg", "price" => "Rs 19,999", "page" => "bose.php"],
        ["name" => "Apple", "image" => "https://i.pinimg.com/736x/60/6b/c0/606bc0717982547e555a514b479365a0.jpg", "price" => "Rs 79,999", "page" => "apple.php"],
        ["name" => "Xiaomi", "image" => "https://i.pinimg.com/736x/69/ba/89/69ba89a243918800df9f551dc563d5ab.jpg", "price" => "Rs 9,999", "page" => "xiaomi.php"],
        ["name" => "JBL", "image" => "https://i.pinimg.com/736x/d5/35/85/d53585d81a4c56d342b90d1d80589acc.jpg", "price" => "Rs 5,499", "page" => "jbl.php"],
    ],
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
    <title>Ambience Mall Brands</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, rgb(245, 239, 227), rgb(248, 242, 235));
            font-family: 'Poppins', sans-serif;
            margin-top: 40px;
            padding: 50px;
        }
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
            cursor: pointer;
        }
        .card:hover {
            transform: scale(1.05);
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
            background-color: rgb(133, 111, 74) !important;
            border-color: rgb(146, 117, 64) !important;
            color: white !important;
        }
        .custom-btn:hover {
            background-color: rgb(61, 52, 29) !important;
        }
        .back-btn {
            background-color: rgb(133, 111, 74);
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 5px;
            font-size: 1rem;
            margin-right: 15px;
            transition: background-color 0.3s;
        }
        .back-btn:hover {
            background-color: rgb(61, 52, 29);
        }
        .header-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
            position: relative;
        }
        .back-btn-container {
            position: absolute;
            left: 0;
        }

        @media (max-width: 768px) {
            .scroll-btn {
                display: none;
            }
            .header-container {
                flex-direction: column;
                align-items: flex-start;
            }
            .back-btn-container {
                position: static;
                margin-bottom: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header-container">
            <div class="back-btn-container">
                <button class="back-btn" onclick="goBack()">← Back</button>
            </div>
            <h1 class="text-center mb-4">Ambience Mall Brands</h1>
        </div>

        <?php foreach ($brands as $category => $items): ?>
            <h2 class="category-title"><?= $category ?></h2>
            <div class="scroll-container-wrapper">
                <button class="scroll-btn scroll-left" onclick="scrollLeft('<?= str_replace(' ', '_', $category) ?>')">&#10094;</button>
                <div class="scroll-container" id="<?= str_replace(' ', '_', $category) ?>">
                    <?php foreach ($items as $brand): ?>
                        <div class="card" onclick="window.location.href='<?= $brand['page'] ?>'">
                            <img src="<?= $brand['image'] ?>" class="card-img-top" alt="<?= $brand['name'] ?>">
                            <h5 class="card-title"><?= $brand['name'] ?></h5>
                            <p class="price"><?= $brand['price'] ?></p>
                            <a href="<?= $brand['page'] ?>" class="btn custom-btn">Explore More</a>
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
        
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>