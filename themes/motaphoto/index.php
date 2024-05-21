<?php
get_header();
?>

<head>
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/assets/css/styles.css"> <!-- Lien vers votre fichier CSS externe -->
</head>

<div class="random-photo-container">
    <?php
    include 'photos.php';

    // Sélectionner un index aléatoire dans le tableau des photos
    $indexAleatoire = array_rand($photos);

    // Récupérer les informations de la photo aléatoire
    $photoAleatoire = $photos[$indexAleatoire];
    ?>
    <img src="<?php echo $photoAleatoire['image']; ?>" alt="<?php echo $photoAleatoire['titre']; ?>" class="photo-aleatoire">
    <img src="<?php echo get_template_directory_uri();?>/assets/images/photographe_event.png" class="photographe_event">
</div>

<div class="gallery-container">

<?php
// Arguments pour WP_Query
$args = array(
    'post_type' => 'post', // Ou le type de post où vous avez le champ ACF
    'posts_per_page' => 8, // Nombre de posts à récupérer
    'meta_query' => array(
        array(
            'key' => 'photo', // Nom du champ ACF
            'compare' => 'EXISTS',
        ),
    ),
);

// Nouvelle requête WP_Query
$query = new WP_Query($args);

// Vérifie si des posts ont été trouvés
if ($query->have_posts()) : ?>
    <div class="gallery-container">
        <?php while ($query->have_posts()) : $query->the_post(); 
            $image = get_field('photo'); // Récupère l'image du champ ACF
            if ($image) :
                $image_url = $image['url']; // URL de l'image
                $image_alt = $image['alt']; // Texte alternatif de l'image
                ?>
                <div class="gallery-item">
                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                </div>
            <?php endif; ?>
        <?php endwhile; ?>
    </div>
    <?php
    // Réinitialise les données post globales
    wp_reset_postdata();
else : ?>
    <p>Aucune image trouvée.</p>
<?php endif; ?>


</div>  

<?php
get_footer();
?>
