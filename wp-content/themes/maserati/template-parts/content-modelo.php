<?php

/**
 * Template part for displaying page content in single-modelo.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package maserati
 */
global $maserati_models;
//get_template_part('parts/part', 'banner-page');
$size = 'full';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php $banner_desktop = get_field('banner_desktop'); ?>
	<?php $banner_mobile = get_field('banner_mobile'); ?>
	<?php if ($banner_desktop || $banner_mobile) : ?>
		<section class="maserati-model_slider">
			<div class="fullwidth">
				<?php if (wp_is_mobile()) :
					if ($banner_mobile) :
						echo wp_get_attachment_image($banner_mobile, $size);
					else :
						echo wp_get_attachment_image($banner_desktop, $size);
					endif;
				else :
					echo wp_get_attachment_image($banner_desktop, $size);
				endif; ?>
				<div class="maserati-content_main__banner">
					<div class="container">
						<?php if (have_rows('grupo_identidad')) : ?>
							<div class="info-left">
								<div class="inner-info-left">
									<?php while (have_rows('grupo_identidad')) : the_row(); ?>
										<?php $emblema_modelo = get_sub_field('emblema_modelo'); ?>
										<?php if ($emblema_modelo) : ?>
											<?php echo wp_get_attachment_image($emblema_modelo, $size); ?>
										<?php endif; ?>
										<?php echo !wp_is_mobile() ? '<h6>' . get_sub_field('slogan_modelo') . '</h6>' : ''; ?>
									<?php endwhile; ?>
								</div>
							</div>
						<?php endif; ?>

						<?php
						$price_model = get_field('precio');
						if ($price_model) : ?>
							<div class="right">
								<h5><?php echo wp_is_mobile() ? __('Desde', 'maserati') :  __('Precio desde', 'maserati'); ?></h5>
								<h2 class="price h1"><?php echo '$' . number_format_i18n($price_model, 0); ?>
									<button type="button" class="maserati-disclamers cursor" data-bs-target="#disclamersModal" data-bs-toggle="modal">
										<span data-bs-placement="bottom" data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="Terminos y Condiciones" data-bs-original-title="" title="">
											<i class="fa-solid fa-exclamation"></i>
										</span>
									</button>
								</h2>
							</div>
						<?php endif; ?>

					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>


	<?php
	$background_presentacion = get_field('background_seccion_presentacion');
	$modelo_img_presentacion = get_field('modelo_img_presentacion');

	if ($background_presentacion) :
	?>
		<section class="maserati-model_presentation" style="<?php echo $background_presentacion ? 'background-image: url(' . wp_get_attachment_image_url($background_presentacion, $size) . ');' : ''; ?>">
			<?php if (have_rows('contenido_presentacion')) : ?>
				<div class="tiny-container">
					<?php while (have_rows('contenido_presentacion')) : the_row(); ?>
						<h3 class="title-line text-white"><?php the_sub_field('titulo_presentacion'); ?></h3>
						<p class="maserati-color--light_grey"><?php the_sub_field('texto_presentacion'); ?></p>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>
			<div class="fullwidth">
				<div class="presentation_model">
					<div class="inner_presentation" data-aos-duration="2200" data-aos="slide-left">
						<?php if (get_field('modelo_sera_video') == 1) : ?>
							<?php if (have_rows('grupo_video_presentacion')) : ?>
								<video data-animation-forward muted autoplay preload="none" playsinline style="z-index: 100;">
									<?php while (have_rows('grupo_video_presentacion')) : the_row(); ?>
										<?php if (get_sub_field('modelo_video_presentacion_mov')) : ?>
											<source data-animation-forward data-src="<?php the_sub_field('modelo_video_presentacion_mov'); ?>" type='video/mp4; codecs=" hvc1"' src="<?php the_sub_field('modelo_video_presentacion_mov'); ?>">
										<?php endif; ?>
										<?php if (get_sub_field('modelo_video_presentacion_webm')) : ?>
											<source data-animation-forward data-src="<?php the_sub_field('modelo_video_presentacion_webm'); ?>" type="video/webm" src="<?php the_sub_field('modelo_video_presentacion_webm'); ?>">
										<?php endif;  ?>
								</video>
							<?php endwhile; ?>
						<?php endif; ?>
					<?php else : ?>
						<?php if ($modelo_img_presentacion) : ?>
							<?php echo wp_get_attachment_image($modelo_img_presentacion, $size); ?>
						<?php endif; ?>
					<?php endif; ?>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>



	<?php if (have_rows('repeater_modelo_galeria')) : ?>
		<section class="maserati-model_galeria">
			<div class="tiny-container">
				<h3><?php the_field('titulo_galeria'); ?></h3>
				<p class="maserati-color--dark_grey"><?php the_field('texto_galeria'); ?></p>
			</div>


			<div class="fullwidth mt-5">
				<div class="swiper  swiper-2_5_gallery card-slider">
					<div class="swiper-wrapper">
						<?php
						while (have_rows('repeater_modelo_galeria')) : the_row();
							$imagen_galeria = get_sub_field('imagen_galeria');
						?>
							<div class="swiper-slide">
								<a class="inner-slide maserati-shadow" data-bs-toggle="modal" data-bs-target="#modelGallery">
									<?php if ($imagen_galeria) : ?>
										<?php echo wp_get_attachment_image($imagen_galeria, $size); ?>
									<?php endif; ?>
								</a>
							</div>
						<?php endwhile; ?>
					</div>
					<div class="swiper-button-prev"></div>
					<div class="swiper-button-next"></div>
					<div class="swiper-pagination"></div>
				</div>
			</div>

		</section>
	<?php endif; ?>


	<?php
	if (get_field('video_desktop') || get_field('video_mobile')) : ?>
		<section id="maserati-model_video" class="maserati-model_video d-none d-md-block">
			<div class="fullwidth">
				<div class="model-inner-video">
					<video id="videoPin" muted autoplay <?php echo get_field('video_desktop') ? 'data-desktop-asset="' . get_field('video_desktop') . '"' : ''; ?> <?php echo get_field('video_mobile') ? 'data-mobile-asset="' . get_field('video_mobile') . '"' : ''; ?> preload="none" loop="" playsinline="" src="<?php echo get_field('video_desktop'); ?>">
					</video>
				</div>
			</div>
		</section>
	<?php
	endif; ?>


	<?php if (have_rows('repeater_caracteristicas')) :
		$numrows = count(get_field('repeater_caracteristicas'));
		//echo '<pre>' . print_r($numrows) . '</pre>'; 
	?>
		<section class="maserati-model_caracteristicas">
			<div class="fullwidth ">
				<div class="swiper swiper-1_5 card-slider">
					<div class="swiper-wrapper <?php echo $numrows == 1 ? 'one-slider' : ''; ?> ">
						<?php while (have_rows('repeater_caracteristicas')) : the_row(); ?>
							<?php $imagen_caracteristica = get_sub_field('imagen_caracteristica_f'); ?>
							<?php while (have_rows('grupo caracteristicas')) : the_row(); ?>
								<?php $titulo_slider_first = get_sub_field('titulo_caracteristicas'); ?>
							<?php endwhile; ?>
							<div class="swiper-slide" data-title-featured="<?php echo sanitize_title($titulo_slider_first); ?>">

								<div class="inner-card">
									<?php if ($imagen_caracteristica) : ?>
										<div class="image-card">
											<?php echo wp_get_attachment_image($imagen_caracteristica, $size); ?>
										</div>
									<?php endif; ?>

									<?php $count_interior_slider = 0;
									if (have_rows('r_repeater')) : ?>
										<?php while (have_rows('r_repeater')) : the_row(); ?>
										<?php
											$count_interior_slider++;
										endwhile; ?>
									<?php endif;
									?>

									<?php if (have_rows('grupo caracteristicas')) : ?>
										<div class="content-card">

											<?php while (have_rows('grupo caracteristicas')) : the_row(); ?>
												<h3 class="title-line text-white"><?php echo $titulo_slider_first; ?></h3>
												<p><?php the_sub_field('resumen_caracteristicas_copiar'); ?></p>

												<?php if ($count_interior_slider > 0) : ?>
													<a class="cursor" data-bs-toggle="modal" data-bs-target="#modelFeatures<?php echo sanitize_title($titulo_slider_first); ?>"><i class="icon-arrow-right"></i> <?php echo __('Ver más', 'maserati'); ?></a>
												<?php endif; ?>

											<?php endwhile; ?>
										</div>
									<?php endif; ?>
								</div>
							</div>
						<?php endwhile; ?>
					</div>
					<div class="swiper-button-prev swiper-button-prev-featured"></div>
					<div class="swiper-button-next swiper-button-next-featured"></div>
					<div class="swiper-scrollbar"></div>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php
	$sound_motor = get_field('sound_motor');
	$url = wp_get_attachment_url($sound_motor);
	$background_motor = get_field('background_motor');
	$background_motor_mobile = get_field('background_motor_mobile');
	?>
	<?php if ($sound_motor) : ?>
		<section class="maserati-model_motor" <?php echo wp_is_mobile() ? 'style="background-image:url(' . wp_get_attachment_image_url($background_motor_mobile, $size) . ');"' : 'style="background-image:url(' . wp_get_attachment_image_url($background_motor, $size) . ');"' ?>>
			<div class="container">
				<div class="inner-container">
					<?php echo wp_is_mobile() ? '<div class="title-group">' : ''; ?>
					<h4 class="title-line text-white"><?php the_field('tiulo_motor'); ?></h4>
					<?php echo wp_is_mobile() ? '<p class="text-white">' . __('Haz click para escuchar el sonido del motor', 'maserati') . '</p> </div>' : ''; ?>
					<?php if ($sound_motor) : ?>
						<div class="pulse-on_off">
							<div class="listen-motor">
								<i class="icon-on-off"></i>
								<div class="pulse-sound"></div>
								<div class="vz-wrapper">
									<audio id="myAudio" src="<?php echo esc_url($url); ?>" data-author="Beethoven" data-title="Allegro"></audio>
									<div class="vz-wrapper -canvas">
										<canvas id="myCanvas" width="400" height="400"></canvas>
									</div>
								</div>
							</div>




							<?php if (!wp_is_mobile()) : ?>
								<p><?php echo __('Haz click para escuchar el sonido del motor', 'maserati'); ?></p>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php if (have_rows('repeat_verisones')) : ?>
		<section class="maserati-model_colection">
			<div class="container marginB-45 text-center">
				<h3 class="maserati-color--navi_blue fw-500"><?php echo __('La colección', 'maserati') . ' ' . get_the_title(); ?></h3>
				<h4 class="maserati-color--feature_grey">Una elección, muchas posibilidades para diferenciarse del resto.</h4>
			</div>
			<div class="container">
				<div class="swiper swiper-name-pagination">
					<div class="swiper-wrapper">
						<?php while (have_rows('repeat_verisones')) : the_row();
							$version_titulo = get_sub_field('nombre_version');
						?>
							<div class="swiper-slide"><?php echo $version_titulo ?></div>
						<?php endwhile; ?>
					</div>
				</div>
				<div class="swiper swiper-single_banner__models_single">
					<?php echo !wp_is_mobile() ? '<div class="swiper-pagination swiper-pagination-name"></div>' : ''; ?>
					<div class="swiper-wrapper">
						<?php $i = 1;
						while (have_rows('repeat_verisones')) : the_row();
							$version_titulo = get_sub_field('nombre_version');
							$version_price  = get_sub_field('precio_version');
							$version_ficha  = get_sub_field('ficha_version');
						?>
							<div class="swiper-slide" data-title="<?php echo $version_titulo ? $version_titulo : ''; ?>" data-ficha="<?php echo $version_ficha ? $version_ficha : ''; ?>" <?php echo $version_titulo && $i == 1 ? 'data-value="' . sanitize_title($version_titulo) . '"' : ''; ?>>
								<article>
									<div class="header-model marginB-45" <?php echo wp_is_mobile() ? '' : 'data-aos="fade-left"'; ?>>
										<?php $imagen_version = get_sub_field('imagen_version'); ?>
										<?php if ($imagen_version) : ?>
											<?php echo wp_get_attachment_image($imagen_version, $size); ?>
										<?php endif; ?>

										<h2 class="h1 maserati-color--navi_blue"><?php echo $version_titulo ?></h2>
										<?php if ($version_price) : ?>
											<h5 class="maserati-color--feature_grey"><?php echo __('Desde:', 'maserati'); ?> <span><?php echo '$' . number_format_i18n($version_price, 0); ?></span>
												<button type="button" class="maserati-disclamers cursor" data-bs-target="#disclamersModal" data-bs-toggle="modal">
													<span data-bs-placement="bottom" data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="Terminos y Condiciones" data-bs-original-title="" title="">
														<i class="fa-solid fa-exclamation"></i>
													</span>
												</button>
											</h5>
										<?php endif; ?>
									</div>
									<div class="body-model">
										<?php if (have_rows('group_information')) : ?>
											<div class="version-info">

												<?php while (have_rows('group_information')) : the_row(); ?>

													<?php if (get_sub_field('potencia_maxima')) : ?>
														<div class="version-info_item">
															<h5 class="maserati-color--dark_grey"><span class="counter"><?php the_sub_field('potencia_maxima'); ?></span> CV</h5>
															<p><?php echo __('Potencia máxima', 'maserati'); ?></p>
														</div>
													<?php endif; ?>

													<?php if (get_sub_field('velocidad_maxima')) : ?>
														<div class="version-info_item">
															<h5 class="maserati-color--dark_grey"><span class="counter"><?php the_sub_field('velocidad_maxima'); ?></span> m/h</h5>
															<p><?php echo __('Velocidad máxima', 'maserati'); ?></p>
														</div>
													<?php endif; ?>

													<?php if (get_sub_field('aceleracion')) : ?>
														<div class="version-info_item">
															<h5 class="maserati-color--dark_grey"><span class="counter"><?php the_sub_field('aceleracion'); ?></span> sec</h5>
															<p><?php echo __('Aceleración', 'maserati'); ?></p>
														</div>
													<?php endif; ?>

													<?php if (get_sub_field('esquema_de_motor')) : ?>
														<div class="version-info_item">
															<h5 class="maserati-color--dark_grey"><span><?php the_sub_field('esquema_de_motor'); ?></span></h5>
															<p><?php echo __('Esquema motor', 'maserati'); ?></p>
														</div>
													<?php endif; ?>

													<?php if (get_sub_field('traccion')) : ?>
														<div class="version-info_item">
															<h5 class="maserati-color--dark_grey"><span><?php the_sub_field('traccion'); ?></span></h5>
															<p><?php echo __('Tracción', 'maserati'); ?></p>
														</div>
													<?php endif; ?>

													<?php if (get_sub_field('cilindrada')) : ?>
														<div class="version-info_item">
															<h5 class="maserati-color--dark_grey"><span class="counter"><?php the_sub_field('cilindrada'); ?></span> cc</h5>
															<p><?php echo __('Cilindrada', 'maserati'); ?></p>
														</div>
													<?php endif; ?>

													<?php if (get_sub_field('year')) : ?>
														<div class="version-info_item d-none" data-year="<?php the_sub_field('year'); ?>"></div>
													<?php endif; ?>

												<?php endwhile; ?>

											</div>
										<?php endif; ?>
									</div>
								</article>
							</div>
						<?php $i++;
						endwhile; ?>
					</div>
					<div class="swiper-pagination"></div>
					<div class="swiper-button-prev"></div>
					<div class="swiper-button-next"></div>
				</div>
			</div>
			<div class="container version_to_action">
				<div class="inner-container">
					<a class="maserati-button maserati-button_large maserati-back--transparent_navy cursor" data-bs-toggle="modal" data-bs-target="#modalversion"><?php echo __('Comparar', 'maserati'); ?></a>
					<a id="version-quote" class="maserati-button maserati-button_large maserati-back--navi_blue" href="#"><?php echo __('Cotizar', 'maserati'); ?></a>
				</div>
				<a id="data-sheet" class="maserati-button aserati-button_large maserati-color--navi_blue mt-5" href="#" target="_blank"><i class="fas fa-arrow-down"></i> <?php echo __('Ficha Técnica', 'maserati'); ?></a>
			</div>
		</section>
	<?php endif; ?>

	<?php $background_config_lg = get_field('background_config_lg'); ?>
	<?php $background_config_sm = get_field('background_config_sm');

	if ($background_config_lg) : ?>
		<section class="maserati-configurador" style="background-image:url(<?php echo !wp_is_mobile() ? wp_get_attachment_image_url($background_config_lg, $size) : ($background_config_sm ? wp_get_attachment_image_url($background_config_sm, $size) : wp_get_attachment_image_url($background_config_lg, $size)); ?>);">
			<div class="container">
				<div class="row">
					<div class="col-md-5 col-sm-12">
						<h3 class="text-white fw-500"><?php the_field('titulo_config'); ?></h3>
						<a class="maserati-button maserati-button_large maserati-back--transparent mt-4 cursor" data-bs-toggle="modal" data-bs-target="#modalConfigVersion"><?php echo __('Iniciar', 'maserati'); ?></a>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php get_template_part('parts/part', 'contacto') ?>

