<?php
/**
 * Reseñas en pila de tarjetas (al lado de "Quién soy").
 *
 * Añade aquí tus reseñas reales (por ejemplo, recomendaciones de LinkedIn), una por bloque.
 * Mientras la lista esté vacía, el bloque no se muestra.
 *
 * Campos:
 *  - texto   (obligatorio) la reseña
 *  - nombre  (obligatorio)
 *  - pais    opcional, p. ej. 'ES'
 *  - cargo   opcional, p. ej. 'Directora de marketing'
 *  - fuente  opcional, p. ej. 'LinkedIn'
 *  - url     opcional, enlace a la reseña original
 *  - foto    opcional, nombre de archivo en assets/img/ (si no hay, se muestran las iniciales)
 *
 * Ejemplo (copia el bloque, quita los // y rellena con datos reales):
 * array(
 *     'texto'  => '...',
 *     'nombre' => 'Nombre Apellido',
 *     'pais'   => 'ES',
 *     'cargo'  => 'Cargo',
 *     'fuente' => 'LinkedIn',
 *     'url'    => 'https://www.linkedin.com/in/tu-perfil/details/recommendations/',
 *     'foto'   => '',
 * ),
 */
$resenas = apply_filters( 'acv_resenas', array(
	// Textos de prueba (lorem ipsum). Sustitúyelos por reseñas reales.
	array(
		'texto'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi euismod, nunc id dictum dictum, nisi nunc tristique lectus.',
		'nombre' => 'Nombre Apellido',
		'pais'   => 'ES',
		'cargo'  => 'Cargo',
		'fuente' => 'LinkedIn',
	),
	array(
		'texto'  => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.',
		'nombre' => 'Nombre Apellido',
		'pais'   => 'ES',
		'cargo'  => 'Cargo',
		'fuente' => 'LinkedIn',
	),
	array(
		'texto'  => 'Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur.',
		'nombre' => 'Nombre Apellido',
		'pais'   => 'ES',
		'cargo'  => 'Cargo',
		'fuente' => 'LinkedIn',
	),
) );

$resenas = array_values( array_filter( $resenas, function ( $r ) {
	return ! empty( $r['texto'] ) && ! empty( $r['nombre'] );
} ) );

if ( ! $resenas ) {
	return;
}

$total = count( $resenas );

function acv_iniciales( $nombre ) {
	$partes = preg_split( '/\s+/', trim( $nombre ) );
	$ini    = mb_substr( $partes[0], 0, 1 );
	if ( count( $partes ) > 1 ) {
		$ini .= mb_substr( end( $partes ), 0, 1 );
	}
	return mb_strtoupper( $ini );
}
?>
<div class="resenas" data-resenas aria-roledescription="carrusel" aria-label="Reseñas">
	<div class="resenas__pila" tabindex="0">
		<?php foreach ( $resenas as $i => $r ) : ?>
			<figure class="resena" data-pos="<?php echo (int) min( $i, 3 ); ?>"
				aria-roledescription="reseña" aria-label="<?php echo esc_attr( ( $i + 1 ) . ' de ' . $total ); ?>">
				<div class="resena__contenido">
					<p class="resena__estrellas" aria-label="5 de 5 estrellas">
						<span aria-hidden="true">[</span>
						<?php for ( $e = 0; $e < 5; $e++ ) : ?>
							<svg viewBox="0 0 14 14" aria-hidden="true"><path d="M7 0v14M0 7h14M2 2l10 10M12 2 2 12" /></svg>
						<?php endfor; ?>
						<span aria-hidden="true">]</span>
					</p>

					<blockquote class="resena__texto">
						<p><?php echo esc_html( $r['texto'] ); ?></p>
					</blockquote>

					<figcaption class="resena__autor">
						<?php if ( ! empty( $r['foto'] ) ) : ?>
							<img class="resena__foto" src="<?php echo esc_url( acv_asset( 'img/' . $r['foto'] ) ); ?>" alt="" width="32" height="32" loading="lazy">
						<?php else : ?>
							<span class="resena__foto resena__foto--iniciales" aria-hidden="true"><?php echo esc_html( acv_iniciales( $r['nombre'] ) ); ?></span>
						<?php endif; ?>

						<span class="resena__nombre"><?php echo esc_html( $r['nombre'] ); ?></span>
						<?php if ( ! empty( $r['pais'] ) ) : ?>
							<span class="resena__meta">[ <?php echo esc_html( $r['pais'] ); ?> ]</span>
						<?php endif; ?>
						<?php if ( ! empty( $r['cargo'] ) ) : ?>
							<span class="resena__meta">[ <?php echo esc_html( $r['cargo'] ); ?> ]</span>
						<?php endif; ?>
						<?php if ( ! empty( $r['fuente'] ) ) : ?>
							<span class="resena__meta" aria-hidden="true">/</span>
							<?php if ( ! empty( $r['url'] ) ) : ?>
								<a class="resena__meta resena__fuente" href="<?php echo esc_url( $r['url'] ); ?>" target="_blank" rel="noopener">[ en <?php echo esc_html( $r['fuente'] ); ?> ] ↗</a>
							<?php else : ?>
								<span class="resena__meta">[ en <?php echo esc_html( $r['fuente'] ); ?> ]</span>
							<?php endif; ?>
						<?php endif; ?>
					</figcaption>
				</div>
			</figure>
		<?php endforeach; ?>
	</div>

	<?php if ( $total > 1 ) : ?>
		<div class="resenas__nav">
			<button type="button" class="resenas__btn" data-dir="-1" aria-label="Reseña anterior">←</button>
			<span class="resenas__contador" aria-live="polite">[ <span data-actual>01</span> / <?php echo esc_html( str_pad( $total, 2, '0', STR_PAD_LEFT ) ); ?> ]</span>
			<button type="button" class="resenas__btn" data-dir="1" aria-label="Reseña siguiente">→</button>
		</div>
	<?php endif; ?>
</div>
