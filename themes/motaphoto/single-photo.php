<?php
// Inclure l'en-tête du thème
get_header();

// Démarrer la boucle WordPress
if (have_posts()) {
    while (have_posts()) {
        the_post();

        // Récupérer l'image associée à la page
        $image = get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'render_photo'));

        // Récupérer les champs personnalisés ACF
        $type_photo = get_field('type');
        $reference_photo = get_field('references');

        // Récupérer les années de la photo
        $annee_photo = get_the_term_list(get_the_ID(), 'annee');

        // Récupérer les catégories de la photo
        $categorie_photo = get_the_terms(get_the_ID(), 'categorie');
        $categorie_slug = '';
        if ($categorie_photo && !is_wp_error($categorie_photo)) {
            $categorie_slug = $categorie_photo[0]->slug;
        }

        // Récupérer les formats de la photo
        $format_photo = get_the_term_list(get_the_ID(), 'format');

        // Afficher une div enveloppant la photo et les textes
        echo '<div class="photo-container">';
        
        // Afficher une div pour les textes
        echo '<div class="text_info">';
        // Afficher le titre de la photo
        echo '<h2>' . get_the_title() . '</h2>';

        // Afficher le type et la référence de la photo
        echo '<p>Type de photo : ' . $type_photo . '</p>';
        echo '<p> ' . $reference_photo . '</p>';

        // Afficher les années de la photo
        if (!empty($annee_photo)) {
            echo '<p>Année(s) : ' . $annee_photo . '</p>';
        }

        // Afficher les catégories de la photo
        if (!empty($categorie_photo)) {
            echo '<p>Catégorie(s) : ' . get_the_term_list(get_the_ID(), 'categorie') . '</p>';
        }

        // Afficher les formats de la photo
        if (!empty($format_photo)) {
            echo '<p>Format(s) : ' . $format_photo . '</p>';
        }

        // Afficher le contenu de la photo si nécessaire
        the_content();

        echo '</div>'; // Fermer la div 'text_info'

        // Afficher une div pour la photo
        echo '<div class="photo_inside">';
        // Afficher l'image de la photo avec la classe 'render_photo'
        if (!empty($image)) {
            echo '<a href="' . get_the_post_thumbnail_url(get_the_ID(), 'full') . '" data-lightbox="image-1" data-title="' . get_the_title() . '">' . $image . '</a>';
        }
        echo '</div>'; // Fermer la div 'photo_inside'

        echo '</div>'; // Fermer la div 'photo-container'
    }
}
?>

<?php
// Récupérer l'ID de la photo actuellement affichée
$post_thumbnail_id = get_post_thumbnail_id();
// Récupérer la référence de la photo depuis ACF en utilisant l'ID de la photo
$ref_photo = get_field('ref', $post_thumbnail_id); // Assurez-vous que 'ref' est le bon nom de champ ACF

// Afficher la référence de la photo pour vérification
echo '<div style="display: none;">';
echo 'Référence de la photo : ' . $ref_photo;
echo '</div>';
echo '<div class="contact_inside">';
echo '<p>Cette photo vous intéresse ?</p>';

?>
<div class="modal_button" id="openModalButton"><a>Contact</a></div>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <img src="<?php echo get_template_directory_uri();?>/assets/images/title_modal.png" class="title_modal">
            <?php
            // Générer le formulaire de contact avec Contact Form 7
            echo do_shortcode('[contact-form-7 id="0d61f35" title="Contact form 1"]');
            ?>
            <script>
            // Pré-remplir le champ "REF-PHOTO" avec la référence de la photo
            jQuery(document).ready(function($) {
                var refPhotoField = $('input[data-name="REF-PHOTO"]');
                if (refPhotoField.length && '<?php echo esc_attr($ref_photo); ?>' !== '') {
                    refPhotoField.val('<?php echo esc_attr($ref_photo); ?>');
                }

                // Afficher la modale au clic sur le bouton de contact
                $('#openModalButton').click(function() {
                    $('#myModal').css('display', 'block');
                });

                // Fermer la modale au clic sur la zone de la modale
                $(window).click(function(event) {
                    if ($(event.target).hasClass('modal')) {
                        $('.modal').css('display', 'none');
                    }
                });
            });
            </script>
        </div>
    </div>

<?php
// Ajouter le lien "Suivante"
$next_post = get_adjacent_post(true, '', false);
if (!empty($next_post)) {
    $next_post_url = get_permalink($next_post->ID);
}
?>

<div class="galerie__photos colonnes padding">
<?php 

$current_category = get_the_terms(get_the_ID(), 'categorie');
$current_category_slug = '';
if ($current_category && !is_wp_error($current_category)) {
    foreach ($current_category as $category) {
        $current_category_slug = $category->slug;
        break;
    }
}
    $galerie = new WP_Query(array(
        'post_type' => 'photo',
        'orderby' => 'rand',
        'posts_per_page' => 1,
        'tax_query' => array(
            array(
                'taxonomy' => 'categorie',
                'field'    => 'slug',
                'terms'    => $current_category_slug,
            ),
        ),
    ));

    afficherImages($galerie, false, 'small-thumbnail'); // Utilisez la taille personnalisée
?>
</div>

</div>

<?php
// PARTIE "VOUS AIMEREZ AUSSI"

// Récupérer la catégorie actuelle de la photo
$current_category = get_the_terms(get_the_ID(), 'categorie');
$current_category_slug = '';
if ($current_category && !is_wp_error($current_category)) {
    foreach ($current_category as $category) {
        $current_category_slug = $category->slug;
        break;
    }
}

// Récupérer deux photos récentes de la même catégorie aléatoirement
?>
<div class="galerie__photos colonnes padding">
<?php 
    $galerie = new WP_Query(array(
        'post_type' => 'photo',
        'orderby' => 'rand',
        'posts_per_page' => 2, // Assurez-vous que le nombre de photos est bien 2
        'tax_query' => array(
            array(
                'taxonomy' => 'categorie',
                'field'    => 'slug',
                'terms'    => $current_category_slug,
            ),
        ),
    ));

    afficherImages($galerie, false, 'small-thumbnail'); // Utilisez la taille personnalisée
?>
</div>

<?php
// Inclure le pied de page du thème
get_footer();
?>

<script>
(function($) {
    $(document).ready(function() {
        // Afficher la modale au clic sur le bouton de contact
        $('#openModalButton').click(function(event) {
            event.preventDefault();
            $('#myModal').css('display', 'block');
        });

        // Fermer la modale en cliquant en dehors du contenu de la modale
        $(window).click(function(event) {
            if ($(event.target).hasClass('modal')) {
                $('#myModal').css('display', 'none');
            }
        });

        // Fermer la modale en cliquant sur un bouton de fermeture (ajoutez-en un si nécessaire)
        $('.close-modal').click(function() {
            $('#myModal').css('display', 'none');
        });
    });
})(jQuery);
</script>
