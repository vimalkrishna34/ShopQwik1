<?php include '../includes/header.php'; ?>
<?php include '../includes/arrays.php'; ?>

<?php
$mall_id = $_GET['mall_id'] ?? 0;
echo "<h2>Products in Selected Mall</h2>";

foreach ($shops as $shop) {
    if ($shop['mall_id'] == $mall_id) {
        echo "<h3>{$shop['name']}</h3>";

        foreach ($products as $product) {
            if ($product['shop_id'] == $shop['shop_id']) {
                echo "<p><a href='product_details.php?product_id={$product['product_id']}'>{$product['name']} - ₹{$product['price']}</a></p>";
            }
        }
    }
}
?>

<?php include '../includes/footer.php'; ?>
