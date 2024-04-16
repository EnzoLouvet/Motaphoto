<footer>
<?php
wp_nav_menu(array(
    'theme_location' => 'footer', // Remplace 'footer-menu' par le nom de ton emplacement de menu
    'menu_class' => 'footer-menu-class', // Classe CSS facultative pour le menu
));
?>
</footer>
<?php wp_footer(); ?>
</body>
</html>