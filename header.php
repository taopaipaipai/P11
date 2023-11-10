<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!--
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	-->
	
	<?php wp_head(); ?>
</head>

<body class="mainContainer">
<?php wp_body_open(); ?>

	<header>
		
	 <div class="ContenaireHeader">

		<div>
			<a href="<?php echo home_url('/'); ?>">
				<img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/Logo.png'; ?>" alt="Logo">
			</a>
		</div>
				
		<nav class="menuNavigation">

			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'container'      => 'false',
					'menu_class'     => 'cssHeader',
				)
			);
			?>

		</nav>
		
	 </div>
	</header>
