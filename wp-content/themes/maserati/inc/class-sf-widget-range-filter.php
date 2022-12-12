<?php

defined('ABSPATH') || exit;

class SF_Widget_Range_Filter extends WC_Widget
{

	public function __construct()
	{
		$this->widget_cssclass    = 'woocommerce widget_price_filter';
		$this->widget_description = __('Muestre un control deslizante para filtrar productos en su tienda por un rango.', 'somosforma');
		$this->widget_id          = 'somosforma_range_filter';
		$this->widget_name        = __('Filtrar productos por metadato (rango numérico)', 'somosforma');
		parent::__construct();
	}

	public function update($new_instance, $old_instance)
	{
		$this->init_settings();
		return parent::update($new_instance, $old_instance);
	}

	public function form($instance)
	{
		$this->init_settings();
		parent::form($instance);
	}

	public function init_settings()
	{
		$this->settings = array(
			'title'    => array(
				'type'  => 'text',
				'std'   => __('Filtrar por', 'somosforma'),
				'label' => __('Título', 'somosforma'),
			),
			'meta_key' => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __('Metadato (debe ser un slug válido)', 'somosforma'),
			),
			'step' => array(
				'type'  => 'number',
				'std'   => 10,
				'label' => __('Intervalo entre números permitidos', 'somosforma'),
				'step'  => 1,
				'min'   => 1,
				'max'   => '',
			),
			'prefix' => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __('Prefijo', 'somosforma'),
			),
			'suffix' => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __('Sufijo', 'somosforma'),
			),
			'format' => array(
				'type'  => 'checkbox',
				'std'   => 1,
				'label' => __('Dar formato a número', 'somosforma'),
			),
		);
	}

	/**
	 * Output widget.
	 *
	 * @see WP_Widget
	 *
	 * @param array $args     Arguments.
	 * @param array $instance Widget instance.
	 */
	public function widget($args, $instance)
	{
		global $wp;

		if (!is_shop() && !is_product_taxonomy()) {
			return;
		}

		$meta_key = trim($instance['meta_key']);
		if (empty($meta_key)) {
			return;
		}

		// Valida que la key pueda ser usada como un slug
		if ($meta_key !== sanitize_title($meta_key)) {
			return;
		}

		if (!static::enqueue_woocommerce_asset('accounting', '/js/accounting/accounting.min.js', array('jquery'))) {
			return;
		}

		if (!static::enqueue_woocommerce_asset('wc-jquery-ui-touchpunch', '/js/jquery-ui-touch-punch/jquery-ui-touch-punch.min.js', array('jquery-ui-slider'))) {
			return;
		}

		// Se requiere dejar los scripts ya cargados aun si no se pinta el widget
		static::enqueue_js();

		// Round values to nearest
		$step = max(intval($instance['step']), 1);

		$minrange_name = 'minrange_' . $meta_key;
		$maxrange_name = 'maxrange_' . $meta_key;

		$current_min_value = isset($_GET[$minrange_name]) && is_numeric($_GET[$minrange_name]) ? floor(floatval(wp_unslash($_GET[$minrange_name])) / $step) * $step : ''; // WPCS: input var ok, CSRF ok.
		$current_max_value = isset($_GET[$maxrange_name]) && is_numeric($_GET[$maxrange_name]) ? ceil(floatval(wp_unslash($_GET[$maxrange_name])) / $step) * $step : ''; // WPCS: input var ok, CSRF ok.

		// If there are not posts and we're not filtering, hide the widget.
		if (!WC_Query::get_main_query()->post_count && '' === $current_min_value && '' === $current_max_value) {
			return;
		}

		// Find min and max range in current result set.
		$range     = $this->get_filtered_range($meta_key);
		$min_value = floor($range['min_value'] / $step) * $step;
		$max_value = ceil($range['max_value'] / $step) * $step;

		// If both min and max are equal, we don't need a slider.
		if ($min_value === $max_value) {
			return;
		}

		if ('' === $current_min_value) {
			$current_min_value = $min_value;
		}

		if ('' === $current_max_value) {
			$current_max_value = $max_value;
		}

		if ($current_max_value < $current_min_value) {
			$tmp               = $current_min_value;
			$current_min_value = $current_max_value;
			$current_max_value = $tmp;
		}

		$prefix = $instance['prefix'];
		$suffix = $instance['suffix'];
		$format = $instance['format'];

		$this->widget_start($args, $instance);

		if ('' === get_option('permalink_structure')) {
			$form_action = remove_query_arg(array('page', 'paged', 'product-page'), add_query_arg($wp->query_string, '', home_url($wp->request)));
		} else {
			$form_action = preg_replace('%\/page/[0-9]+%', '', home_url(trailingslashit($wp->request)));
		}
?>
		<form method="get" action="<?php echo esc_url($form_action); ?>">
			<div class="range_slider_wrapper">
				<div class="range_slider" style="display:none;"></div>
				<div class="range_slider_amount" data-step="<?php echo esc_attr($step); ?>" data-prefix="<?php echo esc_attr($prefix); ?>" data-suffix="<?php echo esc_attr($suffix); ?>" data-format="<?php echo esc_attr($format); ?>">
					<input type="text" class="min_range" name="<?php echo esc_attr($minrange_name); ?>" value="<?php echo esc_attr($current_min_value); ?>" data-min="<?php echo esc_attr($min_value); ?>" placeholder="<?php echo esc_attr__('Valor mínimo', 'somosforma'); ?>" />
					<input type="text" class="max_range" name="<?php echo esc_attr($maxrange_name); ?>" value="<?php echo esc_attr($current_max_value); ?>" data-max="<?php echo esc_attr($max_value); ?>" placeholder="<?php echo esc_attr__('Valor máximo', 'somosforma'); ?>" />
					<div class="range_label" style="display:none;">
						<?php /* echo esc_html__( 'Price:', 'woocommerce' ); */ ?> <span class="from"></span> <!-- &mdash; --> <span class="to"></span>
					</div>
					<button type="submit" class="btn button d-none"><?php echo esc_html__('Filtrar', 'maserati'); ?></button>
					<?php wc_query_string_form_fields(null, array($minrange_name, $maxrange_name, 'paged', 'showsidebar')); ?>
					<div class="clear"></div>
				</div>
			</div>
		</form>
<?php
		$this->widget_end($args);
	}

	/**
	 * Get filtered min price for current products.
	 *
	 * @return int
	 */
	protected function get_filtered_range($meta_key)
	{
		global $wpdb;

		$tax_query  = WC_Query::get_main_tax_query();
		$meta_query = WC_Query::get_main_meta_query();

		foreach (array_keys($meta_query) as $key) {
			if (substr($key, -strlen('_range_filter')) === '_range_filter') {
				unset($meta_query[$key]);
			}
		}

		$meta_query = new WP_Meta_Query($meta_query);
		$tax_query  = new WP_Tax_Query($tax_query);
		$search     = WC_Query::get_main_search_query_sql();

		$meta_query_sql   = $meta_query->get_sql('post', $wpdb->posts, 'ID');
		$tax_query_sql    = $tax_query->get_sql($wpdb->posts, 'ID');
		$search_query_sql = $search ? ' AND ' . $search : '';

		$sql = "
			SELECT COALESCE( MIN( FLOOR( meta_value ) ), 0 ) as min_value, COALESCE( MAX( CEILING( meta_value ) ), 0 ) as max_value
			FROM {$wpdb->postmeta}
			WHERE meta_key = '" . esc_sql($meta_key) . "'
				AND meta_value IS NOT NULL
				AND TRIM( meta_value ) REGEXP '^[+-]?([0-9]*\\.)?[0-9]+$'
				AND post_id IN (
					SELECT ID FROM {$wpdb->posts}
					" . $tax_query_sql['join'] . $meta_query_sql['join'] . "
					WHERE {$wpdb->posts}.post_type IN ('" . implode("','", array_map('esc_sql', apply_filters('woocommerce_price_filter_post_type', array('product')))) . "')
					AND {$wpdb->posts}.post_status = 'publish'
					" . $tax_query_sql['where'] . $meta_query_sql['where'] . $search_query_sql . '
				)';

		/*
		$sql = "
			SELECT min( min_price ) as min_price, MAX( max_price ) as max_price
			FROM {$wpdb->wc_product_meta_lookup}
			WHERE product_id IN (
				SELECT ID FROM {$wpdb->posts}
				" . $tax_query_sql['join'] . $meta_query_sql['join'] . "
				WHERE {$wpdb->posts}.post_type IN ('" . implode( "','", array_map( 'esc_sql', apply_filters( 'woocommerce_price_filter_post_type', array( 'product' ) ) ) ) . "')
				AND {$wpdb->posts}.post_status = 'publish'
				" . $tax_query_sql['where'] . $meta_query_sql['where'] . $search_query_sql . '
			)';

		$sql = apply_filters( 'woocommerce_price_filter_sql', $sql, $meta_query_sql, $tax_query_sql );
		*/

		return $wpdb->get_row($sql, ARRAY_A); // WPCS: unprepared SQL ok.
	}

	protected static function enqueue_woocommerce_asset($name, $src, $deps = array())
	{
		if (!file_exists(WC()->plugin_path() . '/assets' . $src)) {
			return false;
		}

		if ('.css' === substr($src, -4)) {
			wp_enqueue_style($name, WC()->plugin_url() . '/assets' . $src, $deps, WC()->version);
		} else {
			wp_enqueue_script($name, WC()->plugin_url() . '/assets' . $src, $deps, WC()->version, true);
		}

		return true;
	}

	protected static function enqueue_js()
	{
		static $enqueued = false;

		if ($enqueued) {
			return;
		}

		$enqueued = true;

		$params = array(
			'num_decimals' => 0,
			'thousand_sep' => wc_get_price_thousand_separator(),
			'decimal_sep'  => wc_get_price_decimal_separator(),
		);

		wc_enqueue_js(
			'
			var params = ' . wp_json_encode($params) . ';

			$( document.body ).on( "range_slider_create range_slider_slide", ".range_slider", function( event, min, max ) {
				var $self   = $( this );
				var $amount = $self.closest( ".range_slider_wrapper" ).find( ".range_slider_amount" );
				var prefix  = $amount.data( "prefix" );
				var suffix  = $amount.data( "suffix" );
				var format  = $amount.data( "format" );

				var from = format ? accounting.formatNumber( min, params.num_decimals, params.thousand_sep, params.decimal_sep ) : min;
				var to   = format ? accounting.formatNumber( max, params.num_decimals, params.thousand_sep, params.decimal_sep ) : max;

				$amount.find( "span.from" ).html( prefix + from + suffix );
				$amount.find( "span.to" ).html( prefix + to + suffix );
				$self.trigger( "range_slider_updated", [ min, max ] );
			});

			function init_range_filters() {
				$( ".range_slider:not(.ui-slider)" ).each(function() {
					var $self   = $( this );
					var $amount = $self.closest( ".range_slider_wrapper" ).find( ".range_slider_amount" );

					$amount.find( ".min_range, .max_range" ).hide();
					$amount.find( ".range_label" ).show();
					$self.show();

					var min_range         = $amount.find( ".min_range" ).data( "min" ),
						max_range         = $amount.find( ".max_range" ).data( "max" ),
						step              = $amount.data( "step" ) || 1,
						current_min_range = $amount.find( ".min_range" ).val(),
						current_max_range = $amount.find( ".max_range" ).val();

					$self.slider({
						range: true,
						animate: true,
						min: min_range,
						max: max_range,
						step: step,
						values: [ current_min_range, current_max_range ],
						create: function() {
							$amount.find( ".min_range" ).val( current_min_range );
							$amount.find( ".max_range" ).val( current_max_range );
			
							$self.trigger( "range_slider_create", [ current_min_range, current_max_range ] );
						},
						slide: function( event, ui ) {
							$amount.find( ".min_range" ).val( ui.values[0] );
							$amount.find( ".max_range" ).val( ui.values[1] );
			
							$self.trigger( "range_slider_slide", [ ui.values[0], ui.values[1] ] );
						},
						change: function( event, ui ) {
							$self.trigger( "range_slider_change", [ ui.values[0], ui.values[1] ] );
						}
					});
				});
			}
		
			init_range_filters();
			$( document.body ).on( "init_range_filters", init_range_filters );
		
			var hasSelectiveRefresh = (
				"undefined" !== typeof wp &&
				wp.customize &&
				wp.customize.selectiveRefresh &&
				wp.customize.widgetsPreview &&
				wp.customize.widgetsPreview.WidgetPartial
			);
			if ( hasSelectiveRefresh ) {
				wp.customize.selectiveRefresh.bind( "partial-content-rendered", function() {
					init_range_filters();
				} );
			}
			'
		);
	}

	public static function product_query($query, $wc_query)
	{
		if (!$query->is_main_query()) {
			return;
		}

		/*
		// is_shop()             => is_post_type_archive( 'product' ) || is_page( wc_get_page_id( 'shop' ) );
		// is_product_taxonomy() => is_tax( get_object_taxonomies( 'product' ) )
	
		if ( ! is_shop() && ! is_product_taxonomy() ) {
			return;
		}
		*/

		if (
			!$query->is_post_type_archive('product')
			&& !($query->is_page() && absint($query->get('page_id')) === wc_get_page_id('shop'))
			&& !$query->is_tax(get_object_taxonomies('product'))
		) {
			return;
		}

		if (empty($_GET)) {
			return;
		}

		$ignore = array();

		foreach (array_keys($_GET) as $key) {
			if (0 === strpos($key, 'minrange_')) {
				$meta_key = wc_sanitize_taxonomy_name(substr($key, strlen('minrange_')));
			} elseif (0 === strpos($key, 'maxrange_')) {
				$meta_key = wc_sanitize_taxonomy_name(substr($key, strlen('maxrange_')));
			} else {
				continue;
			}

			if (empty($meta_key) || in_array($meta_key, $ignore, true)) {
				continue;
			}

			$ignore[] = $meta_key;

			$minrange_name = 'minrange_' . $meta_key;
			$maxrange_name = 'maxrange_' . $meta_key;

			$min_value = isset($_GET[$minrange_name]) && is_numeric($_GET[$minrange_name]) ? floatval(wp_unslash($_GET[$minrange_name])) : ''; // WPCS: input var ok, CSRF ok.
			$max_value = isset($_GET[$maxrange_name]) && is_numeric($_GET[$maxrange_name]) ? floatval(wp_unslash($_GET[$maxrange_name])) : ''; // WPCS: input var ok, CSRF ok.

			if ('' === $min_value && '' === $max_value) {
				continue;
			}

			if ('' !== $min_value && '' !== $max_value && $max_value < $min_value) {
				$tmp       = $min_value;
				$min_value = $max_value;
				$max_value = $tmp;
			}

			if ('' !== $min_value && '' !== $max_value) {
				$range_filter = array(
					'key'     => $meta_key,
					'value'   => array($min_value, $max_value),
					'type'    => 'NUMERIC',
					'compare' => 'BETWEEN',
				);
			} elseif ('' !== $min_value) {
				$range_filter = array(
					'key'     => $meta_key,
					'value'   => $min_value,
					'type'    => 'NUMERIC',
					'compare' => '>=',
				);
			} else { // '' !== $max_value
				$range_filter = array(
					'key'     => $meta_key,
					'value'   => $max_value,
					'type'    => 'NUMERIC',
					'compare' => '<=',
				);
			}

			$meta_query = $query->get('meta_query');
			$meta_query["{$meta_key}_range_filter"] = $range_filter;
			$query->set('meta_query', $meta_query);
		}
	}

	public static function widget_get_current_page_url($link, $widget)
	{
		if (!empty($_GET)) {
			foreach ($_GET as $key => $value) {
				if (0 === strpos($key, 'minrange_') || 0 === strpos($key, 'maxrange_')) {
					$link = add_query_arg($key, wc_clean(wp_unslash($value)), $link);
				}
			}
		}

		return $link;
	}

	public static function register_widget()
	{
		register_widget(static::class);
	}
}



add_action('widgets_init', SF_Widget_Range_Filter::class . '::register_widget');
add_action('woocommerce_product_query', SF_Widget_Range_Filter::class . '::product_query', 10, 2);
add_filter('woocommerce_widget_get_current_page_url', SF_Widget_Range_Filter::class . '::widget_get_current_page_url', 10, 2);
