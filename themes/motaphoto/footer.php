<?php 
get_template_part('modale'); 
get_template_part('lightbox');
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
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
