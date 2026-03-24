<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('assets/css/product-details.css') ?>">
    <title><?= esc($product['productName']) ?></title>
</head>

<body>
    <?php include 'partials/navbar.php'; ?>

    <main class="product-page">
        <div class="breadcrumb">
            <a href="<?= base_url('/')?>">Home Page</a> /
            <a href="<?= base_url('catalog')?>">Collections</a> /
            <span><?= esc($product['productName']) ?></span>
        </div>

        <div class="product-container">
            <div class="left-side">
                <div class="product-image">
                    <div class="image"><img src="<?= base_url('assets/images/product-images/' . esc($product['productImage'])); ?>" alt="Product Image"></div>
                </div>
            </div>

            <div class="right-side">
                <div class="product-details">
                    <span class="status"><?= esc($product['productStock']) > 0 ? 'Available' : 'Out of Stock' ?></span>
                    <h1 class="product-name"><?= esc($product['productName']) ?></h1>
                    <p class="product-price">₱<?= number_format($product['productPrice'], 2) ?> <small>Taxes Included</small></p>
                </div>

                <div class="product-quantity">
                    <div class="quantity-lbl">
                        <label for="quantity">Quantity</label>
                    </div>

                    <div class="quantity-control">
                        <button class="minus">-</button>
                        <span id="qty">1</span>
                        <button class="plus">+</button>
                    </div>
                </div>

                <div class="stock-bar">
                    <span>Only <?= esc($product['productStock']) ?> left</span>
                    <div class="stock-progress">
                        <div class="stock-fill" ></div>
                    </div>
                </div>

                <div class="product-actions">
                    <button class="add-to-cart">Add to Cart</button>
                    <button class="buy-now">Buy it now</button>
                </div>

                <div class="product-info">
                    <details>
                        <summary>Description & Specifications</summary>
                        <p><?= esc($product['productDescription']) ?></p>
                        <h4>Specifications</h4>
                        <h5>Material</h5>
                        <ul>
                            <li><?= esc($product['productMaterial']) ?></li>
                        </ul>
                        <h5>Dimension</h5>
                        <ul>
                            <li><?= esc($product['productDimension']) ?></li>
                        </ul>
                        <h5>Weight Capacity</h5>
                        <ul>
                            <li><?= esc($product['productWeightCapacity']) ?></li>
                        </ul>
                    </details>
                    <details>
                        <summary>Shipping and Delivery</summary>
                        <p>Shipping details...</p>
                    </details>
                </div>
            </div>
    </main>
</body>

<script>
    function updateButtons() {
        minusBtn.disabled = count <= 1;
        plusBtn.disabled = count >= maxStock;
    }

    const minusBtn = document.querySelector(".minus");
    const plusBtn = document.querySelector(".plus");
    const qty = document.getElementById("qty");
    const maxStock = <?= (int)$product['productStock'] ?>;

let count = 1;

plusBtn.addEventListener("click", () => {
    if (count < maxStock){
        count++;
        qty.textContent = count;
    }
    updateButtons();
});

minusBtn.addEventListener("click", () => {
  if (count > 1) {
    count--;
    qty.textContent = count;
  }
  updateButtons();
});
</script>
</html>