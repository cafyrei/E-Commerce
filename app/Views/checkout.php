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
    <?php include 'partials/navbar.php'; ?>

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
            <?php
                $total = 0;
                foreach ($cartItems as $cartItem):
                    $productItem = $productModel->find($cartItem['productID']);
                    $subtotal = $productItem['productPrice'] * $cartItem['quantity'];
                    $total += $subtotal;
            ?>
                <div class="cart-item">
                    <div class="cart-item-img">
                        <img src="<?= base_url('assets/images/product-images/' . $productItem['productImage']) ?>">
                    </div>
                    
                    <div class="cart-item-details">
                        <p class="product-name"><?= esc($productItem['productName']) ?></p>
                        <p class="product-price">₱<?= number_format($productItem['productPrice']) ?></p>
                        <small>Qty: <?= $cartItem['quantity'] ?></small>
                    </div>
                </div>
            <?php endforeach; ?>

            <hr>

            <div class="total-breakdown">
                <p>Subtotal: ₱<span><?= number_format($total) ?></span></p>
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
