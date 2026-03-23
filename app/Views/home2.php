<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page 2</title>
    <link rel="stylesheet" href="<?= base_url('css/main.css') ?>">
</head>
<body>

    <nav>
        <div class="logo">
            <a href="<?= base_url('/') ?>">
                <img src="<?= base_url('images/Logo.png') ?>" alt="Furniture Brand Logo">
            </a>
        </div>
        <div class="nav-links">
            <a href="<?= base_url('/') ?>">Home</a>
            <a href="<?= base_url('about') ?>">About</a>
            <a href="<?= base_url('admin_signin') ?>">Sign In</a>
        </div>
    </nav>

    <main class="home2-container">

        <section class="promise-section">
            <h2>Our Promise</h2>

            <div class="promise-cards">
                <div class="card small-card">
                    <div class="img-box small-img">(Image)</div>
                    <div class="card-text">
                        <h3>Header</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod consequat.</p>
                    </div>
                </div>

                <div class="card small-card">
                    <div class="img-box small-img">(Image)</div>
                    <div class="card-text">
                        <h3>Header</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod consequat.</p>
                    </div>
                </div>

                <div class="card small-card">
                    <div class="img-box small-img">(Image)</div>
                    <div class="card-text">
                        <h3>Header</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod consequat.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="featured-section">
            <h2>Featured Works</h2>

            <div class="featured-grid">
                <div class="card featured-card featured-large">
                    <div class="img-box featured-img">(Image)</div>
                    <div class="featured-content">
                        <h3>Header</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod consequat.</p>
                        <a href="#" class="small-btn">Shop now →</a>
                    </div>
                </div>

                <div class="card featured-card">
                    <div class="img-box featured-img">(Image)</div>
                    <div class="featured-content">
                        <h3>Header</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod consequat.</p>
                    </div>
                </div>

                <div class="card featured-card">
                    <div class="img-box featured-img">(Image)</div>
                    <div class="featured-content">
                        <h3>Header</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod consequat.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="custom-section">
            <div class="custom-text card">
                <h3>Header</h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat.
                </p>

                <div class="custom-buttons">
                    <a href="#" class="small-btn">Learn More →</a>
                    <a href="<?= base_url('admin_signin') ?>" class="small-btn">Sign In</a>
                </div>
            </div>

            <div class="custom-image card">
                <div class="img-box custom-img">(Website Picture)</div>
            </div>
        </section>

        <section class="bottom-callout">
            <h2>Looking for a custom project?</h2>
        </section>

    </main>

</body>
</html>