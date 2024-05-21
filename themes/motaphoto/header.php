<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="<?php echo get_template_directory_uri(); ?>./assets/js/modal.js"></script>
    <title>Motaphoto</title>
    <?php wp_head(); ?>
</head>
<body>
    <?php wp_body_open(); ?>    
    <header>
        <nav id="site-navigation" class="main-navigation">
            <div class="logo-container">
                <img src="<?php echo get_template_directory_uri();?>/assets/images/Logo.png" class="header_logo">
            </div>
            <div class="links-container">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'header', 
                    'menu_class' => 'header-menu-class', 
                ));
                ?>
                <div id="myModal" class="modal">
                    <div class="modal-content">
                    <img src="<?php echo get_template_directory_uri();?>/assets/images/title_modal.png" class="title_modal">
                        <?php echo do_shortcode('[contact-form-7 id="0d61f35" title="Contact form 1"]'); ?>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</body>
</html>
