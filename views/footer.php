<div class="footer">
                <div class="rights">
                    <p>2023 © TODOS</p>
                </div>
                <nav class="nav">
                    <a href="<?php echo get_url() ?>/?action=about" class="nav-elem">About</a>
                    <?php if (isset($_SESSION['user_id'])): ?>
                    <a class="nav-elem" href="<?php echo get_url() ?>/?action=logout">Logout</a>
                    <?php else: ?>
                    <a href="<?php echo get_url() ?>/?action=auth" class="nav-elem">Login</a>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
</div>
</body>
</html>