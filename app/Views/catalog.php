<?php
$categories = ["Bedroom", "Living Room", "Dining Room", "Home Office", "Kitchen"];
$types = ["Chairs", "Beds", "Shelving", "Desks", "Wardrobes"];
?>

<!DOCTYPE html>
<html>

<head>
    <title>Product Catalog</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/main.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/navbar-dark.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/Catstyle.css') ?>">
</head>

<body>
    <?php include 'partials/navbar.php'; ?>
    <div class="container">

        <div class="filters">

            <h3>Filter Options</h3>

            <div class="filter-section">
                <p>By Categories</p>

                <div class="scroll-box">
                    <?php foreach ($categories as $cat) { ?>
                        <label>
                            <input type="checkbox" name="category[]" value="<?php echo $cat; ?>">
                            <?php echo $cat; ?>
                        </label>
                    <?php } ?>
                </div>

            </div>

            <hr>

            <div class="filter-section">
                <p>By Furniture Types</p>

                <div class="scroll-box">
                    <?php foreach ($types as $type) { ?>
                        <label>
                            <input type="checkbox" name="type[]" value="<?php echo $type; ?>">
                            <?php echo $type; ?>
                        </label>
                    <?php } ?>
                </div>

            </div>

            <hr>

            <div class="filter-section">

                <p>Price Range</p>

                <div class="price-range">
                    <input type="number" placeholder="₱ MIN">
                    <span>-</span>
                    <input type="number" placeholder="₱ MAX">
                </div>

                <button class="apply-btn">Apply</button>

            </div>

        </div>

        <div class="catalog">

            <div class="catalog-top">

                <input type="text" placeholder="Search">

                <select>
                    <option>Sort By: </option>
                    <option>Lowest</option>
                    <option>Highest Price</option>
                    <option>Recommended</option>
                    <option>Popular</option>
                </select>

            </div>

            <div class="active-filters">

                <button class="clear">Clear</button>
            </div>

            <div class="product-grid">

                <?php for ($i = 1; $i <= 10; $i++) { ?>

                    <div class="product-card">

                        <div class="product-img"></div>

                        <div class="product-info">
                            <p>Product Name</p>
                            <span>₱ 1000</span>
                        </div>

                    </div>

                <?php } ?>

            </div>

        </div>

    </div>

</body>

</html>