<?php
/**
 * Hero
 */
?>
<section class="hero" aria-labelledby="hero-titulo">
	<div class="hero__fondo" aria-hidden="true"
		style="--hero-img: url('<?php echo esc_url( acv_asset( 'img/hero-gradiente.webp' ) ); ?>')"></div>

	<div class="hero__contenido">
		<h1 id="hero-titulo" class="hero__titulo">
			<span class="hero__l1">SEO <em>técnico</em></span>
			<span class="hero__l2">para Google</span>
			<span class="hero__l3">y las IA</span>
		</h1>

		<p class="hero__intro">
			Soy Álvaro, SEO en Kenji Marketing (Valencia). Llevo una decena de clientes a la vez,
			entre WordPress, Shopify y webs que piden una auditoría a gritos. Me gusta entender
			por qué algo no posiciona y arreglarlo. Sin humo.
		</p>
	</div>

	<nav class="hero__nav" aria-label="Secciones">
		<a href="#equipos">CV</a>
		<a href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>">Contacto</a>
		<a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Artículos</a>
	</nav>
</section>
