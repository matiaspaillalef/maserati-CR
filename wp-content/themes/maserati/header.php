<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package maserati
 */

?>
<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
	<?php wp_head(); ?>
</head>

<?php
global $maserati_models;

$logotipo = get_field('logotipo', 'option');
$logotipo_blanco = get_field('logotipo_blanco', 'option');
$facebook_general 	= get_field('facebook_general', 'option');
$instagram_general 	= get_field('instagram_general', 'option');
$whatsapp_general 	= get_field('whatsapp_general', 'option');
$mail_general 		= get_field('mail_general', 'option');
$phone_general 		= get_field('telefono_general', 'option');
$size = 'full';
$menuMaserati = '';
if (wp_is_mobile()) :
	$menuMaserati = 'Menu Mbil';
else :
	$menuMaserati = 'Menu Ppal';
endif;

$menuArray = wp_get_nav_menu_items($menuMaserati);
$itemsParent = maserati_filter_menu_items($menuArray, 0);

$shop_id = get_option('woocommerce_shop_page_id'); // Traemos el ID del shop
$archive_id  = get_queried_object();
//La clase loading-page ase usa para que no se mueva el body mientras hace el preload
$custom_clasess = 'loading-page';
?>

<body <?php body_class($custom_clasess); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<header id="masthead" class="site-header <?php echo wp_is_mobile() || is_archive('modelo') ? '' : (get_field('header_transparent', $archive_id) == 1 ? 'header-transparent' : ''); ?> <?php echo get_field('activar_sticky_header', 'option') == 1 ? 'sticky-active' : ''; ?>">
			<div class="container">
				<div class="inner-header">
					<div class="inner-left">
						<div class="hamburger-menu">
							<div class="bar"></div>
						</div>
						<p class="title-medium"><?php echo !wp_is_mobile() ? __('Menú', 'maserati') : ''; ?>
					</div>
					<?php if ($logotipo) : ?>
						<div class="inner-center">
							<a href="/">
								<?php
								echo wp_get_attachment_image($logotipo_blanco, $size, "false", array("class" => "maserati-white"));
								echo wp_get_attachment_image($logotipo, $size, "false", array("class" => "maserati-black"));
								?>
							</a>
						</div>
					<?php endif; ?>
					<?php if (!wp_is_mobile()) : ?>
						<div class="inner-right">
							<a class="maserati-button maserati-button_large" href="/contacto/">
								<?php echo __('Contacto', 'maserati'); ?>
							</a>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</header><!-- #masthead -->



		<div class="sidebar-overlay"></div>
		<?php if (wp_is_mobile()) : // Menu mobile
		?>
			<aside class="side-menu menu-mobile">
				<div class="header-side-menu">
					<?php echo wp_get_attachment_image($logotipo, $size, "false", array("class" => "maserati-black")); ?>
					<div class="hamburger-menu">
						<div class="bar"></div>
					</div>
				</div>
				<nav id="maserati-menu" class="menu-wrap accordion">
					<?php $i = 1; ?>
					<?php foreach ($itemsParent as $itemParent) : ?>
						<ul class="accordion-item">
							<?php $itemsChild = maserati_filter_menu_items($menuArray, $itemParent->ID); ?>
							<?php $current = ($itemParent->object_id == get_queried_object_id()) ? 'current-item' : ''; ?>

							<li class="nav-item <?php echo count($itemsChild) >= 1 ? 'accordion-header' : ''; ?> <?php foreach ($itemParent->classes as $itemClass) : ?><?php echo ' ' . $itemClass; ?><?php endforeach; ?> <?php echo $current; ?>" id="panel-<?php echo $i ?>">
								<a <?php echo get_field('dont_link', $itemParent) == 1  ? '' : 'href="' . $itemParent->url . '"'; ?> class="nav-link maserati-color--navi_blue title-large" data-bs-toggle="collapse" data-bs-target="#panelbody-<?php echo $i ?>" aria-expanded="true" aria-controls="panelbody-<?php echo $i ?>">
									<?php echo $itemParent->title; ?>
									<?php echo count($itemsChild) >= 1 ? '<i class="icon-arrow-down"></i>' : ''; ?>
								</a>
							</li>

							<?php if (count($itemsChild) >= 1) : ?>
								<ul class="maserati-menu--submenu accordion-collapse collapse show" id="panelbody-<?php echo $i ?>" aria-labelledby="panel-<?php echo $i ?>">
									<?php $count = 1; ?>
									<?php foreach ($itemsChild as $itemChild) : ?>
										<?php $itemsGrandson = maserati_filter_menu_items($menuArray, $itemChild->ID); ?>
										<li class="nav-subitem <?php echo get_field('es_un_modelo', $itemChild) == 1  ? 'item-modelo' : ''; ?> <?php echo count($itemsGrandson) >= 1 ? 'accordion-header' : ''; ?>" <?php echo count($itemsGrandson) >= 1 ? 'id="panel-sub' . $i . '-' . $count . '"' : ''; ?>>
											<a <?php echo get_field('dont_link', $itemChild) == 1  ? '' : 'href="' . $itemChild->url . '"'; ?> class="nav-link <?php foreach ($itemChild->classes as $itemClass) : ?><?php echo ' ' . $itemClass; ?><?php endforeach; ?> maserati-color--navi_blue title-large" <?php echo count($itemsGrandson) >= 1 ? 'data-bs-toggle="collapse" data-bs-target="#panelbody-sub' . $i . '-' . $count . '" aria-expanded="true" aria-controls="panelbody-sub' . $i . '-' . $count . '"' : ''; ?>>
												<?php if (get_field('es_un_modelo', $itemChild) == 1) : ?>
													<?php echo get_the_post_thumbnail($itemChild->object_id); ?>
												<?php endif; ?>
												<?php echo $itemChild->title; ?>
												<?php echo count($itemsGrandson) >= 1 ? '<i class="icon-arrow-down"></i>' : ''; ?>
											</a>

											<?php if (count($itemsGrandson) >= 1) : ?>
												<ul class=" maserati-menu--submenu menu_grandson accordion-collapse <?php echo count($itemsGrandson) >= 1 ? 'collapse show' : ''; ?>" <?php echo count($itemsGrandson) >= 1 ? 'id="panelbody-sub' . $i . '-' . $count . '" aria-labelledby="panel-sub' . $i . '-' . $count . '"' : ''; ?>>
													<?php foreach ($itemsGrandson as $itemGrandson) : ?>
														<li class="nav-subitem item-grandson">
															<a <?php echo get_field('dont_link', $itemGrandson) == 1  ? '' : 'href="' . $itemGrandson->url . '"'; ?> class="nav-link <?php foreach ($itemChild->classes as $itemClass) : ?><?php echo ' ' . $itemClass; ?><?php endforeach; ?> maserati-color--navi_blue title-large">
																<?php echo $itemGrandson->title; ?>
															</a>
														</li>
													<?php endforeach; ?>
												</ul>
											<?php endif; ?>

										</li>
										<?php $count++; ?>
									<?php endforeach; ?>
								</ul>

							<?php endif; ?>
						</ul>
						<?php $i++; ?>
					<?php endforeach; ?>
					<div class="maserati-datos-menu maserati-color--navi_blue">
						<?php if (have_rows('repeater_menu_extra', 'option')) : ?>
							<div class="maserati-extra">
								<?php while (have_rows('repeater_menu_extra', 'option')) : the_row(); ?>
									<?php $icono_tool = get_sub_field('icono_tool'); ?>
									<?php $titulo_y_enlace_tool = get_sub_field('titulo_y_enlace_tool'); ?>

									<?php $whatsapp_api = 'https://api.whatsapp.com/send?phone=' . get_sub_field('telefono_tool') . '&text=' . get_sub_field('mensaje_tool'); ?>

									<a href="<?php echo get_sub_field('whatsapp_tool') == 1 ? $whatsapp_api : esc_url($titulo_y_enlace_tool['url']) ?>" target="<?php echo get_sub_field('whatsapp_tool') == 1 ? '_blank' : esc_attr($titulo_y_enlace_tool['target']); ?>">
										<?php if (get_sub_field('shopping_tool_font_icon') == 1) : ?>
											<?php if (get_sub_field('icon_font_tool')) : ?>
												<?php the_sub_field('icon_font_tool'); ?>
											<?php endif; ?>
										<?php else : ?>
											<?php if ($icono_tool) : ?>
												<?php echo wp_get_attachment_image($icono_tool, 'full'); ?>
											<?php endif; ?>
										<?php endif; ?>

										<span class="tooltip-hover"><?php echo get_sub_field('whatsapp_tool') == 1 ? get_sub_field('titulo_y_enlace_tooltip_wsp') : esc_html($titulo_y_enlace_tool['title']); ?></span>
									</a>
								<?php endwhile; ?>
							</div>
						<?php endif; ?>
						<div class="maserati-contact">
							<?php if ($mail_general) : ?>
								<p><i class="icon-mail"></i> <span class="body-small"><?php echo $mail_general ?></span></p>
							<?php endif; ?>
							<?php if ($phone_general) : ?>
								<p><i class="icon-phone"></i> <span class="body-small"><?php echo $phone_general ?></span></p>
							<?php endif; ?>
						</div>
						<div class="maserati-social">
							<p class="title-medium"><?php echo __('Contáctanos en', 'maserati'); ?></p>
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




					</div>


				</nav>

			</aside>
		<?php else : // Menu desktop 
		?>
			<aside class="side-menu menu-desktop">

				<div class="menu-left">
					<div class="header-side-menu">
						<?php echo wp_get_attachment_image($logotipo, $size, "false", array("class" => "maserati-black")); ?>
						<div class="hamburger-menu">
							<div class="bar"></div>
						</div>
					</div>
					<nav id="maserati-menu" class="maserati-menu">
						<?php $i = 1; ?>
						<ul>
							<?php foreach ($itemsParent as $itemParent) : ?>
								<?php $itemsChild = maserati_filter_menu_items($menuArray, $itemParent->ID); ?>
								<?php $current = ($itemParent->object_id == get_queried_object_id()) ? 'current-item' : ''; ?>

								<li class="nav-item <?php echo count($itemsChild) == 0 ? 'no-child' : ''; ?> <?php foreach ($itemParent->classes as $itemClass) : ?><?php echo ' ' . $itemClass; ?><?php endforeach; ?> <?php echo $current; ?>" data-menu="<?php echo sanitize_title($itemParent->title); ?>">
									<a <?php echo get_field('dont_link', $itemParent) == 1  ? '' : 'href="' . $itemParent->url . '"'; ?> class="nav-link maserati-color--navi_blue title-large">
										<?php echo $itemParent->title; ?>
										<?php echo count($itemsChild) >= 1 ? '<i class="fa-solid fa-angle-right"></i>' : ''; ?>
									</a>
								</li>

								<?php $i++; ?>
							<?php endforeach; ?>
						</ul>
						<div class="maserati-datos-menu maserati-color--navi_blue">
							<?php if (have_rows('repeater_menu_extra', 'option')) : ?>
								<div class="maserati-extra">
									<?php while (have_rows('repeater_menu_extra', 'option')) : the_row(); ?>
										<?php $icono_tool = get_sub_field('icono_tool'); ?>
										<?php $titulo_y_enlace_tool = get_sub_field('titulo_y_enlace_tool'); ?>

										<?php $whatsapp_api = 'https://api.whatsapp.com/send?phone=' . get_sub_field('telefono_tool') . '&text=' . get_sub_field('mensaje_tool'); ?>

										<a href="<?php echo get_sub_field('whatsapp_tool') == 1 ? $whatsapp_api : esc_url($titulo_y_enlace_tool['url']) ?>" target="<?php echo get_sub_field('whatsapp_tool') == 1 ? '_blank' : esc_attr($titulo_y_enlace_tool['target']); ?>">
											<?php if (get_sub_field('shopping_tool_font_icon') == 1) : ?>
												<?php if (get_sub_field('icon_font_tool')) : ?>
													<?php the_sub_field('icon_font_tool'); ?>
												<?php endif; ?>
											<?php else : ?>
												<?php if ($icono_tool) : ?>
													<?php echo wp_get_attachment_image($icono_tool, 'full'); ?>
												<?php endif; ?>
											<?php endif; ?>

											<span class="tooltip-hover"><?php echo get_sub_field('whatsapp_tool') == 1 ? get_sub_field('titulo_y_enlace_tooltip_wsp') : esc_html($titulo_y_enlace_tool['title']); ?></span>
										</a>
									<?php endwhile; ?>
								</div>
							<?php endif; ?>

							<div class="foot-menu-desktop">
								<div class="maserati-social">
									<p class="title-medium"><?php echo __('Contáctanos en', 'maserati'); ?></p>
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
										<p><i class="icon-mail"></i> <span class="body-small"><?php echo $mail_general ?></span></p>
									<?php endif; ?>
									<?php if ($phone_general) : ?>
										<p><i class="icon-phone"></i> <span class="body-small"><?php echo $phone_general ?></span></p>
									<?php endif; ?>
								</div>
							</div>
						</div>


					</nav>
				</div>
				<div class="menu-right maserati-bg--feature_grey" style="background-image:url(/wp-content/uploads/2022/10/Rectangle-128.jpg)">
					<?php $i = 1; ?>
					<?php foreach ($itemsParent as $itemParent) : ?>
						<?php $background_menu = get_field('backgroun', $itemParent); ?>
						<?php $itemsChild = maserati_filter_menu_items($menuArray, $itemParent->ID); ?>
						<?php $current = ($itemParent->object_id == get_queried_object_id()) ? 'current-item' : ''; ?>

						<?php if (count($itemsChild) >= 0) : ?>
							<nav class="accordion <?php foreach ($itemParent->classes as $itemClass) : ?><?php echo ' ' . $itemClass; ?><?php endforeach; ?>" data-menu="<?php echo sanitize_title($itemParent->title); ?>" style="display:none;<?php echo $background_menu ? 'background-image:url(' . wp_get_attachment_image_url($background_menu, $size) . ');' : 'background-color:#535353;'; ?>">
								<?php $count = 1; ?>
								<ul class="items-navs">
									<?php foreach ($itemsChild as $itemChild) : ?>
										<?php $itemsGrandson = maserati_filter_menu_items($menuArray, $itemChild->ID); ?>
										<li class="nav-subitem item-parent <?php echo get_field('es_un_modelo', $itemChild) == 1  ? 'item-modelo' : ''; ?> <?php echo count($itemsGrandson) >= 1 ? 'accordion-header' : ''; ?>" <?php echo count($itemsGrandson) >= 1 ? 'id="panel-sub' . $i . '-' . $count . '"' : ''; ?>>
											<a <?php echo get_field('dont_link', $itemChild) == 1  ? '' : 'href="' . $itemChild->url . '"'; ?> class="nav-link <?php foreach ($itemChild->classes as $itemClass) : ?><?php echo ' ' . $itemClass; ?><?php endforeach; ?> maserati-color--navi_blue title-large" <?php echo count($itemsGrandson) >= 1 ? 'data-bs-toggle="collapse" data-bs-target="#panelbody-sub' . $i . '-' . $count . '" aria-expanded="false" aria-controls="panelbody-sub' . $i . '-' . $count . '"' : ''; ?>>
												<?php if (get_field('es_un_modelo', $itemChild) == 1) : ?>
													<?php echo get_the_post_thumbnail($itemChild->object_id); ?>
												<?php endif; ?>

												<?php if (have_rows('grupo_identidad', $itemChild->object_id)) : ?>
													<?php while (have_rows('grupo_identidad', $itemChild->object_id)) : the_row(); ?>
														<?php $emblema_modelo = get_sub_field('emblema_modelo'); ?>
														<?php if ($emblema_modelo) : ?>
															<?php echo wp_get_attachment_image($emblema_modelo, $size); ?>
														<?php else : ?>
															<?php echo $itemChild->title; ?>
														<?php endif; ?>
													<?php endwhile; ?>
												<?php else : ?>
													<?php echo $itemChild->title; ?>
												<?php endif; ?>
												<?php echo count($itemsGrandson) >= 1 ? '<i class="fa-solid fa-angle-right"></i>' : ''; ?>
											</a>
											<?php if (count($itemsGrandson) >= 1) : ?>
												<ul class="maserati-menu--submenu menu_grandson accordion-collapse <?php echo count($itemsGrandson) >= 1 ? 'collapse' : ''; ?>" <?php echo count($itemsGrandson) >= 1 ? 'id="panelbody-sub' . $i . '-' . $count . '" aria-labelledby="panelbody-sub' . $i . '-' . $count . '"' : ''; ?>>
													<?php foreach ($itemsGrandson as $itemGrandson) : ?>
														<li class="nav-subitem item-grandson">
															<a <?php echo get_field('dont_link', $itemGrandson) == 1  ? '' : 'href="' . $itemGrandson->url . '"'; ?> class="nav-link <?php foreach ($itemChild->classes as $itemClass) : ?><?php echo ' ' . $itemClass; ?><?php endforeach; ?> maserati-color--navi_blue title-large">
																<?php echo $itemGrandson->title; ?>
															</a>
														</li>
													<?php endforeach; ?>
												</ul>
											<?php endif; ?>
										</li>
										<?php $count++; ?>
									<?php endforeach; ?>
								</ul>
							</nav>

						<?php endif; ?>
						<?php $i++; ?>
					<?php endforeach; ?>

				</div>

			</aside>
		<?php endif; ?>