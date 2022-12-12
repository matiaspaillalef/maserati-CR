<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package maserati
 */

?>


<?php
$logotipo_footer 	= get_field('logotipo_footer', 'option');
$facebook_general 	= get_field('facebook_general', 'option');
$instagram_general 	= get_field('instagram_general', 'option');
$whatsapp_general 	= get_field('whatsapp_general', 'option');
$mail_general 		= get_field('mail_general', 'option');
$phone_general 		= get_field('telefono_general', 'option');
$size 				= 'full';
?>
<footer id="colophon" class="site-footer black-back">
	<div class="container">
		<?php if ($logotipo_footer) : ?>
			<div class="maserati-footer__logo">
				<?php echo wp_get_attachment_image($logotipo_footer, $size); ?>
			</div>
		<?php endif; ?>
		<div class="row">
			<?php if (have_rows('column_1', 'option')) : ?>
				<?php while (have_rows('column_1', 'option')) : the_row(); ?>
					<div class="col-md-3 col-sm-12">
						<p class="title-medium"><?php the_sub_field('titulo_seccion_1'); ?></p>
						<?php the_sub_field('menu_1'); ?>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>
			<?php if (have_rows('column_2', 'option')) : ?>
				<?php while (have_rows('column_2', 'option')) : the_row(); ?>
					<div class="col-md-3 col-sm-12">
						<p class="title-medium"><?php the_sub_field('titulo_seccion_2'); ?></p>
						<?php the_sub_field('menu_2'); ?>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>
			<?php if (have_rows('column_3', 'option')) : ?>
				<?php while (have_rows('column_3', 'option')) : the_row(); ?>
					<div class="col-md-3 col-sm-12">
						<p class="title-medium"><?php the_sub_field('titulo_seccion_3'); ?></p>
						<?php the_sub_field('menu_3'); ?>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>
			<?php if (have_rows('column_4', 'option')) : ?>
				<?php while (have_rows('column_4', 'option')) : the_row(); ?>
					<div class="col-md-3 col-sm-12">
						<?php echo !wp_is_mobile() ? '<p class="title-medium">' . get_sub_field('titulo_seccion_4') . '</p>' : ''; ?>
						<div class="inner-column">
							<div class="maserati-social">
								<?php echo wp_is_mobile() ? '<p class="title-medium">' . get_sub_field('titulo_seccion_4') . '</p>' : ''; ?>
								<?php if ($facebook_general) : ?>
									<a href="<?php echo esc_url($facebook_general['url']); ?>" target="<?php echo esc_attr($facebook_general['target']); ?>"><i class="fa-brands fa-facebook"></i></a>
								<?php endif; ?>
								<?php if ($instagram_general) : ?>
									<a href="<?php echo esc_url($instagram_general['url']); ?>" target="<?php echo esc_attr($instagram_general['target']); ?>"><i class="fa-brands fa-instagram"></i></a>
								<?php endif; ?>
								<?php if ($whatsapp_general) : ?>
									<a href="<?php echo esc_url($whatsapp_general['url']); ?>" target="<?php echo esc_attr($whatsapp_general['target']); ?>"><i class="fa-brands fa-whatsapp"></i></a>
								<?php endif; ?>
							</div>
							<div class="maserati-contact">
								<?php if ($mail_general) : ?>
									<p><a target="_blank" href="mailto:<?php echo $mail_general ?>"><i class="icon-mail"></i> <span class="body-small"><?php echo $mail_general ?></span></a></p>
								<?php endif; ?>
								<?php if ($phone_general) : ?>
									<p><i class="icon-phone"></i> <span class="body-small"><?php echo $phone_general ?></span></p>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>
		<?php if (get_field('activar_bottom_footer', 'option') == 1) : ?>
			<div class="bottom-footer">
				<div class="row">
					<?php if (get_field('bottom_left', 'option')) : ?>
						<div class="col-md-6 col-sm-12">
							<p><?php the_field('bottom_left', 'option'); ?></p>
						</div>
					<?php endif; ?>
					<?php if (get_field('bottom_right', 'option')) : ?>
						<div class="col-md-6 col-sm-12">
							<p><?php the_field('bottom_right', 'option'); ?></p>
						</div>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>

	</div>
</footer>


<?php /** Modal videos Main banner page (Banner home)*/ ?>
<?php if (have_rows('repeater_slider') && is_page()) : ?>
	<?php $i = 1; ?>
	<?php while (have_rows('repeater_slider')) : the_row(); ?>
		<?php if (get_sub_field('url_video_completo')) :  ?>
			<div class="modal fade modalvideo" id="modalVideo<?php echo $i; ?>" tabindex="-1" aria-labelledby="modalVideoLabel<?php echo $i; ?>" aria-hidden="true">
				<div class="modal-dialog modal-fullscreen">
					<div class="modal-content">
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						<div class="modal-body">
							<video id="my-video" class="video-js vjs-theme-fantasy" controls preload="auto" data-setup="{}">
								<source src="<?php the_sub_field('url_video_completo'); ?>" type="video/mp4">
							</video>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
		<?php $i++; ?>
	<?php endwhile; ?>
<?php endif; ?>

<!-- Modal galeria-->
<?php if (have_rows('repeater_modelo_galeria')) : ?>
	<div class="modal fade" id="modelGallery" tabindex="-1" aria-labelledby="modelGalleryLabel" aria-hidden="true">
		<div class="modal-dialog modal-fullscreen">
			<div class="modal-content">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				<div class="modal-body">
					<?php if (have_rows('grupo_identidad')) : ?>
						<div class="container">
							<?php while (have_rows('grupo_identidad')) : the_row(); ?>
								<?php $emblema_modelo = get_sub_field('emblema_modelo'); ?>
								<?php if ($emblema_modelo) : ?>
									<?php echo wp_get_attachment_image($emblema_modelo, $size, '', array('class' => 'emblema-absolute')); ?>
								<?php endif; ?>
							<?php endwhile; ?>
						</div>
					<?php endif; ?>
					<?php if (have_rows('repeater_modelo_galeria')) : ?>
						<div class="swiper swiper-2_5_gallery-modal card-slider">
							<div class="swiper-wrapper">

								<?php
								while (have_rows('repeater_modelo_galeria')) : the_row();
									$imagen_galeria = get_sub_field('imagen_galeria');
								?>
									<div class="swiper-slide">
										<div class="inner-slide maserati-shadow">
											<?php if ($imagen_galeria) : ?>
												<?php echo wp_get_attachment_image($imagen_galeria, $size); ?>
											<?php endif; ?>
											<?php $exterior_interior_selected_option = get_sub_field('exterior_interior'); ?>
											<?php if ($exterior_interior_selected_option) : ?>
												<h5 class="text-center text-white"><?php echo esc_html($exterior_interior_selected_option['label']); ?></h5>
											<?php endif; ?>
										</div>
									</div>
								<?php endwhile; ?>
							</div>
							<div class="swiper-button-prev"></div>
							<div class="swiper-button-next"></div>
							<div class="swiper-pagination"></div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>


</div>

<?php wp_footer(); ?>

</body>

</html>