</article>


<!-- Modal Versión-->
<div class="modal fade" id="modalversion" tabindex="-1" aria-labelledby="modalversionLabel" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen">
		<div class="modal-content">
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			<div class="modal-body maserati-comparador">
				<div class="container">
					<div class="header-comparador text-center mb-5">
						<h3 class="maserati-color--navi_blue"><?php echo !wp_is_mobile() ? __('¡Bienvenido al comparador!', 'maserati') : __('¡Te damos la bienvenida al comparador!', 'maserati'); ?></h3>
						<p class="maserati-color--feature_grey"><?php echo __('Estos son los modelos que estas comparanto', 'maserati'); ?></p>
					</div>
					<div class="body-comparador text-center">
						<div class="row">
							<div class="col-md-6 col-sm-12 full-table">
								<i class="icon-close d-none"></i>
								<table class="table-left in full">
									<thead class="found">
										<tr>
											<th class="model-image">
												<img src="" alt="">
											</th>
											<th class="model-title">
												<p></p>
											</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												Año
											</td>
											<td class="model-year" data-title="Año">
												<p></p>
											</td>
										</tr>
										<tr>
											<td>
												Esquema motor
											</td>
											<td class="model-esquema" data-title="Esquema motor">
												<p></p>
											</td>
										</tr>
										<tr>
											<td>
												Cilindrada
											</td>
											<td class="model-cilindrada" data-title="Cilindrada">
												<p></p>
											</td>
										</tr>
										<tr>
											<td>
												Aceleración
											</td>
											<td class="model-aceleracion" data-title="Aceleración">
												<p></p>
											</td>
										</tr>
										<tr>
											<td>
												Velocidad máxima
											</td>
											<td class="model-velocidad" data-title="Velocidad máxima">
												<p></p>
											</td>
										</tr>
										<tr>
											<td>
												Potencia máxima
											</td>
											<td class="model-potencia" data-title="Potencia máxima">
												<p></p>
											</td>
										</tr>
										<tr>
											<td>
												Tracción
											</td>
											<td class="model-traccion" data-title="tracción">
												<p></p>
											</td>
										</tr>
										<tr>
											<td>
												Precio
											</td>
											<td class="model-precio" data-title="Precio">
												<p></p>
											</td>
										</tr>
									</tbody>
									<tfoot>
										<tr>
											<td><a class="maserati-button aserati-button_large maserati-color--navi_blue ficha-comparador" href="" target="_blank"><i class="fas fa-arrow-down"></i> <?php echo __('Ficha Técnica', 'maserati'); ?></a></td>
										</tr>
										<tr>
											<td><a class="maserati-button maserati-button_large maserati-back--navi_blue marginX-auto button-cotizador" href=""><?php echo __('Cotizar', 'maserati'); ?></a></td>
										</tr>
									</tfoot>
								</table>
							</div>
							<div class="versus">
								<span>VS</span>
							</div>
							<div class="col-md-6 col-sm-12 empty-table">
								<table class="table-right empty">
									<thead class="not-found" data-bs-toggle="modal" data-bs-target="#modalAllVersion" data-ficha="">
										<tr>
											<th class="model-image">
												<i class="icon-plus"></i>
											</th>
											<th class="model-title">
												<p>Agregar Modelo</p>
											</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												Año
											</td>
											<td class="model-year" data-title="Año">
												<p>-</p>
											</td>
										</tr>
										<tr>
											<td>
												Esquema motor
											</td>
											<td class="model-esquema" data-title="Esquema motor">
												<p>-</p>
											</td>
										</tr>
										<tr>
											<td>
												Cilindrada
											</td>
											<td class="model-cilindrada" data-title="Cilindrada">
												<p>-</p>
											</td>
										</tr>
										<tr>
											<td>
												Aceleración
											</td>
											<td class="model-aceleracion" data-title="Aceleración">
												<p>-</p>
											</td>
										</tr>
										<tr>
											<td>
												Velocidad máxima
											</td>
											<td class="model-velocidad" data-title="Velocidad máxima">
												<p>-</p>
											</td>
										</tr>
										<tr>
											<td>
												Potencia máxima
											</td>
											<td class="model-potencia" data-title="Potencia máxima">
												<p>-</p>
											</td>
										</tr>
										<tr>
											<td>
												Tracción
											</td>
											<td class="model-traccion" data-title="tracción">
												<p>-</p>
											</td>
										</tr>
										<tr>
											<td>
												Precio
											</td>
											<td class="model-precio" data-title="Precio">
												<p>-</p>
											</td>
										</tr>
									</tbody>
									<tfoot>
										<tr>
											<td><a class="maserati-button aserati-button_large maserati-color--navi_blue ficha-comparador" href="" target="_blank"><i class="fas fa-arrow-down"></i> <?php echo __('Ficha Técnica', 'maserati'); ?></a></td>
										</tr>
										<tr>
											<td><a class="maserati-button maserati-button_large maserati-back--navi_blue marginX-auto cursor button-cotizador"><?php echo __('Cotizar', 'maserati'); ?></a></td>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="button-call_to_action" style="display:none;">
			<a class="maserati-button maserati-button_large maserati-back--navi_blue marginX-auto text-uppercase" href=""><?php echo __('Configurar', 'maserati'); ?> <i class="icon-arrow-right"></i></a>
		</div>
	</div>
