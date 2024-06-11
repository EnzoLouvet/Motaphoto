(function($) {
    'use strict';

    // Ajoute la classe 'bouton' aux éléments ayant la classe '.wpcf7-submit'
    $('.wpcf7-submit').addClass('bouton');

    // Variables globales pour la pagination et les filtres
    var page = 1;
    var categorieSelection = 'all';
    var formatSelection = 'all';
    var orderDirection = 'DESC';

    // Fonction pour mettre à jour les images en fonction des filtres
    function updateImages() {
        $.ajax({
            url: ajaxurl,
            type: 'post',
            data: {
                action: 'filter',
                categorieSelection: categorieSelection,
                formatSelection: formatSelection,
                orderDirection: orderDirection,
                page: page
            },
            success: function(response) {
                if (response) {
                    $('.galerie__photos').html(response); // Mettre à jour le contenu de la galerie
                    initLightboxEvents(); // Réinitialiser les événements de la lightbox
                } else {
                    $('.galerie__photos').html('<p>Aucune image trouvée.</p>');
                }
            }
        });
    }

    // Écouter les changements dans les sélecteurs de filtres
    $('#select-categorie').on('change', function() {
        categorieSelection = $(this).val();
        page = 1; // Réinitialiser la pagination
        updateImages();
    });

    $('#select-format').on('change', function() {
        formatSelection = $(this).val();
        page = 1; // Réinitialiser la pagination
        updateImages();
    });

    $('#select-ordre').on('change', function() {
        orderDirection = $(this).val();
        page = 1; // Réinitialiser la pagination
        updateImages();
    });

    // Charger plus d'images
    $('#btn-charger-plus').on('click', function() {
        page++;
        $.ajax({
            url: ajaxurl,
            type: 'post',
            data: {
                action: 'charger_plus_images',
                categorieSelection: categorieSelection,
                formatSelection: formatSelection,
                orderDirection: orderDirection,
                page: page
            },
            success: function(response) {
                if (response) {
                    $('.galerie__photos').append(response);
                    initLightboxEvents(); // Réinitialiser les événements de la lightbox
                } else {
                    $('#btn-charger-plus').hide(); // S'il n'y a plus d'images à charger, cachez le bouton
                }
            }
        });
    });

    // Initialisation des événements de la lightbox
    function initLightboxEvents() {
        // Variables globales pour suivre l'image actuelle et la liste des images
        var images = [];
        var currentIndex = -1;

        // Sélectionne les éléments de la lightbox et des boutons de fermeture
        var btnFermetureLightbox = $('#close-lightbox');

        // Lorsqu'on clique sur un bouton avec la classe '.btn-plein-ecran'
        $(document).on('click', '.btn-plein-ecran', function() {
            var image = $(this).closest('.rangee').find('.img-medium');
            var urlImage = image.attr('data-full');
            var categoryImage = image.attr('data-category'); // Récupérer la catégorie
            var referenceImage = image.attr('data-references');
            
            // Débogage : Vérifiez les valeurs récupérées
            console.log("URL de l'image:", urlImage);
            console.log("Catégorie de l'image:", categoryImage);
            console.log("Référence de l'image:", referenceImage);
            
            var creerImage = `<img src="${urlImage}" alt="Image agrandie">`;
            $('.lightbox__image').html(creerImage);
            $('#lightbox-title').text(categoryImage); // Afficher la catégorie
            $('#lightbox-reference').text(referenceImage);
            transitionPopup($('.lightbox'), 1); // Affiche la lightbox avec effet de transition

            // Met à jour les images et l'index actuel
            images = $('.img-medium').map(function() {
                return {
                    url: $(this).data('full'),
                    category: $(this).data('category'), // Ajouter la catégorie
                    reference: $(this).data('references')
                };
            }).get();
            currentIndex = $('.img-medium').index(image);
        });

        // Lorsqu'on clique sur le bouton de fermeture de la lightbox
        btnFermetureLightbox.click(function() {
            transitionPopup($('.lightbox'), 0); // Ferme la lightbox avec effet de transition
        });

        // Fonction pour effectuer une transition d'affichage avec une opacité donnée
        function transitionPopup(element, opacity) {
            $(element).css('display', opacity === 1 ? 'flex' : 'none');
            $(element).animate({ opacity: opacity }, 500); // Utilisation de la variable dureeTransitionPopup
        }

        // Gérer la navigation entre les images dans la lightbox
        $('.fleche-gauche, .fleche-droite').click(function() {
            if ($(this).hasClass('fleche-gauche')) {
                currentIndex = (currentIndex - 1 + images.length) % images.length;
            } else {
                currentIndex = (currentIndex + 1) % images.length;
            }
            var image = images[currentIndex];
            var creerImage = `<img src="${image.url}" alt="Image agrandie">`;
            $('.lightbox__image').html(creerImage);
            $('#lightbox-title').text(image.category); // Afficher la catégorie
            $('#lightbox-reference').text('Référence: ' + image.reference);
        });
    }

    // Initialiser les événements de la lightbox lors du chargement initial de la page
    initLightboxEvents();

})(jQuery);
