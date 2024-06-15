    <div id="myModal" class="modal">
        <div class="modal-content">
            <img src="<?php echo get_template_directory_uri();?>/assets/images/title_modal.png" class="title_modal">
            <?php
            // Générer le formulaire de contact avec Contact Form 7
            echo do_shortcode('[contact-form-7 id="0d61f35" title="Contact form 1"]');
            ?>
        </div>
    </div>


    