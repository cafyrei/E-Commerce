<?php
$active = isset($_GET['tab']) ? $_GET['tab'] : 'customer';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>

<body>

    <div class="container">


        <div class="checkout-left">

            <div class="tabs">
                <a href="?tab=customer" class="<?php if ($active == 'customer')
                    echo 'active'; ?>">Customer Information</a>
                <a href="?tab=shipping" class="<?php if ($active == 'shipping')
                    echo 'active'; ?>">Shipping Method</a>
            </div>

            <?php if ($active == "customer") { ?>

                <div class="section">

                    <h3>Check Out Your Items</h3>
                    <h5>Name</h5>
                    <div class="input-row">
                        <input type="text" value="Juan" readonly>
                        <input type="text" value="Dela Cruz" readonly>
                    </div>
                    <h5>Address</h5>
                    <textarea readonly>123 Sampaloc Manila</textarea>

                    <h3>Payment Method</h3>

                    <label class="payment">
                        <span>Cash On Delivery</span>
                        <input type="radio" name="payment">
                    </label>

                    <label class="payment">
                        <span>Online Payment</span>
                        <input type="radio" name="payment">
                    </label>

                    <label class="payment">
                        <span>Bank Payment</span>
                        <input type="radio" name="payment">
                    </label>

                </div>

            <?php } ?>

            <?php if ($active == "shipping") { ?>

                <div class="section">

                    <h3>Select Shipping Method</h3>

                    <label class="shipping">
                        <span>Standard Shipping (3-5 Days)</span>
                        <input type="radio" name="shipping">
                    </label>

                    <label class="shipping">
                        <span>Express Shipping (1-2 Days)</span>
                        <input type="radio" name="shipping">
                    </label>

                    <label class="shipping">
                        <span>Next Day Delivery</span>
                        <input type="radio" name="shipping">
                    </label>

                    <label class="shipping">
                        <span>Same Day Delivery</span>
                        <input type="radio" name="shipping">
                    </label>

                </div>

            <?php } ?>

        </div>

        <div class="order-summary">
            <div class="order-items">
                <h2>Orders</h2>

                <div class="product">
                    <div class="img"></div>
                    <div class="info">
                        <p>Product Name</p>
                        <small>Product Description</small>
                    </div>
                    <div class="price">₱00</div>
                </div>

                <div class="product">
                    <div class="img"></div>
                    <div class="info">
                        <p>Product Name</p>
                        <small>Product Description</small>
                    </div>
                    <div class="price">₱00</div>
                </div>

                <hr> 

                <div class="total">
                    <p>Total</p>
                    <p>₱00.00</p>
                </div>
            </div>

            <button class="checkout-btn">Confirm Checkout</button>
        </div>

    </div>

</body>

</html>