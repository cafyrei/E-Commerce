<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Access | System Control</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/admin-login.css') ?>">

    <style>
        .error {
            background-color: rgba(248, 113, 113, 0.1);
            color: #f87171;
            border: 1px solid rgba(248, 113, 113, 0.2);
            padding: 0.75rem 1rem;
            border-radius: 6px;
            font-size: 0.85rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            animation: slideIn 0.3s ease-out;
        }

        .error::before {
            font-size: 0.6rem;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <div class="header">
                <h2>Admin Login</h2>
                <p>Authorize your session to continue</p>
            </div>
            <form action="<?= base_url('/admin/authenticate') ?>" method="POST">
                <div class="input-group">
                    <label for="admin">Username</label>
                    <input type="text" id="admin" name="admin" required placeholder="Enter admin ID">
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required placeholder="••••••••">
                </div>
                <button type="submit" class="login-btn">Secure Login</button>
                <?php if (isset($error)): ?>
                    <p class="error"><?= $error ?></p>
                <?php endif; ?>
            </form>
        </div>
    </div>
</body>

</html>