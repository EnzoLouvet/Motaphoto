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


