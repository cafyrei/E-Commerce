<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - E-Commerce</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: #f4f6f8;
            color: #333;
        }

        /* Admin Container */
        .admin-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: #1f2937;
            color: #fff;
            position: fixed;
            height: 100%;
            overflow-y: auto;
            transition: transform 0.3s ease;
            z-index: 1000;
        }

        .sidebar-header {
            padding: 25px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-header h2 {
            font-size: 1.6rem;
            margin-bottom: 5px;
        }

        .sidebar-header p {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.7);
        }

        .sidebar-menu {
            list-style: none;
            padding: 20px 0;
        }

        .sidebar-menu li {
            margin-bottom: 5px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 15px 25px;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .sidebar-menu a.active,
        .sidebar-menu a:hover {
            background: #374151;
            transform: translateX(5px);
        }

        .sidebar-menu i {
            margin-right: 15px;
            font-size: 1.1rem;
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            flex: 1;
            padding: 25px;
            transition: margin-left 0.3s ease;
        }

        /* Mobile Sidebar Toggle */
        .toggle-sidebar {
            display: none;
            position: fixed;
            top: 20px;
            left: 20px;
            background: #2563eb;
            color: #fff;
            border: none;
            padding: 12px 15px;
            border-radius: 8px;
            cursor: pointer;
            z-index: 1100;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .toggle-sidebar {
                display: block;
            }
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .header h1 {
            font-size: 1.8rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header-actions {
            display: flex;
            gap: 15px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-primary:hover {
            background: #1e40af;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(37, 99, 235, 0.4);
        }

        .btn-secondary {
            background: #f3f4f6;
            color: #111827;
            border: 2px solid #e5e7eb;
        }

        .btn-secondary:hover {
            background: #e5e7eb;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-number {
            font-size: 2.3rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #6b7280;
            font-size: 0.95rem;
        }

        .stat-growth {
            margin-top: 10px;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .growth-positive {
            color: #10b981;
        }

        .growth-negative {
            color: #ef4444;
        }

        /* Users Table */
        .content-section {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .section-header {
            padding: 20px 25px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .section-title {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 15px 20px;
            text-align: left;
        }

        th {
            background: #f3f4f6;
            position: sticky;
            top: 0;
        }

        tr:hover {
            background: #f9fafb;
        }

        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .status-active {
            background: #d1fae5;
            color: #065f46;
        }

        .status-inactive {
            background: #fee2e2;
            color: #991b1b;
        }

        .status-pending {
            background: #fef3c7;
            color: #78350f;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 2000;
            backdrop-filter: blur(5px);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .modal-content {
            background: white;
            border-radius: 12px;
            width: 100%;
            max-width: 500px;
            padding: 30px;
            max-height: 90vh;
            overflow-y: auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        input,
        select {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 2px solid #e5e7eb;
            font-size: 1rem;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: #2563eb;
        }
    </style>
</head>

<body>
    <button class="toggle-sidebar" onclick="toggleSidebar()"><i class="fas fa-bars"></i></button>
    <div class="admin-container">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h2><i class="fas fa-store"></i> Admin Panel</h2>
                <p>E-Commerce Dashboard</p>
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
            <!-- Header -->
            <div class="header">
                <div>
                    <h1><i class="fas fa-users-cog"></i> User Management</h1>
                </div>
                <div class="header-actions">
                    <button class="btn btn-primary" onclick="openModal('addUserModal')"><i class="fas fa-plus"></i> Add
                        User</button>
                    <button class="btn btn-secondary"><i class="fas fa-download"></i> Export</button>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number" style="color: #2563eb;">1,247</div>
                    <div class="stat-label">Total Users</div>
                    <div class="stat-growth growth-positive"><i class="fas fa-arrow-up"></i> +12.5%</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" style="color: #10b981;">892</div>
                    <div class="stat-label">Active Users</div>
                    <div class="stat-growth growth-positive"><i class="fas fa-arrow-up"></i> +8.3%</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" style="color: #facc15;">245</div>
                    <div class="stat-label">New Users</div>
                    <div class="stat-growth growth-positive"><i class="fas fa-arrow-up"></i> +25.6%</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" style="color: #ef4444;">110</div>
                    <div class="stat-label">Banned Users</div>
                    <div class="stat-growth growth-negative"><i class="fas fa-arrow-down"></i> -5.2%</div>
                </div>
            </div>

            <!-- Users Table -->
            <div class="content-section">
                <div class="section-header">
                    <div class="section-title">All Users</div>
                    <div>
                        <input type="text" id="searchUsers" placeholder="Search users...">
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
                            <tr>
                                <td>#001</td>
                                <td><img src="https://i.pravatar.cc/40?img=1" alt="User"
                                        style="width: 40px; border-radius: 50%;"></td>
                                <td>John Doe</td>
                                <td>john@example.com</td>
                                <td><span class="status-badge" style="background:#e7f3ff;color:#0066cc;">Customer</span></td>
                                <td><span class="status-badge status-active">Active</span></td>
                                <td>2024-01-15</td>
                                <td>12</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-sm btn-success" onclick="viewUser(1)">View</button>
                                        <button class="btn btn-sm btn-warning" onclick="editUser(1)">Edit</button>
                                        <button class="btn btn-sm btn-danger" onclick="deleteUser(1,event)">Delete</button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Add more rows -->
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
                <div style="display:flex;gap:10px;justify-content:flex-end;">
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
        function openModal(id) {
            document.getElementById(id).style.display = 'flex';
        }

        function closeModal(id) {
            document.getElementById(id).style.display = 'none';
        }

        window.onclick = function (e) {
            if (e.target.classList.contains('modal')) closeModal(e.target.id);
        }

        document.getElementById('addUserForm').addEventListener('submit', function (e) {
            e.preventDefault();
            alert('User created successfully!');
            closeModal('addUserModal');
            this.reset();
        });

        // Search Users
        document.getElementById('searchUsers').addEventListener('input', function () {
            const term = this.value.toLowerCase();
            document.querySelectorAll('#usersTable tr').forEach(row => {
                const name = row.cells[2].textContent.toLowerCase();
                const email = row.cells[3].textContent.toLowerCase();
                const role = row.cells[4].textContent.toLowerCase();
                row.style.display = (name.includes(term) || email.includes(term) || role.includes(term)) ? '' : 'none';
            });
        });

        function deleteUser(id, event) {
            if (confirm(`Delete user #${id}?`)) {
                event.target.closest('tr').remove();
                alert(`User #${id} deleted!`);
            }
        }

        function viewUser(id) { alert(`View user ${id}`); }
        function editUser(id) { alert(`Edit user ${id}`); }
    </script>
</body>

</html>