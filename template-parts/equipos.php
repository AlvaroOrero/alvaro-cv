<?php
/**
 * Equipos en los que he trabajado
 * Los datos de cada empresa están en este array: para editar textos solo hay que tocar aquí.
 */
$empresas = array(
	array(
		'id'      => 'kenji',
		'nombre'  => 'Kenji Marketing',
		'logo'    => 'logo-kenji.svg',
		'logo_w'  => 187,
		'logo_h'  => 75,
		'que'     => 'Agencia de SEO y SEM en Valencia',
		'puesto'  => 'Consultor SEO · 2024, actualidad',
		'areas'   => array(
			array( 'SEO técnico y auditorías', 'WordPress · Shopify' ),
			array( 'Arquitectura web y keyword research', '' ),
			array( 'SEO local', 'Perfil de Empresa de Google' ),
			array( 'Copywriting y contenidos', '' ),
			array( 'Medición y objetivos de crecimiento', 'Looker Studio' ),
			array( 'GEO', 'Visibilidad en IA' ),
		),
	),
	array(
		'id'      => 'kova',
		'nombre'  => 'Kova Builder',
		'logo'    => 'logo-kova-builder.svg',
		'logo_w'  => 231,
		'logo_h'  => 75,
		'que'     => 'Aceleradora de startups del sector financiero',
		'puesto'  => 'Redactor SEO · 2023 - 2024',
		'areas'   => array(
			array( 'Keyword research por mercado', 'DE · US · SE' ),
			array( 'Contenido SEO para blog', 'Alemán · Inglés · Sueco' ),
		),
	),
	array(
		'id'      => 'finergia',
		'nombre'  => 'Finergia',
		'logo'    => 'logo-finergia.svg',
		'logo_w'  => 307,
		'logo_h'  => 70,
		'que'     => 'SaaS de gestión financiera y control de tesorería',
		'puesto'  => 'Responsable de marketing · 2022 - 2023',
		'areas'   => array(
			array( 'Flujos de email marketing y automatización', '' ),
			array( 'Campañas de remarketing', '' ),
			array( 'Contenido SEO para blog', '' ),
			array( 'Redes sociales', '' ),
		),
	),
);
?>
<section id="equipos" class="equipos section" aria-labelledby="equipos-titulo">
	<h2 id="equipos-titulo" class="titulo-l titulo-centrado reveal">
		<em>Equipos</em> en los que he trabajado
	</h2>

	<ul class="logos reveal" aria-label="Empresas">
		<?php foreach ( $empresas as $e ) : ?>
			<li>
				<a href="#empresa-<?php echo esc_attr( $e['id'] ); ?>">
					<img src="<?php echo esc_url( acv_asset( 'img/' . $e['logo'] ) ); ?>"
						alt="<?php echo esc_attr( $e['nombre'] ); ?>"
						width="<?php echo (int) $e['logo_w']; ?>" height="<?php echo (int) $e['logo_h']; ?>"
						loading="lazy" decoding="async">
				</a>
			</li>
		<?php endforeach; ?>
	</ul>

	<p class="eyebrow equipos__eyebrow">Habilidades que he desarrollado con mis clientes</p>

	<div class="empresas">
		<?php foreach ( $empresas as $i => $e ) : ?>
			<article id="empresa-<?php echo esc_attr( $e['id'] ); ?>"
				class="empresa reveal <?php echo 1 === $i % 2 ? 'empresa--invertida' : ''; ?>">
				<header class="empresa__info">
					<h3><?php echo esc_html( $e['nombre'] ); ?></h3>
					<p><?php echo esc_html( $e['que'] ); ?></p>
					<p><?php echo esc_html( $e['puesto'] ); ?></p>
				</header>

				<ol class="areas">
					<?php foreach ( $e['areas'] as $n => $area ) : ?>
						<li class="area">
							<span class="area__nombre">
								<?php echo esc_html( $area[0] ); ?>
								<?php if ( $area[1] ) : ?>
									<span class="area__etiqueta">[ <?php echo esc_html( $area[1] ); ?> ]</span>
								<?php endif; ?>
							</span>
							<span class="area__num" aria-hidden="true">[ <?php echo (int) $n + 1; ?> ]</span>
						</li>
					<?php endforeach; ?>
				</ol>
			</article>
		<?php endforeach; ?>
	</div>
</section>
