// JavaScript pour gérer le clic sur le menu hamburger et afficher/cacher l'overlay
document.addEventListener('DOMContentLoaded', function() {
    var overlay2 = document.querySelector('.overlay2');
    var hamburgerMenu = document.querySelector('.hamburger-menu');
    hamburgerMenu.addEventListener('click', function() {
        overlay2.style.display = 'block'; // Affiche l'overlay2 rouge
    });
    overlay2.addEventListener('click', function() {
        overlay2.style.display = 'none'; // Cache l'overlay2 rouge
    });
});


document.addEventListener("DOMContentLoaded", function() {
    var modal = document.getElementById("myModal");
    var menuItem = document.querySelector('.menu-item-121');
    var span = document.querySelector(".close");
    var modalButton = document.getElementById("modalButton"); // Sélectionnez le bouton

    function openModal() {
        console.log("Modal opened"); // Vérifiez si la fonction est appelée
        modal.style.display = "block";
    }

    function closeModal() {
        modal.style.display = "none";
    }

    if (menuItem) {
        menuItem.addEventListener('click', openModal);
    }

    if (span) {
        span.addEventListener('click', closeModal);
    }

    // Ajoutez un écouteur d'événements pour le bouton
    if (modalButton) {
        modalButton.addEventListener('click', openModal);
    }

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

    window.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && modal.style.display === "block") {
            closeModal();
        }
    });
});



document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('myModal');
    var menuContacts = document.querySelectorAll('.menu-contact');
    var span = document.getElementsByClassName('close')[0];

    // Boucle à travers tous les éléments du menu contact pour ajouter le gestionnaire d'événements
    menuContacts.forEach(function(menuContact) {
        menuContact.addEventListener('click', function() {
            modal.style.display = "block";
        });
    });

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});

