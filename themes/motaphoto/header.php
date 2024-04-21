<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="<?php echo get_template_directory_uri(); ?>./assets/js/modal.js"></script>
    <title>Motaphoto</title>
    <?php wp_head(); ?>

</head>
<body>
    <?php wp_body_open(); ?>    
    <header>
        <nav id="site-navigation" class="main-navigation">
            <div class="logo-container">
                <img src="<?php echo get_template_directory_uri();?>/assets/images/Logo.png" class="header_logo">
            </div>
            <div class="links-container">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'header', 
                    'menu_class' => 'header-menu-class', 
                ));
                ?>

                <div id="myModal" class="modal">
                    <div class="modal-content">
                    <img src="<?php echo get_template_directory_uri();?>/assets/images/title_modal.png" class="title_modal">
                        <?php echo do_shortcode('[contact-form-7 id="0d61f35" title="Contact form 1"]'); ?>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <script>
document.addEventListener("DOMContentLoaded", function() {
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the <li> element that opens the modal
    var menuItem = document.querySelector('.menu-item-121');

    // Get the <span> element that closes the modal
    var span = document.querySelector(".close");

    // Function to open the modal
    function openModal() {
        modal.style.display = "block";
    }

    // Function to close the modal
    function closeModal() {
        modal.style.display = "none";
    }

    // When the user clicks on the <li> element, open the modal
    if (menuItem) {
        menuItem.addEventListener('click', openModal);
    }

    // When the user clicks on <span> (x), close the modal
    if (span) {
        span.addEventListener('click', closeModal);
    }

    // When the user clicks anywhere outside of the modal, close it
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            closeModal();
        }
        if (event.target.closest('.modal-content')) {
            var backgroundColor = window.getComputedStyle(event.target).backgroundColor;
            if (backgroundColor === 'rgb(153, 153, 153)') {
                closeModal();
            }
        }
    });

    // Close the modal when the user presses the Escape key
    window.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && modal.style.display === "block") {
            closeModal();
        }
    });
});


    </script>
</body>
</html>
