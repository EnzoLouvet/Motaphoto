// Permet d'ouvrir le menu hamburger
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


// Permet d'ouvrir la modale dans le menu hamburger
document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('myModal');
    var menuContacts = document.querySelectorAll('.menu-contact');
    var span = document.getElementsByClassName('close')[0];

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

