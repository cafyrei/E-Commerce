<?php
$section = isset($_GET['section']) ? $_GET['section'] : 'account';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <link rel="stylesheet" href="<?= base_url('css/Prostyle.css') ?>">
</head>

<body>
    <div class="top-header">Your Profile</div>

    <div class="container">
        <div class="sidebar-left">
            <h3>Personal Center</h3>
            <ul class="menu">
                <li><a href="?section=account">My Account</a></li>
                <li><a href="?section=orders">My Orders</a></li>
                <li><a href="?section=favorites">My Favorites</a></li>
                <li><a href="?section=signout">Sign Out</a></li>
            </ul>
        </div>

        <div class="content-center">
            <?php if ($section == 'account'): ?>
                <h2>Manage My Account</h2>
                <div class="account-field">
                    <label>Email</label>
                    <p>n******@sample.com</p>
                    <button>Change</button>
                </div>
                <div class="account-field">
                    <label>Password</label>
                    <p>********</p>
                    <button>Change</button>
                </div>
                <div class="account-field">
                    <p style="color:red; font-weight:bold;">DELETE ACCOUNT (This cannot be recovered)</p>
                    <button class="delete-btn">Delete Account</button>
                </div>

            <?php elseif ($section == 'orders'): ?>
                <h2>My Orders</h2>
                <p>Order 1: Pending</p>
                <p>Order 2: Delivered</p>

            <?php elseif ($section == 'favorites'): ?>
                <h2>My Favorites</h2>
                <p>Item 1</p>
                <p>Item 2</p>

            <?php elseif ($section == 'signout'): ?>
                <h2>Sign Out</h2>
                <p>You have been signed out.</p>

            <?php elseif ($section == 'messages'): ?>
                <h2>My Messages</h2>
                <p>No new messages.</p>

            <?php elseif ($section == 'reports'): ?>
                <h2>Service Reports</h2>
                <p>You have 2 reports.</p>

            <?php elseif ($section == 'wishlists'): ?>
                <h2>Wishlists</h2>
                <p>Your wishlist is empty.</p>

            <?php elseif ($section == 'recent'): ?>
                <h2>Recently Viewed</h2>
                <p>You haven't viewed any items recently.</p>
            <?php endif; ?>
        </div>

        <div class="sidebar-right">
            <h3>Customer Service</h3>
            <ul>
                <li><a href="?section=messages"><span class="icon">💬</span>     My Messages</a></li>
                <li><a href="?section=reports"><span class="icon">📄</span>     Service Reports</a></li>
                <li><a href="?section=wishlists"><span class="icon">⭐</span>     Wishlists</a></li>
                <li><a href="?section=recent"><span class="icon">🕒</span>     Recently Viewed</a></li>
            </ul>
        </div>
    </div>
</body>

</html>