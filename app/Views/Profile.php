<?php
$sess = session();

$nav_theme = 'dark';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/user.profile-style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/navbar-dark.css') ?>">
</head>

<body>

    <?php include 'partials/navbar.php'; ?>

    <div class="profile-layout-wrapper">

        <!-- SIDEBAR -->
        <aside class="custom-side-panel">
            <div class="side-box-stack">
                <div class="side-item-box active" data-target="account-content">My Account</div>
                <div class="side-item-box" data-target="orders-content">My Orders</div>
                <div class="side-item-box" data-target="favorites-content">My Favorites</div>
                <div class="side-item-box logout">Sign Out</div>
            </div>
        </aside>

        <!-- RIGHT PANEL -->
        <div class="content-center">

            <!-- ACCOUNT TAB -->
            <div class="tab-content" id="account-content">
                <!-- HEADER -->
                <div class="profile-header-meta">
                    <h2>Personal Data</h2>
                    <p>Manage your information to make checkout faster and easier.</p>
                </div>

                <!-- PERSONAL INFO ACCORDION -->
                <div class="accordion-section active">
                    <div class="accordion-header">
                        <span>Personal Info</span>
                        <span class="arrow">▶</span>
                    </div>
                    <div class="accordion-content">
                        <!-- PROFILE UPLOAD AREA -->
                        <div class="profile-upload-area">
                            <div class="avatar-large">A</div>
                            <button class="btn-outline">Edit Photo</button>
                        </div>

                        <form>
                            <div class="form-grid">
                                <div class="input-group">
                                    <label>First Name</label>
                                    <input type="text" name="first_name" value="<?= esc($user['first_name']) ?>">
                                </div>
                                <div class="input-group">
                                    <label>Last Name</label>
                                    <input type="text" name="last_name" value="<?= esc($user['last_name']) ?>">
                                </div>
                                <div class="input-group">
                                    <label>Birthdate</label>
                                    <input type="date" name="birthdate">
                                </div>
                                <div class="input-group">
                                    <label>Country</label>
                                    <select name="country">
                                        <option>Philippines</option>
                                        <option>United States</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="button" class="btn-outline">Cancel</button>
                                <button type="submit" class="btn-save">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- SECURITY ACCORDION -->
                <div class="accordion-section">
                    <div class="accordion-header">
                        <span>Security & Password</span>
                        <span class="arrow">▶</span>
                    </div>
                    <div class="accordion-content">
                        <form>
                            <div class="form-grid">
                                <div class="input-group">
                                    <label>Current Password</label>
                                    <input type="password" name="current_password" placeholder="Current Password">
                                </div>
                                <div class="input-group">
                                    <label>New Password</label>
                                    <input type="password" name="new_password" placeholder="New Password">
                                </div>
                                <div class="input-group">
                                    <label>Confirm Password</label>
                                    <input type="password" name="confirm_password" placeholder="Confirm Password">
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="button" class="btn-outline">Cancel</button>
                                <button type="submit" class="btn-save">Update Password</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- DELIVERY ADDRESSES ACCORDION -->
                <div class="accordion-section">
                    <div class="accordion-header">
                        <span>Delivery Addresses</span>
                        <span class="arrow">▶</span>
                    </div>
                    <div class="accordion-content">
                        <div class="address-list">
                            <div class="address-card">
                                <h4>Home</h4>
                                <p>Juan Dela Cruz</p>
                                <p>09123456789</p>
                                <p>123 Street, Barangay, City, Philippines</p>
                                <div class="address-actions">
                                    <button class="btn-outline">Edit</button>
                                    <button class="btn-outline">Delete</button>
                                </div>
                            </div>
                        </div>
                        <form class="address-form">
                            <h3>Add New Address</h3>
                            <div class="form-grid">
                                <div class="input-group">
                                    <label>Full Name</label>
                                    <input type="text" name="fullname" placeholder="Fullname">
                                </div>
                                <div class="input-group">
                                    <label>Phone Number</label>
                                    <input type="text" name="phone" placeholder="Contact Number">
                                </div>
                                <div class="input-group">
                                    <label>City</label>
                                    <input type="text" name="city" placeholder="City">
                                </div>
                                <div class="input-group">
                                    <label>Province</label>
                                    <input type="text" name="province" placeholder="Province">
                                </div>
                                <div class="input-group">
                                    <label>Postal Code</label>
                                    <input type="text" name="postal" placeholder="Postal Code">
                                </div>
                                <div class="input-group">
                                    <label>Label (Home, Work)</label>
                                    <input type="text" name="label" placeholder="Label">
                                </div>
                            </div>
                            <div class="input-group" style="margin-top:15px;">
                                <label>Full Address</label>
                                <input type="text" name="address" placeholder="Full Address">
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn-save">Add Address</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- ORDERS TAB -->
            <div class="tab-content" id="orders-content" style="display:none;">
                <div class="profile-header-meta">
                    <h2>Order History</h2>
                    <p>Your previous orders will be listed here.</p>
                </div>
            </div>

            <!-- FAVORITES TAB -->
            <div class="tab-content" id="favorites-content" style="display:none;">
                <div class="profile-header-meta">
                    <h2>Favorites</h2>
                    <p>Your saved items.</p>
                </div>
            </div>

        </div>
    </div>
</body>

<!-- JS -->
<script>
    const headers = document.querySelectorAll('.accordion-header');

    headers.forEach(header => {
        header.addEventListener('click', () => {
            const section = header.parentElement;
            document.querySelectorAll('.accordion-section').forEach(s => {
                if (s !== section) s.classList.remove('active');
            });

            section.classList.toggle('active');
        });
    });

    const sidebarItems = document.querySelectorAll('.side-item-box');
    const tabContents = document.querySelectorAll('.tab-content');

    sidebarItems.forEach(item => {
        item.addEventListener('click', () => {

            if (item.classList.contains('logout')) return;

            sidebarItems.forEach(i => i.classList.remove('active'));

            item.classList.add('active');

            tabContents.forEach(tab => tab.style.display = 'none');

            const target = document.getElementById(item.dataset.target);
            if (target) target.style.display = 'block';
        });
    });
</script>

</body>

</html>