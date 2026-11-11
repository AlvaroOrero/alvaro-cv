<?php
/**
 * Quién soy
 */
?>
<section id="quien-soy" class="quien section" aria-labelledby="quien-titulo">
	<div class="quien__foto" aria-hidden="true">
		<?php /* Hueco reservado para la foto. Cuando la tengas: assets/img/alvaro.webp */ ?>
	</div>

	<div class="quien__texto reveal">
		<p class="eyebrow">Quién soy</p>

		<h2 id="quien-titulo" class="titulo-l">
			En SEO todo depende.<br>
			A mí me gusta saber<br>
			de qué depende
		</h2>

		<p class="quien__parrafo">
			Me interesa el SEO que se hace mirando por dentro. Logs, renderizado, rastreo, rendimiento.
			Cuanto mejor entiendo cómo lee una web Google, o una IA, mejores soluciones puedo proponer.
		</p>

		<a class="link-icono" href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>">
			<svg width="14" height="14" viewBox="0 0 14 14" aria-hidden="true"><path d="M7 0v14M0 7h14M2 2l10 10M12 2 2 12" stroke="currentColor" stroke-width="1"/></svg>
			Contacta conmigo
		</a>
	</div>
</section>
