<?php 
get_template_part('template-parts/modale'); 
get_template_part('template-parts/lightbox');
?>
<footer class="footer">
    <nav class="footer__nav">
        <?php
        if (has_nav_menu('primary_menu')) {
            wp_nav_menu(array('theme_location' => 'footer'));
        }
        ?>
    </nav>
    <?php wp_footer(); ?>
</footer>

</body>
</html>
