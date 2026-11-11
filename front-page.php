<?php
/**
 * Home del CV. Cada sección vive en template-parts/.
 */
get_header();

get_template_part( 'template-parts/hero' );
get_template_part( 'template-parts/quien-soy' );
get_template_part( 'template-parts/equipos' );
get_template_part( 'template-parts/herramientas' );
get_template_part( 'template-parts/contacto' );

get_footer();
