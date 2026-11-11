<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script>document.documentElement.classList.add('js');</script>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#contenido">Saltar al contenido</a>

<header class="site-header">
	<a class="site-header__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">Álvaro Orero Gimeno</a>

	<button class="site-header__menu" aria-expanded="false" aria-controls="menu-principal">
		<span class="burger" aria-hidden="true"><span></span><span></span><span></span></span>
		Menú
	</button>

	<nav id="menu-principal" class="site-nav" aria-label="Menú principal">
		<?php
		wp_nav_menu( array(
			'theme_location' => 'principal',
			'container'      => false,
			'fallback_cb'    => 'acv_menu_por_defecto',
		) );
		?>
	</nav>
</header>

<main id="contenido">
