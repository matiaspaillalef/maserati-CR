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

$archive_id  = get_queried_object();
//print_r($archive_id ->ID)
?>
<main id="primary" class="site-main">

    <?php get_template_part('parts/part', 'banner-page'); ?>

    <?php

    if (have_posts()) :
    ?>
        <section class="maserati-grid-modelos">
            <div class="container">
                <?php get_template_part('searchform'); ?>
                <div class="row g-4">

                    <?php while (have_posts()) : the_post(); ?>
                        <div class="col-md-4 col-sm-12">
                            <?php get_template_part('template-parts/content', 'card-post'); ?>
                        </div>
                    <?php endwhile;
                    //the_posts_navigation();

                    the_posts_pagination(array(
                        'mid_size' => 6,
                        'prev_text' => '<i class="icon-arrow-left"></i>',
                        'next_text' => '<i class="icon-arrow-right"></i>',
                        //'screen_reader_text' => __( 'Titulo', 'maserati' ),
                    ));
                    ?>

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
