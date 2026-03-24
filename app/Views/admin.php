<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - E-Commerce</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h2><i class="fas fa-store"></i> Admin Panel</h2>
                <p>E-Commerce Management</p>
            </div>
            <ul class="sidebar-menu">
                <li><a href="#" class="active"><i class="fas fa-users"></i> Users</a></li>
                <li><a href="#"><i class="fas fa-box"></i> Products</a></li>
                <li><a href="#"><i class="fas fa-shopping-cart"></i> Orders</a></li>
                <li><a href="#"><i class="fas fa-dollar-sign"></i> Revenue</a></li>
                <li><a href="#"><i class="fas fa-chart-line"></i> Analytics</a></li>
                <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
                <li><a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Mobile Toggle -->
            <button class="toggle-sidebar" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Header -->
            <div class="header">
                <div>
                    <h1><i class="fas fa-users-cog"></i> User Management</h1>
                    <p>Manage all user accounts and permissions</p>
                </div>
                <div class="header-actions">
                    <button class="btn btn-primary" onclick="openModal('addUserModal')">
                        <i class="fas fa-plus"></i> Add User
                    </button>
                    <button class="btn btn-secondary">
                        <i class="fas fa-download"></i> Export
                    </button>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number" style="color: #667eea;">1,247</div>
                    <div class="stat-label">Total Users</div>
                    <div class="stat-growth growth-positive">
                        <i class="fas fa-arrow-up"></i> +12.5% from last month
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" style="color: #28a745;">892</div>
                    <div class="stat-label">Active Users</div>
                    <div class="stat-growth growth-positive">
                        <i class="fas fa-arrow-up"></i> +8.3%
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" style="color: #ffc107;">245</div>
                    <div class="stat-label">New Users</div>
                    <div class="stat-growth growth-positive">
                        <i class="fas fa-arrow-up"></i> +25.6%
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" style="color: #dc3545;">110</div>
                    <div class="stat-label">Banned Users</div>
                    <div class="stat-growth growth-negative">
                        <i class="fas fa-arrow-down"></i> -5.2%
                    </div>
                </div>
            </div>

            <!-- Users Table -->
            <div class="content-section">
                <div class="section-header">
                    <div class="section-title">All Users</div>
                    <div>
                        <input type="text" id="searchUsers" placeholder="Search users..." style="padding: 8px 15px; border: 2px solid #e9ecef; border-radius: 8px; width: 250px;">
                    </div>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Avatar</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Joined</th>
                                <th>Total Orders</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="usersTable">
                            <!-- Sample data - replace with real data -->
                            <tr>
                                <td>#001</td>
                                <td><img src="https://i.pravatar.cc/40?img=1" alt="User" style="width: 40px; height: 40px; border-radius: 50%;"></td>
                                <td>John Doe</td>
                                <td>john@example.com</td>
                                <td><span class="status-badge" style="background: #e7f3ff; color: #0066cc;">Customer</span></td>
                                <td><span class="status-badge status-active">Active</span></td>
                                <td>2024-01-15</td>
                                <td>12</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-sm btn-success" onclick="viewUser(1)">View</button>
                                        <button class="btn btn-sm btn-warning" onclick="editUser(1)">Edit</button>
                                        <button class="btn btn-sm btn-danger" onclick="deleteUser(1)">Delete</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>#002</td>
                                <td><img src="https://i.pravatar.cc/40?img=2" alt="User" style="width: 40px; height: 40px; border-radius: 50%;"></td>
                                <td>Jane Smith</td>
                                <td>jane@example.com</td>
                                <td><span class="status-badge" style="background: #fff3cd; color: #856404;">Admin</span></td>
                                <td><span class="status-badge status-active">Active</span></td>
                                <td>2024-02-01</td>
                                <td>45</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-sm btn-success" onclick="viewUser(2)">View</button>
                                        <button class="btn btn-sm btn-warning" onclick="editUser(2)">Edit</button>
                                        <button class="btn btn-sm btn-danger" onclick="deleteUser(2)">Delete</button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add User Modal -->
    <div id="addUserModal" class="modal">
        <div class="modal-content">
            <h2><i class="fas fa-user-plus"></i> Add New User</h2>
            <form id="addUserForm">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select name="role" required>
                        <option value="customer">Customer</option>
                        <option value="admin">Admin</option>
                        <option value="moderator">Moderator</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>
                <div style="display: flex; gap: 10px; justify-content: flex-end;">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('addUserModal')">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create User</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Toggle Sidebar
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
        }

        // Modal Functions
        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'block';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.style.display = 'none';
            }
        }

        // Form submission
        document.getElementById('addUserForm').addEventListener('submit', function(e) {
            e.preventDefault();
            // Add your API call here
            alert('User created successfully!');
            closeModal('addUserModal');
            this.reset();
        });

        // Search functionality
        document.getElementById('searchUsers').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('#usersTable tr');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // User action functions
        function viewUser(id) {
            alert(`Viewing user details for ID: ${id}`);
            // Implement view user modal or redirect
        }

        function editUser(id) {
            alert(`Editing user ID: ${id}`);
            // Implement edit user modal
        }

        function deleteUser(id) {
            if (confirm(`Are you sure you want to delete user #${id}?`)) {
                const row = event.target.closest('tr');
                row.remove();
                alert(`User #${id} deleted successfully!`);
            }
        }

        // Sidebar navigation
        document.querySelectorAll('.sidebar-menu a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelectorAll('.sidebar-menu a').forEach(l => l.classList.remove('active'));
                this.classList.add('active');

                // Load different content based on link
                const content = this.textContent.trim();
                if (content === 'Products') {
                    loadProducts();
                } else if (content === 'Orders') {
                    loadOrders();
                }
                // Add more sections as needed
            });
        });

        // Sample functions for other sections
        function loadProducts() {
            document.querySelector('.header h1').innerHTML = '<i class="fas fa-box"></i> Product Management';
            // Load products content
        }

        function loadOrders() {
            document.querySelector('.header h1').innerHTML = '<i class="fas fa-shopping-cart"></i> Order Management';
            // Load orders content
        }

        // Auto-refresh stats every 30 seconds (demo)
        setInterval(() => {
            // Simulate live stats update
            const numbers = document.querySelectorAll('.stat-number');
            numbers.forEach((num, index) => {
                const current = parseInt(num.textContent.replace(/[^\d]/g, ''));
                const change = Math.floor(Math.random() * 10) - 5;
                num.textContent = (current + change).toLocaleString();
            });
        }, 30000);

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Admin Dashboard loaded successfully!');
        });
    </script>
</body>

</html>