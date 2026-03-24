<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Modern</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">
</head>
<body>

    <div class="admin-container">
        <aside class="sidebar">
            <div class="sidebar-logo">
                <div class="logo-icon"><i class="fas fa-bolt"></i></div>
                <span>Admin</span>
            </div>
            
            <nav class="sidebar-nav">
                <div class="sidebar-item active" data-tab="users">
                    <i class="fas fa-user-friends"></i> <span>Users</span>
                </div>
                <div class="sidebar-item" data-tab="products">
                    <i class="fas fa-box-open"></i> <span>Products</span>
                </div>
                <div class="sidebar-item" data-tab="stats">
                    <i class="fas fa-chart-line"></i> <span>Sales</span>
                </div>
            </nav>

            <div class="sidebar-footer">
                <p>v2.4.0 Stable</p>
            </div>
        </aside>

        <main class="content-area">
            
            <section id="users" class="tab-content active">
                <div class="glass-header">
                    <div>
                        <h2>User Management</h2>
                        <p>Oversee your community and member access.</p>
                    </div>
                    <form method="get" class="modern-search">
                        <i class="fas fa-search"></i>
                        <input type="text" name="search_user" placeholder="Find a user..." value="<?= esc($_GET['search_user'] ?? '') ?>">
                        <button type="submit">Search</button>
                    </form>
                </div>

                <div class="modern-grid">
                    <?php foreach ($users as $user): ?>
                    <div class="modern-card">
                        <div class="user-avatar">
                            <?= substr(esc($user['first_name']), 0, 1) ?>
                        </div>
                        <div class="card-info">
                            <h3><?= esc($user['first_name']) ?> <?= esc($user['last_name']) ?></h3>
                            <p><i class="far fa-envelope"></i> <?= esc($user['email']) ?></p>
                            <p><i class="fas fa-phone-alt"></i> <?= esc($user['phone_number']) ?></p>
                        </div>
                        <div class="card-actions">
                            <a href="<?= base_url('admin/deleteUser/' . $user['userID']) ?>" 
                               class="btn-icon delete" onclick="return confirm('Delete user?')">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <section id="products" class="tab-content">
                <div class="glass-header">
                    <div>
                        <h2>Inventory Control</h2>
                        <p>Track stock levels and pricing.</p>
                    </div>
                    <form method="get" class="modern-search">
                        <i class="fas fa-search"></i>
                        <input type="text" name="search_product" placeholder="Search inventory..." value="<?= esc($_GET['search_product'] ?? '') ?>">
                        <button type="submit">Search</button>
                    </form>
                </div>

                <div class="modern-grid">
                    <?php foreach ($products as $product): ?>
                    <div class="modern-card product-card">
                        <div class="product-badge"><?= esc($product['productCategory']) ?></div>
                        <div class="card-info">
                            <h3><?= esc($product['productName']) ?></h3>
                            <div class="product-stats">
                                <span>Stock: <strong><?= esc($product['productStock']) ?></strong></span>
                                <span class="price">₱<?= number_format($product['productPrice'], 2) ?></span>
                            </div>
                        </div>
                        <div class="card-actions">
                            <a href="<?= base_url('admin/deleteProduct/' . $product['productID']) ?>" 
                               class="btn-icon delete" onclick="return confirm('Delete product?')">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <section id="stats" class="tab-content">
                <div class="glass-header">
                    <div>
                        <h2>Sales Overview</h2>
                        <p>Financial health at a glance.</p>
                    </div>
                </div>

                <div class="stats-container">
                    <div class="stat-glass-card">
                        <div class="stat-icon purple"><i class="fas fa-shopping-cart"></i></div>
                        <div class="stat-data">
                            <h3><?= esc($salesStats['total_sold'] ?? 0) ?></h3>
                            <p>Units Sold</p>
                        </div>
                    </div>
                    <div class="stat-glass-card">
                        <div class="stat-icon green"><i class="fas fa-hand-holding-usd"></i></div>
                        <div class="stat-data">
                            <h3>₱<?= number_format($salesStats['total_revenue'] ?? 0, 2) ?></h3>
                            <p>Total Revenue</p>
                        </div>
                    </div>
                </div>
            </section>

        </main>
    </div>

    <script>
        const navItems = document.querySelectorAll('.sidebar-item');
        const sections = document.querySelectorAll('.tab-content');

        navItems.forEach(item => {
            item.addEventListener('click', () => {
                // Remove active classes
                navItems.forEach(i => i.classList.remove('active'));
                sections.forEach(s => s.classList.remove('active'));

                // Add active state
                item.classList.add('active');
                const targetId = item.getAttribute('data-tab');
                document.getElementById(targetId).classList.add('active');
            });
        });
    </script>
</body>
</html>