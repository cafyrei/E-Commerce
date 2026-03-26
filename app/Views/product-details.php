<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('assets/css/product-details.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/navbar-dark.css') ?>">
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
                            <button type="button" class="minus">-</button>
                            <span id="qty">1</span>
                            <button type="button" class="plus">+</button>
                        </div>
                    </div>

                    <div class="stock-bar">
                        <span>Only <?= esc($product['productStock']) ?> left</span>
                        <div class="stock-progress">
                            <div class="stock-fill" ></div>
                        </div>
                    </div>

                    <div class="product-actions">
                        <form action="<?= base_url('cart/add') ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="productID" value="<?= $product['productID'] ?>">
                            <input type="hidden" name="qty" id="qtyInput" value="1">

                            <?php if ((int) $product['productStock'] > 0): ?>
                            <button type="submit" class="add-to-cart">Add to Cart</button>
                            <?php else: ?>
                            <button type="button" class="add-to-cart" disabled>Out of Stock</button>
                            <?php endif; ?>
                        </form>

                        <form action="<?= base_url('buy-now') ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="productID" value="<?= $product['productID'] ?>">
                            <input type="hidden" name="qty" id="buyQtyInput" value="1">

                            <?php if ((int) $product['productStock'] > 0): ?>
                            <button type="submit" class="buy-now">Buy it now</button>
                            <?php else: ?>
                            <button type="button" class="buy-now" disabled>Out of Stock</button>
                            <?php endif; ?>
                    </form>
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
                        <p>Learn more about Shipping and Delivery through the Checkout Page</p>
                    </details>
                </div>
            </div>
    </main>
</body>

<script>
        const minusBtn = document.querySelector(".minus");
        const plusBtn = document.querySelector(".plus");
        const qty = document.getElementById("qty");
        const qtyInput = document.getElementById("qtyInput");
        const buyQtyInput = document.getElementById("buyQtyInput");

        const maxStock = <?= (int) $product['productStock'] ?>;
        let count = 1;

        function syncQtyInputs() {
            qty.textContent = count;
            qtyInput.value = count;
            buyQtyInput.value = count;
        }

        function updateButtons() {
            minusBtn.disabled = count <= 1;
            plusBtn.disabled = count >= maxStock || maxStock <= 0;
        }

        plusBtn.addEventListener("click", () => {
            if (count < maxStock) {
                count++;
                syncQtyInputs();
            }
            updateButtons();
        });

        minusBtn.addEventListener("click", () => {
            if (count > 1) {
                count--;
                syncQtyInputs();
            }
            updateButtons();
        });

        syncQtyInputs();
        updateButtons();
</script>
</html>