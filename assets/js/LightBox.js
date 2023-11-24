
/* Lightbox Ouverture et Fermeture */
console.log("Lightbox Ouverture et Fermeture : son js est chargé");

$(document).ready(function() {
    var $lightbox = $('#lightbox');
    var $lightboxImage = $('.lightboxImage');
    var $lightboxCategory = $('.lightboxCategorie');
    var $lightboxReference = $('.lightboxReference');
    var currentIndex = 0; 

    function updateLightbox(index) {
        var $images = $('.fullscreen-icon');
        var $image = $images.eq(index);
        
        var categoryText = $image.data('category').toUpperCase();
        var referenceText = $image.data('reference').toUpperCase();

        $lightboxImage.attr('src', $image.data('full'));
        $lightboxCategory.text(categoryText);
        $lightboxReference.text(referenceText);
        currentIndex = index;
    }

    function openLightbox(index) {
        updateLightbox(index);
        $lightbox.show();
    }

    function fermetureLightbox() {
        $lightbox.hide();
    }

    window.attachEventsToImages = function() {
        var $images = $('.fullscreen-icon');
        $images.off('click', imageClickHandler); 
        $images.on('click', imageClickHandler);
    };

    function imageClickHandler() {
        var $images = $('.fullscreen-icon');
        var index = $images.index($(this).closest('.fullscreen-icon'));
        openLightbox(index);
    }

    attachEventsToImages();

    $('.fermelightbox').on('click', fermetureLightbox);

    $('.lightboxPrecedent').on('click', function() {
        var $images = $('.fullscreen-icon');
        if (currentIndex > 0) {
            updateLightbox(currentIndex - 1);
        } else {
            updateLightbox($images.length - 1);
        }
    });

    $('.lightboxSuivant').on('click', function() {
        var $images = $('.fullscreen-icon');
        if (currentIndex < $images.length - 1) {
            updateLightbox(currentIndex + 1);
        } else {
            updateLightbox(0);
        }
    });

});
