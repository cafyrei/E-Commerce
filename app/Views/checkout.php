<?php
$active = $_GET['tab'] ?? 'customer';
$selectedPayment = $_GET['payment'] ?? '';
$selectedShipping = $_GET['shipping'] ?? '';
$address = $_GET['address'] ?? '123 Sampaloc Manila';

$shippingNames = [
    "50"  => "Standard Shipping",
    "100" => "Express Shipping",
    "150" => "Next Day Delivery",
    "200" => "Same Day Delivery"
];
$shippingDisplayName = $shippingNames[$selectedShipping] ?? 'None';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/checkout.css') ?>">
</head>
<body>
    <div class="container">
        <div class="checkout-left">
            <div class="tabs">
                <a href="?tab=customer&payment=<?= $selectedPayment ?>&shipping=<?= $selectedShipping ?>&address=<?= urlencode($address) ?>"
                class="<?= ($active == 'customer') ? 'active' : '' ?>">Customer Information</a>

                <a href="?tab=shipping&payment=<?= $selectedPayment ?>&shipping=<?= $selectedShipping ?>&address=<?= urlencode($address) ?>"
                class="<?= ($active == 'shipping') ? 'active' : '' ?>">Shipping Method</a>
            </div>

            <?php if ($active == "customer"): ?>
                <div class="section">
                    <h3>Check Out Your Items</h3>
                    <h5>Name</h5>
                    <div class="input-row">
                        <input type="text" value="Juan" readonly>
                        <input type="text" value="Dela Cruz" readonly>
                    </div>
                    <h3>Address</h3>
                <form method="GET">
                    <input type="hidden" name="tab" value="customer">
                    <input type="hidden" name="payment" value="<?= htmlspecialchars($selectedPayment) ?>">
                    <input type="hidden" name="shipping" value="<?= htmlspecialchars($selectedShipping) ?>">

                    <textarea name="address" placeholder="Enter your delivery address..." onblur="this.form.submit()"><?= htmlspecialchars($address) ?></textarea>
                    
                    </form>

                    <h3>Payment Method</h3>
                    <form method="GET">
                        <input type="hidden" name="tab" value="customer">
                        <input type="hidden" name="shipping" value="<?= htmlspecialchars($selectedShipping) ?>">
                        
                        <?php foreach (['Cash On Delivery', 'Online Payment', 'Bank Payment'] as $method): ?>
                            <label class="payment">
                                <span><?= $method ?></span>
                                <input type="radio" name="payment" value="<?= $method ?>" 
                                    <?= ($selectedPayment == $method) ? 'checked' : '' ?> 
                                    onchange="this.form.submit()">
                            </label>
                        <?php endforeach; ?>
                    </form>
                </div>
            <?php endif; ?>

            <?php if ($active == "shipping"): ?>
                <div class="section">
                    <h3>Select Shipping Method</h3>
                    <form method="GET">
                        <input type="hidden" name="tab" value="shipping">
                        <input type="hidden" name="payment" value="<?= htmlspecialchars($selectedPayment) ?>">

                        <?php foreach ($shippingNames as $price => $name): ?>
                            <label class="shipping">
                                <span><?= "$name (₱$price)" ?></span>
                                <input type="radio" name="shipping" value="<?= $price ?>" 
                                    <?= ($selectedShipping == $price) ? 'checked' : '' ?> 
                                    onchange="this.form.submit()">
                            </label>
                        <?php endforeach; ?>
                    </form>
                </div>
            <?php endif; ?>
        </div>

        <div class="order-summary">
            <h2>Orders</h2>

            <div class="product">
                <div class="img"></div>
                <div class="info">
                    <p>Chair A</p>
                    <small>Comfortable chair</small>
                    <div class="qty-controls">
                        <button type="button" onclick="changeQty(this, -1)">−</button>
                        <span class="qty">1</span>
                        <button type="button" onclick="changeQty(this, 1)">+</button>
                    </div>
                </div>
                <div class="price" data-price="1000">₱1000</div>
            </div>

            <div class="product">
                <div class="img"></div>
                <div class="info">
                    <p>Desk B</p>
                    <small>Wooden desk</small>
                    <div class="qty-controls">
                        <button onclick="changeQty(this, -1)">−</button>
                        <span class="qty">1</span>
                        <button onclick="changeQty(this, 1)">+</button>
                    </div>
                </div>
                <div class="price" data-price="3500">₱3500</div>
            </div>

            <hr>

            <div class="total-breakdown">
                <p>Subtotal: ₱<span id="subtotal">0</span></p>
                <p>Shipping: ₱<span id="shippingCost"><?= $selectedShipping ?: 0 ?></span></p>
                <hr>
                <p><strong>Total: ₱<span id="totalPrice">0</span></strong></p>
                <p>Payment: <strong><?= $selectedPayment ?: 'None' ?></strong></p>
                <p>Method: <strong><?= $shippingDisplayName ?></strong></p>
            </div>

            <button class="checkout-btn" onclick="confirmCheckout()">Confirm Checkout</button>
        </div>
    </div>

    <script>
        function changeQty(btn, delta) {
            const qtyEl = btn.parentElement.querySelector(".qty");
            let qty = parseInt(qtyEl.innerText) + delta;
            if (qty < 1) qty = 1;
            qtyEl.innerText = qty;
            updateOrderSummary();
        }

        function updateOrderSummary() {
            const products = document.querySelectorAll(".product");
            let subtotal = 0;
            
            products.forEach(p => {
                let qty = parseInt(p.querySelector(".qty").innerText);
                let unitPrice = parseInt(p.querySelector(".price").dataset.price);
                let lineTotal = qty * unitPrice;
                subtotal += lineTotal;
            });

            document.getElementById("subtotal").innerText = subtotal;
            let shipping = parseInt(document.getElementById("shippingCost").innerText);
            document.getElementById("totalPrice").innerText = subtotal + shipping;
        }

        function confirmCheckout() {
            const total = document.getElementById("totalPrice").innerText;
            alert("Order Confirmed! Total: ₱" + total);
        }

        window.onload = updateOrderSummary;
    </script>
</body>
</html>