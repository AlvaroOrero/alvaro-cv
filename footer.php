</main>

<?php
$datos          = acv_datos();
$privacidad_url = get_privacy_policy_url() ? get_privacy_policy_url() : home_url( '/politica-de-privacidad/' );
?>
<footer class="site-footer">
	<?php get_template_part( 'template-parts/circulos' ); ?>

	<div class="site-footer__principal">
		<p class="site-footer__marca" data-texto="Álvaro" aria-hidden="true">Álvaro</p>

		<div class="site-footer__columnas">
			<div class="site-footer__col">
				<p class="site-footer__nombre">Álvaro Orero Gimeno</p>
				<p>SEO en Valencia.<br>Sin humo.</p>
			</div>

			<nav class="site-footer__col" aria-label="Navegación del pie">
				<p class="eyebrow">Navegación</p>
				<ul>
					<li><a href="<?php echo esc_url( acv_ancla( 'equipos' ) ); ?>">CV</a></li>
					<li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Artículos</a></li>
					<li><a href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>">Contacto</a></li>
				</ul>
			</nav>

			<div class="site-footer__col">
				<p class="eyebrow">Dónde encontrarme</p>
				<ul>
					<?php if ( $datos['linkedin'] ) : ?>
						<li><a href="<?php echo esc_url( $datos['linkedin'] ); ?>" target="_blank" rel="noopener me">LinkedIn ↗</a></li>
					<?php endif; ?>
					<?php if ( $datos['github'] ) : ?>
						<li><a href="<?php echo esc_url( $datos['github'] ); ?>" target="_blank" rel="noopener me">GitHub ↗</a></li>
					<?php endif; ?>
					<?php if ( $datos['whatsapp'] ) : ?>
						<li><a href="<?php echo esc_url( 'https://wa.me/' . $datos['whatsapp'] ); ?>" target="_blank" rel="noopener">WhatsApp ↗</a></li>
					<?php endif; ?>
					<li><a href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>">Formulario</a></li>
				</ul>
			</div>

			<nav class="site-footer__col" aria-label="Legal">
				<p class="eyebrow">Legal</p>
				<ul>
					<li><a href="<?php echo esc_url( home_url( '/aviso-legal/' ) ); ?>">Aviso legal</a></li>
					<li><a href="<?php echo esc_url( $privacidad_url ); ?>">Privacidad</a></li>
					<li><a href="<?php echo esc_url( home_url( '/politica-de-cookies/' ) ); ?>">Cookies</a></li>
				</ul>
			</nav>
		</div>
	</div>

	<div class="site-footer__barra">
		<p>© <?php echo esc_html( date( 'Y' ) ); ?> Álvaro Orero Gimeno · Valencia</p>
		<?php if ( $datos['github'] ) : ?>
			<a href="<?php echo esc_url( $datos['github'] ); ?>" target="_blank" rel="noopener">Hecha a código, sin constructores ↗</a>
		<?php endif; ?>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
