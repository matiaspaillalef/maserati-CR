<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

get_header('shop');

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
//do_action('woocommerce_before_main_content');

global $wp_query, $wp;

$post_id = get_option('woocommerce_shop_page_id'); // Traemos el ID del shop

$banner_shop = get_field('banner_shop', $post_id);
$size = 'full';

$current_url = preg_replace('%\/page/[0-9]+%', '', home_url(trailingslashit($wp->request)));

?>



<?php if ($banner_shop) : ?>
    <div class="maserati-banner-shop">
        <?php wp_is_mobile() ? '' : do_action('breadcrumbs_maserati'); ?>
        <?php echo wp_get_attachment_image($banner_shop, $size); ?>
        <?php if (have_rows('content_shop', $post_id)) : ?>
            <?php while (have_rows('content_shop', $post_id)) : the_row(); ?>
                <div class="container">
                    <div class="inner-container">
                        <h3><?php the_sub_field('titulo_shop'); ?></h3>
                        <h4 class="title-line"><?php the_sub_field('tsubitulo_shop'); ?></h4>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
<?php endif; ?>




<section class="maserati-archive-product">
    <div class="container">
        <?php if (is_search() && false) :
            /*$resultSearch = new WP_Query("s=$s&showposts=0");*/
        ?>
            <h3 class="text-center"><?php printf($wp_query->found_posts . ' ' .  esc_html__('resultados para: %s', 'maserati'), '<span>"' . get_search_query() . '"</span>'); ?></h3>
        <?php elseif (!is_tax()) : ?>
            <h3 class="text-center"><?php _e('Elige uno de nuestros modelos', 'maserati'); ?></h3>
        <?php endif; ?>


        <div class="row">

            <?php
            echo wp_is_mobile() ? '<div class="sidebar-overlay"></div>' : '';

            //get_template_part('inc/sidebar-shop');

            //$show_sidebar = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 'xmlhttprequest' === strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_REQUEST['showsidebar']);

            ?>
            <div class="col-md-3 col-sm-12 sidebar-filter <?php echo wp_is_mobile() ? 'mobile-sidebar' : ''; ?>">

                <?php echo wp_is_mobile() ? '<i class="icon-close"></i>' : ''; ?>

                <?php
                $_chosen_attributes = WC_Query::get_layered_nav_chosen_attributes();

                $minrange_name = 'minrange_year';
                $maxrange_name = 'maxrange_year';

                $current_min_value = isset($_GET[$minrange_name]) && is_numeric($_GET[$minrange_name]) ? floor(floatval(wp_unslash($_GET[$minrange_name]))) : ''; // WPCS: input var ok, CSRF ok.
                $current_max_value = isset($_GET[$maxrange_name]) && is_numeric($_GET[$maxrange_name]) ? ceil(floatval(wp_unslash($_GET[$maxrange_name]))) : ''; // WPCS: input var ok, CSRF ok.


                if ($_chosen_attributes || ($current_min_value || $current_max_value)) : ?>
                    <div class="maserati-filter-selected">
                        <h5><?php echo __('Filtro seleccionado', 'maserati'); ?></h5>
                        <div id="tags-filter">
                            <ul>

                                <?php

                                if ('' !== $current_min_value && '' !== $current_max_value) {
                                    $link = remove_query_arg(array('add-to-cart', $minrange_name, $maxrange_name), get_pagenum_link(1, false));
                                    echo '<li>' . esc_html($current_min_value . '-' . $current_max_value)  . ' <a href="' . esc_url($link) . '"> <i class="icon-close"></i></a></li>';
                                }


                                foreach ($_chosen_attributes as $taxonomy => $values) {
                                    $attribute   = wc_attribute_taxonomy_slug($taxonomy);
                                    $filter_name = "filter_$attribute";
                                    $link        = remove_query_arg(array('add-to-cart', $filter_name), get_pagenum_link(1, false));

                                    if (count($values['terms']) == 1) {
                                        $term = get_term_by('slug', $values['terms'][0], $taxonomy);
                                        if (!$term) {
                                            continue;
                                        }

                                        $link = remove_query_arg("query_type_$attribute", $link);

                                        echo '<li>' . esc_html($term->name) . ' <a href="' . esc_url($link) . '"> <i class="icon-close"></i></a></li>';
                                    } else {
                                        foreach ($values['terms'] as $index => $term_slug) {
                                            $term = get_term_by('slug', $term_slug, $taxonomy);
                                            if (!$term) {
                                                continue;
                                            }

                                            $new_terms = array_slice($values['terms'], 0, $index) + array_slice($values['terms'], $index + 1);
                                            $link      = add_query_arg($filter_name, implode(',', $new_terms), $link);

                                            echo '<li>' . esc_html($term->name) . ' <a href="' . esc_url($link) . '"> <i class="icon-close"></i></i></a></li>';
                                        }
                                    }
                                }


                                ?>

                            </ul>
                        </div>
                    </div>
                <?php endif; ?>

                <?php

                do_action('woocommerce_sidebar');
                if (!wp_is_mobile()) {
                    if (!empty(WC_Query::get_layered_nav_chosen_attributes()) || ($current_min_value || $current_max_value)) {
                        echo '<a rel="nofollow" class="maserati-button maserati-button_large maserati-back--transparent_navy clear-filter" href="' . esc_url($current_url) . '">Limpiar filtros</a>';
                    }
                }
                ?>

                <?php echo wp_is_mobile() ? '<button class="maserati-button maserati-button_large maserati-back--navi_blue marginX-auto filter-button cursor mt-5">Filtrar</button>' : ''; ?>
            </div>



            <div class="col-md-9 col-sm-12 product-list" id="product-list">
                <?php

                get_product_search_form();
                ?>

                <?php if (wp_is_mobile()) : ?>
                    <div class="row">
                        <div class="col-6">
                            <p class="maserati-filter-toggle cursor"><span><?php echo __('Filtros', 'maserati'); ?></span> <i class="icon-arrow-down"></i></p>
                        </div>
                        <div class="col-6">
                            <?php
                            if (!empty(WC_Query::get_layered_nav_chosen_attributes()) || ($current_min_value || $current_max_value)) {
                                echo '<a rel="nofollow" href="' . esc_url($current_url) . '">Limpiar filtros <i class="icon-less"></i></a>';
                            }
                            ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php
                /**
                 * Hook: woocommerce_before_shop_loop.
                 *
                 * @hooked woocommerce_output_all_notices - 10
                 * @hooked woocommerce_result_count - 20
                 * @hooked woocommerce_catalog_ordering - 30
                 */
                do_action('woocommerce_before_shop_loop');
                ?>

                <?php
                if (woocommerce_product_loop()) {
                    woocommerce_product_loop_start();

                    if (wc_get_loop_prop('total')) {
                        while (have_posts()) {
                            the_post();

                            /**
                             * Hook: woocommerce_shop_loop.
                             */
                            do_action('woocommerce_shop_loop');

                            wc_get_template_part('content', 'product');
                        }
                    }

                    woocommerce_product_loop_end();
                } else {
                    /**
                     * Hook: woocommerce_no_products_found.
                     *
                     * @hooked wc_no_products_found - 10
                     */
                    do_action('woocommerce_no_products_found');
                }
                /**
                 * Hook: woocommerce_after_shop_loop.
                 *
                 * @hooked woocommerce_pagination - 10
                 */
                do_action('woocommerce_after_shop_loop');

                ?>
            </div>
        </div>
    </div>
</section>

<?php get_template_part('parts/part', 'personalizable') ?>
<?php get_template_part('parts/part', 'contacto') ?>

<?php


/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action('woocommerce_after_main_content');


get_footer('shop');
