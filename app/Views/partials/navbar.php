<?php
use App\Models\UserModel;

$sess = session();

$user = null;
if ($sess->has('user_id')) {
    $model = new UserModel();
    $user = $model->find($sess->get('user_id'));
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
        <h3>Your Cart</h3>
        <div id="cartItems">
            <p>Your cart is empty.</p>
        </div>
        <button id="closeCart" class="close-cart">Close</button>
    </div>
</nav>

<script>
const cartBtn = document.getElementById('cartBtn');
const cartPanel = document.getElementById('cartPanel');
const closeCart = document.getElementById('closeCart');

cartBtn.addEventListener('click', () => {
    cartPanel.classList.add('active');
});

closeCart.addEventListener('click', () => {
    cartPanel.classList.remove('active');
});

window.addEventListener('click', (e) => {
    if (!cartPanel.contains(e.target) && !cartBtn.contains(e.target)) {
        cartPanel.classList.remove('active');
    }
});
</script>