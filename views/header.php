<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './inc/helper.php'; ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo get_url() ?>/views/css/style.css">
    <title>Todos</title>
</head>
<body>
    <div class="container">
        <div class="header">
                <div class="logo">
                    <a href="/"> <img class="logo-img" src="<?php echo get_url() ?>/views/img/logo.png" alt="TODO"> </a>
                </div>
                <nav class="nav">
                    <a href="#" class="nav-elem">About</a>
                    <a href="#" class="nav-elem">ToDo</a>
                    <a href="#" class="nav-elem">Login</a>
                </nav>
        </div>

        <div class="content">
            <h1>Todos</h1>
            <div class="add-task">
                <div class="block-title">
                    <p block-title>Add a task</p>
                </div>
                <div class="block-form">
                    <label>Item</label>
                    <input placeholder="What do you want to do?" type="text">
                    <p>Enter what you want to procastinate</p>
                    <button type="submit">Submit</button>
                </div>
            </div>

            <div class="tasks">
                <div class="block-title">
                    <p>Tasks</p>
                </div>
                <div class="block-task">
                    <table>
                        <tr>Item</tr>
                        <tr>Status</tr>
                        <tr>Action</tr>
                    </table>
                </div>
            </div>
        </div>
</div>
</body>
</html>