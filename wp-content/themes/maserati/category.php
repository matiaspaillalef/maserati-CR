<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package maserati
 */

get_header();
//$categories = get_the_category();
$current_category = get_queried_object();
$category_id = $current_category->term_id;
$taxonomy_prefix = 'category';
$term_id = $category_id;
$term_id_prefixed = $taxonomy_prefix . '_' . $term_id;

$current_value = $_GET['order'] ?? ''; //En el function se cambian los valores orden_post_categorias()

global $wp_query, $query_vars;


get_template_part('parts/part', 'banner-page');
?>

<main id="primary" class="site-main">
    <?php
    if (have_posts()) : ?>
        <section class="maserati-all-news post-grid category-post">
            <div class="container">
                <?php get_search_form(); ?>
                <div class="row ">
                    <div class="col-md-6 col-sm-12">
                        <?php echo get_field('titulo_after_search', $term_id_prefixed) ? '<h3 class="fw-500">' . get_field('titulo_after_search', $term_id_prefixed) . '</h3>' : ''; ?>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <form method="GET">
                            <div class="dropdowwn dropdown-maserati">
                                <select name="order" class="form-select">
                                    <option value="nuevos" <?php selected($current_value, 'nuevos', true); ?>>Nuevos</option>
                                    <option value="antiguos" <?php selected($current_value, 'antiguos', true); ?>>Antiguos</option>
                                    <option value="az" <?php selected($current_value, 'az', true); ?>>A-Z</option>
                                    <option value="za" <?php selected($current_value, 'za', true); ?>>Z-A</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">

                    <?php
                    /* Start the Loop */
                    while (have_posts()) : the_post(); ?>
                        <div class="col-md-4 col-sm-12">
                            <?php get_template_part('template-parts/content', 'category'); ?>
                        </div>
                    <?php endwhile;

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
    <?php get_template_part('parts/part', 'newsletter');

    else :

        get_template_part('template-parts/content', 'none');

    endif;
    ?>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
