<?php

/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package maserati
 */
get_template_part('parts/part', 'banner-page');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content default-page">
		<div class="container">
			<?php the_content(); ?>
		</div>
	</div>
</article>