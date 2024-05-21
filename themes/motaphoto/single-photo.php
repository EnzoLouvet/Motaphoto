<script src="<?php echo get_template_directory_uri(); ?>./assets/js/single-photo.js"></script>

<?php
// Incluez l'en-tête du thème
get_header();

// Commencez la boucle WordPress
if (have_posts()) {
    while (have_posts()) {
        the_post();

        // Récupérez l'image associée à la page
        $image = get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'render_photo'));

        // Récupérez les champs personnalisés ACF
        $type_photo = get_field('type');
        $reference_photo = get_field('references');

        // Récupérez les années de la photo
        $annee_photo = get_the_term_list(get_the_ID(), 'annee');

        // Récupérez les catégories de la photo
        $categorie_photo = get_the_term_list(get_the_ID(), 'categorie');

        // Récupérez les formats de la photo
        $format_photo = get_the_term_list(get_the_ID(), 'format');

        // Affichez une div englobant la photo et les textes
        echo '<div class="photo-container">';
        
        // Affichez une div pour les textes
        echo '<div class="text_info">';
        // Affichez le titre de la photo
        echo '<h2>' . get_the_title() . '</h2>';

        // Affichez le type et la référence de la photo
        echo '<p>Type de photo : ' . $type_photo . '</p>';
        echo '<p>Référence : ' . $reference_photo . '</p>';

        // Affichez les années de la photo
        if (!empty($annee_photo)) {
            echo '<p>Année(s) : ' . $annee_photo . '</p>';
        }

        // Affichez les catégories de la photo
        if (!empty($categorie_photo)) {
            echo '<p>Catégorie(s) : ' . $categorie_photo . '</p>';
        }

        // Affichez les formats de la photo
        if (!empty($format_photo)) {
            
            echo '<p>Format(s) : ' . $format_photo . '</p>';
        }

        // Affichez le contenu de la photo si nécessaire
        the_content();

        echo '</div>'; // Fermeture de la div 'text'

        // Affichez une div pour la photo
        echo '<div class="photo_inside">';
        // Affichez l'image de la photo avec la classe 'render_photo'
        if (!empty($image)) {
            echo '<div class="test">' . $image . '</div>';
        }
        echo '</div>'; // Fermeture de la div 'photo'

        echo '</div>'; // Fermeture de la div 'photo-container'   
    }
}?>

<?php
// Récupérer l'ID de la photo actuellement affichée sur la page
$post_thumbnail_id = get_post_thumbnail_id();
// Récupérer la référence de la photo à partir de ACF en utilisant l'ID de la photo
$ref_photo = get_field('ref', $post_thumbnail_id); // Assurez-vous que 'ref' est le nom correct du champ ACF

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
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
            // Préremplir le champ "REF-PHOTO" avec la référence de la photo
            jQuery(document).ready(function($) {
                var refPhotoField = $('input[data-name="REF-PHOTO"]');
                if (refPhotoField.length && '<?php echo esc_attr($ref_photo); ?>' !== '') {
                    refPhotoField.val('<?php echo esc_attr($ref_photo); ?>');
                }
            });
            </script>
        </div>
    </div>
</div>


              
       





<?php
// PARTIE "VOUS AIMEREZ AUSSI"

// Récupérer la catégorie actuelle de la photo
 $current_category = get_the_terms(get_the_ID(), 'categorie');

// Récupérer les deux dernières photos de la même catégorie
if ($current_category) {
    $category_id = $current_category[0]->term_id;
    $args = array(
        'post_type' => 'photo', // Le nom du type de contenu personnalisé
        'posts_per_page' => 2, // Nombre de photos à afficher
        'tax_query' => array(
            array(
                'taxonomy' => 'categorie', // Le nom de la taxonomie
                'field' => 'term_id',
                'terms' => $category_id, // L'ID de la catégorie actuelle
            ),
        ),
        'post__not_in' => array(get_the_ID()) // Exclure la photo actuellement affichée
    );
    $related_photos = get_posts($args);
    if ($related_photos) {
        echo '<div class="vous_aimerez_aussi">';
        echo '<p>Vous aimerez aussi :</p>';
        echo '<div class="related-photos-container">'; // Div parent pour les photos
    
        foreach ($related_photos as $related_photo) {
            echo '<div class="related-photo">';
            echo get_the_post_thumbnail($related_photo->ID, 'full');
            echo '</div>';
        }
    
        echo '</div>'; // Fermeture de la div parent
        echo '</div>';
    }
}    
// Inclure le pied de page du thème
get_footer();
?>
