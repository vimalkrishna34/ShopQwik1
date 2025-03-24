<?php include '../includes/header.php'; ?>
<?php include '../includes/arrays.php'; ?>

<?php
$product_id = $_GET['product_id'] ?? 0;
$product = array_filter($products, fn($p) => $p['product_id'] == $product_id);
$product = reset($product);

if ($product):
?>
    <h2><?= $product['name'] ?></h2>
    <p>Price: ₹<?= $product['price'] ?></p>
    <p><?= $product['description'] ?></p>
    <a href="cart.php?add=<?= $product['product_id'] ?>">Add to Cart</a>
<?php else: ?>
    <p>Product not found.</p>
<?php endif; ?>

<?php include '../includes/footer.php'; ?>
