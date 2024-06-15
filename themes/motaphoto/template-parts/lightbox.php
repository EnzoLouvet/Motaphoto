<div class="lightbox" id="lightbox-container">
    <div id="overlay" style="display:none;">
        <span id="close-btn">&times;</span>
    </div>
    <button class="lightbox__close btn-close" id="close-lightbox" type="button">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/close_icon.png" alt="Croix de fermeture" />
    </button>
    <div class="column">
        <div class="lightbox__nav">
            <div class="fleche-gauche">
                <p>← Précédente</p>
            </div>
            <div class="lightbox__image">
            </div>
            <div class="fleche-droite">
                <p>Suivante →</p>
            </div>
        </div>
        <div class="lightbox__text">
            <p id="lightbox-title"></p> <!-- Titre / Catégorie -->
            <p id="lightbox-reference"></p> <!-- Référence -->
        </div>
    </div>
</div>
