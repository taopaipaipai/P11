<?php

function theme_enqueue_styles(){
    // Chargement du style.css du thème enfant
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/assets/css/style.css', array(), filemtime(get_stylesheet_directory() . '/assets/css/style.css'));

    // Chargement des Fonts Awesome
    wp_enqueue_style('Font-Awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
}

// Action qui permet de charger des scripts dans notre thème
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

/* Ajout de la librairie JQuery  */
function librairie_JQuery() {
    wp_enqueue_script('JQuery-js', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js', array('jquery'), '3.7.1', true);
}
add_action( 'wp_enqueue_scripts', 'librairie_JQuery' );

/* Chargement des script JS du thème enfant */
function script_JS_Custo() {

    // Gestion de la Modale
    wp_enqueue_script('Modale', get_stylesheet_directory_uri() . '/assets/js/modale.js', array('jquery'), '1.0.0', true);

}
add_action( 'wp_enqueue_scripts', 'script_JS_Custo' );

// Astuce pour éviter d'avoir des <p> partout dans CF7
add_filter('wpcf7_autop_or_not', '__return_false');

function enregistrement_nav_menus() {

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primaire', 'motachildZ' ),
			'menu-2' => esc_html__( 'Secondaire', 'motachildZ' ),
		)
	);
}
add_action( 'after_setup_theme', 'enregistrement_nav_menus' );

