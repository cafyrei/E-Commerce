<?php

use App\Models\UserModel;

$sess = session();

$user = null;
if ($sess->has('user_id')) {
    $model = new UserModel();
    $user = $model->find($sess->get('user_id'));
}
?>

<?php
$categories = ["Bedroom", "Living Room", "Dining Room", "Home Office", "Kitchen"];
$types = ["Chairs", "Beds", "Shelving", "Desks", "Wardrobes"];
$active_tags = ["Chairs", "₱0 - ₱5000"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artisan Furniture | Product Catalog</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/catalog-modern.css') ?>">
</head>

<body>

    <?php include 'partials/navbar.php'; ?>

    <div class="catalog-wrapper">
        <div class="sidebar-sticky">
            <aside class="sidebar">
                <form action="<?= base_url('catalog') ?>" method="get">
                    <div class="filter-container">
                        <div class="sidebar-header">
                            <h3 style="margin:0">Filters</h3>
                            <a href="<?= base_url('catalog') ?>" class="reset-btn" style="text-decoration:none;">Reset All</a>
                        </div>

                        <div class="filter-group">
                            <h4>Categories</h4>
                            <?php foreach ($categories as $cat): ?>
                                <label class="filter-checkbox">
                                    <input type="checkbox" name="category[]" value="<?= $cat; ?>"
                                        <?= (isset($_GET['category']) && in_array($cat, $_GET['category'])) ? 'checked' : '' ?>>
                                    <span><?= $cat; ?></span>
                                </label>
                            <?php endforeach; ?>
                        </div>

                        <div class="filter-group">
                            <h4>Price Range</h4>
                            <div class="price-range">
                                <input type="number" name="min_price" placeholder="Min" class="price-input"
                                    value="<?= service('request')->getVar('min_price') ?>">
                                <span style="color:var(--border)">—</span>
                                <input type="number" name="max_price" placeholder="Max" class="price-input"
                                    value="<?= service('request')->getVar('max_price') ?>">
                            </div>
                            <button type="submit" class="view-btn" style="width: 100%; margin-top: 1rem;">Apply Filter</button>
                        </div>
                    </div>
                </form>
            </aside>
        </div>

        <main class="catalog-main">
            <div class="catalog-controls">
                <form action="<?= base_url('catalog') ?>" method="get" class="search-bar">
                    <span class="search-icon">
                        <img src="<?= base_url('assets/images/social-icons/main-icons/search.png') ?>" alt="search-icon">
                    </span>
                    <input type="text" name="search" placeholder="Search for unique pieces..."
                        value="<?= esc(service('request')->getVar('search')) ?>">
                </form>

                <select style="padding: 0.8rem; border-radius: 12px; border: 1px solid var(--border);">
                    <option>Sort: Newest First</option>
                    <option>Price: Low to High</option>
                    <option>Price: High to Low</option>
                </select>
            </div>

            <div class="active-filters">
                <?php if (!empty($_GET['search'])): ?>
                    <div class="filter-chip">
                        Search: <?= esc($_GET['search']) ?>
                        <a href="<?= base_url('catalog') ?>" class="remove-chip" style="text-decoration:none; color:white;">&times;</a>
                    </div>
                <?php endif; ?>

                <?php foreach ($active_tags as $tag): ?>
                    <div class="filter-chip">
                        <?= esc($tag); ?>
                        <button class="remove-chip">&times;</button>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="product-grid">
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="product-card">
                            <div class="image-wrapper">
                                <img src="<?= base_url('uploads/' . $product['productImage']) ?>"
                                    alt="<?= esc($product['productName']) ?>"
                                    style="width:100%; height:100%; object-fit:cover;">
                                <div class="overlay">
                                    <a href="<?= base_url('product-details/' . $product['productID']) ?>"><button class="view-btn">Quick View</button></a>
                                </div>
                            </div>
                            <div class="product-info">
                                <span class="category"><?= esc($product['productCategory']) ?></span>
                                <h3 class="name"><?= esc($product['productName']) ?></h3>
                                <span class="price">₱<?= number_format($product['productPrice'], 2) ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No products found matching your criteria.</p>
                <?php endif; ?>
            </div>
        </main>
    </div>

</body>

</html>