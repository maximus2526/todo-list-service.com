<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="<?php echo get_url() ?>/views/js/modal.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Playfair+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo get_url() ?>/views/css/style.css">
    <title>Todos</title>
</head>
<body>
    <div class="container">
        <div class="header">
                <div class="logo">
                    <a href="<?php echo get_url() ?>"> <h1>Todos</h1> </a>
                </div>
                <?php if (is_logged_in()): ?>
                    <p class="nav-elem">Hi, <?php echo get_user_name() ?>. <a href="<?php echo get_url() ?>/?action=logout">Logout.</a></p>
                <?php else: ?>
                    <a href="<?php echo get_url() ?>/?action=auth" class="nav-elem">Login</a>
                <?php endif; ?>
        </div>
        
        <?php 

        Errors::display();
 
        ?>

        
