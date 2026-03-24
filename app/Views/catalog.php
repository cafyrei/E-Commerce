<?php
$categories = ["Bedroom", "Living Room", "Dining Room", "Home Office", "Kitchen"];
$types = ["Chairs", "Beds", "Shelving", "Desks", "Wardrobes"];

// hardcoded
$products = [
    ["name" => "Chair A", "price" => 1000, "category" => "Living Room", "type" => "Chairs"],
    ["name" => "Bed A", "price" => 5000, "category" => "Bedroom", "type" => "Beds"],
    ["name" => "Desk A", "price" => 3000, "category" => "Home Office", "type" => "Desks"],
    ["name" => "Shelf A", "price" => 2000, "category" => "Living Room", "type" => "Shelving"],
    ["name" => "Wardrobe A", "price" => 7000, "category" => "Bedroom", "type" => "Wardrobes"],
    ["name" => "Chair B", "price" => 1200, "category" => "Dining Room", "type" => "Chairs"],
    ["name" => "Desk B", "price" => 3500, "category" => "Home Office", "type" => "Desks"],
    ["name" => "Shelf B", "price" => 1800, "category" => "Kitchen", "type" => "Shelving"]
];

$selectedCategories = $_GET['category'] ?? [];
$selectedTypes = $_GET['type'] ?? [];
$minPrice = $_GET['min'] ?? "";
$maxPrice = $_GET['max'] ?? "";
$search = $_GET['search'] ?? "";
$sort = $_GET['sort'] ?? "";

if ($minPrice !== "" && $maxPrice !== "" && $minPrice > $maxPrice) {
    $temp = $minPrice;
    $minPrice = $maxPrice;
    $maxPrice = $temp;
}


$filteredProducts = array_filter($products, function ($product) use ($selectedCategories, $selectedTypes, $minPrice, $maxPrice, $search) {

    if (!empty($selectedCategories) && !in_array($product['category'], $selectedCategories)) {
        return false;
    }

    if (!empty($selectedTypes) && !in_array($product['type'], $selectedTypes)) {
        return false;
    }

    if ($minPrice !== "" && $product['price'] < $minPrice) {
        return false;
    }

    if ($maxPrice !== "" && $product['price'] > $maxPrice) {
        return false;
    }

    if ($search !== "" && stripos($product['name'], $search) === false) {
        return false;
    }

    return true;
});
if ($sort == "low") {
    usort($filteredProducts, function ($a, $b) {
        return $a['price'] <=> $b['price'];
    });
} elseif ($sort == "high") {
    usort($filteredProducts, function ($a, $b) {
        return $b['price'] <=> $a['price'];
    });
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Catalog</title>
    <link rel="stylesheet" href="Catstyle.css">
</head>
<body>

    <form method="GET">
        <div class="container">

            <div class="filters">
                <h3>Filter Options</h3>

                <div class="filter-section">
                    <p>By Categories</p>
                    <div class="scroll-box">
                        <?php foreach ($categories as $cat): ?>
                            <label>
                                <input type="checkbox" name="category[]" value="<?= $cat ?>" 
                                    <?= in_array($cat, $selectedCategories) ? "checked" : "" ?>>
                                <?= $cat ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <hr>

                <div class="filter-section">
                    <p>By Furniture Types</p>
                    <div class="scroll-box">
                       <?php foreach ($types as $type): ?>
                            <label>
                                <input type="checkbox" name="type[]" value="<?= $type ?>" 
                                    <?= in_array($type, $selectedTypes) ? "checked" : "" ?>>
                                <?= $type ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <hr>

                <div class="filter-section">
                    <p>Price Range</p>
                    <div class="price-range">
                        <input type="number" name="min" placeholder="₱ MIN" value="<?= $minPrice ?>">
                        <span>-</span>
                        <input type="number" name="max" placeholder="₱ MAX" value="<?= $maxPrice ?>">
                    </div>
                </div>

                <br>
                <button class="apply-btn" type="submit">Apply Filters</button>
            </div>

            <div class="catalog">

                <div class="catalog-top">
                    <input type="text" name="search" placeholder="Search" value="<?= htmlspecialchars($search) ?>">

                    <select name="sort" onchange="this.form.submit()">
                        <option value="">Sort By</option>
                        <option value="low" <?= ($sort == "low") ? "selected" : "" ?>>Lowest Price</option>
                        <option value="high" <?= ($sort == "high") ? "selected" : "" ?>>Highest Price</option>
                    </select>
                </div>

                <div class="active-filters">
                    <a href="?"><button type="button" class="clear">Clear All</button></a>
                </div>

                <div class="product-grid">
                    <?php if (empty($filteredProducts)): ?>
                        <p>No products found.</p>
                    <?php else: ?>
                        <?php foreach ($filteredProducts as $product): ?>
                            <div class="product-card">
                                <div class="product-img"></div>
                                <div class="product-info">
                                    <p><?= $product['name'] ?></p>
                                    <span>₱ <?= number_format($product['price']) ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </form>
</body>
</html>