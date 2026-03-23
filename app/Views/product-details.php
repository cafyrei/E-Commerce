<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('css/product-details.css') ?>">
    <title>Product Detail</title>
</head>

<body>

    <nav>
        <div class="logo">
            <a href="<?= base_url() ?>">
                <img src="<?= base_url('images/alt-logo.png') ?>" alt="Furniture Brand Logo">
            </a>
        </div>
        <div class="website-title">
            <p>Website Name</p>
        </div>
        <div class="nav-links">
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="#">Contact</a>
        </div>
    </nav>

    <main class="product-page">
        <div class="breadcrumb">
            <a href="#">Home Page</a> /
            <a href="#">Collections</a> /
            <span><?= esc($product['productName']) ?></span>
        </div>

        <div class="product-container">
            <div class="product-images">
                <div class="image"><img src="#" alt="Product Image 1"></div>
                <div class="image"><img src="#" alt="Product Image 2"></div>
                <div class="image"><img src="#" alt="Product Image 3"></div>
                <div class="image"><img src="#" alt="Product Image 4"></div>
            </div>

            <div class="product-details">
                <span class="status"><?= esc($product['productStock']) > 0 ? 'Available' : 'Out of Stock' ?></span>
                <h1 class="product-name"><?= esc($product['productName']) ?></h1>
                <p class="product-price">₱<?= number_format($product['productPrice'], 2) ?> <small>Taxes Included</small></p>
            </div>

                <div class="product-quantity">
                    <label for="quantity">Quantity</label>
                    <div class="quantity-control">
                        <button>-</button>
                        <input type="number" id="quantity" value="1" min="1">
                        <button>+</button>
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
                        <p>Product description here...</p>
                    </details>
                    <details>
                        <summary>How to get the right size</summary>
                        <p>Size guide information...</p>
                    </details>
                    <details>
                        <summary>Shipping and Delivery</summary>
                        <p>Shipping details...</p>
                    </details>
                </div>
            </div>
        </div>
    </main>

    <div class="cart-overlay"></div>
    <div class="cart-container">
        <h2>Your Cart <span class="item-count">2 Items</span></h2>

        <div class="cart-items">
            <div class="cart-item">
                <div class="cart-item">
                    <div class="item-image"></div>
                    <div class="item-details">
                        <p class="item-name"><?= esc($product['productName']) ?></p>
                        <p class="item-type">Furniture Type</p>

                        <div class="item-controls">
                        <div class="quantity">
                            <button>-</button>
                            <span>1</span>
                            <button>+</button>
                        </div>
                        <p class="price">₱999</p>
                        </div>
                    </div>
                </div>

                 <div class="cart-item">
                    <div class="item-image"></div>
                    <div class="item-details">
                        <p class="item-name">Product Name</p>
                        <p class="item-type">Furniture Type</p>

                        <div class="item-controls">
                        <div class="quantity">
                            <button>-</button>
                            <span>1</span>
                            <button>+</button>
                        </div>
                        <p class="price">₱999</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="cart-summary">
                <div class="summary-row">
                    <span>Product 1</span>
                    <span>₱999</span>
                </div>
                <div class="summary-row">
                    <span>Product 2</span>
                    <span>₱999</span>
                </div>
                <div class="summary-total">
                    <strong>Total</strong>
                    <strong>₱1998</strong>
                </div>

                 <button class="checkout-btn">Proceed to Checkout</button>
            </div>
        </div>
    </div>
</body>
</html>