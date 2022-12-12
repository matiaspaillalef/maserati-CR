<?php

/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */

if (!defined('ABSPATH')) {
    exit;
}

if ($related_products) : ?>

    <section class="related products maserati-bg--off_white">
        <div class="container">
            <?php
            $heading = apply_filters('woocommerce_product_related_products_heading', __('Explora otros modelos', 'maserati'));

            if ($heading) :
            ?>
                <h3 class="title-related text-center maserati-color--navi_blue"><?php echo esc_html($heading); ?></h3>
            <?php endif; ?>

            <?php woocommerce_product_loop_start(); ?>


            <div class="swiper related-pre-owned">
                <div class="swiper-wrapper">
                    <?php foreach ($related_products as $related_product) : ?>
                        <div class="swiper-slide">
                            <?php
                            $post_object = get_post($related_product->get_id());

                            setup_postdata($GLOBALS['post'] = &$post_object); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

                            wc_get_template_part('content', 'product');
                            ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php woocommerce_product_loop_end(); ?>
        </div>
    </section>
<?php
endif;

wp_reset_postdata();
