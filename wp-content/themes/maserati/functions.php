<?php

/**
 * maserati functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package maserati
 */

require get_template_directory() . '/inc/function-admin.php';

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function maserati_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on maserati, use a find and replace
		* to change 'maserati' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('maserati', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'maserati'),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'maserati_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'maserati_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function maserati_content_width()
{
	$GLOBALS['content_width'] = apply_filters('maserati_content_width', 640);
}
add_action('after_setup_theme', 'maserati_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function maserati_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'maserati'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'maserati'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'maserati_widgets_init');


function maserati_enqueue_asset($name, $src, $deps = array(), $var_name = '', $var_values = array())
{
	// Get the theme data.
	static $theme_version;
	static $base_local_path;
	static $base_path;

	if (!isset($theme_version)) {
		$theme_version   = wp_get_theme()->get('Version');
		$base_local_path = get_stylesheet_directory();
		$base_path       = get_stylesheet_directory_uri();
	}

	$file_version = $theme_version . '.' . filemtime($base_local_path . $src);
	if ('.css' === substr($src, -4)) {
		wp_enqueue_style($name, $base_path . $src, $deps, $file_version);
	} else {
		wp_enqueue_script($name, $base_path . $src, $deps, $file_version, true);

		if (!empty($var_name) && !empty($var_values)) {
			wp_localize_script($name, $var_name, $var_values);
		}
	}
}

/**
 * Enqueue scripts and styles.
 */
function maserati_scripts()
{
	wp_enqueue_style('maserati-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('maserati-style', 'rtl', 'replace');

	wp_enqueue_style('swiper', 'https://unpkg.com/swiper@8.0.7/swiper-bundle.min.css', array(), null);
	wp_enqueue_style('icon-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css', array(), null);
	wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css', array(), null);
	wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css', array(), null);
	wp_enqueue_style('aos', 'https://unpkg.com/aos@next/dist/aos.css', array(), null);
	wp_enqueue_style('videoplayer', 'https://vjs.zencdn.net/7.20.1/video-js.css', array(), null); //video base
	wp_enqueue_style('videoplayer-fantasy', 'https://unpkg.com/@videojs/themes@1/dist/fantasy/index.css', array(), null); //video theme fantasy
	maserati_enqueue_asset('maserati-styles', '/assets/css/style.css');
	maserati_enqueue_asset('maserati-fonts', '/assets/css/fonts.css');
	maserati_enqueue_asset('maserati-icons', '/assets/fonts/maserati-v1.0/style.css');


	wp_enqueue_script('swiper', 'https://unpkg.com/swiper@8.0.7/swiper-bundle.min.js', array(), null, true);
	wp_enqueue_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js', array(), null, true);
	wp_enqueue_script('aos', 'https://unpkg.com/aos@next/dist/aos.js', array(), null, true);
	wp_enqueue_script('videoplayer', 'https://vjs.zencdn.net/7.20.1/video.min.js', array(), null, true);
	wp_enqueue_script('gsap', 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/gsap-latest-beta.min.js?r=5426', array(), null, true);
	wp_enqueue_script('gsap-scrolltrigger', 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/ScrollTrigger.min.js?v=3.3.0-3', array(), null, true);
	//wp_enqueue_script('blockui', 'https://malsup.github.io/jquery.blockUI.js', array(), null, true);


	if (is_woocommerce()) {
		maserati_enqueue_asset('maserati-woocommerce', '/assets/js/woocommerce.js', array(), 'maserati_global_vars', array(
			'ajax_url' => admin_url('admin-ajax.php'),
		));
	}

	maserati_enqueue_asset('maserati-script', '/assets/js/main.js', array(), 'maserati_global_vars', array(
		'ajax_url' => admin_url('admin-ajax.php'),
	));

	//if (!is_archive('modelos')) :
	maserati_enqueue_asset('maserati-carousel', '/assets/js/carousel-swp.js', array('jquery'), null, true);
	//endif;

	maserati_enqueue_asset('maserati-maps', '/assets/js/map.js');

	if (is_front_page() || is_home()) :
		wp_enqueue_script('api-map', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyB2Zy128WTFXERoKCR5PB7lz2ZD8s2ayUY&callback=initMap', array(), null, true); // API GOOGLE MAP
	endif;

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

	if (is_singular('modelo') || is_page('garantia')) {
		maserati_enqueue_asset('circularaudiowave', '/assets/js/circular-audio-wave.js', array(), null, true);
		wp_enqueue_script('echarts', 'https://cdnjs.cloudflare.com/ajax/libs/echarts/4.8.0/echarts.min.js', array(), null, true);
		maserati_enqueue_asset('visualizer-js', '/assets/js/visualizer.js', array(), null, false);
	}

	if (is_singular('modelo')) {
		//wp_enqueue_script('', 'https://www.cssscript.com/demo/circular-audio-visualizer/circular-audio-wave.min.js', array(), null, true);
		maserati_enqueue_asset('maserati-single-script', '/assets/js/single-modelo.js', array(), null, true);
	}

	if (is_singular('product')) {
		maserati_enqueue_asset('maserati-single-preowned', '/assets/js/preowned.js', array(), null, true);
	}

	if (is_page(array('merchandesign', 'personalizacion'))) {
		maserati_enqueue_asset('circularaudiowave', '/assets/js/merchandesign.js', array(), null, true);
	}
}
add_action('wp_enqueue_scripts', 'maserati_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if (class_exists('WooCommerce')) {
	require get_template_directory() . '/inc/woocommerce.php';
	require get_template_directory() . '/inc/class-sf-widget-range-filter.php';
	//require get_template_directory() . '/inc/sidebar-shop.php';
}

// Eliminar editor Gutenberg.
add_filter('use_block_editor_for_post', '__return_false', 10);

// Eliminar editor Gutenberg zona widget.
add_filter('gutenberg_use_widgets_block_editor', '__return_false');
add_filter('use_widgets_block_editor', '__return_false');

//Filtro menu maserati
function maserati_filter_menu_items($menuArray, $parentID)
{
	return array_filter($menuArray, function ($item) use ($parentID) {
		return $item->menu_item_parent == $parentID;
	});
}

// ACF Opciones
if (function_exists('acf_add_options_page')) {

	acf_add_options_page(array(
		'page_title' 		=> 'Opciones generales',
		'menu_title' 		=> 'Opciones',
		'menu_slug' 		=> 'theme-general-settings',
		'capability'		=> 'edit_posts',
		'redirect'			=> false,
		'position' 			=> 4,
		'icon_url' 			=> 'dashicons-id-alt',
		'update_button'		=> 'Actualizar',
		'updated_message'	=> 'Opciones actualizadas',
	));

	acf_add_options_page(array(
		'page_title' 		=> 'Mundon Maserati',
		'menu_title' 		=> 'Mundo Maserati',
		'menu_slug' 		=> 'mundo-maserati',
		'capability'		=> 'edit_posts',
		'redirect'			=> false,
		'position' 			=> 5,
		'icon_url' 			=> 'dashicons-admin-site-alt2',
		'update_button'		=> 'Actualizar',
		'updated_message'	=> 'Actualizado',
	));
}


//Variable modelos
add_action('wp_loaded', 'maserati_modelos_global_vars', 1);
function maserati_modelos_global_vars()
{
	global $maserati_models;

	$args = array(
		'post_type' => 'modelo',
		'posts_per_page' => -1,
		'public'   => true,
		'hide_empty' => false,
		'orderby' => 'ID',
		'order' => 'ASC'
	);
	$maserati_models = get_posts($args);
}

/*
* Función bradcrumbs
* do_action breadcrumbs_maserati
*/

add_action('breadcrumbs_maserati', 'maserati_breadcrumbs', 5);
function maserati_breadcrumbs()
{
	get_template_part('inc/content', 'breadcrumbs');
}


//Orden por defecto archives
add_filter('posts_orderby', 'maserati_order_default_archive_models');
function maserati_order_default_archive_models($orderby)
{
	global $wpdb;

	if (is_archive() && get_query_var("post_type") == "modelo") {
		return "$wpdb->posts.post_title ASC";
	}

	return $orderby;
}

//Cambiar el nombre del menu de WC
add_action('admin_menu', 'maserati_change_label_wc_menu', 99, 0);
function maserati_change_label_wc_menu()
{
	global $menu, $submenu;
	//echo '<pre>' . print_r($menu) . '</pre>';
	$menu['55.5'][0] = 'Config. Usados';
}

//Cambiar el labels del post type productos WC
add_filter('woocommerce_register_post_type_product', 'maserati_change_post_type_label_wc');

function maserati_change_post_type_label_wc($args)
{
	$labels = array(
		//'name'               => __('Usados', 'maserati'),
		'singular_name'      => __('Usado', 'maserati'),
		'menu_name'          => _x('Usados', 'Admin menu name', 'maserati'),
		'add_new'            => __('Agregar Usado', 'maserati'),
		'add_new_item'       => __('Agregar Usado', 'maserati'),
		'edit'               => __('Editar Usado', 'maserati'),
		'edit_item'          => __('Edit Element', 'maserati'),
		'new_item'           => __('Nuevo Usado', 'maserati'),
		'view'               => __('Ver Usado', 'maserati'),
		'view_item'          => __('Ver Usado', 'maserati'),
		'search_items'       => __('Buscar Usados', 'maserati'),
		'not_found'          => __('Usados no encontrados', 'maserati'),
		'not_found_in_trash' => __('Usados no encontrados en papelera', 'maserati'),
		'parent'             => __('Usado padre', 'maserati'),

	);

	$icon = 'dashicons-car';


	$args['labels'] = $labels;
	$args['menu_icon'] = $icon;
	return $args;
}



//Eliminar () en el filtro de los productos o eliminar count
add_filter('woocommerce_layered_nav_count', 'maserati_woocommerce_layered_nav_count', 10, 3);
function maserati_woocommerce_layered_nav_count($text, $count, $term)
{
	//return '<span class="count">' . absint($count) . '</span>';

	return '';
}

//Cambiar etiqueta h2 por defecto del widget title
add_filter('dynamic_sidebar_params', 'maserati_change_tag_html');
function maserati_change_tag_html($params)
{
	if (wp_is_mobile()) {
		$params[0]['before_title'] = '<h5 class="widget-title hide-filter">';
		$params[0]['after_title']  = '<i class="icon-arrow-down"></i></h5>';
	} else {
		$params[0]['before_title'] = '<h5 class="widget-title">';
		$params[0]['after_title']  = '</h5>';
	}

	return $params;
}



add_filter('woocommerce_product_tabs', 'maserati_wc_product_tabs');
function maserati_wc_product_tabs($tabs)
{

	//Removemos Tabs no necesarios
	unset($tabs['description']);
	unset($tabs['reviews']);
	unset($tabs['additional_information']);


	//Nuevos Tabs
	if (have_rows('especificaciones_group')) :
		$tabs['especificaciones_tab'] = array(
			'title'     => __('Especificaciones', 'woocommerce'),
			'priority'  => 100,
			'callback'  => 'especificaciones_tab_content'
		);
	endif;

	$tabs['equipamiento_tab'] = array(
		'title'     => __('Equipamiento', 'maserati'),
		'priority'  => 110,
		'callback'  => 'equipamiento_tab_content'
	);

	return $tabs;
}

// Contenido de los nuevos Tabs
function especificaciones_tab_content()
{
	global $product;

	if (have_rows('especificaciones_group')) : ?>
		<table class="table-especificaciones">
			<tbody>
				<?php if (get_post_meta($product->id, 'year', true)) : ?>
					<tr>
						<td><?php echo __('Año', 'maserati'); ?></td>
						<td><?php echo get_post_meta($product->id, 'year', true); ?></td>
					</tr>
				<?php endif; ?>
				<?php while (have_rows('especificaciones_group')) : the_row(); ?>
					<?php if (get_sub_field('transimision_especificaciones')) : ?>
						<tr>
							<td><?php echo __('Transimisión', 'maserati'); ?></td>
							<td><?php the_sub_field('transmision_especificaciones'); ?></td>
						</tr>
					<?php endif; ?>
					<?php
					if (get_sub_field('cilindrada_especificaciones')) : ?>
						<tr>
							<td><?php echo __('Cilindrada', 'maserati'); ?></td>
							<td><?php number_format_i18n(the_sub_field('cilindrada_especificaciones'), 0); ?> cc</td>
						</tr>
					<?php endif; ?>
					<?php if (get_sub_field('color_especificaciones')) : ?>
						<tr>
							<td><?php echo __('Color', 'maserati'); ?></td>
							<td><?php the_sub_field('color_especificaciones'); ?></td>
						</tr>
					<?php endif; ?>
					<?php if (get_sub_field('combustible_especificaciones')) : ?>
						<tr>
							<td><?php echo __('Combustible', 'maserati'); ?></td>
							<td><?php the_sub_field('combustible_especificaciones'); ?></td>
						</tr>
					<?php endif; ?>
					<?php if (get_sub_field('kilometraje_especificaciones')) : ?>
						<tr>
							<td><?php echo __('Kilometraje', 'maserati'); ?></td>
							<td><?php the_sub_field('kilometraje_especificaciones'); ?></td>
						</tr>
					<?php endif; ?>
					<?php if (get_sub_field('traccion_especificaciones')) : ?>
						<tr>
							<td><?php echo __('Tracción', 'maserati'); ?></td>
							<td><?php the_sub_field('traccion_especificaciones'); ?></td>
						</tr>
					<?php endif; ?>
				<?php endwhile; ?>

				<?php if (have_rows('especificaciones_group_custom')) : ?>
					<?php while (have_rows('especificaciones_group_custom')) : the_row(); ?>
						<?php if (get_sub_field('titulo_custom') && get_sub_field('valor_custom')) : ?>
							<tr>
								<td><?php the_sub_field('titulo_custom'); ?></td>
								<td><?php the_sub_field('valor_custom'); ?></td>
							</tr>
						<?php endif; ?>
					<?php endwhile; ?>

				<?php endif; ?>
			</tbody>
		</table>
	<?php endif;
}


function equipamiento_tab_content()
{
	the_field('equipamiento'); 
	/*
	if (have_rows('equipamiento_repeater')) : ?>
		<table class="table-equipamiento">
			<tbody>
				<?php while (have_rows('equipamiento_repeater')) : the_row(); ?>
					<?php if (get_sub_field('titulo_custom') && get_sub_field('valor_custom')) : ?>
						<tr>
							<td><?php the_sub_field('titulo_custom'); ?></td>
							<td><?php the_sub_field('valor_custom'); ?></td>
						</tr>
					<?php endif; ?>
				<?php endwhile; ?>
			</tbody>
		</table>
	<?php endif;*/
}


remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);

remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
remove_action('woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20);

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);

remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
add_action('woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 5);


if (!wp_is_mobile()) {
	add_action('woocommerce_before_single_product_summary', 'woocommerce_template_single_title', 5);
	add_action('woocommerce_before_single_product_summary', 'woocommerce_template_single_price', 15);
} else {
	add_action('woocommerce_before_single_product_summary', 'woocommerce_template_single_title', 21);
	add_action('woocommerce_before_single_product_summary', 'woocommerce_template_single_price', 30);
}



//Carrusel de imagenes Pre-Owned
add_action('woocommerce_before_single_product_summary', 'woocommerce_template_single_swiper', 20);
function woocommerce_template_single_swiper()
{
	global $product, $post;

	$attachment_gallery_ids = $product->get_gallery_image_ids();
	$image_current_product  = $product->get_image_id();
	$full = 'full';
	$tipo_modelo = $post->post_type;
	?>
	<div class="carousel-gallery">
		<?php echo wp_is_mobile() ? '<a class="return text-decoration-none" href="' . get_post_type_archive_link($tipo_modelo) . '"><i class="fa-solid fa-arrow-left"></i> ' . __('Maserati Pre-Owned', 'maserati') . '</a>' : ''; ?>

		<div class="swiper pre-owned-gallery">
			<div class="swiper-wrapper">
				<div class="swiper-slide"><?php echo wp_get_attachment_image($image_current_product, $full); ?></div>
				<?php foreach ($attachment_gallery_ids as $attachment_gallery_id) : ?>
					<div class="swiper-slide"><?php echo wp_get_attachment_image($attachment_gallery_id, $full); ?></div>
				<?php endforeach; ?>
			</div>

		</div>
		<?php echo wp_is_mobile() ? '<div class="swiper-pagination swiper-pagination-gallery "></div>' : ''; ?>
		<div class="swiper-button-prev swiper-button-prev-gallery"></div>
		<div class="swiper-button-next swiper-button-next-gallery"></div>
	</div>

	<div class="swiper pre-owned-gallery_thumbs">
		<div class="swiper-wrapper">
			<div class="swiper-slide"><?php echo wp_get_attachment_image($image_current_product, $full); ?></div>
			<?php foreach ($attachment_gallery_ids as $attachment_gallery_id) : ?>
				<div class="swiper-slide"><?php echo wp_get_attachment_image($attachment_gallery_id, $full); ?></div>
			<?php endforeach; ?>
		</div>
	</div>
<?php
}


//add_action('woocommerce_single_product_summary', 'maserati_ficha_pre_owned_tecnica', 10);
function maserati_ficha_pre_owned_tecnica()
{
?>
	<?php $ficha_pre_owned = get_field('ficha_pre_owned'); ?>
	<?php if ($ficha_pre_owned) : ?>
		<a class="maserati-button maserati-button_large maserati-color--navi_blue cursor marginX-auto" href="<?php echo esc_url($ficha_pre_owned['url']); ?>" target="_blank">
			<i class="fas fa-arrow-down"></i> <?php echo __('Ficha Técnica', 'maserati'); ?>
		</a>
	<?php endif; ?>
<?php
}


add_action('woocommerce_single_product_summary', 'maserati_pre_owned_cotizar', 15);
function maserati_pre_owned_cotizar()
{
?>
	<a id="quote-preowned" class="maserati-button maserati-button_large maserati-back--navi_blue marginX-auto cursor" target="_blank">
		<?php echo __('Cotizar', 'maserati'); ?>
	</a>
<?php
}


/*if (!wp_is_mobile()) {
	add_action('woocommerce_before_single_product_summary', 'maserati_pre_owned_subtitle', 10);
} else {
	add_action('woocommerce_before_single_product_summary', 'maserati_pre_owned_subtitle', 25);
}*/

//add_action('woocommerce_shop_loop_item_title', 'maserati_pre_owned_subtitle', 15);
function maserati_pre_owned_subtitle()
{
	if (get_field('subtitulo_pre_owned')) :
		echo '<h5 class="product_subtitle text-center maserati-color--navi_blue">' . get_field('subtitulo_pre_owned') . '</h4>';
	endif;
}


remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);

remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);


add_action('woocommerce_before_shop_loop_item', 'maserati_template_loop_product_link_open', 10);
function maserati_template_loop_product_link_open()
{
	global $product;

	$link = apply_filters('woocommerce_loop_product_link', get_the_permalink(), $product);

	echo '<div class="woocommerce-LoopProduct-link woocommerce-loop-product__link">';
}

add_action('woocommerce_after_shop_loop_item', 'maserati_template_loop_product_link_close', 5);
function maserati_template_loop_product_link_close()
{
	echo '</div>';
}


add_action('woocommerce_shop_loop_item_title', 'maserati_template_loop_product_title', 10);
function maserati_template_loop_product_title()
{
	echo '<h5 class="text-center maserati-color--navi_blue ' . esc_attr(apply_filters('woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title')) . '">' . get_the_title() . '</h5>';
}


add_action('woocommerce_after_shop_loop_item_title', 'maserati_info_card_product', 15);
function maserati_info_card_product()
{
	global $product;

?>
	<div class="info-pre-owned">
		<?php if (get_post_meta($product->id, 'year', true)) : ?>
			<p><?php echo __('Año', 'maserati'); ?><span><?php echo get_post_meta($product->id, 'year', true); ?></span></p>
		<?php endif; ?>


		<?php if (have_rows('datos_relevante_group')) : ?>
			<?php while (have_rows('datos_relevante_group')) : the_row(); ?>
				<?php if (get_sub_field('valor_relevante')) : ?>
					<p><?php the_sub_field('titulo_relevante'); ?><span><?php the_sub_field('valor_relevante'); ?></span></p>
				<?php endif; ?>
			<?php endwhile; ?>
		<?php endif; ?>

		<?php
		$kilometraje = get_field('kilometraje_pre_owned');
		if ($kilometraje) : ?>
			<p><?php echo __('Kilometraje', 'maserati'); ?><span><?php echo number_format_i18n($kilometraje, 0); ?> kms</span></p>
		<?php endif; ?>
	</div>
<?php

}



add_action('woocommerce_after_shop_loop_item_title', 'maserati_button_card_product', 20);
function maserati_button_card_product()
{
?>
	<div class="button_explorer">
		<a class="maserati-button maserati-button_large maserati-back--navi_blue marginX-auto" href="<?php the_permalink(); ?>">
			<?php echo __('Explorar', 'maserati'); ?>
		</a>
	</div>
	<?php
}



add_image_size('thubnail-maserati', 260, 190, array('center', 'center'));


add_filter('single_product_archive_thumbnail_size	', function ($size) {
	return array(
		'width' => 260,
		'height' => 190,
		'crop' => 0,
	);
});

add_filter('single_product_archive_thumbnail_size', function ($size) {
	return 'thubnail-maserati';
});

remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);



// Add our Custom Fields to simple products
if (!function_exists('maserati_product_options_general_product_data')) {
	function maserati_product_options_general_product_data()
	{
		echo '<div class="options_group">';

		woocommerce_wp_text_input(
			array(
				'id'                => 'year',
				'name'              => 'year',
				'label'             => __('Año', 'maserati'),
				'type'              => 'number',
				'custom_attributes' => array(
					'min'     => '2012',
					'step'    => '1'
				),
				'data_type'         => 'stock',
				'desc_tip'          => true,
				'description'       => __('Sólo para Pre-Owned (Autos usados)', 'maserati')
			)
		);

		echo '</div>';
	}
}
add_action('woocommerce_product_options_general_product_data', 'maserati_product_options_general_product_data');

// Save our simple product fields (con prioridad lejana para asegurar que los datos basicos ya fueron guardados)
if (!function_exists('maserati_process_product_meta')) {
	function maserati_process_product_meta($post_id)
	{
		if (isset($_POST['year'])) {
			$value = wc_clean(wp_unslash($_POST['year']));
			update_post_meta($post_id, 'year', is_numeric($value) ? absint($value) : 0);
		}
	}
}
add_action('woocommerce_process_product_meta', 'maserati_process_product_meta', 90, 1);


//Agregamos clase especial a solo paginas, para distingir algunos modals
add_filter('body_class', 'name_page_body_class');
function name_page_body_class($classes)
{
	if (is_page()) {
		$classes[] = 'maserati-page-' . sanitize_title(get_the_title());
	} elseif (is_single() || is_category()) {
		global $post;
		foreach ((get_the_category($post->ID)) as $category) {
			$classes[] = 'maserati-cat-' . $category->category_nicename;
		}
	}
	return $classes;
}



add_filter('wpcf7_form_tag', 'maserati_select_dinamic_modelos', 10, 2);
function maserati_select_dinamic_modelos($tag, $unused)
{
	if ($tag['name'] != 'modelos')
		return $tag;

	$args = array(
		'numberposts'   => -1,
		'post_type'     => 'modelo',
		'orderby'       => 'date',
		'order'         => 'ASC',
	);

	$modelos = get_posts($args);

	/* <pre><?php print_r($modelos); ?></pre> */

	if (!$modelos)
		return $tag;


	foreach ($modelos as $modelo) {
		if (have_rows('repeat_verisones', $modelo->ID)) :
			while (have_rows('repeat_verisones', $modelo->ID)) : the_row();
				$name_version = get_sub_field('nombre_version');
				$image_version = get_sub_field('imagen_version');
				//echo $name_version;
				$tag['raw_values'][] = $name_version;
				$tag['values'][] = sanitize_title($name_version); //value de la opcion generada
				$tag['labels'][] = $name_version; //$modelo->post_title; 
				$tag['attr'] = 'data-image="' . wp_get_attachment_url($image_version, 'full') . '"';
			/*?>
				<pre><?php print_r($tag); ?></pre>
<?php*/
			endwhile;
		endif;
	}

	return $tag;
}



add_filter('wpcf7_form_tag', 'maserati_select_dinamic_preowned', 10, 2);
function maserati_select_dinamic_preowned($tag, $unused)
{
	if ($tag['name'] != 'preowned')
		return $tag;

	$args = array(
		'numberposts'   => -1,
		'post_type'     => 'product',
		'orderby'       => 'date',
		'order'         => 'ASC',
	);

	$modelosPO = get_posts($args);

	if (!$modelosPO)
		return $tag;


	foreach ($modelosPO as $modeloPO) {
		//print_r($modeloPO->post_title);
		$name_version = $modeloPO->post_title;

		$tag['raw_values'][] = $name_version;
		$tag['values'][] = sanitize_title($name_version); //value de la opcion generada
		$tag['labels'][] = $name_version; //$modelo->post_title; 


	}

	return $tag;
}


function maserati_elementos_form($html)
{
	function maserati_remplazar_blank($name, $text, &$html)
	{
		$matches = false;
		preg_match('/<select name="' . $name . '"[^>]*>(.*)<\/select>/iU', $html, $matches);
		if ($matches) {
			$select = str_replace('<option value="">---</option>', '<option value="">' . $text . '</option>', $matches[0]);
			$html = preg_replace('/<select name="' . $name . '"[^>]*>(.*)<\/select>/iU', $select, $html);
		}
	}
	maserati_remplazar_blank('modelos', 'Selecciona el modelo', $html);
	maserati_remplazar_blank('preowned', 'Selecciona el modelo', $html);
	return $html;
}
add_filter('wpcf7_form_elements', 'maserati_elementos_form');



add_filter('wpcf7_form_elements', 'maserati_cf7_data_attributes');
function maserati_cf7_data_attributes($content)
{
	$contact_form = WPCF7_ContactForm::get_current();
	$tags         = $contact_form->scan_form_tags();
	$data_tags    = array();

	// loop through tags and save any data attributes we find along with the corresponding tag name
	foreach ($tags as $tag) {
		foreach ($tag->options as $attr) {
			if (strpos($attr, 'data-') === 0) {
				$data_attr = explode(':', $attr);
				$data_tag = [
					'name'      => $tag->name,
					'data_attr' => $data_attr[0] . '="' . esc_attr($data_attr[1]) . '"'
				];
				$data_tags[] = $data_tag;
			}
		}
	}

	// if we have any data attribute tags from above, search and replace them in the form
	if (!empty($data_tags)) {
		foreach ($data_tags as $tag) {
			$search  = 'name="' . $tag['name'] . '" ';
			$replace = $search . $tag['data_attr'] . ' ';
			$content = str_replace($search, $replace, $content);
		}
	}

	return $content;
}

add_filter('wpcf7_form_hidden_fields', 'maserati_cf7_hidden_fields');
function maserati_cf7_hidden_fields($extra_hidden_fields)
{
	$contact_form = WPCF7_ContactForm::get_current();

	if ($contact_form->id() === 1000) {

		$args = array(
			'numberposts'   => -1,
			'post_type'     => 'modelo',
			'orderby'       => 'date',
			'order'         => 'ASC',
		);

		$modelos = get_posts($args);


		foreach ($modelos as $modelo) {
			if (have_rows('repeat_verisones', $modelo->ID)) :
				while (have_rows('repeat_verisones', $modelo->ID)) : the_row();
					$name_version = get_sub_field('nombre_version');
					$image_version = get_sub_field('imagen_version');
					$extra_hidden_fields[sanitize_title($name_version)] = wp_get_attachment_url($image_version, 'full');
				endwhile;
			endif;
		}
	}

	if ($contact_form->id() === 1008) {

		$args = array(
			'numberposts'   => -1,
			'post_type'     => 'product',
			'orderby'       => 'date',
			'order'         => 'ASC',
		);

		$modelos = get_posts($args);



		foreach ($modelos as $modelo) {

			$name_version = $modelo->post_title;
			$id_version = $modelo->ID;

			if (have_rows('datos_relevante_group', $id_version)) :
				while (have_rows('datos_relevante_group', $id_version)) : the_row();
					$dato_relevante = get_sub_field('valor_relevante');
				endwhile;
			endif;

			$image_version = get_the_post_thumbnail_url($id_version);
			$subtitulo_version = get_field('subtitulo_pre_owned', $id_version);
			$dato_version = $dato_relevante;
			$year_version = get_post_meta($id_version, 'year', true);
			$kilometraje_version = get_field('kilometraje_pre_owned', $id_version);


			$valores = array(
				'image' 		=> $image_version,
				'subtitulo' 	=> $subtitulo_version,
				'dato' 			=> $dato_version,
				'year' 			=> $year_version,
				'kilometraje' 	=> number_format_i18n($kilometraje_version, 0),
			);

			$extra_hidden_fields[sanitize_title($name_version)] = wp_json_encode($valores);
		}
	}

	return $extra_hidden_fields;
}


function farizon_jquery_add_inline()
{
	wp_add_inline_script('jquery-core', 'window.$ = window.jQuery;');
}
add_action('wp_enqueue_scripts', 'farizon_jquery_add_inline');



add_action('wp_footer', 'maserati_contact_form_sent');

function maserati_contact_form_sent()
{
	if (is_page(array('cotizador-pre-owned', 'cotizador-modelos', 'contacto-fuoriserie', 'contacto'))) :
		$contact_form = WPCF7_ContactForm::get_current();
	?>
		<script>
			var wpcf7Elm = document.querySelector('.wpcf7');
			wpcf7Elm.addEventListener('wpcf7mailsent', function(event) {
				jQuery("#formSuccess").modal('show');
			}, false);
		</script>

		<div class="modal fade" id="formSuccess" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="formSuccessLabel" aria-hidden="true">
			<div class="modal-dialog  modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-body">
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						<img src="/wp-content/uploads/2022/10/CheckCircle.svg" alt="check circle success">
						<h3>Tu mensaje ha sido enviado</h3>
						<?php if ($contact_form->id() === 1000 || $contact_form->id() === 1008) : ?>
							<p>Muy pronto uno de nuestros ejecutivos se contactará contigo para continuar la cotización.</p>
						<?php else : ?>
							<p>Muy pronto uno de nuestros ejecutivos se contactará contigo.</p>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	<?php endif;
}


add_action('wp_footer', 'maserati_fix_button');
function maserati_fix_button()
{
	if (have_rows('repeater_tools', 'option')) :
	?>
		<div class="buttons-fix <?php echo wp_is_mobile() ? 'dropup' : ''; ?> ">
			<?php if (wp_is_mobile()) : ?>
				<button class="btn btn-secondary btn-lg dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
					<?php echo __('Shopping Tools', 'maserati'); ?>
				</button>
			<?php endif; ?>
			<ul <?php echo wp_is_mobile() ? 'class="dropdown-menu"' : ''; ?>>
				<?php while (have_rows('repeater_tools', 'option')) : the_row(); ?>

					<?php $icono_tool = get_sub_field('icono_tool'); ?>
					<?php $titulo_y_enlace_tool = get_sub_field('titulo_y_enlace_tool'); ?>
					<?php if ($titulo_y_enlace_tool) : ?>

						<?php $whatsapp_api = 'https://api.whatsapp.com/send?phone=' . get_sub_field('telefono_tool') . '&text=' . get_sub_field('mensaje_tool'); ?>
						<li>
							<a class="tools-item <?php echo wp_is_mobile() ? 'dropdown-item' : ''; ?>" href="<?php echo get_sub_field('whatsapp_tool') == 1 ? $whatsapp_api : esc_url($titulo_y_enlace_tool['url']) ?>" target="<?php echo get_sub_field('whatsapp_tool') == 1 ? '_blank' : esc_attr($titulo_y_enlace_tool['target']); ?>">
								<?php echo wp_is_mobile() ? '<div class="group-item">' : ''; ?>
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
								<?php echo wp_is_mobile() ? '</div>' : ''; ?>
								<?php echo wp_is_mobile() ? '<i class="icon-arrow-right"></i>' : ''; ?>

							</a>
						</li>

					<?php endif; ?>
				<?php endwhile; ?>
			</ul>
		</div>
	<?php endif;
}



add_action('wp_footer', 'maserati_preload');
function maserati_preload()
{ ?>
	<div class="preload-maserati">
		<div class="preload-content">
			<img src="/wp-content/uploads/2022/10/loader.gif" alt="Preloaded Maserati">
		</div>
	</div>
<?php }


function orden_post_categorias($query)
{
	$current_value = $_GET['order'] ?? '';

	if (is_category()) {
		//$query->set('posts_per_page', '1');

		if ($current_value == 'nuevos') {
			set_query_var('order', 'DESC');
			set_query_var('orderby', 'date');
		}
		if ($current_value == 'antiguos') {
			set_query_var('order', 'ASC');
			set_query_var('orderby', 'date');
		}
		if ($current_value == 'az') {
			set_query_var('order', 'ASC');
			set_query_var('orderby', 'title');
		}
		if ($current_value == 'za') {
			set_query_var('order', 'DESC');
			set_query_var('orderby', 'title');
		}
	}
}
add_action('pre_get_posts', 'orden_post_categorias');



//Contar imagenes de la galeria y agregar clase segun cantidad
add_action('wp_footer', 'addclass_galerias');
function addclass_galerias()
{ ?>

	<script>
		jQuery(".gallery-content").each(function(index) {
			const gallery = jQuery(this);
			const itemsGallery = gallery.find(".item-galery");
			var countItems = itemsGallery.length;

			if (countItems == 1) {
				gallery.addClass("img-individual");
			}
			if (countItems == 2) {
				gallery.addClass("img-duo");
			}
			if (countItems == 3) {
				gallery.addClass("img-trio");
			}
		});
	</script>
<?php
}

/**
 * Intercept data from contact form 7 forms and send to QuickBase API
 */
function my_action_wpcf7_before_send_mail($contact_form, $abort)
{
	// to get form id
	$form_id = $contact_form->id();

	// to get form title
	$form_title = $contact_form->title();

	// to get submission data $posted_data is asociative array
	$submission = WPCF7_Submission::get_instance();
	$posted_data = $submission->get_posted_data();

	if (in_array($form_title, ['Contacto Page', 'Cotizar Modelo', 'Contacto fuoriserie', 'Contacto merchandesign', 'Cotizar PreOwned'/* , 'Newsletter' */])) {
		$response = quickbase_records($posted_data, $form_title);
		if ($response['status'] != 200) {
			// It will abort mail function if we assing $abort = true;
			$abort = true;
		}
	}
}
add_action('wpcf7_before_send_mail', 'my_action_wpcf7_before_send_mail', 10, 2);

/**
 * Create a record in quickbase
 */
function quickbase_records($posted_data = [], $form_title = 'Contacto Page')
{
	//configure quickbase api access data
	$access_t = "b7rivj_bbfm_0_ccnpck9szgshftbmqe8cq8e2kw";
	$quickbase_domain = 'veinsacr.quickbase.com';
	$table_id = 'bsurzxvu4';
	$url = "https://api.quickbase.com/v1/records";
	$useragent = 'User-Agent';

	$fields_quickbase_cf7 = [];
	if ($form_title == 'Contacto Page') {
		$fields_quickbase_cf7 = [
			'6' => 'origen',
			'8'  => 'nombre',
			'9'   => 'apellido',
			'11'   => 'email',
			'12'   => 'telefono',
			'13'   => 'checkbox_info',
			'18'   => 'consulta',
			'14'   => 'checkbox_terms',
			'15'   => 'checkbox_promociones',
		];
	} else if ($form_title == 'Cotizar Modelo') {
		$fields_quickbase_cf7 = [
			'6' => 'origen',
			'7' => 'modelos',
			'8'  => 'nombre',
			'9'   => 'apellido',
			'11'   => 'email',
			'12'   => 'telefono',
			'13'   => 'checkbox_info',
			'18'   => 'consulta',
			'14'   => 'checkbox_terms',
			'15'   => 'checkbox_promociones',
		];
	} else if ($form_title == 'Contacto fuoriserie') {
		$fields_quickbase_cf7 = [
			'6' => 'origen',
			'8'  => 'nombre',
			'9'   => 'apellido',
			'11'   => 'email',
			'12'   => 'telefono',
			'13'   => 'checkbox_info',
			'18'   => 'consulta',
			'14'   => 'checkbox_terms',
			'15'   => 'checkbox_promociones',
		];
	} else if ($form_title == 'Contacto merchandesign') {
		$fields_quickbase_cf7 = [
			'6' => 'origen',
			'8'  => 'nombre',
			'9'   => 'apellido',
			'11'   => 'email',
			'12'   => 'telefono',
			'13'   => 'checkbox_info',
			'18'   => 'consulta',
			'14'   => 'checkbox_terms',
			'15'   => 'checkbox_promociones',
		];
	} else if ($form_title == 'Cotizar PreOwned') {
		$fields_quickbase_cf7 = [
			'6' => 'origen',
			'7' => 'nombremodelo',
			'8'  => 'nombre',
			'9'   => 'apellido',
			'11'   => 'email',
			'12'   => 'telefono',
			'13'   => 'checkbox_info',
			'18'   => 'consulta',
			'14'   => 'checkbox_terms',
			'15'   => 'checkbox_promociones',
		];
	} else if ($form_title == 'Newsletter') {
		$fields_quickbase_cf7 = [
			'6' => 'origen',
			'11'   => 'email',
		];
	}

	if (empty($fields_quickbase_cf7)) {
		return ['status' => 401];
	}

	$fields = [];
	foreach ($fields_quickbase_cf7 as $key => $value) {
		$valueField = $posted_data[$value];
		if (is_array($valueField)) {
			$valueField = implode(", ", $posted_data[$value]);
		}
		if ($value == 'checkbox_terms') {
			$valueField = 0;
			if ($posted_data[$value][0]) {
				$valueField = 1;
			}
		}
		if ($value == 'checkbox_promociones') {
			$valueField = 0;
			if ($posted_data[$value][0]) {
				$valueField = 1;
			}
		}
		$valueField = remove_accents($valueField);
		$fields[$key] = ['value' => $valueField];
	}
	$fields = json_encode($fields);
	$data = '
	{
		"to": "' . $table_id . '", 
		"data": [
			' . $fields . '
		]
	}
	';

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array(
		"QB-Realm-Hostname: $quickbase_domain",
		"User-Agent: $useragent",
		"Authorization: QB-USER-TOKEN $access_t",
		'Content-Type:application/json'
	));
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($curl);
	$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	curl_close($curl);

	insertar_tabla_quickbase_records(null, $form_title, $url, $data, $response);

	$response = json_decode($response, true);
	$response['status'] = $status;

	return $response;
}

/**
 * insertar registro en la tabla de bitacora de quickbase
 */
function insertar_tabla_quickbase_records($fecha = null, $origen = null, $destino = null, $request = null, $response = null)
{
	crear_tabla_quickbase_records();

	if (!$fecha) {
		$fecha = date('Y-m-d H:i:s');
	}

	global $wpdb;
	$mi_tabla = 'quickbase_bitacora';
	$prefix = $wpdb->prefix;
	$nombre_tabla = $prefix.$mi_tabla;
	$fila=array(
		'fecha_creacion'  => $fecha,
		'origen'          => $origen,
		'destino'         => $destino,
		'request'         => $request,
		'response'        => $response,
	);
	$resultado=$wpdb->insert($nombre_tabla,$fila); 
}

/**
 * crear tabla de bitacora de quickbase
 */
function crear_tabla_quickbase_records()
{
	global $wpdb;
	$mi_tabla = 'quickbase_bitacora';
	$prefix = $wpdb->prefix;
	$collate = $wpdb->collate;
	$nombre_tabla = $prefix.$mi_tabla;
	$sql = "CREATE TABLE IF NOT EXISTS {$nombre_tabla} (
		id bigint(20) NOT NULL AUTO_INCREMENT,
		fecha_creacion datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
		origen varchar(255),
		destino varchar(255),		
		request TEXT,
		response TEXT,
		PRIMARY KEY  (id),
		KEY fecha_creacion (fecha_creacion)
	  ) 
	  COLLATE {$collate}";
	require_once(ABSPATH.'wp-admin/includes/upgrade.php');
	dbDelta($sql);
}