<?php
/**
 * Página de contacto.
 * WordPress la usa automáticamente para la página cuyo slug sea "contacto".
 */
get_header();

$datos  = acv_datos();
$estado = '';
if ( isset( $_GET['enviado'] ) ) {
	$estado = 'ok';
} elseif ( isset( $_GET['error'] ) ) {
	$estado = sanitize_key( $_GET['error'] );
}
$privacidad_url = get_privacy_policy_url() ? get_privacy_policy_url() : home_url( '/politica-de-privacidad/' );
?>
<section class="contacto-pag" aria-labelledby="contacto-pag-titulo">
	<div class="contacto-pag__fondo" aria-hidden="true"
		style="--hero-img: url('<?php echo esc_url( acv_asset( 'img/hero-gradiente.webp' ) ); ?>')"></div>
	<?php get_template_part( 'template-parts/circulos' ); ?>

	<div class="contacto-pag__contenido">
		<h1 id="contacto-pag-titulo" class="titulo-l contacto-pag__titulo">
			<em>Contacta</em><br>conmigo
		</h1>

		<form id="formulario" class="form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<input type="hidden" name="action" value="acv_contacto">
			<?php wp_nonce_field( 'acv_contacto', 'acv_nonce' ); ?>

			<?php /* Campo trampa: invisible para personas, los bots lo rellenan */ ?>
			<div class="form__hp" aria-hidden="true">
				<label>No rellenar <input type="text" name="acv_web_hp" tabindex="-1" autocomplete="off"></label>
			</div>

			<?php if ( 'ok' === $estado ) : ?>
				<p class="form__aviso form__aviso--ok" role="status">Mensaje enviado. Te respondo lo antes posible.</p>
			<?php elseif ( $estado ) : ?>
				<p class="form__aviso form__aviso--error" role="alert">
					<?php echo 'campos' === $estado ? 'Falta tu nombre, cómo contactarte o aceptar la política de privacidad.' : 'No se ha podido enviar. Prueba otra vez o escríbeme por WhatsApp.'; ?>
				</p>
			<?php endif; ?>

			<div class="form__filas">
				<label class="form__fila">
					<span class="sr-only">Nombre</span>
					<input type="text" name="nombre" placeholder="Nombre" autocomplete="name" required>
				</label>
				<label class="form__fila">
					<span class="sr-only">Email o teléfono</span>
					<input type="text" name="contacto" placeholder="Email o teléfono" autocomplete="email" required>
				</label>
				<label class="form__fila">
					<span class="sr-only">¿En qué estás interesado?</span>
					<input type="text" name="interes" placeholder="¿En qué estás interesado?">
				</label>
				<label class="form__fila">
					<span class="sr-only">¿Algo que comentarme?</span>
					<textarea name="mensaje" rows="1" placeholder="¿Algo que comentarme?"></textarea>
				</label>
				<label class="form__fila">
					<span class="sr-only">URL de tu web</span>
					<input type="url" name="web" placeholder="URL de tu web" autocomplete="url" inputmode="url">
				</label>
			</div>

			<label class="form__privacidad">
				<input type="checkbox" name="privacidad" value="1" required>
				<span>He leído y acepto la <a href="<?php echo esc_url( $privacidad_url ); ?>">política de privacidad</a>.</span>
			</label>

			<div class="form__botones">
				<button type="submit" class="boton boton--sec">Enviar formulario</button>
				<?php if ( $datos['whatsapp'] ) : ?>
					<a class="boton boton--sec js-whatsapp" data-numero="<?php echo esc_attr( $datos['whatsapp'] ); ?>"
						href="<?php echo esc_url( 'https://wa.me/' . $datos['whatsapp'] ); ?>" target="_blank" rel="noopener">Enviar WhatsApp</a>
				<?php endif; ?>
			</div>
		</form>
	</div>
</section>

<?php
get_footer();
