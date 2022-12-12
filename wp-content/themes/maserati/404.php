<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package maserati
 */

get_header();
?>
<?php
$background_404 = get_field('background_404', 'option');
$background_404_mobile = get_field('background_404_mobile', 'option');
$size = 'full';
?>

<main id="primary" class="site-main">

	<section class="error-404 not-found" style="<?php echo !wp_is_mobile() ? 'background-image:url(' . wp_get_attachment_url($background_404, $size) . ');' : ($background_404_mobile ? 'background-image:url(' . wp_get_attachment_url($background_404_mobile, $size) . ');' : 'background-image:url(' . wp_get_attachment_url($background_404, $size) . ');'); ?>">
		<div class="container">
			<div class="row">
				<div class="col-md-7 col-sm-12">
					<h1><?php the_field('titulo_404', 'option'); ?></h1>
					<h4><?php the_field('subtitulo_404', 'option'); ?></h4>
					<?php if (have_rows('grupo_enlaces_404', 'option')) : ?>
						<div class="enlaces-404">
							<?php while (have_rows('grupo_enlaces_404', 'option')) : the_row(); ?>
								<?php echo get_sub_field('mensaje_enlaces_404') ? '<p class="text-white">' . get_sub_field('mensaje_enlaces_404') . '</p>' : ''; ?>
								<?php if (have_rows('repeater_enlaces_404')) : ?>
									<ul class="lista-enlaces-404">
										<?php while (have_rows('repeater_enlaces_404')) : the_row(); ?>
											<?php $enlace_404 = get_sub_field('enlace_404'); ?>
											<?php if ($enlace_404) : ?>
												<li><a href="<?php echo esc_url($enlace_404['url']); ?>" target="<?php echo esc_attr($enlace_404['target']); ?>"><?php echo esc_html($enlace_404['title']); ?></a></li>
											<?php endif; ?>
										<?php endwhile; ?>
									</ul>
								<?php endif; ?>
							<?php endwhile; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section><!-- .error-404 -->

</main><!-- #main -->

<?php
get_footer();
