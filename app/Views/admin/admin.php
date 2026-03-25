<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Modern</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">

    <style>
        .logout-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            color: #fff;
            background-color: #f87171;
            /* red */
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
        }

        .logout-btn:hover {
            background-color: #f56565;
        }

        /* --- SIDEBAR UPDATES --- */
        .sidebar {
            width: 280px;
            background: var(--dark);
            color: white;
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
        }

        .sidebar-nav {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        /* Push footer/logout to the bottom */
        .sidebar-footer {
            margin-top: auto;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 18px;
            background: rgba(239, 68, 68, 0.1);
            /* Subtle red tint */
            color: #f87171;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background: var(--danger);
            color: white;
        }

        /* --- ADD PRODUCT FORM ALIGNMENT --- */
        /* Updated to match your --glass and --border variables */
        .modern-split-form {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 2rem;
            background: white;
            /* Changed from dark slate to match your dashboard cards */
            padding: 30px;
            border-radius: 24px;
            border: 1px solid var(--border);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
        }

        .section-title {
            color: var(--primary);
            /* Switched from sky-blue to your theme primary */
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .input-group label {
            display: block;
            color: var(--text-muted);
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 8px;
        }

        /* Updated inputs to match the "Modern Search" look */
        .input-group input,
        .input-group textarea,
        .input-group select {
            width: 100%;
            padding: 12px 16px;
            background: var(--bg-main);
            border: 1px solid var(--border);
            border-radius: 10px;
            color: var(--text-main);
            font-family: inherit;
            transition: all 0.3s;
        }

        .input-group input:focus {
            border-color: var(--primary);
            background: white;
            outline: none;
            box-shadow: 0 0 0 4px var(--primary-soft);
        }

        /* Image Preview Styling */
        .image-preview-box {
            width: 100%;
            height: 200px;
            background: var(--bg-main);
            border: 2px dashed var(--border);
            border-radius: 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            margin-top: 10px;
            overflow: hidden;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 25px;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            flex: 2;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            filter: brightness(1.1);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }

        .btn-secondary {
            background: white;
            color: var(--text-muted);
            border: 1px solid var(--border);
            padding: 12px 24px;
            border-radius: 10px;
            cursor: pointer;
            flex: 1;
        }

        .btn-secondary:hover {
            background: var(--bg-main);
        }
    </style>
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
                <div class="sidebar-item" data-tab="add-product">
                    <i class="fas fa-plus-circle"></i> <span>Add Product</span>
                </div>
                <div class="sidebar-item" data-tab="stats">
                    <i class="fas fa-chart-line"></i> <span>Sales</span>
                </div>

                <div class="sidebar-footer">
                    <a href="<?= base_url('admin/logout') ?>" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
                    </a>
                </div>
            </nav>
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

            <section id="add-product" class="tab-content">
                <div class="glass-header">
                    <div class="header-text">
                        <h2>Inventory Control</h2>
                        <p>Register a new item to the system database.</p>
                    </div>
                </div>

                <div class="form-container">
                    <form action="<?= base_url('admin/addProduct') ?>" method="POST" enctype="multipart/form-data" class="modern-split-form">

                        <div class="form-section">
                            <h3 class="section-title"><i class="fas fa-info-circle"></i> General Information</h3>

                            <div class="input-group">
                                <label>Product Name</label>
                                <input type="text" name="productName" placeholder="e.g. Minimalist Oak Chair" required>
                            </div>

                            <div class="input-row">
                                <div class="input-group">
                                    <label>Category</label>
                                    <select name="productCategory" required>
                                        <option value="Furniture">Furniture</option>
                                        <option value="Lighting">Lighting</option>
                                        <option value="Decor">Decor</option>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <label>Price (PHP)</label>
                                    <input type="number" name="productPrice" step="0.01" placeholder="0.00" required>
                                </div>
                            </div>

                            <div class="input-group">
                                <label>Description</label>
                                <textarea name="productDescription" rows="4" placeholder="Describe the craftsmanship..."></textarea>
                            </div>
                        </div>

                        <div class="form-section">
                            <h3 class="section-title"><i class="fas fa-layer-group"></i> Inventory & Media</h3>

                            <div class="input-group">
                                <label>Stock Quantity</label>
                                <input type="number" name="productStock" placeholder="0" required>
                            </div>

                            <div class="input-group">
                                <label>Image URL</label>
                                <div class="url-input-wrapper">
                                    <i class="fas fa-link"></i>
                                    <input type="text" name="productImage" placeholder="https://image-source.com/photo.jpg">
                                </div>
                            </div>

                            <div class="image-preview-box" id="imagePreview">
                                <i class="fas fa-image"></i>
                                <p>Image Preview</p>
                            </div>

                            <div class="form-actions">
                                <button type="reset" class="btn-secondary">Clear</button>
                                <button type="submit" class="btn-primary">Confirm & Save</button>
                            </div>
                        </div>

                    </form>
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
                navItems.forEach(i => i.classList.remove('active'));
                sections.forEach(s => s.classList.remove('active'));

                item.classList.add('active');
                const targetId = item.getAttribute('data-tab');
                document.getElementById(targetId).classList.add('active');
            });
        });
    </script>
</body>

</html>