
//console.log(" Message dans la console, pour vérifier que le JavaScript est fonctionnel ")
console.log(" le script javascript lancé se nomme modale.js ")

/* au click de la souris affichage de la modale */

$(document).ready(function() {
    const boutonContact = $('#menu-item-60');
    const modaleOverlay = $('.popup-overlay');

    function openModal() {
        modaleOverlay.css('display', 'flex');
    }

    function closeModal() {
        modaleOverlay.css('display', 'none');
    }

    if (boutonContact.length) {
        boutonContact.on('click', function(event) {
            event.preventDefault();
            openModal();
        });
    }

    $(window).on('click', function(event) {
        if ($(event.target).is(modaleOverlay)) {
            closeModal();
        }
    });
});