</div>


<!-- Modal versiones-->
<div class="modal fade" id="modalAllVersion" tabindex="-1" aria-labelledby="modalAllVersionLabel" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen">
		<div class="modal-content">
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			<div class="modal-body">
				<div class="container">
					<h3 class="maserati-color--navi_blue"><?php echo !wp_is_mobile() ? __('Selecciona 1 modelo para comparar', 'maserati') : __('Selecciona otro modelo para comparar', 'maserati'); ?></h3>
					<div class="accordion" id="accordionModels">

						<?php $i = 1; ?>
						<?php foreach ($maserati_models as $maserati_model) : ?>
							<div class="accordion-item">
								<h2 class="accordion-header" id="headingModel<?php echo $maserati_model->post_name; ?>">
									<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseModel<?php echo $maserati_model->post_name; ?>" aria-expanded="false" aria-controls="collapseModel<?php echo $maserati_model->post_name; ?>">
										<h5 class="maserati-color--navi_blue"><?php echo __('La colección', 'maserati') . ' ' . $maserati_model->post_title; ?></h5>
									</button>
								</h2>
								<div id="collapseModel<?php echo $maserati_model->post_name; ?>" class="accordion-collapse collapse" aria-labelledby="headingModel<?php echo $maserati_model->post_name; ?>" data-bs-parent="#accordionModels">
									<div class="accordion-body">

										<?php if (have_rows('grupo_identidad', $maserati_model->ID)) : ?>
											<?php while (have_rows('grupo_identidad', $maserati_model->ID)) : the_row(); ?>
												<h6 class="maserati-color--feature_grey"><?php the_sub_field('slogan_modelo', $maserati_model->ID); ?></h6>
											<?php endwhile; ?>
										<?php endif; ?>
										<div class="select-version">
											<?php while (have_rows('repeat_verisones', $maserati_model->ID)) : the_row();

												$version_titulo = get_sub_field('nombre_version', $maserati_model->ID);
												$version_price = get_sub_field('precio_version', $maserati_model->ID);
												$version_image = get_sub_field('imagen_version', $maserati_model->ID);
												$version_ficha = get_sub_field('ficha_version');

												while (have_rows('group_information')) : the_row();
													$version_potencia = get_sub_field('potencia_maxima');
													$version_velocidad = get_sub_field('velocidad_maxima');
													$version_aceleracion = get_sub_field('aceleracion');
													$version_esquema = get_sub_field('esquema_de_motor');
													$version_traccion = get_sub_field('traccion');
													$version_cilindrada = get_sub_field('cilindrada');
													$version_year =  get_sub_field('year');
												endwhile; ?>

												<div class="mini-card cursor" data-year="<?php echo $version_year ?>" data-esquema="<?php echo $version_esquema ?>" data-cilindrada="<?php echo $version_cilindrada ?> cc" data-aceleracion="<?php echo $version_aceleracion ?> sec" data-velocidad="<?php echo $version_velocidad ?> km/h" data-potencia="<?php echo $version_potencia ?> CV" data-traccion="<?php echo $version_traccion ?>" data-price=" <?php echo 'Desde: $' . number_format_i18n($version_price, 0);  ?>" data-ficha="<?php echo $version_ficha ?>">
													<?php echo wp_get_attachment_image($version_image, $size); ?>
													<p><?php echo $version_titulo; ?></p>
												</div>

											<?php endwhile; ?>
										</div>
									</div>
								</div>
							</div>
							<?php $i++; ?>
						<?php endforeach; ?>
					</div>

				</div>

			</div>
		</div>
	</div>
	<div class="button-call_to_action" style="display:none;">
		<a class="maserati-button maserati-button_large maserati-back--navi_blue marginX-auto text-uppercase cursor"><?php echo __('Comparar', 'maserati'); ?> <i class="icon-arrow-right"></i></a>
	</div>
