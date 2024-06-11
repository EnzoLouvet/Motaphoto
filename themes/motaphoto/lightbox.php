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
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ArrowL.png" alt="Fleche gauche" />
            </div>
            <div class="lightbox__image">
            </div>
            <div class="fleche-droite">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ArrowR.png" alt="Fleche droite" />
            </div>
        </div>
        <div class="lightbox__info">  
            <p id="lightbox-reference">
            <p id="lightbox-title"></p>
        </div>
    </div>
</div>
