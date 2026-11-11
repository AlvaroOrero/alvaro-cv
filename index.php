<?php
/**
 * Plantilla de respaldo obligatoria en WordPress.
 * Se usará más adelante para el blog; de momento muestra las entradas de forma simple.
 */
get_header();
?>

<section class="section">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class(); ?>>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php the_excerpt(); ?>
				</article>
			<?php endwhile; ?>
		<?php else : ?>
			<p>Aún no hay contenido por aquí.</p>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
