<?php get_header(); ?>

<section class="hero">
    <h1>Photographe event</h1>
    <?php 
        // Requête pour récupérer une image aléatoire du type de contenu 'photos' avec la taxonomie 'format' définie en 'paysage'
        $random_image = new WP_Query(array (
            'post_type' => 'photo',
            'tax_query' => array(
                array(
                    'taxonomy' => 'format',
                    'field' => 'slug',
                    'terms' => 'paysage',
                ),
            ),
            'orderby' => 'rand',
            'posts_per_page' => '1'
        ));

        // Afficher l'image aléatoire si disponible
        if ($random_image->have_posts()) {
            while ($random_image->have_posts()) {
                $random_image->the_post();
                echo '<img class="hero__background" src="';
                echo the_post_thumbnail_url();
                echo '" />';
            }
        }
        wp_reset_postdata();
    ?> 
</section>

<section class="galerie bloc-page">
    <div class="filtres colonnes">
        <div class="filtres__taxonomie colonnes colonne">
            <form id="categories" class="js-filter-form filtres__taxonomie_categories filtre colonne">
                <label for="select-categorie">Catégories</label>
                <select id="select-categorie" name="categorie">
                    <option value="all" hidden></option>
                    <option value="all">Toutes les catégories</option>
                    <?php afficherTaxonomies('categorie'); ?>
                </select>
            </form>
            <form id="format" class="js-filter-form filtres_taxonomie__formats filtre colonne">
                <label for="select-format">Formats</label>
                <select id="select-format" name="format">
                    <option value="all" hidden></option>
                    <option value="all">Tous les formats</option>
                    <?php afficherTaxonomies('format'); ?>
                </select>
            </form>
        </div>
        <div class="filtres__tri colonnes colonne">
            <form id="ordre" class="js-filter-form filtres_taxonomie__formats filtre colonne">
                <label for="select-ordre">Trier par</label>
                <select id="select-ordre" name="ordre">
                    <option class="js-ordre-item" value="DESC">Nouveautés</option>
                    <option class="js-ordre-item" value="ASC">Les plus anciens</option>
                </select>
            </form>
        </div>
    </div>
    <div class="galerie__photos colonnes">
        <?php 
            $galerie = new WP_Query(array(
                'post_type' => 'photo',
                'orderby' => 'date',
                'order' => 'DESC',
                'posts_per_page' => 8,
                'paged' => 1
            ));
            afficherImages($galerie, false);
        ?>
    </div>
    <div class="galerie__btn">
        <input type="button" id="btn-charger-plus" value="Charger plus">
    </div>
</section>

<?php get_footer(); ?>