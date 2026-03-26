<?php
use App\Models\UserModel;
use App\Models\AddressModel;

$active = $_GET['tab'] ?? 'customer';
$selectedPayment = $_GET['payment'] ?? '';
$selectedShipping = $_GET['shipping'] ?? '';

$shippingNames = [
    "50"  => "Standard Shipping",
    "100" => "Express Shipping",
    "150" => "Next Day Delivery",
    "200" => "Same Day Delivery"
];

$shippingDisplayName = $shippingNames[$selectedShipping] ?? 'None';

$sess = session();

$checkoutUser = null;
$savedAddress = null;
$savedAddressText = '';

if ($sess->has('user_id')) {
    $userModel = new UserModel();
    $checkoutUser = $userModel->find($sess->get('user_id'));

    if ($checkoutUser && !empty($checkoutUser['userID'])) {
        $addressModel = new AddressModel();
        $savedAddress = $addressModel->where('userID', $checkoutUser['userID'])->first();

        if ($savedAddress) {
            $savedAddressText =
                ($savedAddress['street'] ?? '') . ', ' .
                ($savedAddress['city'] ?? '') . ', ' .
                ($savedAddress['state'] ?? '') . ', ' .
                ($savedAddress['zip'] ?? '');
        }
    }
}

$address = isset($_GET['address']) && trim($_GET['address']) !== ''
    ? $_GET['address']
    : $savedAddressText;

$firstName = $checkoutUser['first_name'] ?? '';
$lastName  = $checkoutUser['last_name'] ?? '';

if ($firstName === '' && !empty($checkoutUser['username'])) {
    $firstName = $checkoutUser['username'];
}

$total = 0;
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
            <a href="?tab=customer&payment=<?= urlencode($selectedPayment) ?>&shipping=<?= urlencode($selectedShipping) ?>&address=<?= urlencode($address) ?>"
               class="<?= ($active == 'customer') ? 'active' : '' ?>">
                Customer Information
            </a>

            <a href="?tab=shipping&payment=<?= urlencode($selectedPayment) ?>&shipping=<?= urlencode($selectedShipping) ?>&address=<?= urlencode($address) ?>"
               class="<?= ($active == 'shipping') ? 'active' : '' ?>">
                Shipping Method
            </a>
        </div>

            <?php if ($active == "customer"): ?>
                <div class="section">
                    <h3>Check Out Your Items</h3>
                    <h5>Name</h5>
                    <div class="input-row">
                        <input type="text" value="<?= esc($firstName) ?>" readonly>
                        <input type="text" value="<?= esc($lastName) ?>" readonly>
                    </div>
                    <h3>Address</h3>
                    <div class="input-group">
                        <textarea readonly><?= esc($address) ?></textarea>
                    </div>
                    <form method="GET">
                        <input type="hidden" name="tab" value="customer">
                        <input type="hidden" name="shipping" value="<?= esc($selectedShipping) ?>">
                        <input type="hidden" name="address" value="<?= esc($address) ?>">

                        <?php foreach (['Cash On Delivery', 'Online Payment', 'Bank Payment'] as $method): ?>
                            <label class="payment">
                                <span><?= esc($method) ?></span>
                                <input type="radio"
                                    name="payment"
                                    value="<?= esc($method) ?>"
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
                    <input type="hidden" name="payment" value="<?= esc($selectedPayment) ?>">
                    <input type="hidden" name="address" value="<?= esc($address) ?>">

                    <?php foreach ($shippingNames as $price => $name): ?>
                        <label class="shipping">
                            <span><?= esc($name) ?> (₱<?= number_format((float)$price, 2) ?>)</span>
                            <input type="radio"
                                   name="shipping"
                                   value="<?= esc($price) ?>"
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

            <?php $total = 0; ?>

            <?php foreach ($cartItems as $cartItem): ?>
                <?php
                    $productItem = $productModel->find($cartItem['productID']);
                    if (!$productItem) continue;

                    $price = (float) $productItem['productPrice'];
                    $qty   = (int) $cartItem['quantity'];

                    $itemSubtotal = $price * $qty;
                    $total += $itemSubtotal;
                ?>

                <div class="cart-item">
                    <div class="cart-item-img">
                        <img src="<?= base_url('assets/images/product-images/' . $productItem['productImage']) ?>"
                            alt="<?= esc($productItem['productName']) ?>">
                    </div>

                    <div class="cart-item-details">
                        <p><?= esc($productItem['productName']) ?></p>
                        <p>₱<?= number_format($price, 2) ?></p>
                        <small>Qty: <?= $qty ?></small>
                        <small>Subtotal: ₱<?= number_format($itemSubtotal, 2) ?></small>
                    </div>
                </div>
            <?php endforeach; ?>

            <hr>

            <?php $grandTotal = $total + (float) $selectedShipping; ?>

            <p>Subtotal: ₱<?= number_format($total, 2) ?></p>
            <p>Shipping: ₱<?= number_format((float) $selectedShipping, 2) ?></p>
            <hr>
            <p><strong>Total: ₱<?= number_format($grandTotal, 2) ?></strong></p>

            <p>Payment: <?= $selectedPayment ? esc($selectedPayment) : 'None' ?></p>
            <p>Shipping: <?= esc($shippingDisplayName) ?></p>

            <form action="<?= base_url('checkout/process') ?>" method="post">
                <?= csrf_field() ?>

                <input type="hidden" name="address" value="<?= esc($address) ?>">
                <input type="hidden" name="payment_method" value="<?= esc($selectedPayment) ?>">
                <input type="hidden" name="shipping_fee" value="<?= esc($selectedShipping) ?>">
                <input type="hidden" name="shipping_method" value="<?= esc($shippingDisplayName) ?>">
                <input type="hidden" name="subtotal" value="<?= esc($total) ?>">
                <input type="hidden" name="total_amount" value="<?= esc($grandTotal) ?>">

                <?php if (!$selectedPayment || !$selectedShipping): ?>
                    <button class="checkout-btn" disabled>Select Payment & Shipping First</button>
                <?php else: ?>
                    <button type="submit" class="checkout-btn">Confirm Checkout</button>
                <?php endif; ?>
            </form>
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
