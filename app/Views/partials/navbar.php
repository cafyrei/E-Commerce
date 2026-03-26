<?php

use App\Models\UserModel;
use App\Models\CartModel;
use App\Models\CartItemModel;
use App\Models\ProductModel;

$sess = session();

$cartItems = [];

$user = null;
if ($sess->has('user_id')) {
    $model = new UserModel();
    $user = $model->find($sess->get('user_id'));
}

if ($user) {
    $cartModel = new CartModel();
    $cartItemModel = new CartItemModel();
    $productModel = new ProductModel();

    $cart = $cartModel->where('userID', $user['userID'])->first();

    if ($cart) {
        $cartItems = $cartItemModel->where('cartID', $cart['cartID'])->findAll();
    }
}
?>

<nav>
    <div class="logo">
        <div class="image-logo">
            <a href="<?= base_url() ?>">
                <img src="<?= base_url('assets/images/alt-logo.png') ?>" alt="Logo">
            </a>
        </div>
        <div class="greetings">
            <?php if ($user): ?>
                <span class="user-greetings">Hello, <i><?= esc($user['first_name']) ?></i></span>
            <?php endif; ?>
        </div>
    </div>

    <div class="nav-links">
        <a href="<?= base_url('/') ?>">Home</a>
        <a href="<?= base_url('about') ?>">About</a>
        <?php if ($user): ?>
            <a href="<?= base_url('profile') ?>">Profile</a>
            <a href="<?= base_url('logout') ?>">Logout</a>
        <?php else: ?>
            <a href="<?= base_url('login') ?>">Sign In</a>
        <?php endif; ?>
        <button id="cartBtn" class="cart-btn">
            <img src="<?= base_url("assets/images/social-icons/main-icons/shopping-cart.png") ?>" alt="Cart">
        </button>
    </div>

    <div id="cartPanel" class="cart-panel">
        <div class="cart-top">
            <h1>Your Cart</h1>
            <h2><?= count($cartItems) ?> items</h2>
        </div>

        <div id="cartItemsList">
            <?php if (empty($cartItems)): ?>
                <p style="padding: 20px;">Your cart is empty.</p>
            <?php else: ?>
                <?php $total = 0;
                foreach ($cartItems as $item):
                    $product = $productModel->find($item['productID']);
                    $subtotal = $product['productPrice'] * $item['quantity'];
                    $total += $subtotal;
                ?>
                    <div class="cart-item" data-price="<?= $product['productPrice'] ?>" style="display: flex; gap: 15px; padding: 15px; border-bottom: 1px solid #eee; align-items: center;">
                        <img src="<?= base_url('assets/images/product-images/' . $product['productImage']) ?>" style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">
                        <div class="details" style="flex: 1;">
                            <p style="margin: 0; font-weight: bold; font-size: 14px;"><?= esc($product['productName']) ?></p>
                            <p style="margin: 5px 0; color: #555;">₱<?= number_format($product['productPrice']) ?></p>

                            <div class="qty-ctrl" style="display: flex; align-items: center; gap: 10px; background: #f0f0f0; width: fit-content; padding: 2px 10px; border-radius: 20px;">
                                <button type="button" class="btn-qty-minus" data-id="<?= $item['cartItemID'] ?>" style="border:none; cursor:pointer; background:none; font-weight:bold; font-size: 16px;">-</button>
                                <span id="qty-num-<?= $item['cartItemID'] ?>" class="qty-num" style="font-weight: bold; font-size: 14px;"><?= $item['quantity'] ?></span>
                                <button type="button" class="btn-qty-plus" data-id="<?= $item['cartItemID'] ?>" data-stock="<?= $product['productStock'] ?>" style="border:none; cursor:pointer; background:none; font-weight:bold; font-size: 16px;">+</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="cart-footer" style="padding: 20px;">
            <?php if (!empty($cartItems)): ?>
                <div style="display: flex; justify-content: space-between; font-weight: bold; margin-bottom: 15px; font-size: 18px;">
                    <span>Total</span>
                    <span>₱<?= number_format($total) ?></span>
                </div>
                <a href="<?= base_url('checkout') ?>" style="text-decoration: none;">
                    <button style="width: 100%; padding: 12px; background: #222; color: #fff; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">Proceed to Checkout</button>
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const cBtn = document.getElementById('cartBtn');
        const cPanel = document.getElementById('cartPanel');

        cBtn.onclick = () => cPanel.classList.add('active');

        window.onclick = (e) => {
            if (!cPanel.contains(e.target) && !cBtn.contains(e.target)) {
                cPanel.classList.remove('active');
            }
        };

        const updateCartUI = () => {
            let grandTotal = 0;
            let itemCount = 0;

            document.querySelectorAll('.cart-item').forEach(item => {
                // Get price from the data attribute we set
                const price = parseFloat(item.dataset.price) || 0;
                const qty = parseInt(item.querySelector('.qty-num').innerText) || 0;

                grandTotal += price * qty;
                itemCount += qty;
            });

            const totalElem = document.querySelector('.cart-footer span:last-child');
            if (totalElem) totalElem.innerText = '₱' + grandTotal.toLocaleString();

            // Update the item count in the header
            const countElem = document.querySelector('.cart-top h2');
            if (countElem) countElem.innerText = itemCount + ' items';
        };

        document.querySelectorAll('.btn-qty-plus, .btn-qty-minus').forEach(btn => {
            btn.addEventListener('click', async function() {
                const id = this.dataset.id;
                const isPlus = this.classList.contains('btn-qty-plus');
                const display = document.getElementById(`qty-num-${id}`);
                let val = parseInt(display.innerText);
                const stock = parseInt(this.dataset.stock) || 99;

                // Simple validation
                if (isPlus && val < stock) val++;
                else if (!isPlus && val > 1) val--;
                else return;

                // Prepare Data for Server
                const formData = new FormData();
                formData.append('cartItemID', id);
                formData.append('quantity', val);
                formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');

                try {
                    const res = await fetch('<?= base_url("cart/update-quantity") ?>', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    const data = await res.json();

                    if (data.status === 'success') {
                        display.innerText = val;
                        updateCartUI();
                    } else {
                        alert('Error: ' + (data.message || 'Failed to update'));
                    }
                } catch (err) {
                    console.error("Critical Error:", err);
                }
            });
        });

        document.querySelectorAll('.cart-item').forEach(item => {
            const priceText = item.querySelector('p:nth-child(2)').innerText.replace('₱', '').replace(/,/g, '');
            item.dataset.price = parseFloat(priceText);
        });
    });
</script>