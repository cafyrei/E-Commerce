        <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>About Us | Artisan Woodworks</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&family=Playfair+Display:ital,wght@0,700;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/about.css') ?>">
</head>

<body>

    <?php include 'partials/navbar.php'; ?>

    <main class="about-page-wrapper">

        <section class="full-hero-container">
            <div class="full-hero-image">
                <img src="<?= base_url('assets/images/about-Images/Background2.jpg') ?>" alt="Our Workshop" class="story-img-left">
                <h1 class="hero-title">Artisan Woodworks</h1>
            </div>

            <div class="full-hero-text">
                <div class="text-inner">
                    <p>
                        Artisan Woodworks is a pioneering force in the furniture industry, committed to advancing
                        innovation and growth within the realm of home and interior design. Our mission revolves
                        around empowering homeowners and interior lovers alike, equipping them with the necessary
                        pieces, custom furniture, and bespoke designs to unleash their vision and create groundbreaking
                        living experiences.
                    </p>
                    <p>
                        We foster a supportive ecosystem that not only encourages sustainable sourcing but also
                        champions
                        traditional craftsmanship, heritage techniques, and community engagement. At Artisan Woodworks,
                        we strive for excellence in material selection and durability, pushing the boundaries of
                        woodworking
                        through time-honored joinery and strategic design partnerships.
                    </p>
                </div>
            </div>
        </section>

        <section class="content-body">

            <div class="team-wrapper">
                <h2 class="section-title">The Master Artisans</h2>
                <div class="team-container">

                    <div class="team-card">
                        <div class="member-image">
                            <img src="<?= base_url('assets/images/artisan-images/allen.jpg') ?>" alt="Allen Alcabaza">
                        </div>
                        <div class="member-info">
                            <h3>Allen Alcabaza</h3>
                            <span class="role">Placeholder</span>
                            <p>Placeholder</p>
                        </div>
                    </div>

                    <div class="team-card">
                        <div class="member-image">
                            <img src="Images/team2.jpg" alt="James Manzano">
                        </div>
                        <div class="member-info">
                            <h3>James Manzano</h3>
                            <span class="role">Placeholder</span>
                            <p>Placeholder</p>
                        </div>
                    </div>

                    <div class="team-card">
                        <div class="member-image">
                            <img src="Images/team3.jpg" alt="Sean Nieves">
                        </div>
                        <div class="member-info">
                            <h3>Sean Nieves</h3>
                            <span class="role">Placeholder</span>
                            <p>Placeholder</p>
                        </div>
                    </div>

                    <div class="team-card">
                        <div class="member-image">
                            <img src="Images/team4.jpg" alt="Rovic Sarthou">
                        </div>
                        <div class="member-info">
                            <h3>Rovic Sarthou</h3>
                            <span class="role">Placeholder</span>
                            <p>Placeholder</p>
                        </div>
                    </div>

                    <div class="team-card">
                        <div class="member-image">
                            <img src="Images/team5.jpg" alt="Miggy Valmonte">
                        </div>
                        <div class="member-info">
                            <h3>Miggy Valmonte</h3>
                            <span class="role">Placeholder</span>
                            <p>Placeholder</p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="story-block reverse">
                <div class="story-image">
                    <img src="<?= base_url('assets/images/about-Images/Background1.jpg') ?>" alt="Handcrafted Detail">
                </div>
                <div class="story-text">
                    <p>
                        Our mission revolves around empowering homeowners and interior lovers alike,
                        equipping them with the necessary pieces to transform their living spaces.
                        We foster a supportive ecosystem that not only encourages sustainable sourcing
                        but also champions traditional craftsmanship and community engagement.
                    </p>
                </div>
            </div>

            <div class="story-block">
                <div class="story-image">
                    <img src="<?= base_url('assets/images/about-Images/Background3.jpg') ?>" alt="Finished Furniture">
                </div>
                <div class="story-text">
                    <p>
                        At our core, we strive for excellence in design and durability, pushing the
                        boundaries of modern furniture through time-honored techniques. Our goal is
                        to redefine the home landscape, delivering immersive and memorable
                        environments to families worldwide.
                    </p>
                </div>
            </div>

            <div class="values-wrapper">
                <h2 class="section-title">One Company, One Community</h2>
                <div class="values-grid">
                    <div class="value-card">
                        <div class="icon-box"><i class="fas fa-eye"></i></div>
                        <h3>Vision</h3>
                        <p>To lead the charge in transforming the furniture industry through sustainable innovation and
                            timeless creativity.</p>
                    </div>
                    <div class="value-card">
                        <div class="icon-box"><i class="fas fa-bullseye"></i></div>
                        <h3>Mission</h3>
                        <p>To empower homeowners by providing the high-quality, handcrafted tools and furniture they
                            need to thrive.</p>
                    </div>
                    <div class="value-card">
                        <div class="icon-box"><i class="fas fa-award"></i></div>
                        <h3>Goal</h3>
                        <p>To redefine the domestic landscape by fostering an inclusive environment that encourages
                            architectural beauty.</p>
                    </div>
                </div>
            </div>


    </main>

</body>

</html>