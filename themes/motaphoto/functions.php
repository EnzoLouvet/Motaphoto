<?php
add_action('after_setup_theme', function() {
    add_theme_support('title-tag');
    add_theme_support('menus');
    register_nav_menus(array(
        'primary_menu' => __('Primary Menu'),
        'footer_menu'  => __('Footer Menu'),
    ));
});

function theme_enqueue_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/assets/css/header.css');
    wp_enqueue_style('footer-style', get_template_directory_uri() . '/assets/css/footer.css');
    wp_enqueue_style('single-style', get_template_directory_uri() . '/assets/css/single-photo.css');
    wp_enqueue_style('style-style', get_template_directory_uri() . '/assets/css/style.css');
    wp_enqueue_style('modal-style', get_template_directory_uri() . '/assets/css/modal.css');
    wp_enqueue_script('hamburger-js', get_template_directory_uri() . '/assets/js/hamburger.js');
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

function theme_scripts() {
    wp_enqueue_script('script', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), '', true);
    wp_localize_script('script', 'ajaxurl', admin_url('admin-ajax.php'));
}
add_action('wp_footer', 'theme_scripts');

function afficherTaxonomies($nomTaxonomie) {
    if($terms = get_terms(array(
        'taxonomy' => $nomTaxonomie,
        'orderby' => 'name'
    ))) {
        foreach ($terms as $term) {
            echo '<option class="js-filter-item" value="' . $term->slug . '">' . $term->name . '</option>';
        }
    }
}

function filter() {
    $tax_query = array('relation' => 'AND');

    if ($_POST['categorieSelection'] != 'all') {
        $tax_query[] = array(
            'taxonomy' => 'categorie',
            'field' => 'slug',
            'terms' => $_POST['categorieSelection'],
        );
    }

    if ($_POST['formatSelection'] != 'all') {
        $tax_query[] = array(
            'taxonomy' => 'format',
            'field' => 'slug',
            'terms' => $_POST['formatSelection'],
        );
    }

    $args = array(
        'post_type' => 'photo',
        'orderby' => 'date',
        'order' => $_POST['orderDirection'],
        'posts_per_page' => 8,
        'paged' => $_POST['page'],
    );

    if (!empty($tax_query)) {
        $args['tax_query'] = $tax_query;
    }

    $requeteAjax = new WP_Query($args);

    afficherImages($requeteAjax, true);
}
add_action('wp_ajax_nopriv_filter', 'filter');
add_action('wp_ajax_filter', 'filter');

function afficherImages($galerie, $exit) {
    if ($galerie->have_posts()) {
        while ($galerie->have_posts()) {
            $galerie->the_post();
            $categories = get_the_terms(get_the_ID(), 'categorie'); 
            $category_list = '';
            if ($categories && !is_wp_error($categories)) {
                $category_names = array();
                foreach ($categories as $category) {
                    $category_names[] = $category->name;
                }
                $category_list = implode(', ', $category_names);
            }
            ?>
            <div class="colonne">
                <div class="rangee">
                    <img class="img-medium" 
                         src="<?php echo the_post_thumbnail_url(); ?>" 
                         data-full="<?php echo the_post_thumbnail_url('full'); ?>" 
                         data-references="<?php echo esc_attr(get_field('references')); ?>" 
                         data-category="<?php echo esc_attr($category_list); ?>" /> 
                    <div>
                        <div class="img-hover">
                            <img class="btn-plein-ecran" src="<?php echo get_template_directory_uri(); ?>/assets/images/fullscreen.png" alt="Icône de plein écran" />
                            <a href="<?php echo get_post_permalink(); ?>">
                                <img class="btn-oeil" src="<?php echo get_template_directory_uri(); ?>/assets/images/eye_icon.png" alt="Icône en forme d'oeil" />
                            </a>
                            <div class="img-infos">
                                <?php
                                $reference_photo = get_field('references');
                                if ($reference_photo) {
                                    echo '<p>' . $reference_photo . '</p>';
                                }
                                ?>
                                <?php
                                if ($category_list) {
                                    echo '<p>' . $category_list . '</p>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        echo "";
    }
    wp_reset_postdata();
    if ($exit) {
        exit(); 
    }
}

function charger_plus_images() {
    $page = $_POST['page'];

    $offset = ($page - 1) * 8; 

    $galerie = new WP_Query(array(
        'post_type' => 'photo',
        'orderby' => 'date',
        'order' => 'DESC',
        'posts_per_page' => 8,
        'offset' => $offset 
    ));

    afficherImages($galerie, true);
}

add_action('wp_ajax_nopriv_charger_plus_images', 'charger_plus_images');
add_action('wp_ajax_charger_plus_images', 'charger_plus_images');
?>
