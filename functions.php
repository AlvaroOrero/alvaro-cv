<?php
/**
 * Funciones del tema Álvaro CV
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'ACV_VERSION', '0.3.0' );

/**
 * Soporte básico del tema
 */
function acv_setup() {
	add_theme_support( 'title-tag' );          // WordPress gestiona el <title>
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );

	register_nav_menus( array(
		'principal' => 'Menú principal',
	) );
}
add_action( 'after_setup_theme', 'acv_setup' );

/**
 * Clase propia en el <body> para que nuestros estilos ganen a los globales de plugins
 */
function acv_clase_body( $clases ) {
	$clases[] = 'acv-tema';
	return $clases;
}
add_filter( 'body_class', 'acv_clase_body' );

/**
 * URL de un archivo dentro de assets/
 */
function acv_asset( $ruta ) {
	return get_template_directory_uri() . '/assets/' . ltrim( $ruta, '/' );
}

/**
 * Carga de CSS y JS
 * La versión usa la fecha de modificación del archivo para evitar problemas de caché mientras desarrollamos.
 */
function acv_assets() {
	$css = get_template_directory() . '/assets/css/main.css';
	$js  = get_template_directory() . '/assets/js/main.js';

	wp_enqueue_style(
		'acv-main',
		acv_asset( 'css/main.css' ),
		array(),
		file_exists( $css ) ? filemtime( $css ) : ACV_VERSION
	);

	wp_enqueue_script(
		'acv-main',
		acv_asset( 'js/main.js' ),
		array(),
		file_exists( $js ) ? filemtime( $js ) : ACV_VERSION,
		array( 'strategy' => 'defer', 'in_footer' => true )
	);
}
add_action( 'wp_enqueue_scripts', 'acv_assets' );

/**
 * Precarga de las fuentes que se ven nada más entrar (mejora LCP y evita saltos de texto)
 */
function acv_precargar_fuentes() {
	$fuentes = array( 'aspekta-600.woff2', 'aspekta-500.woff2', 'inter-italic-400.woff2' );
	foreach ( $fuentes as $fuente ) {
		printf(
			'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
			esc_url( acv_asset( 'fonts/' . $fuente ) )
		);
	}
}
add_action( 'wp_head', 'acv_precargar_fuentes', 1 );

/**
 * Datos de contacto y redes. Rellena aquí lo que falte; lo que esté vacío no se muestra.
 * WhatsApp: número con prefijo de país y sin espacios ni "+", por ejemplo 34600000000.
 */
function acv_datos() {
	return array(
		'linkedin' => '',
		'github'   => 'https://github.com/AlvaroOrero',
		'whatsapp' => '',
	);
}

/**
 * URL de la home con un ancla, válida desde cualquier página (no solo desde la home)
 */
function acv_ancla( $ancla ) {
	return home_url( '/#' . $ancla );
}

/**
 * Menú por defecto mientras no se cree uno en Apariencia > Menús
 */
function acv_menu_por_defecto() {
	echo '<ul>';
	echo '<li><a href="' . esc_url( acv_ancla( 'quien-soy' ) ) . '">Quién soy</a></li>';
	echo '<li><a href="' . esc_url( acv_ancla( 'equipos' ) ) . '">Experiencia</a></li>';
	echo '<li><a href="' . esc_url( acv_ancla( 'herramientas' ) ) . '">Herramientas</a></li>';
	echo '<li><a href="' . esc_url( home_url( '/contacto/' ) ) . '">Contacto</a></li>';
	echo '</ul>';
}

/**
 * Formulario de contacto: lo procesa WordPress (admin-post.php), sin plugins.
 * Envía el mensaje al email de administración de WordPress (Ajustes > Generales).
 */
function acv_procesar_contacto() {
	$volver = wp_get_referer() ? wp_get_referer() : home_url( '/contacto/' );
	$volver = remove_query_arg( array( 'enviado', 'error' ), $volver );

	// Seguridad: nonce y campo trampa para bots (si viene relleno, es spam)
	if ( ! isset( $_POST['acv_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['acv_nonce'] ) ), 'acv_contacto' ) ) {
		wp_safe_redirect( add_query_arg( 'error', 'seguridad', $volver ) . '#formulario' );
		exit;
	}
	if ( ! empty( $_POST['acv_web_hp'] ) ) {
		wp_safe_redirect( add_query_arg( 'enviado', '1', $volver ) . '#formulario' );
		exit;
	}

	$nombre    = sanitize_text_field( wp_unslash( $_POST['nombre'] ?? '' ) );
	$contacto  = sanitize_text_field( wp_unslash( $_POST['contacto'] ?? '' ) );
	$interes   = sanitize_text_field( wp_unslash( $_POST['interes'] ?? '' ) );
	$mensaje   = sanitize_textarea_field( wp_unslash( $_POST['mensaje'] ?? '' ) );
	$web       = esc_url_raw( wp_unslash( $_POST['web'] ?? '' ) );
	$privacidad = ! empty( $_POST['privacidad'] );

	if ( '' === $nombre || '' === $contacto || ! $privacidad ) {
		wp_safe_redirect( add_query_arg( 'error', 'campos', $volver ) . '#formulario' );
		exit;
	}

	$cuerpo  = "Nombre: {$nombre}\n";
	$cuerpo .= "Email o teléfono: {$contacto}\n";
	$cuerpo .= "Interesado en: {$interes}\n";
	$cuerpo .= "Web: {$web}\n\n";
	$cuerpo .= "Mensaje:\n{$mensaje}\n";

	$cabeceras = array();
	if ( is_email( $contacto ) ) {
		$cabeceras[] = 'Reply-To: ' . $nombre . ' <' . $contacto . '>';
	}

	$ok = wp_mail( get_option( 'admin_email' ), 'Nuevo contacto desde la web: ' . $nombre, $cuerpo, $cabeceras );

	wp_safe_redirect( add_query_arg( $ok ? 'enviado' : 'error', $ok ? '1' : 'envio', $volver ) . '#formulario' );
	exit;
}
add_action( 'admin_post_nopriv_acv_contacto', 'acv_procesar_contacto' );
add_action( 'admin_post_acv_contacto', 'acv_procesar_contacto' );

/**
 * Limpieza del <head>: quitamos lo que WordPress mete por defecto y no necesitamos
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );

/**
 * Quitamos los estilos de bloques de Gutenberg en el front, no los usamos
 */
function acv_quitar_estilos_bloques() {
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'global-styles' );
	wp_dequeue_style( 'classic-theme-styles' );
}
add_action( 'wp_enqueue_scripts', 'acv_quitar_estilos_bloques', 100 );