</div>

<!-- Modal Configuración-->
<div class="modal fade" id="modalConfigVersion" tabindex="-1" aria-labelledby="modalConfigVersionLabel" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen modal-dialog-scrollable">
		<div class="modal-content">
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			<div class="modal-body p-0">
				<?php
				$banner_modal_config = get_field('banner_modal_config');
				$background_config_sm = get_field('background_config_sm');

				?>
				<?php if ($banner_modal_config) : ?>
					<figure>
						<?php echo !wp_is_mobile() ? wp_get_attachment_image($banner_modal_config, $size, "", array("class" => "banner-modelo-conf")) : ($background_config_sm ? wp_get_attachment_image($background_config_sm, $size, "", array("class" => "banner-modelo-conf")) : wp_get_attachment_image($banner_modal_config, $size, "", array("class" => "banner-modelo-conf"))); ?>
						<?php while (have_rows('grupo_identidad')) : the_row(); ?>
							<?php $emblema_modelo = get_sub_field('emblema_modelo'); ?>
							<?php if ($emblema_modelo) : ?>
								<?php echo wp_get_attachment_image($emblema_modelo, $size, "", array("class" => "emblema-modelo-conf")); ?>
							<?php endif; ?>
						<?php endwhile; ?>
					</figure>
				<?php endif; ?>
				<div class="container">
					<h3 class="maserati-color--navi_blue text-center"><?php echo __('Selecciona 1 modelo para configurar', 'maserati'); ?></h3>
					<div class="accordion" id="accordionModels">
						<div class="accordion-item">
							<h2 class="accordion-header" id="headingModel<?php echo get_the_title(); ?>">
								<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseModel<?php echo get_the_title(); ?>" aria-expanded="true" aria-controls="collapseModel<?php echo get_the_title(); ?>">
									<h5 class="maserati-color--navi_blue"><?php echo __('La colección', 'maserati') . ' ' . get_the_title(); ?></h5>
								</button>
							</h2>
							<div id="collapseModel<?php echo get_the_title(); ?>" class="accordion-collapse show" aria-labelledby="headingModel<?php echo get_the_title(); ?>" data-bs-parent="#accordionModels">
								<div class="accordion-body">

									<?php if (have_rows('grupo_identidad')) : ?>
										<?php while (have_rows('grupo_identidad')) : the_row(); ?>
											<h6 class="maserati-color--feature_grey"><?php the_sub_field('slogan_modelo'); ?></h6>
										<?php endwhile; ?>
									<?php endif; ?>
									<div class="select-version">
										<?php while (have_rows('repeat_verisones')) : the_row();

											$version_titulo = get_sub_field('nombre_version');
											$version_image = get_sub_field('imagen_version');
											$codigo_version = get_sub_field('codigo_version');
										?>
											<?php if ($codigo_version) : ?>
												<div class="mini-card cursor" data-code="<?php echo $codigo_version ?>">
													<?php echo wp_get_attachment_image($version_image, $size); ?>
													<p><?php echo $version_titulo; ?></p>
												</div>
											<?php endif; ?>
										<?php endwhile; ?>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>

			</div>
		</div>
	</div>
	<div class="button-call_to_action" style="display:none;">
		<a class="maserati-button maserati-button_large maserati-back--navi_blue marginX-auto text-uppercase cursor"><?php echo __('Configurar', 'maserati'); ?> <i class="icon-arrow-right"></i></a>
	</div>
