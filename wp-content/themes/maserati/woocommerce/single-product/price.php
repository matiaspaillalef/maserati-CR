<?php

/**
 * Single Product Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

global $product;

?>
<h5 class="<?php echo esc_attr(apply_filters('woocommerce_product_price_class', 'price')); ?> text-center maserati-color--navi_blue">
    <?php echo $product->get_price_html(); ?>
    <button type="button" class="maserati-disclamers cursor" data-bs-target="#disclamersModal" data-bs-toggle="modal">
        <span data-bs-placement="bottom" data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="Terminos y Condiciones" data-bs-original-title="" title="">
            <i class="fa-solid fa-exclamation"></i>
        </span>
    </button>
</h5>