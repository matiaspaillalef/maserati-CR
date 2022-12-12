<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package maserati
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php if (have_posts()) : ?>
		<section class="maserati-grid-news">
			<div class="container">
				<div class="row">
					<?php /*<header class="page-header">
				<h1 class="page-title">
					<?php

		printf(esc_html__('Search Results for: %s', 'maserati'), '<span>' . get_search_query() . '</span>');
		?>
		</h1>
		</header><!-- .page-header -->
		*/ ?>
					<?php
					/* Start the Loop */
					while (have_posts()) : the_post(); ?>
						<div class="col-md-4 col-sm-12">
							<?php get_template_part('template-parts/content', 'card-post'); ?>
						</div>
					<?php endwhile;

					the_posts_pagination(array(
						'mid_size' => 6,
						'prev_text' => '<i class="icon-arrow-left"></i>',
						'next_text' => '<i class="icon-arrow-right"></i>',
						//'screen_reader_text' => __( 'Titulo', 'maserati' ),
					));
					?>
				</div>
			</div>
		</section>
	<?php else :

		get_template_part('template-parts/content', 'none');

	endif;
	?>

</main><!-- #main -->

<?php
//get_sidebar();
get_footer();
