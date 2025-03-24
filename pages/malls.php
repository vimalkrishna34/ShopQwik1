<?php include '../includes/arrays.php'; ?>

<h2>Select Mall</h2>
<ul>
    <?php foreach ($malls as $mall): ?>
        <li>
            <a href="products.php?mall_id=<?= $mall['mall_id'] ?>">
                <?= $mall['name'] ?> - <?= $mall['location'] ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>

<?php include '../includes/footer.php'; ?>
