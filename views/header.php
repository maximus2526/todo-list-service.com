<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="<?php echo get_url() ?>/js/modal.js"></script>
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
                <nav class="nav">
                    <a href="<?php echo get_url() ?>/?action=about" class="nav-elem">About</a>
                    <a href="<?php echo get_url() ?>/?action=auth" class="nav-elem">Login</a>
                </nav>
        </div>
        <?php 
        
        if (!$errors->has_errors()){
            $errors->show_massage();
        } else{
            $errors->show_error(); 
        }   
             
    
       
        
        
        ?>

        
