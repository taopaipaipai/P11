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

    // Custom JS (script JQuery)
    wp_enqueue_script('CustomJS', get_stylesheet_directory_uri() . '/assets/js/CustomJS.js', array('jquery'), '1.0.0', true);

}
add_action( 'wp_enqueue_scripts', 'script_JS_Custo' );

// Astuce pour eviter d'avoir des <p> partout dans CF7
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
