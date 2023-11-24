<?php

function theme_enqueue_styles(){
    // Chargement du style.css du theme
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/assets/css/style.css', array(), filemtime(get_stylesheet_directory() . '/assets/css/style.css'));

}

// Action qui permet de charger des scripts dans notre theme
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

/* Ajout de la librairie JQuery  */
function librairie_JQuery() {
    wp_enqueue_script('JQuery-js', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js', array('jquery'), '3.7.1', true);
}
add_action( 'wp_enqueue_scripts', 'librairie_JQuery' );

/* Chargement des script JS du theme */
function script_JS_Custo() {

    // Gestion de la Modale (script JQuery)
    wp_enqueue_script('ModaleJS', get_stylesheet_directory_uri() . '/assets/js/modalePopupContact.js', array('jquery'), '1.0.0', true);

    // Bibliotheque Select2 pour les selects de tri
    wp_enqueue_script('select2-js', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js', array('jquery'), '4.0.13', true);
    wp_enqueue_style('select2-css', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css', array());

    // Gestion du Menu Burger (script JQuery)
    wp_enqueue_script('menuBurgerJS', get_stylesheet_directory_uri() . '/assets/js/menuBurger.js', array('jquery'), '1.0.0', true);

    // Affichage des images miniature (script JQuery)
    wp_enqueue_script('AffichageMiniatureJS', get_stylesheet_directory_uri() . '/assets/js/AffichageMiniature.js', array('jquery'), '1.0.0', true);

    // Gestion des Filtres (script JQuery)
    wp_enqueue_script('FiltresJS', get_stylesheet_directory_uri() . '/assets/js/Filtres.js', array('jquery'), '1.0.0', true);

    // Gestion de la LightBox (script JQuery)
    wp_enqueue_script('LightBoxJS', get_stylesheet_directory_uri() . '/assets/js/LightBox.js', array('jquery'), '1.0.0', true);

    // Chargement de plus d'images avec Ajax (script JQuery)
    wp_enqueue_script('Ajax-charge-plus-images', get_stylesheet_directory_uri() . '/assets/js/Ajax-charge-plus-images.js', array('jquery'), '1.0.0', true);

    // Custom JS (script JQuery)
    wp_enqueue_script('CustomJS', get_stylesheet_directory_uri() . '/assets/js/CustomJS.js', array('jquery'), '1.0.0', true);

}
add_action( 'wp_enqueue_scripts', 'script_JS_Custo' );

// Astuce pour �viter d'avoir des <p> partout dans CF7
add_filter('wpcf7_autop_or_not', '__return_false');

function enregistrement_nav_menus() {

	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primaire', 'motachildZ' ),
			'menu-2' => esc_html__( 'Secondaire', 'motachildZ' ),
		)
	);
}
add_action( 'after_setup_theme', 'enregistrement_nav_menus' );


/* Chargement photos Ajax load more */

function load_more_photos() {
    $paged = $_POST['page'] + 1;
    $query_vars = json_decode(stripslashes($_POST['query']), true);
    $query_vars['paged'] = $paged;
    $query_vars['posts_per_page'] = 12;
    $query_vars['orderby'] = 'date';

    $photos = new WP_Query($query_vars);
    if ($photos->have_posts()) {
        ob_start();
        while ($photos->have_posts()) {
            $photos->the_post();
            get_template_part('template-parts/photo_block', null);
        }
        wp_reset_postdata();

        $output = ob_get_clean(); // Get the buffer and clean it
        echo $output; // Echo the output
    }
    else {
        ob_clean(); // Clean any previous output
        echo 'no_posts';
    }
        die();

}
add_action('wp_ajax_nopriv_load_more', 'load_more_photos');
add_action('wp_ajax_load_more', 'load_more_photos');

/* Filtres */

function filter_photos_function(){

    $filter = $_POST['filter'];

    $args = array(
        'post_type' => 'photos',
        'posts_per_page' => -1,
        'tax_query' => array(
            'relation' => 'AND',
        )
    );

    // Ajoute chaque filtre a la tax query si elle est definie
    if(!empty($filter['categorie'])){
        $args['tax_query'][] = array(
            'taxonomy' => 'categorie',
            'field'    => 'slug',
            'terms'    => $filter['categorie'],
        );
    }

    if(!empty($filter['format'])){
        $args['tax_query'][] = array(
            'taxonomy' => 'format',
            'field'    => 'slug',
            'terms'    => $filter['format'],
        );
    }

    if(!empty($filter['annees'])){
        $args['tax_query'][] = array(
            'taxonomy' => 'annees',
            'field'    => 'slug',
            'terms'    => $filter['annees'],
        );
    }

    $query = new WP_Query($args);

    if($query->have_posts()){
        while($query->have_posts()){
            $query->the_post();

            get_template_part('template-parts/photo_block', null);
        }
        wp_reset_postdata();
    } else {
        echo '<p class="critereFiltrage">Aucune photo ne correspond aux criteres de filtrage</p>';
    }

    die();
}

add_action('wp_ajax_filter_photos', 'filter_photos_function');
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos_function');
