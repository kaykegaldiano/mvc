<?php require __DIR__ . '/../head.php'; ?>

<h1><?= $title ?></h1>
        
<form method="post" action="/save-product<?= $product->getId() ? '?id=' . $product->getId() : ''; ?>" class="row g-3 pt-2">
            
    <div class="col-12">
        <div class="form-floating">
            <input type="text" class="form-control" name="name" placeholder="Insert product name" value="<?= $product->getName() ?? '' ?>" autocomplete="off" required>
            <label>Insert product name</label>
        </div>
    </div>

    <div class="col-12 col-md-6">
        <button type="submit" class="btn btn-lg btn-primary w-100">Save</button>
    </div>
        
    <div class="col-12 col-md-6">
        <a href="/list-products" class="btn btn-lg btn-secondary w-100">Go back</a>
    </div>

</form>

<?php require __DIR__ . '/../bottom.php'; ?>