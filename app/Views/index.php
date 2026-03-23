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
    <link rel="stylesheet" href="<?= base_url('assets/css/navbar.css') ?>">
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
        <a href="<?= base_url('home2') ?>" class="small-btn">Show more</a>
    </header>

</body>

</html>