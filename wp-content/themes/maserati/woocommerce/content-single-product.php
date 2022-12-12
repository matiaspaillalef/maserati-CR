<?php

/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;


/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}

?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>
    <?php
    /**
     * maserati_breadcrumbs - 5
     */
    do_action('breadcrumbs_maserati');
    ?>
    <div class="container <?php echo wp_is_mobile() ? 'full-container' : ''; ?>">
        <?php
        /**
         * Hook: woocommerce_before_single_product_summary.
         *
         * @hooked woocommerce_show_product_sale_flash - 10
         * @hooked woocommerce_show_product_images - 20
         */
        do_action('woocommerce_before_single_product_summary');
        ?>

        <div class="summary entry-summary">
            <?php
            /**
             * Hook: woocommerce_single_product_summary.
             *
             * @hooked woocommerce_template_single_title - 5
             * @hooked woocommerce_template_single_rating - 10
             * @hooked woocommerce_template_single_price - 10
             * @hooked woocommerce_template_single_excerpt - 20
             * @hooked woocommerce_template_single_add_to_cart - 30
             * @hooked woocommerce_template_single_meta - 40
             * @hooked woocommerce_template_single_sharing - 50
             * @hooked WC_Structured_Data::generate_product_data() - 60
             */
            do_action('woocommerce_single_product_summary');
            ?>
        </div>
    </div>
    <?php
    /**
     * Hook: woocommerce_after_single_product_summary.
     *
     * @hooked woocommerce_output_product_data_tabs - 10
     * @hooked woocommerce_upsell_display - 15
     * @hooked woocommerce_output_related_products - 20
     */
    do_action('woocommerce_after_single_product_summary');
    ?>

</div>

<?php get_template_part('parts/part', 'personalizable') ?>

<?php do_action('woocommerce_after_single_product'); ?>

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