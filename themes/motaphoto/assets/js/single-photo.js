document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('openModalButton').addEventListener('click', function() {
        var modal = document.getElementById("myModal");
        modal.style.display = "block";

        // Récupérer la référence depuis ACF
        var reference = getReferenceFromACF('customReferenceField');

        // Remplir le champ de référence dans le formulaire avec la référence récupérée
        document.getElementById('referenceField').value = reference;
    });
});

// Fonction pour récupérer la référence depuis ACF
function getReferenceFromACF(fieldName) {
    var reference = '';
    // Utilisez la fonction getField pour récupérer la valeur du champ personnalisé
    reference = getField(fieldName);
    return reference;
}
