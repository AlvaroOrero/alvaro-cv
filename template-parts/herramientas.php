<?php
/**
 * Herramientas que domino
 */
$herramientas = array(
	'SEO técnico y auditoría'        => array( 'Chrome DevTools', 'Screaming Frog SEO Spider', 'Screaming Frog Log File Analyser', 'PageSpeed Insights', 'Rich Results Test' ),
	'Analítica y medición'           => array( 'Google Search Console', 'Bing Webmaster Tools', 'Google Analytics', 'Google Tag Manager', 'Looker Studio' ),
	'Keyword research y competencia' => array( 'Ahrefs', 'SE Ranking' ),
	'IA y desarrollo'                => array( 'Claude Code', 'Claude', 'Novamira' ),
	'Diseño'                         => array( 'Figma' ),
);
?>
<section id="herramientas" class="herramientas section" aria-labelledby="herramientas-titulo">
	<h2 id="herramientas-titulo" class="titulo-l titulo-centrado reveal">
		<em>Herramientas</em> que domino
	</h2>

	<div class="herramientas__grid reveal">
		<?php foreach ( $herramientas as $categoria => $lista ) : ?>
			<div class="herramientas__col">
				<h3><?php echo esc_html( $categoria ); ?></h3>
				<ul>
					<?php foreach ( $lista as $item ) : ?>
						<li><?php echo esc_html( $item ); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endforeach; ?>
	</div>
</section>
