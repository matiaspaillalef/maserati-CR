<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package maserati
 */

get_header();
/**
 * maserati_breadcrumbs - 5
 */
do_action('breadcrumbs_maserati');
?>
<main id="primary" class="site-main">

    <?php if (have_posts()) : ?>
        <section class="maserati-grid-modelos">
            <div class="container text-center mb-5">
                <h3 class="maserati-color--navi_blue fw-500"><?php echo __('Explora uno de nuestros modelos', 'maserati'); ?></h3>
                <h4 class="maserati-color--feature_grey"><?php echo __('El Maserati ideal para ti', 'maserati'); ?></h4>
            </div>
            <div class="container">
                <div class="row g-4">

                    <?php while (have_posts()) : the_post(); ?>
                        <div class="col-md-4 col-sm-12">
                            <?php get_template_part('template-parts/content', 'modelos'); ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
    <?php else : ?>
        <section class="maserati-grid-modelos no-found">
            <div class="container">
                <h2><?php echo __('No existen modelos que mostrar', 'maserati'); ?></h2>
            </div>
        </section>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>


    <?php get_template_part('parts/part', 'pre-owned') ?>




</main><!-- #main -->

<?php

get_footer();
