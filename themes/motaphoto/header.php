<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            'theme_location' => 'header', // Remplace 'footer-menu' par le nom de ton emplacement de menu
            'menu_class' => 'header-menu-class', // Classe CSS facultative pour le menu
            ));
            ?>
            </div>
        </nav>
    </header>



