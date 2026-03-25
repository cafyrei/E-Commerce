<?php

use App\Models\UserModel;

$sess = session();

if ($sess->has('user_id')) {
    $model = new UserModel();
    $user = $model->find($sess->get('user_id'));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('assets/css/main.css') ?>">
    <title>E-Commerce</title>
</head>

<body>
    <?php include 'partials/navbar.php'; ?>

    <header class="hero">
        <h1>
            Crafted In Wood.
            <span>Built to last.</span>
        </h1>
        <p>Handmade wooden furniture and pieces shaped by time, grain, and care.</p>
        <a href="<?= base_url('catalog') ?>" class="small-btn">Shop Now!</a>
    </header>

    <div class="home2-container">

        <section class="section-wrapper">
            <h2 class="section-title">Our Promise</h2>
            <div class="promise-grid">
                <div class="promise-card">
                    <div class="placeholder-box"><img src="<?= base_url('assets/images/featured-photos/featured-2.jpg') ?>" alt="" srcset=""></div>
                    <div class="content">
                        <h3>Header</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</p>
                    </div>
                </div>
                <div class="promise-card">
                    <div class="placeholder-box">Image</div>
                    <div class="content">
                        <h3>Header</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</p>
                    </div>
                </div>
                <div class="promise-card">
                    <div class="placeholder-box">Image</div>
                    <div class="content">
                        <h3>Header</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</p>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <div class="home2-container">
        <section class="section-wrapper">
            <h2 class="section-title">Featured Works</h2>
            <div class="featured-main-grid">
                <div class="feat-box large">
                    <div class="img-area">Image</div>
                    <div class="feat-footer">
                        <div>
                            <h2>Header</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                        <a href="<?= base_url('catalog') ?>" class="small-btn">Shop now</a>
                    </div>
                </div>
                <div class="feat-box">
                    <div class="img-area">Image</div> 
                    <h2>Header</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
                <div class="feat-box">
                    <div class="img-area">Image</div>
                    <h2>Header</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
        </section>
    </div>

    <div class="home2-container">
        <section class="custom-project-box">
            <div class="custom-content">
                <h3>Header</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
                <div class="btn-group">
                    <a href="#" class="small-btn outline">Learn More &rarr;</a>
                    <a href="#" class="small-btn outline">Contact Us</a>
                </div>
            </div>
            <div class="custom-img-placeholder">
                <img src="<?= base_url('assets/images/featured-photos/featured-5.jpg') ?>" alt="">
            </div>
        </section>
        <h2 class="final-cta">Looking for a custom project?</h2>
    </div>

    <section class="featured-slider">
        <div class="slider-cta">
            <p class="cta-quote">"Furniture that tells a story, crafted for yours."</p>
            <h2 class="cta-title">Bring Nature Home</h2>
            <a href="<?= base_url('catalog') ?>" class="btn">Shop With Us</a>
        </div>

        <div class="slider-wrapper">
            <div class="feat-slide active">
                <img src="<?= base_url('assets/images/featured-photos/featured-2.jpg') ?>" alt="Handcrafted Table">
                <div class="feat-overlay">
                    <h3>The Oak Collection</h3>
                    <p>Sustainable, solid, and stunning.</p>
                </div>
            </div>

            <div class="feat-slide">
                <img src="<?= base_url('assets/images/featured-photos/featured-3.jpg') ?>" alt="Artisan Chair">
                <div class="feat-overlay">
                    <h3>Artisan Seating</h3>
                    <p>Comfort meets raw natural beauty.</p>
                </div>
            </div>

            <div class="feat-slide">
                <img src="<?= base_url('assets/images/featured-photos/featured-1.jpg') ?>" alt="Wooden Decor">
                <div class="feat-overlay">
                    <h3>Decorative Pieces</h3>
                    <p>Small details, massive impact.</p>
                </div>
            </div>
        </div>

        <div class="feat-nav">
            <button id="prevBtn">&larr;</button>
            <button id="nextBtn">&rarr;</button>
        </div>
    </section>
</body>

<script>
    const wrapper = document.querySelector('.slider-wrapper');
    const slides = document.querySelectorAll('.feat-slide');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    let index = 0;

    function updateSlider() {
        wrapper.style.transform = `translateX(-${index * 100}%)`;
    }

    nextBtn.addEventListener('click', () => {
        index = (index + 1) % slides.length;
        updateSlider();
    });

    prevBtn.addEventListener('click', () => {
        index = (index - 1 + slides.length) % slides.length;
        updateSlider();
    });

    setInterval(() => {
        index = (index + 1) % slides.length;
        updateSlider();
    }, 6000);
</script>

</html>