<?php
$photo_url = get_the_post_thumbnail_url(null, "large");
$photo_titre = get_the_title();
$post_url = get_permalink();
$reference = get_field('reference');
$categories = get_the_terms(get_the_ID(), 'categorie');
$categorie_name = $categories[0]->name;

$PHOTO_TITRE = strtoupper (get_the_title());
$CATEGORIE_NAME = strtoupper (get_field('categorie')); /* affiche des caractere chelou donc je ne fais pas */
?>


            <div class="blockPhotoRelative">
                <img src="<?php echo esc_url($photo_url); ?>" alt="<?php the_title_attribute(); ?>">

                <div class="overlay">





                </div>
            </div>
            
       