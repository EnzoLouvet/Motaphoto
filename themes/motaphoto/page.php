
<?php
get_header();
?>
<main id="primary" class="site-main">

        <div class="pages-content">
            <?= get_post_field('post_content', $post->ID) ?>
            <h1>Bonne journée</h1>
        </div>
    </main>
<?php
get_footer();
?>