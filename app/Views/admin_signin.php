<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sign In</title>
    <link rel="stylesheet" href="<?= base_url('css/main.css') ?>">
</head>
<body>

    <nav>
        <div class="logo">
            <a href="<?= base_url('/') ?>">
                <img src="<?= base_url('images/Logo.png') ?>" alt="Logo">
            </a>
        </div>

        <div class="nav-links">
            <a href="<?= base_url('/') ?>">Home</a>
            <a href="<?= base_url('about') ?>">About</a>
            <a href="<?= base_url('admin_signin') ?>">Sign In</a>
        </div>
    </nav>

    <section class="signin-page">
        <div class="signin-wrapper">
            <div class="signin-left">
                <div class="signin-form-area">
                    <h1>SIGN IN</h1>

                    <form>
                        <input type="text" placeholder="Email or Username">

                        <div class="password-box">
                            <input type="password" placeholder="Password">
                            <span class="eye-icon">👁</span>
                        </div>

                        <div class="signin-options">
                            <label class="remember-me">
                                <input type="checkbox">
                                <span>Remember Me</span>
                            </label>

                            <a href="#">Forgot Password?</a>
                        </div>

                        <button type="submit" class="signin-btn">Sign In</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

</body>
</html>