</div>

<!-- Modal Caracteristicas-->
<?php if (have_rows('repeater_caracteristicas')) : ?>
	<?php while (have_rows('repeater_caracteristicas')) : the_row(); ?>
		<?php while (have_rows('grupo caracteristicas')) : the_row(); ?>
			<?php $titulo_slider_first = get_sub_field('titulo_caracteristicas'); ?>
		<?php endwhile; ?>
		<?php if (have_rows('r_repeater')) : ?>
			<div class="modal fade" id="modelFeatures<?php echo sanitize_title($titulo_slider_first); ?>" tabindex="-1" aria-labelledby="modelFeatures<?php echo sanitize_title($titulo_slider_first); ?>Label" aria-hidden="true">
				<div class="modal-dialog modal-fullscreen">
					<div class="modal-content">
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						<div class="modal-body">
							<div class="swiper swiper-modal card-slider">
								<div class="swiper-wrapper">
									<?php while (have_rows('r_repeater')) : the_row(); ?>
										<div class="swiper-slide">
											<div class="inner-card">
												<div class="image-card">
													<?php if (wp_is_mobile() && have_rows('content_caracteristica')) : ?>
														<?php while (have_rows('content_caracteristica')) : the_row(); ?>
															<h3 class="text-center text-white"><?php the_sub_field('titulo_caracteristica'); ?></h3>
														<?php endwhile; ?>
													<?php endif; ?>
													<?php $imagen_caracteristica = get_sub_field('imagen_caracteristica'); ?>
													<?php if ($imagen_caracteristica) : ?>
														<?php echo wp_get_attachment_image($imagen_caracteristica, $size); ?>
													<?php endif; ?>
												</div>
												<?php if (have_rows('content_caracteristica')) : ?>
													<div class="content-card">
														<?php while (have_rows('content_caracteristica')) : the_row(); ?>
															<h3 class="title-line text-white"><?php echo !wp_is_mobile() ?  get_sub_field('titulo_caracteristica')  : ''; ?> <span><?php the_sub_field('subtitulo_caracteristica'); ?></span></h3>
															<p><?php the_sub_field('contenido_caracteristica'); ?></p>
														<?php endwhile; ?>

														<div id="fraction" class="label-medium text-white swiper-pagination"></div>

													</div>
												<?php endif; ?>
											</div>
										</div>
									<?php endwhile; ?>
								</div>
								<div class="swiper-button-prev swiper-button-prev-featured"></div>
								<div class="swiper-button-next swiper-button-next-featured"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
	<?php endwhile; ?>
<?php endif; ?>

<!-- Disclamer Modal -->
<div class="modal fade show" id="disclamersModal" tabindex="-1" aria-labelledby="disclamersModalLabel" aria-modal="true" role="dialog">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				<h5 class="text-center">Términos y condiciones</h5>
				<p class="mb-5">*Los precios mostrados incluyen IVA e impuestos de matriculación. </br> El IVA y el Impuesto de Matriculación (IEDMT) se han calculado al tipo general, pudiendo variar estos importes dependiendo de la fecha final de la compraventa así como de los porcentajes aplicables fiscalmente según los impuestos de cada comunidad autónoma o por variaciones en los valores de emisiones debido al equipamiento opcional finalmente elegido.</p>
				<p class="mb-5"><strong>Para más información no dude en contactar con su concesionario más cercano.</strong></p>
				<a class="maserati-button maserati-button_large maserati-back--transparent_navy marginX-auto" data-bs-dismiss="modal" aria-label="Close">Entendido</a>
			</div>
		</div>
	</div>
</div>