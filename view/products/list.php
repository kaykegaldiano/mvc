<?php require __DIR__ . '/../head.php'; ?>

<div class="d-flex align-items-center justify-content-between">
    <h1><?= $title ?></h1>
    <a href="/new-product" class="btn btn-primary">Register Product</a>
</div>

<ul class="list-group">
    <?php foreach ($products as $product): ?>
        <li class="list-group-item d-flex align-items-center justify-content-between">
            <?= $product->getName() ?>
            <span>
                <a href="/edit-product?id=<?= $product->getId(); ?>" class="btn btn-sm btn-info">Edit</a>
                <a href="/remove-product?id=<?= $product->getId(); ?>" class="btn btn-sm btn-danger">Remove</a>
            </span>
        </li>
    <?php endforeach; ?>
</ul>

<?php require __DIR__ . '/../bottom.php'; ?>