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
            <p>Your cart is empty.</p>
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
                    
                    <div class="cart-item-details"
                        data-product-id="<?= $productItem['productID'] ?>"
                        data-stock="<?= $productItem['productStock'] ?>"
                        data-price="<?= $productItem['productPrice'] ?>">

                        <a class="remove-product"
                        href="<?= base_url('cart/remove/' . $productItem['productID']) ?>">
                        &#10005;
                        </a>

                        <p class="product-name"><?= esc($productItem['productName']) ?></p>
                        <p class="product-price">₱<?= number_format($productItem['productPrice']) ?></p>

                        <div class="cart-quantity-control">
                            <button type="button" class="cart-minus">-</button>
                            <span class="cart-qty"><?= $cartItem['quantity']?></span>
                            <button type="button" class="cart-plus">+</button>
                        </div>

                            <p class="cart-subtotal">
                            ₱<span class="item-subtotal">
                                <?= number_format($productItem['productPrice'] * $cartItem['quantity']) ?>
                            </span>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <hr>

    <!-- CART SUMMARY -->
    <div class="cart-summary">
        <?php if (!empty($cartItems)): ?>
            <form action="<?= base_url('checkout') ?>" method="post">
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
                <span>₱<span id="cartTotal"><?= number_format($total) ?></span></span>
            </div>
            <a href="<?= base_url('checkout') ?>"><button type="submit" class="checkout-btn">Proceed to Checkout</button></a>
        <?php endif; ?>
        </form>
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

function updateCartTotal() {
    let total = 0;

    document.querySelectorAll(".cart-item-details").forEach(item => {
        const price = parseFloat(item.dataset.price);
        const qty = parseInt(item.querySelector(".cart-qty").textContent);

        total += price * qty;
    });

    document.getElementById("cartTotal").textContent = total.toLocaleString();
}

document.querySelectorAll(".cart-item-details").forEach(item => {
    const minusBtn = item.querySelector(".cart-minus");
    const plusBtn = item.querySelector(".cart-plus");
    const qtySpan = item.querySelector(".cart-qty");
    const subtotalSpan = item.querySelector(".item-subtotal");

    if (!minusBtn || !plusBtn || !qtySpan || !subtotalSpan) return;

    let count = parseInt(qtySpan.textContent);
    const maxStock = parseInt(item.dataset.stock) || 1;
    const price = parseFloat(item.dataset.price);

    function updateUI() {
        qtySpan.textContent = count;

        subtotalSpan.textContent = (price * count).toLocaleString();

        minusBtn.disabled = count <= 1;
        plusBtn.disabled = count >= maxStock;

        updateCartTotal();
    }

    plusBtn.addEventListener("click", () => {
        if (count < maxStock) {
            count++;
            updateUI();
        }
    });

    minusBtn.addEventListener("click", () => {
        if (count > 1) {
            count--;
            updateUI();
        }
    });

    updateUI();
});
</script>