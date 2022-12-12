<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package maserati
 */

get_header();
?>
<?php
/**
 * maserati_breadcrumbs - 5
 */
do_action('breadcrumbs_maserati');
?>
<main id="primary" class="site-main">

	<?php
	while (have_posts()) :
		the_post();

		get_template_part('template-parts/content', get_post_type());

	endwhile;

	get_template_part('parts/part', 'related-single');
	?>

</main>

<?php
get_footer();
