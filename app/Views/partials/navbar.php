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

if ($user){
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
                <img src="<?= base_url('assets/images/alt-logo.png') ?>" alt="Furniture Brand Logo">
            </a>
        </div>

        <div class="greetings">
            <?php if ($user): ?>
                <span class="user-greetings">
                    Hello, <i><?= esc($user['first_name']) ?></i>
                </span>
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

    <!-- CART PANEL -->
<div id="cartPanel" class="cart-panel">
    <div class="cart-top">
        <h1>Your Cart</h1>
        <h2><?= esc(count($cartItems)) ?> items</h2>
    </div>
    
    <div id="cartItems">
        <?php if (empty($cartItems)): ?>
            <div class="empty-message"><p >Your cart is empty.</p></div>
        <?php else: ?>
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
        <?php endif; ?>
    </div>

    <hr>

    <!-- CART SUMMARY -->
    <div class="cart-summary">
        <?php if (!empty($cartItems)): ?>
            <div class="items">
                <?php foreach ($cartItems as $cartItem):
                    $productItem = $productModel->find($cartItem['productID']);
                ?>
                    <div class="item">
                        <span><?= esc($productItem['productName']) ?></span>
                        <span>₱<?= number_format($productItem['productPrice'] * $cartItem['quantity']) ?></span>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="total">
                <span>Total</span>
                <span>₱<?= number_format($total) ?></span>
            </div>
            <a href="<?= base_url('checkout') ?>"><button class="checkout-btn">Proceed to Checkout</button></a>
        <?php endif; ?>

    </div>
</div>
</nav>

<script>
const cartBtn = document.getElementById('cartBtn');
const cartPanel = document.getElementById('cartPanel');

cartBtn.addEventListener('click', () => {
    cartPanel.classList.add('active');
});

window.addEventListener('click', (e) => {
    if (!cartPanel.contains(e.target) && !cartBtn.contains(e.target)) {
        cartPanel.classList.remove('active');
    }
});
</script>